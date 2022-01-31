<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Diseases Controller
 *
 * @property \App\Model\Table\DiseasesTable $Diseases
 * @method \App\Model\Entity\Disease[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiseasesController extends AppController
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
       
        $query = $this->Diseases->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['Diseases.id' => $id]);
        }
    
        if ($description) {
           $query->where(['Diseases.description' => $description]);
        }
    
        if ($state) {
           $query->where(['Diseases.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $diseases = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['Diseases'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('diseases', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Disease id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view($id = null) {
        $this->getRequest()->allowMethod("GET");
        $disease = $this->Diseases->get($id, [
            'contain' => ['Diagnostics'],
        ]);

        $this->set(compact('disease'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $disease = $this->Diseases->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->Diseases->save($disease)) {
            $message = __('El disease fue registrado correctamente');
        }
        else {
            $message = __('El disease no fue registrado correctamente');
            $errors = $disease->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('disease', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Disease id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $disease = $this->Diseases->patchEntity(
            $this->Diseases->get($id), $this->request->getData()
        );
        $errors = null;
        
        if ($this->Diseases->save($disease)) {
            $message = __('El disease fue modificado correctamente');
        } else {
            $message = __('El disease no fue modificado correctamente');
            $errors = $disease->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('disease', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Enable method
     *
     * @param string|null $id Disease id.
     * @return \Cake\Http\Response|null|void Redirects on successful enable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $disease = $this->Diseases->get($id);
        $disease->state = 1;
        $errors = null;
        
        if ($this->Diseases->save($disease)) {
            $message = __('El disease fue habilitado correctamente');
        } else {
            $message = __('El disease no fue habilitado correctamente');
            $errors = $disease->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('disease', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Disable method
     *
     * @param string|null $id Disease id.
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $disease = $this->Diseases->get($id);
        $disease->state = 2;
        $errors = null;
        
        if ($this->Diseases->save($disease)) {
            $message = __('El disease fue deshabilitado correctamente');
        } else {
            $message = __('El disease no fue deshabilitado correctamente');
            $errors = $disease->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('disease', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
