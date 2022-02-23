<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * Citts Controller
 *
 * @property \App\Model\Table\CittsTable $Citts
 * @method \App\Model\Entity\Citt[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CittsController extends AppController
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
        $appointmentId = $this->getRequest()->getQuery('appointment_id');
        $startDate = $this->getRequest()->getQuery('start_date');
        $endDate = $this->getRequest()->getQuery('end_date');
        $numberDays = $this->getRequest()->getQuery('number_days');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->Citts->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($id) {
           $query->where(['Citts.id' => $id]);
        }
    
        if ($appointmentId) {
           $query->where(['Citts.appointment_id' => $appointmentId]);
        }
    
        if ($startDate) {
           $query->where(['Citts.start_date' => $startDate]);
        }
    
        if ($endDate) {
           $query->where(['Citts.end_date' => $endDate]);
        }
    
        if ($numberDays) {
           $query->where(['Citts.number_days' => $numberDays]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $this->paginate = [
            'contain' => ['Appointments'],
        ];
        $citts = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['Citts'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('citts', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Citt id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view($id = null) {
        $this->getRequest()->allowMethod("GET");
        $citt = $this->Citts->get($id, [
            'contain' => ['Appointments'],
        ]);

        $this->set(compact('citt'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $citt = $this->Citts->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->Citts->save($citt)) {
            $message = __('El citt fue registrado correctamente');
        }
        else {
            $message = __('El citt no fue registrado correctamente');
            $errors = $citt->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('citt', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Citt id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $citt = $this->Citts->patchEntity(
            $this->Citts->get($id), $this->request->getData()
        );
        $errors = null;
        
        if ($this->Citts->save($citt)) {
            $message = __('El citt fue modificado correctamente');
        } else {
            $message = __('El citt no fue modificado correctamente');
            $errors = $citt->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('citt', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Citt id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {    
        $this->getRequest()->allowMethod("DELETE");
        $citt = $this->Citts->get($id);
        $errors = null;
        
        if ($this->Citts->delete($citt)) {
            $message = __('El citt fue eliminado correctamente');
        } else {
            $message = __('El citt no fue eliminado correctamente');
            $errors = $citt->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('citt', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
