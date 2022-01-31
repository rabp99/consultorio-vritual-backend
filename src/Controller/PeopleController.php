<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * People Controller
 *
 * @property \App\Model\Table\PeopleTable $People
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PeopleController extends AppController
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
        $docType = $this->getRequest()->getQuery('doc_type');
        $docNum = $this->getRequest()->getQuery('doc_num');
        $names = $this->getRequest()->getQuery('names');
        $lastName1 = $this->getRequest()->getQuery('last_name1');
        $lastName2 = $this->getRequest()->getQuery('last_name2');
        $birth = $this->getRequest()->getQuery('birth');
        $nationality = $this->getRequest()->getQuery('nationality');
        $gendre = $this->getRequest()->getQuery('gendre');
        $tels = $this->getRequest()->getQuery('tels');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->People->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($docType) {
           $query->where(['People.doc_type' => $docType]);
        }
    
        if ($docNum) {
           $query->where(['People.doc_num' => $docNum]);
        }
    
        if ($names) {
           $query->where(['People.names' => $names]);
        }
    
        if ($lastName1) {
           $query->where(['People.last_name1' => $lastName1]);
        }
    
        if ($lastName2) {
           $query->where(['People.last_name2' => $lastName2]);
        }
    
        if ($birth) {
           $query->where(['People.birth' => $birth]);
        }
    
        if ($nationality) {
           $query->where(['People.nationality' => $nationality]);
        }
    
        if ($gendre) {
           $query->where(['People.gendre' => $gendre]);
        }
    
        if ($tels) {
           $query->where(['People.tels' => $tels]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $people = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['People'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('people', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view() {
        $this->getRequest()->allowMethod("GET");
        $docType = $this->getRequest()->getParam('doc_type');
        $docNum = $this->getRequest()->getParam('doc_num');
        $person = $this->People->get([$docType, $docNum], [
            'contain' => [],
        ]);

        $this->set(compact('person'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $person = $this->People->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->People->save($person)) {
            $message = __('El person fue registrado correctamente');
        }
        else {
            $message = __('El person no fue registrado correctamente');
            $errors = $person->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('person', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $docType = $this->getRequest()->getParam('doc_type');
        $docNum = $this->getRequest()->getParam('doc_num');
        $person = $this->People->patchEntity(
            $this->People->get([$docType, $docNum]), $this->request->getData()
        );
        $errors = null;
        
        if ($this->People->save($person)) {
            $message = __('El person fue modificado correctamente');
        } else {
            $message = __('El person no fue modificado correctamente');
            $errors = $person->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('person', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Person id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {    
        $this->getRequest()->allowMethod("DELETE");
        $person = $this->People->get($id);
        $errors = null;
        
        if ($this->People->delete($person)) {
            $message = __('El person fue eliminado correctamente');
        } else {
            $message = __('El person no fue eliminado correctamente');
            $errors = $person->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('person', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
