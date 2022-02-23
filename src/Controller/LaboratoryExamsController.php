<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * LaboratoryExams Controller
 *
 * @property \App\Model\Table\LaboratoryExamsTable $LaboratoryExams
 * @method \App\Model\Entity\LaboratoryExam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LaboratoryExamsController extends AppController
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
        $description = $this->getRequest()->getQuery('description');
        $state = $this->getRequest()->getQuery('state');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->LaboratoryExams->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['LaboratoryExams.id' => $id]);
        }
    
        if ($description) {
           $query->where(['LaboratoryExams.description' => $description]);
        }
    
        if ($state) {
           $query->where(['LaboratoryExams.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $laboratoryExams = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['LaboratoryExams'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('laboratoryExams', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Laboratory Exam id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view($id = null) {
        $this->getRequest()->allowMethod("GET");
        $laboratoryExam = $this->LaboratoryExams->get($id, [
            'contain' => ['Appointments'],
        ]);

        $this->set(compact('laboratoryExam'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $laboratoryExam = $this->LaboratoryExams->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->LaboratoryExams->save($laboratoryExam)) {
            $message = __('El laboratory exam fue registrado correctamente');
        }
        else {
            $message = __('El laboratory exam no fue registrado correctamente');
            $errors = $laboratoryExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('laboratoryExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Laboratory Exam id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $laboratoryExam = $this->LaboratoryExams->patchEntity(
            $this->LaboratoryExams->get($id), $this->request->getData()
        );
        $errors = null;
        
        if ($this->LaboratoryExams->save($laboratoryExam)) {
            $message = __('El laboratory exam fue modificado correctamente');
        } else {
            $message = __('El laboratory exam no fue modificado correctamente');
            $errors = $laboratoryExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('laboratoryExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Enable method
     *
     * @param string|null $id Laboratory Exam id.
     * @return \Cake\Http\Response|null|void Redirects on successful enable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $laboratoryExam = $this->LaboratoryExams->get($id);
        $laboratoryExam->state = 1;
        $errors = null;
        
        if ($this->LaboratoryExams->save($laboratoryExam)) {
            $message = __('El laboratory exam fue habilitado correctamente');
        } else {
            $message = __('El laboratory exam no fue habilitado correctamente');
            $errors = $laboratoryExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('laboratoryExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Disable method
     *
     * @param string|null $id Laboratory Exam id.
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $laboratoryExam = $this->LaboratoryExams->get($id);
        $laboratoryExam->state = 2;
        $errors = null;
        
        if ($this->LaboratoryExams->save($laboratoryExam)) {
            $message = __('El laboratory exam fue deshabilitado correctamente');
        } else {
            $message = __('El laboratory exam no fue deshabilitado correctamente');
            $errors = $laboratoryExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('laboratoryExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
