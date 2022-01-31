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
    public function index() {
        $this->getRequest()->allowMethod("GET");
        $sortColumn = $this->getRequest()->getQuery("sort_column");
        $sortOrder = $this->getRequest()->getQuery("sort_order");
        $id = $this->getRequest()->getQuery('id');
        $patientPersonDocType = $this->getRequest()->getQuery('patient_person_doc_type');
        $patientPersonDocNum = $this->getRequest()->getQuery('patient_person_doc_num');
        $employeePersonDocType = $this->getRequest()->getQuery('employee_person_doc_type');
        $employeePersonDocNum = $this->getRequest()->getQuery('employee_person_doc_num');
        $consultingRoomId = $this->getRequest()->getQuery('consulting_room_id');
        $appointmentDate = $this->getRequest()->getQuery('appointment_date');
        $cost = $this->getRequest()->getQuery('cost');
        $state = $this->getRequest()->getQuery('state');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->Appointments->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['Appointments.id' => $id]);
        }
    
        if ($patientPersonDocType) {
           $query->where(['Appointments.patient_person_doc_type' => $patientPersonDocType]);
        }
    
        if ($patientPersonDocNum) {
           $query->where(['Appointments.patient_person_doc_num' => $patientPersonDocNum]);
        }
    
        if ($employeePersonDocType) {
           $query->where(['Appointments.employee_person_doc_type' => $employeePersonDocType]);
        }
    
        if ($employeePersonDocNum) {
           $query->where(['Appointments.employee_person_doc_num' => $employeePersonDocNum]);
        }
    
        if ($consultingRoomId) {
           $query->where(['Appointments.consulting_room_id' => $consultingRoomId]);
        }
    
        if ($appointmentDate) {
           $query->where(['Appointments.appointment_date' => $appointmentDate]);
        }
    
        if ($cost) {
           $query->where(['Appointments.cost' => $cost]);
        }
    
        if ($state) {
           $query->where(['Appointments.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $this->paginate = [
            'contain' => ['ConsultingRooms'],
        ];
        $appointments = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['Appointments'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('appointments', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view($id = null) {
        $this->getRequest()->allowMethod("GET");
        $appointment = $this->Appointments->get($id, [
            'contain' => ['ConsultingRooms', 'Diagnostics', 'Recipes'],
        ]);

        $this->set(compact('appointment'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $appointment = $this->Appointments->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->Appointments->save($appointment)) {
            $message = __('El appointment fue registrado correctamente');
        }
        else {
            $message = __('El appointment no fue registrado correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('appointment', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $appointment = $this->Appointments->patchEntity(
            $this->Appointments->get($id), $this->request->getData()
        );
        $errors = null;
        
        if ($this->Appointments->save($appointment)) {
            $message = __('El appointment fue modificado correctamente');
        } else {
            $message = __('El appointment no fue modificado correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('appointment', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Enable method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Redirects on successful enable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $appointment = $this->Appointments->get($id);
        $appointment->state = 1;
        $errors = null;
        
        if ($this->Appointments->save($appointment)) {
            $message = __('El appointment fue habilitado correctamente');
        } else {
            $message = __('El appointment no fue habilitado correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('appointment', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Disable method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $appointment = $this->Appointments->get($id);
        $appointment->state = 2;
        $errors = null;
        
        if ($this->Appointments->save($appointment)) {
            $message = __('El appointment fue deshabilitado correctamente');
        } else {
            $message = __('El appointment no fue deshabilitado correctamente');
            $errors = $appointment->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('appointment', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
