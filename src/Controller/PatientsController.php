<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Patients Controller
 *
 * @property \App\Model\Table\PatientsTable $Patients
 * @method \App\Model\Entity\Patient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PatientsController extends AppController
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
        $state = is_string($this->getRequest()->getQuery('state')) ?
            explode(',', $this->getRequest()->getQuery('state')) : null;

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->Patients->find()
            ->contain('People');

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        // filters
        if ($personDocType) {
            $query->where(['Patients.person_doc_type IN' => $personDocType]);
        }

        if ($personDocNum && is_string($personDocNum)) {
            $query->where(['Patients.person_doc_num LIKE' => "%$personDocNum%"]);
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

        if ($state) {
            $query->where(['Patients.state IN' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $patients = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['Patients'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(['patients' => $patients, 'pagination' => $pagination, 'count' => $count]);
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
        $patient = $this->Patients->get([$personDocType, $personDocNum], [
            'contain' => ['People'],
        ]);

        $this->set(['patient' => $patient]);
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
        $patient = $this->Patients->newEntity($this->getRequest()->getData());
        $errors = null;
        $message = null;

        try {
            $this->Patients->getConnection()->begin();
            $this->Patients->saveOrFail($patient);
            $message = __('El paciente fue registrado correctamente');
            $this->Patients->getConnection()->commit();
        } catch (\PDOException $ex) {
            $message = __('El paciente no fue registrado correctamente');
            $errors = $patient->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
            $this->Patients->getConnection()->rollback();
        } finally {
            $this->set(['patient' => $patient, 'message' => $message, 'errors' => $errors]);
            $this->viewBuilder()->setOption('serialize', true);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Patient id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $personDocType = $this->getRequest()->getParam('person_doc_type');
        $personDocNum = $this->getRequest()->getParam('person_doc_num');
        $patient = $this->Patients->patchEntity(
            $this->Patients->get([$personDocType, $personDocNum]),
            $this->request->getData()
        );
        $errors = null;

        if ($this->Patients->save($patient)) {
            $message = __('El paciente fue modificado correctamente');
        } else {
            $message = __('El paciente no fue modificado correctamente');
            $errors = $patient->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(['patient' => $patient, 'message' => $message, 'errors' => $errors]);
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
        $patient = $this->Patients->get([$personDocType, $personDocNum]);
        $errors = null;

        if ($this->Patients->enable($patient)) {
            $message = __('El paciente fue habilitado correctamente');
        } else {
            $message = __('El paciente no fue habilitado correctamente');
            $errors = $patient->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(['patient' => $patient, 'message' => $message, 'errors' => $errors]);
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
        $patient = $this->Patients->get([$personDocType, $personDocNum]);
        $errors = null;

        if ($this->Patients->disable($patient)) {
            $message = __('El paciente fue deshabilitado correctamente');
        } else {
            $message = __('El paciente no fue deshabilitado correctamente');
            $errors = $patient->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(['patient' => $patient, 'message' => $message, 'errors' => $errors]);
        $this->viewBuilder()->setOption('serialize', true);
    }
}
