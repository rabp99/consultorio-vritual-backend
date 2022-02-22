<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * EmployeeRecords Controller
 *
 * @property \App\Model\Table\EmployeeRecordsTable $EmployeeRecords
 * @method \App\Model\Entity\EmployeeRecord[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeeRecordsController extends AppController
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
        $employeePersonDocType = $this->getRequest()->getQuery('employee_person_doc_type');
        $employeePersonDocNum = $this->getRequest()->getQuery('employee_person_doc_num');
        $start = $this->getRequest()->getQuery('start');
        $end = $this->getRequest()->getQuery('end');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->EmployeeRecords->find();

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        // filters
        if ($id) {
            $query->where(['EmployeeRecords.id' => $id]);
        }

        if ($employeePersonDocType) {
            $query->where(['EmployeeRecords.employee_person_doc_type' => $employeePersonDocType]);
        }

        if ($employeePersonDocNum) {
            $query->where(['EmployeeRecords.employee_person_doc_num' => $employeePersonDocNum]);
        }

        if ($start) {
            $query->where(['EmployeeRecords.start' => $start]);
        }

        if ($end) {
            $query->where(['EmployeeRecords.end' => $end]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $employeeRecords = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['EmployeeRecords'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(compact('employeeRecords', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Employee Record id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $employeeRecord = $this->EmployeeRecords->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('employeeRecord'));
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
        $employeeRecord = $this->EmployeeRecords->newEntity($this->getRequest()->getData());
        $errors = null;

        if ($this->EmployeeRecords->save($employeeRecord)) {
            $message = __('El employee record fue registrado correctamente');
        } else {
            $message = __('El employee record no fue registrado correctamente');
            $errors = $employeeRecord->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('employeeRecord', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Employee Record id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $employeeRecord = $this->EmployeeRecords->patchEntity(
            $this->EmployeeRecords->get($id),
            $this->request->getData()
        );
        $errors = null;

        if ($this->EmployeeRecords->save($employeeRecord)) {
            $message = __('El employee record fue modificado correctamente');
        } else {
            $message = __('El employee record no fue modificado correctamente');
            $errors = $employeeRecord->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('employeeRecord', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Employee Record id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->getRequest()->allowMethod('DELETE');
        $employeeRecord = $this->EmployeeRecords->get($id);
        $errors = null;

        if ($this->EmployeeRecords->delete($employeeRecord)) {
            $message = __('El employee record fue eliminado correctamente');
        } else {
            $message = __('El employee record no fue eliminado correctamente');
            $errors = $employeeRecord->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('employeeRecord', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
