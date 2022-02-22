<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
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
        $personDocType = is_string($this->getRequest()->getQuery('person_doc_type')) ?
            explode(',', $this->getRequest()->getQuery('person_doc_type')) : null;
        $personDocNum = $this->getRequest()->getQuery('person_doc_num');
        $personFullName = $this->getRequest()->getQuery('person_full_name');
        $cmp = $this->getRequest()->getQuery('cmp');
        $state = is_string($this->getRequest()->getQuery('state')) ?
            explode(',', $this->getRequest()->getQuery('state')) : null;

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->Employees->find()
            ->contain(['People']);

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            if ($sortColumn === 'Employees.person_doc_num') {
                $query->order([
                    'Employees.person_doc_type' => $sortOrder,
                    'Employees.person_doc_num' => $sortOrder,
                ]);
            } else {
                $query->order([$sortColumn => $sortOrder]);
            }
        }

        // filters
        if ($personDocType) {
            $query->where(['Employees.person_doc_type IN' => $personDocType]);
        }

        if ($personDocNum && is_string($personDocNum)) {
            $query->where(['Employees.person_doc_num LIKE' => "%$personDocNum%"]);
        }

        if ($personFullName && is_string($personFullName)) {
            $query->where(['OR' => [
                ['People.names LIKE' => "%$personFullName%"],
                ['People.last_name1 LIKE' => "%$personFullName%"],
                ['People.last_name2 LIKE' => "%$personFullName%"],
                ["CONCAT(People.last_name1, ' ', People.last_name2) LIKE" => "%$personFullName%"],
                ["CONCAT(People.last_name1, ' ', People.last_name2, ', ', People.names) LIKE" => "%$personFullName%"],
                ["CONCAT(People.names, ' ', People.last_name1, ', ', People.last_name2) LIKE" => "%$personFullName%"],
            ]]);
        }

        if ($cmp && is_string($cmp)) {
            $query->where(['Employees.cmp LIKE' => "%$cmp%"]);
        }

        if ($state) {
            $query->where(['Employees.state IN' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $employees = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['Employees'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(['employees' => $employees, 'pagination' => $pagination, 'count' => $count]);
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $this->getRequest()->allowMethod('GET');
        $personDocType = $this->getRequest()->getParam('person_doc_type');
        $personDocNum = $this->getRequest()->getParam('person_doc_num');
        $employee = $this->Employees->get([$personDocType, $personDocNum], [
            'contain' => ['People'],
        ]);

        $this->set(['employee' => $employee]);
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
        $employee = $this->Employees->newEntity($this->getRequest()->getData());
        $errors = null;
        $message = null;

        try {
            $this->Employees->getConnection()->begin();
            $this->Employees->saveOrFail($employee);
            $message = __('El médico fue registrado correctamente');
            $this->Employees->getConnection()->commit();
        } catch (\PDOException $ex) {
            $message = __('El médico no fue registrado correctamente');
            $errors = $employee->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
            $this->Employees->getConnection()->rollback();
        } finally {
            $this->set(['employee' => $employee, 'message' => $message, 'errors' => $errors]);
            $this->viewBuilder()->setOption('serialize', true);
        }
    }

    /**
     * Edit method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {
        $this->getRequest()->allowMethod('PUT');
        $personDocType = $this->getRequest()->getParam('person_doc_type');
        $personDocNum = $this->getRequest()->getParam('person_doc_num');
        $employee = $this->Employees->patchEntity(
            $this->Employees->get([$personDocType, $personDocNum]),
            $this->request->getData()
        );
        $errors = null;

        if ($this->Employees->save($employee)) {
            $message = __('El médico fue modificado correctamente');
        } else {
            $message = __('El médico no fue modificado correctamente');
            $errors = $employee->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['employee' => $employee, 'message' => $message, 'errors' => $errors]);
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
        $personDocType = $this->getRequest()->getData('person_doc_type');
        $personDocNum = $this->getRequest()->getData('person_doc_num');
        $start = $this->getRequest()->getData('start');
        $employee = $this->Employees->get([$personDocType, $personDocNum], ['contain' => ['LastEmployeeRecord']]);
        $errors = null;

        if ($this->Employees->enable($employee, $start)) {
            $message = __('El médico fue habilitado correctamente');
        } else {
            $message = __('El médico no fue habilitado correctamente');
            $errors = $employee->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(['employee' => $employee, 'message' => $message, 'errors' => $errors]);
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
        $personDocType = $this->getRequest()->getData('person_doc_type');
        $personDocNum = $this->getRequest()->getData('person_doc_num');
        $end = $this->getRequest()->getData('end');
        $employee = $this->Employees->get([$personDocType, $personDocNum], ['contain' => ['LastEmployeeRecord']]);
        $errors = null;

        if ($this->Employees->disable($employee, $end)) {
            $message = __('El médico fue deshabilitado correctamente');
        } else {
            $message = __('El médico no fue deshabilitado correctamente');
            $errors = $employee->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(['employee' => $employee, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }
}
