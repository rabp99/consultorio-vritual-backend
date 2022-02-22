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
    public function index()
    {
        $this->getRequest()->allowMethod('GET');
        $sortColumn = $this->getRequest()->getQuery('sort_column');
        $sortOrder = $this->getRequest()->getQuery('sort_order');
        $description = $this->getRequest()->getQuery('description');
        $state = is_string($this->getRequest()->getQuery('state')) ?
            explode(',', $this->getRequest()->getQuery('state')) : null;

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->Diseases->find();

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        if ($description && is_string($description)) {
            $query->where(['Diseases.description LIKE' => "%$description%"]);
        }

        if ($state) {
            $query->where(['Diseases.state IN' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $diseases = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['Diseases'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
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
    public function view($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $disease = $this->Diseases->get($id);

        $this->set(compact('disease'));
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
        $disease = $this->Diseases->newEntity($this->getRequest()->getData());
        $errors = null;

        if ($this->Diseases->save($disease)) {
            $message = __('La enfermedad fue registrada correctamente');
        } else {
            $message = __('La enfermedad no fue registrada correctamente');
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
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $disease = $this->Diseases->patchEntity(
            $this->Diseases->get($id),
            $this->request->getData()
        );
        $errors = null;

        if ($this->Diseases->save($disease)) {
            $message = __('La enfermedad fue modificada correctamente');
        } else {
            $message = __('La enfermedad no fue modificada correctamente');
            $errors = $disease->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('disease', 'message', 'errors'));
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
        $disease = $this->Diseases->get($id);
        $disease->state = 'ACTIVO';
        $errors = null;

        if ($this->Diseases->save($disease)) {
            $message = __('La enfermedad fue habilitada correctamente');
        } else {
            $message = __('La enfermedad no fue habilitada correctamente');
            $errors = $disease->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('disease', 'message', 'errors'));
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
        $disease = $this->Diseases->get($id);
        $disease->state = 'INACTIVO';
        $errors = null;

        if ($this->Diseases->save($disease)) {
            $message = __('La enfermedad fue deshabilitada correctamente');
        } else {
            $message = __('La enfermedad no fue deshabilitada correctamente');
            $errors = $disease->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('disease', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
