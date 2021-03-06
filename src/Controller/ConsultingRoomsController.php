<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ConsultingRooms Controller
 *
 * @property \App\Model\Table\ConsultingRoomsTable $ConsultingRooms
 * @method \App\Model\Entity\ConsultingRoom[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConsultingRoomsController extends AppController
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
        $floor = $this->getRequest()->getQuery('floor');
        $placeId = $this->getRequest()->getQuery('place_id');
        $state = is_string($this->getRequest()->getQuery('state')) ?
            explode(',', $this->getRequest()->getQuery('state')) : null;

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->ConsultingRooms->find();

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        if ($description && is_string($description)) {
            $query->where(['ConsultingRooms.description LIKE' => "%$description%"]);
        }

        if ($floor && is_string($floor)) {
            $query->where(['ConsultingRooms.floor LIKE' => "%$floor%"]);
        }

        if ($placeId) {
            $query->where(['ConsultingRooms.place_id' => $placeId]);
        }

        if ($state) {
            $query->where(['ConsultingRooms.state IN' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $this->paginate = [
            'contain' => ['Places'],
        ];
        $consultingRooms = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['ConsultingRooms'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(['consultingRooms' => $consultingRooms, 'pagination' => $pagination, 'count' => $count]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Consulting Room id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $consultingRoom = $this->ConsultingRooms->get($id);

        $this->set(['consultingRoom' => $consultingRoom]);
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
        $consultingRoom = $this->ConsultingRooms->newEntity($this->getRequest()->getData());
        $errors = null;

        if ($this->ConsultingRooms->save($consultingRoom)) {
            $message = __('El consultorio fue registrado correctamente');
        } else {
            $message = __('El consultorio no fue registrado correctamente');
            $errors = $consultingRoom->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['consultingRoom' => $consultingRoom, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Consulting Room id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $consultingRoom = $this->ConsultingRooms->patchEntity(
            $this->ConsultingRooms->get($id),
            $this->request->getData()
        );
        $errors = null;

        if ($this->ConsultingRooms->save($consultingRoom)) {
            $message = __('El consultorio fue modificado correctamente');
        } else {
            $message = __('El consultorio no fue modificado correctamente');
            $errors = $consultingRoom->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['consultingRoom' => $consultingRoom, 'message' => $message, 'errors' => $errors]);
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
        $consultingRoom = $this->ConsultingRooms->get($id);
        $consultingRoom->state = 'ACTIVO';
        $errors = null;

        if ($this->ConsultingRooms->save($consultingRoom)) {
            $message = __('El consultorio fue habilitado correctamente');
        } else {
            $message = __('El consultorio no fue habilitado correctamente');
            $errors = $consultingRoom->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(['consultingRoom' => $consultingRoom, 'message' => $message, 'errors' => $errors]);
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
        $consultingRoom = $this->ConsultingRooms->get($id);
        $consultingRoom->state = 'INACTIVO';
        $errors = null;

        if ($this->ConsultingRooms->save($consultingRoom)) {
            $message = __('El consultorio fue deshabilitado correctamente');
        } else {
            $message = __('El consultorio no fue deshabilitado correctamente');
            $errors = $consultingRoom->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(['consultingRoom' => $consultingRoom, 'message' => $message, 'errors' => $errors]);
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
        $consultingRooms = $this->ConsultingRooms->find()->where(['ConsultingRooms.state' => 'ACTIVO']);

        $this->set(['consultingRooms' => $consultingRooms]);
        $this->viewBuilder()->setOption('serialize', true);
    }
}
