<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Medicines Controller
 *
 * @property \App\Model\Table\MedicinesTable $Medicines
 * @method \App\Model\Entity\Medicine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MedicinesController extends AppController
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
        $presentation = $this->getRequest()->getQuery('presentation');
        $state = $this->getRequest()->getQuery('state');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->Medicines->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['Medicines.id' => $id]);
        }
    
        if ($description) {
           $query->where(['Medicines.description' => $description]);
        }
    
        if ($presentation) {
           $query->where(['Medicines.presentation' => $presentation]);
        }
    
        if ($state) {
           $query->where(['Medicines.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $medicines = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['Medicines'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('medicines', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Medicine id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view($id = null) {
        $this->getRequest()->allowMethod("GET");
        $medicine = $this->Medicines->get($id, [
            'contain' => ['RecipeDetails'],
        ]);

        $this->set(compact('medicine'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $medicine = $this->Medicines->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->Medicines->save($medicine)) {
            $message = __('El medicine fue registrado correctamente');
        }
        else {
            $message = __('El medicine no fue registrado correctamente');
            $errors = $medicine->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('medicine', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Medicine id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $medicine = $this->Medicines->patchEntity(
            $this->Medicines->get($id), $this->request->getData()
        );
        $errors = null;
        
        if ($this->Medicines->save($medicine)) {
            $message = __('El medicine fue modificado correctamente');
        } else {
            $message = __('El medicine no fue modificado correctamente');
            $errors = $medicine->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('medicine', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Enable method
     *
     * @param string|null $id Medicine id.
     * @return \Cake\Http\Response|null|void Redirects on successful enable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $medicine = $this->Medicines->get($id);
        $medicine->state = 1;
        $errors = null;
        
        if ($this->Medicines->save($medicine)) {
            $message = __('El medicine fue habilitado correctamente');
        } else {
            $message = __('El medicine no fue habilitado correctamente');
            $errors = $medicine->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('medicine', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Disable method
     *
     * @param string|null $id Medicine id.
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable() {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData("id");
        $medicine = $this->Medicines->get($id);
        $medicine->state = 2;
        $errors = null;
        
        if ($this->Medicines->save($medicine)) {
            $message = __('El medicine fue deshabilitado correctamente');
        } else {
            $message = __('El medicine no fue deshabilitado correctamente');
            $errors = $medicine->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('medicine', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
