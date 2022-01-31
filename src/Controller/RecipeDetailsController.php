<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * RecipeDetails Controller
 *
 * @property \App\Model\Table\RecipeDetailsTable $RecipeDetails
 * @method \App\Model\Entity\RecipeDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RecipeDetailsController extends AppController
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
        $recipeId = $this->getRequest()->getQuery('recipe_id');
        $medicineId = $this->getRequest()->getQuery('medicine_id');
        $amount = $this->getRequest()->getQuery('amount');
        $days = $this->getRequest()->getQuery('days');
        $prescription = $this->getRequest()->getQuery('prescription');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->RecipeDetails->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['RecipeDetails.id' => $id]);
        }
    
        if ($recipeId) {
           $query->where(['RecipeDetails.recipe_id' => $recipeId]);
        }
    
        if ($medicineId) {
           $query->where(['RecipeDetails.medicine_id' => $medicineId]);
        }
    
        if ($amount) {
           $query->where(['RecipeDetails.amount' => $amount]);
        }
    
        if ($days) {
           $query->where(['RecipeDetails.days' => $days]);
        }
    
        if ($prescription) {
           $query->where(['RecipeDetails.prescription' => $prescription]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $this->paginate = [
            'contain' => ['Recipes', 'Medicines'],
        ];
        $recipeDetails = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['RecipeDetails'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('recipeDetails', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Recipe Detail id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view($id = null) {
        $this->getRequest()->allowMethod("GET");
        $recipeDetail = $this->RecipeDetails->get($id, [
            'contain' => ['Recipes', 'Medicines'],
        ]);

        $this->set(compact('recipeDetail'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $recipeDetail = $this->RecipeDetails->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->RecipeDetails->save($recipeDetail)) {
            $message = __('El recipe detail fue registrado correctamente');
        }
        else {
            $message = __('El recipe detail no fue registrado correctamente');
            $errors = $recipeDetail->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('recipeDetail', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Recipe Detail id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $recipeDetail = $this->RecipeDetails->patchEntity(
            $this->RecipeDetails->get($id), $this->request->getData()
        );
        $errors = null;
        
        if ($this->RecipeDetails->save($recipeDetail)) {
            $message = __('El recipe detail fue modificado correctamente');
        } else {
            $message = __('El recipe detail no fue modificado correctamente');
            $errors = $recipeDetail->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('recipeDetail', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Recipe Detail id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {    
        $this->getRequest()->allowMethod("DELETE");
        $recipeDetail = $this->RecipeDetails->get($id);
        $errors = null;
        
        if ($this->RecipeDetails->delete($recipeDetail)) {
            $message = __('El recipe detail fue eliminado correctamente');
        } else {
            $message = __('El recipe detail no fue eliminado correctamente');
            $errors = $recipeDetail->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('recipeDetail', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
