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
    public function index()
    {
        $this->getRequest()->allowMethod('GET');
        $sortColumn = $this->getRequest()->getQuery('sort_column');
        $sortOrder = $this->getRequest()->getQuery('sort_order');
        $description = $this->getRequest()->getQuery('description');
        $presentation = $this->getRequest()->getQuery('presentation');
        $state = is_string($this->getRequest()->getQuery('state')) ?
            explode(',', $this->getRequest()->getQuery('state')) : null;

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->Medicines->find();

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        if ($description && is_string($description)) {
            $query->where(['Medicines.description LIKE' => "%$description%"]);
        }

        if ($presentation && is_string($presentation)) {
            $query->where(['Medicines.presentation LIKE' => "%$presentation"]);
        }

        if ($state) {
            $query->where(['Medicines.state IN' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $medicines = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['Medicines'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(['medicines' => $medicines, 'pagination' => $pagination, 'count' => $count]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Medicine id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $medicine = $this->Medicines->get($id);

        $this->set(['medicine' => $medicine]);
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
        $medicine = $this->Medicines->newEntity($this->getRequest()->getData());
        $errors = null;

        if ($this->Medicines->save($medicine)) {
            $message = __('El medicamento fue registrado correctamente');
        } else {
            $message = __('El medicamento no fue registrado correctamente');
            $errors = $medicine->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['medicine' => $medicine, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Medicine id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $medicine = $this->Medicines->patchEntity(
            $this->Medicines->get($id),
            $this->request->getData()
        );
        $errors = null;

        if ($this->Medicines->save($medicine)) {
            $message = __('El medicamento fue modificado correctamente');
        } else {
            $message = __('El medicamento no fue modificado correctamente');
            $errors = $medicine->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['medicine' => $medicine, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Enable method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful enable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable()
    {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData('id');
        $medicine = $this->Medicines->get($id);
        $medicine->state = 'ACTIVO';
        $errors = null;

        if ($this->Medicines->save($medicine)) {
            $message = __('El medicamento fue habilitado correctamente');
        } else {
            $message = __('El medicamento no fue habilitado correctamente');
            $errors = $medicine->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(['medicine' => $medicine, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Disable method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful disable, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function disable()
    {
        $this->getRequest()->allowMethod(['POST']);
        $id = $this->getRequest()->getData('id');
        $medicine = $this->Medicines->get($id);
        $medicine->state = 'INACTIVO';
        $errors = null;

        if ($this->Medicines->save($medicine)) {
            $message = __('El medicamento fue deshabilitado correctamente');
        } else {
            $message = __('El medicamento no fue deshabilitado correctamente');
            $errors = $medicine->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(['medicine' => $medicine, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Get List method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function getList()
    {
        $this->getRequest()->allowMethod('GET');
        $medicines = $this->Medicines->find()
            ->select(['id', 'description', 'presentation'])
            ->where(['Medicines.state' => 'ACTIVO']);

        $this->set(['medicines' => $medicines]);
        $this->viewBuilder()->setOption('serialize', true);
    }
}
