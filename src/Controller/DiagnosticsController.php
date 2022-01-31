<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Diagnostics Controller
 *
 * @property \App\Model\Table\DiagnosticsTable $Diagnostics
 * @method \App\Model\Entity\Diagnostic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiagnosticsController extends AppController
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
        $appointmentId = $this->getRequest()->getQuery('appointment_id');
        $diseaseId = $this->getRequest()->getQuery('disease_id');
        $state = $this->getRequest()->getQuery('state');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->Diagnostics->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['Diagnostics.id' => $id]);
        }
    
        if ($appointmentId) {
           $query->where(['Diagnostics.appointment_id' => $appointmentId]);
        }
    
        if ($diseaseId) {
           $query->where(['Diagnostics.disease_id' => $diseaseId]);
        }
    
        if ($state) {
           $query->where(['Diagnostics.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $this->paginate = [
            'contain' => ['Appointments', 'Diseases'],
        ];
        $diagnostics = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['Diagnostics'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('diagnostics', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Diagnostic id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view($id = null) {
        $this->getRequest()->allowMethod("GET");
        $diagnostic = $this->Diagnostics->get($id, [
            'contain' => ['Appointments', 'Diseases'],
        ]);

        $this->set(compact('diagnostic'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $diagnostic = $this->Diagnostics->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->Diagnostics->save($diagnostic)) {
            $message = __('El diagnostic fue registrado correctamente');
        }
        else {
            $message = __('El diagnostic no fue registrado correctamente');
            $errors = $diagnostic->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('diagnostic', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Diagnostic id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $diagnostic = $this->Diagnostics->patchEntity(
            $this->Diagnostics->get($id), $this->request->getData()
        );
        $errors = null;
        
        if ($this->Diagnostics->save($diagnostic)) {
            $message = __('El diagnostic fue modificado correctamente');
        } else {
            $message = __('El diagnostic no fue modificado correctamente');
            $errors = $diagnostic->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('diagnostic', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Enable method
     *
     * @param string|null $id Diagnostic id.
     * @return \Cake\Http\Response|null|void Redirects on successful enable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $diagnostic = $this->Diagnostics->get($id);
        $diagnostic->state = 1;
        $errors = null;
        
        if ($this->Diagnostics->save($diagnostic)) {
            $message = __('El diagnostic fue habilitado correctamente');
        } else {
            $message = __('El diagnostic no fue habilitado correctamente');
            $errors = $diagnostic->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('diagnostic', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Disable method
     *
     * @param string|null $id Diagnostic id.
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $diagnostic = $this->Diagnostics->get($id);
        $diagnostic->state = 2;
        $errors = null;
        
        if ($this->Diagnostics->save($diagnostic)) {
            $message = __('El diagnostic fue deshabilitado correctamente');
        } else {
            $message = __('El diagnostic no fue deshabilitado correctamente');
            $errors = $diagnostic->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('diagnostic', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
