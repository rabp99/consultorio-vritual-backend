<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Recipes Controller
 *
 * @property \App\Model\Table\RecipesTable $Recipes
 * @method \App\Model\Entity\Recipe[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RecipesController extends AppController
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
        $id = $this->getRequest()->getQuery('id');
        $appointmentId = $this->getRequest()->getQuery('appointment_id');
        $state = $this->getRequest()->getQuery('state');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->Recipes->find();

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        // filters
        if ($id) {
            $query->where(['Recipes.id' => $id]);
        }

        if ($appointmentId) {
            $query->where(['Recipes.appointment_id' => $appointmentId]);
        }

        if ($state) {
            $query->where(['Recipes.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $this->paginate = [
            'contain' => ['Appointments'],
        ];
        $recipes = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['Recipes'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(['recipes' => $recipes, 'pagination' => $pagination, 'count' => $count]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Recipe id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $recipe = $this->Recipes->get($id, [
            'contain' => ['Appointments', 'RecipeDetails'],
        ]);

        $this->set(['recipe' => $recipe]);
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
        $recipe = $this->Recipes->newEntity($this->getRequest()->getData());
        $errors = null;

        if ($this->Recipes->save($recipe)) {
            $message = __('El recipe fue registrado correctamente');
        } else {
            $message = __('El recipe no fue registrado correctamente');
            $errors = $recipe->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['recipe' => $recipe, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Recipe id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $recipe = $this->Recipes->patchEntity(
            $this->Recipes->get($id),
            $this->request->getData()
        );
        $errors = null;

        if ($this->Recipes->save($recipe)) {
            $message = __('El recipe fue modificado correctamente');
        } else {
            $message = __('El recipe no fue modificado correctamente');
            $errors = $recipe->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['recipe' => $recipe, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }
}
