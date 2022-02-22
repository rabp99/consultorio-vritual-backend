<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Appointments Controller
 *
 * @property \App\Model\Table\AppointmentsTable $Appointments
 * @method \App\Model\Entity\Appointment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppointmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->getRequest()->allowMethod('GET');
        $sortColumn = $this->getRequest()->getQuery('sort_column');
        $sortOrder = $this->getRequest()->getQuery('sort_order');
        $appointmentDate = $this->getRequest()->getQuery('appointment_date');
        $state = is_string($this->getRequest()->getQuery('state')) ?
            explode(',', $this->getRequest()->getQuery('state')) : null;

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->Appointments->find();

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        // filters
        if ($appointmentDate) {
            $query->where(["DATE_FORMAT(Appointments.appointment_date, '%Y-%m-%d') =" => $appointmentDate]);
        }

        if ($state) {
            $query->where(['Appointments.state IN' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $this->paginate = [
            'contain' => [
                'ConsultingRooms',
                'Employees' => 'EmployeePerson',
                'Patients' => 'PatientPerson',
            ],
        ];
        $appointments = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['Appointments'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(['appointments' => $appointments, 'pagination' => $pagination, 'count' => $count]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $appointment = $this->Appointments->get($id, [
            'contain' => ['Patients' => 'People', 'Employees' => 'People', 'ConsultingRooms', 'Diagnostics', 'Recipes'],
        ]);

        $this->set(['appointment' => $appointment]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Get to edit method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function getToEdit($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $appointment = $this->Appointments->get($id, [
            'contain' => ['Patients' => 'People', 'Employees' => 'People'],
        ]);

        $this->set(['appointment' => $appointment]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->getRequest()->allowMethod('POST');
        $appointment = $this->Appointments->newEntity($this->getRequest()->getData());
        $errors = null;
        $message = null;

        try {
            $this->Appointments->getConnection()->begin();
            $this->Appointments->saveOrFail($appointment);
            $message = __('La cita fue registrada correctamente');
            $this->Appointments->getConnection()->commit();
        } catch (\PDOException | \Cake\ORM\Exception\PersistenceFailedException $ex) {
            $message = __('La cita no fue registrada correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
            $this->Appointments->getConnection()->rollback();
        } finally {
            $this->set(['appointment' => $appointment, 'message' => $message, 'errors' => $errors]);
            $this->viewBuilder()->setOption('serialize', true);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $appointment = $this->Appointments->patchEntity(
            $this->Appointments->get($id),
            $this->request->getData()
        );
        $errors = null;

        if (in_array($appointment->state, ['PENDIENTE', 'REPROGRAMADA'])) {
            if ($this->Appointments->save($appointment)) {
                $message = __('La cita fue modificada correctamente');
            } else {
                $message = __('La cita no fue modificada correctamente');
                $errors = $appointment->getErrors();
                $this->setResponse($this->getResponse()->withStatus(500));
            }
        } else {
            $message = __('La cita no fue modificada correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['appointment' => $appointment, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Cancel method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cancel()
    {
        $this->getRequest()->allowMethod(['DELETE']);
        $id = $this->getRequest()->getParam('id');
        $appointment = $this->Appointments->get($id);
        $errors = null;

        if (in_array($appointment->state, ['PENDIENTE', 'REPROGRAMADA'])) {
            if ($this->Appointments->cancel($appointment)) {
                $message = __('La cita fue cancelada correctamente');
            } else {
                $message = __('La cita no fue cancelada correctamente');
                $errors = $appointment->getErrors();
                $this->setResponse($this->getResponse()->withStatus(500));
            }
        } else {
            $message = __('La cita no fue cancelada correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['appointment' => $appointment, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Undo Cancel method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function undoCancel()
    {
        $this->getRequest()->allowMethod(['PUT']);
        $id = $this->getRequest()->getParam('id');
        $appointment = $this->Appointments->get($id);
        $errors = null;

        if ($appointment->state === 'CANCELADA') {
            if ($this->Appointments->undoCancel($appointment)) {
                $message = __('Se anuló la cancelación de la cita correctamente');
            } else {
                $message = __('No se pudo anular la cancelación de la cita');
                $errors = $appointment->getErrors();
                $this->setResponse($this->getResponse()->withStatus(500));
            }
        } else {
            $message = __('No se pudo anular la cancelación de la cita');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['appointment' => $appointment, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Reschedule method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function reschedule()
    {
        $this->getRequest()->allowMethod(['PUT']);
        $id = $this->getRequest()->getParam('id');
        $appointment = $this->Appointments->patchEntity(
            $this->Appointments->get($id),
            $this->request->getData()
        );
        $errors = null;

        if (in_array($appointment->state, ['PENDIENTE', 'REPROGRAMADA'])) {
            if ($this->Appointments->reschedule($appointment)) {
                $message = __('La cita fue reprogramada correctamente');
            } else {
                $message = __('La cita no fue reprogramada correctamente');
                $errors = $appointment->getErrors();
                $this->setResponse($this->getResponse()->withStatus(500));
            }
        } else {
            $message = __('La cita no fue reprogramada correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['appointment' => $appointment, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Attend method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function attend()
    {
        $this->getRequest()->allowMethod('PUT');
        $id = $this->getRequest()->getParam('id');
        $appointment = $this->Appointments->patchEntity(
            $this->Appointments->get($id),
            $this->request->getData()
        );
        $errors = null;

        if ($this->Appointments->attend($appointment)) {
            $message = __('Se registró la atención correctamente');
        } else {
            $message = __('No se registró la atención correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['appointment' => $appointment, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Get by Patient method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function getByPatient()
    {
        $this->getRequest()->allowMethod('GET');
        $patient_person_doc_type = $this->getRequest()->getParam('patient_person_doc_type');
        $patient_person_doc_num = $this->getRequest()->getParam('patient_person_doc_num');

        $appointments = $this->Appointments->find('byPatient', [
            'patient_person_doc_type' => $patient_person_doc_type,
            'patient_person_doc_num' => $patient_person_doc_num,
        ]);

        $this->set(['appointments' => $appointments]);
        $this->viewBuilder()->setOption('serialize', true);
    }
}
