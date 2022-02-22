<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Places Controller
 *
 * @property \App\Model\Table\PlacesTable $Places
 * @method \App\Model\Entity\Place[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlacesController extends AppController
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
        $state = is_string($this->getRequest()->getQuery('state')) ?
            explode(',', $this->getRequest()->getQuery('state')) : null;

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->Places->find();

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        if ($description && is_string($description)) {
            $query->where(['Places.description LIKE' => "%$description%"]);
        }

        if ($state) {
            $query->where(['Places.state IN' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $places = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['Places'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(compact('places', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Place id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $place = $this->Places->get($id, [
            'contain' => ['ConsultingRooms'],
        ]);

        $this->set(compact('place'));
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
        $place = $this->Places->newEntity($this->getRequest()->getData());
        $errors = null;

        if ($this->Places->save($place)) {
            $message = __('El establecimiento fue registrado correctamente');
        } else {
            $message = __('El establecimiento no fue registrado correctamente');
            $errors = $place->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('place', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Place id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $place = $this->Places->patchEntity(
            $this->Places->get($id),
            $this->request->getData()
        );
        $errors = null;

        if ($this->Places->save($place)) {
            $message = __('El establecimiento fue modificado correctamente');
        } else {
            $message = __('El establecimiento no fue modificado correctamente');
            $errors = $place->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('place', 'message', 'errors'));
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
        $place = $this->Places->get($id);
        $place->state = 'ACTIVO';
        $errors = null;

        if ($this->Places->save($place)) {
            $message = __('El establecimiento fue habilitado correctamente');
        } else {
            $message = __('El establecimiento no fue habilitado correctamente');
            $errors = $place->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('place', 'message', 'errors'));
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
        $place = $this->Places->get($id);
        $place->state = 'INACTIVO';
        $errors = null;

        if ($this->Places->save($place)) {
            $message = __('El establecimiento fue deshabilitado correctamente');
        } else {
            $message = __('El establecimiento no fue deshabilitado correctamente');
            $errors = $place->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('place', 'message', 'errors'));
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
        $places = $this->Places->find()->where(['Places.state' => 'ACTIVO']);

        $this->set(compact('places'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
