<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * ImagingExams Controller
 *
 * @property \App\Model\Table\ImagingExamsTable $ImagingExams
 * @method \App\Model\Entity\ImagingExam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ImagingExamsController extends AppController
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
       
        $query = $this->ImagingExams->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['ImagingExams.id' => $id]);
        }
    
        if ($description) {
           $query->where(['ImagingExams.description' => $description]);
        }
    
        if ($state) {
           $query->where(['ImagingExams.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $imagingExams = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['ImagingExams'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('imagingExams', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Imaging Exam id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view($id = null) {
        $this->getRequest()->allowMethod("GET");
        $imagingExam = $this->ImagingExams->get($id, [
            'contain' => ['Appointments'],
        ]);

        $this->set(compact('imagingExam'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $imagingExam = $this->ImagingExams->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->ImagingExams->save($imagingExam)) {
            $message = __('El imaging exam fue registrado correctamente');
        }
        else {
            $message = __('El imaging exam no fue registrado correctamente');
            $errors = $imagingExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('imagingExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Imaging Exam id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $imagingExam = $this->ImagingExams->patchEntity(
            $this->ImagingExams->get($id), $this->request->getData()
        );
        $errors = null;
        
        if ($this->ImagingExams->save($imagingExam)) {
            $message = __('El imaging exam fue modificado correctamente');
        } else {
            $message = __('El imaging exam no fue modificado correctamente');
            $errors = $imagingExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('imagingExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Enable method
     *
     * @param string|null $id Imaging Exam id.
     * @return \Cake\Http\Response|null|void Redirects on successful enable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $imagingExam = $this->ImagingExams->get($id);
        $imagingExam->state = 1;
        $errors = null;
        
        if ($this->ImagingExams->save($imagingExam)) {
            $message = __('El imaging exam fue habilitado correctamente');
        } else {
            $message = __('El imaging exam no fue habilitado correctamente');
            $errors = $imagingExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('imagingExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Disable method
     *
     * @param string|null $id Imaging Exam id.
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $imagingExam = $this->ImagingExams->get($id);
        $imagingExam->state = 2;
        $errors = null;
        
        if ($this->ImagingExams->save($imagingExam)) {
            $message = __('El imaging exam fue deshabilitado correctamente');
        } else {
            $message = __('El imaging exam no fue deshabilitado correctamente');
            $errors = $imagingExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('imagingExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
