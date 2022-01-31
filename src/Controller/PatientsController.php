<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientsController extends AppController
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
        $personDocType = $this->getRequest()->getQuery('person_doc_type');
        $personDocNum = $this->getRequest()->getQuery('person_doc_num');
        $state = $this->getRequest()->getQuery('state');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->Patients->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['Patients.id' => $id]);
        }
    
        if ($personDocType) {
           $query->where(['Patients.person_doc_type' => $personDocType]);
        }
    
        if ($personDocNum) {
           $query->where(['Patients.person_doc_num' => $personDocNum]);
        }
    
        if ($state) {
           $query->where(['Patients.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $patients = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['Patients'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('patients', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view() {
        $this->getRequest()->allowMethod("GET");
        $personDocType = $this->getRequest()->getParam('person_doc_type');
        $personDocNum = $this->getRequest()->getParam('person_doc_num');
        $patient = $this->Patients->get([$personDocType, $personDocNum], [
            'contain' => [],
        ]);

        $this->set(compact('patient'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $patient = $this->Patients->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->Patients->save($patient)) {
            $message = __('El patient fue registrado correctamente');
        }
        else {
            $message = __('El patient no fue registrado correctamente');
            $errors = $patient->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('patient', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $personDocType = $this->getRequest()->getParam('person_doc_type');
        $personDocNum = $this->getRequest()->getParam('person_doc_num');
        $patient = $this->Patients->patchEntity(
            $this->Patients->get([$personDocType, $personDocNum]), $this->request->getData()
        );
        $errors = null;
        
        if ($this->Patients->save($patient)) {
            $message = __('El patient fue modificado correctamente');
        } else {
            $message = __('El patient no fue modificado correctamente');
            $errors = $patient->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('patient', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Enable method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Redirects on successful enable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable() {
        $this->getRequest()->allowMethod(['POST']);
        $personDocType = $this->getRequest()->getData('person_doc_type');
        $personDocNum = $this->getRequest()->getData('person_doc_num');
        $patient = $this->Patients->get([$personDocType, $personDocNum]);
        $patient->state = 1;
        $errors = null;
        
        if ($this->Patients->save($patient)) {
            $message = __('El patient fue habilitado correctamente');
        } else {
            $message = __('El patient no fue habilitado correctamente');
            $errors = $patient->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('patient', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Disable method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable() {
        $this->getRequest()->allowMethod(['POST']);
        $personDocType = $this->getRequest()->getData('person_doc_type');
        $personDocNum = $this->getRequest()->getData('person_doc_num');
        $patient = $this->Patients->get([$personDocType, $personDocNum]);
        $patient->state = 2;
        $errors = null;
        
        if ($this->Patients->save($patient)) {
            $message = __('El patient fue deshabilitado correctamente');
        } else {
            $message = __('El patient no fue deshabilitado correctamente');
            $errors = $patient->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('patient', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
