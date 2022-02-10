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
        $appointmentDate = $this->getRequest()->getQuery('appointment_date');
        $state = explode(',', $this->getRequest()->getQuery('state'));

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->Appointments->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($appointmentDate) {
           $query->where(['Appointments.appointment_date' => $appointmentDate]);
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
                'Employees' => 'People',
                'Patients' => 'People'
            ],
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
