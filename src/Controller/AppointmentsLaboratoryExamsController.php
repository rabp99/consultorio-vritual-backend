<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * AppointmentsLaboratoryExams Controller
 *
 * @property \App\Model\Table\AppointmentsLaboratoryExamsTable $AppointmentsLaboratoryExams
 * @method \App\Model\Entity\AppointmentsLaboratoryExam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppointmentsLaboratoryExamsController extends AppController
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
        $appointmentId = $this->getRequest()->getQuery('appointment_id');
        $laboratoryExamId = $this->getRequest()->getQuery('laboratory_exam_id');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->AppointmentsLaboratoryExams->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($appointmentId) {
           $query->where(['AppointmentsLaboratoryExams.appointment_id' => $appointmentId]);
        }
    
        if ($laboratoryExamId) {
           $query->where(['AppointmentsLaboratoryExams.laboratory_exam_id' => $laboratoryExamId]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $this->paginate = [
            'contain' => ['Appointments', 'LaboratoryExams'],
        ];
        $appointmentsLaboratoryExams = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['AppointmentsLaboratoryExams'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('appointmentsLaboratoryExams', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Appointments Laboratory Exam id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view() {
        $this->getRequest()->allowMethod("GET");
        $appointmentId = $this->getRequest()->getParam('appointment_id');
        $laboratoryExamId = $this->getRequest()->getParam('laboratory_exam_id');
        $appointmentsLaboratoryExam = $this->AppointmentsLaboratoryExams->get([$appointmentId, $laboratoryExamId], [
            'contain' => ['Appointments', 'LaboratoryExams'],
        ]);

        $this->set(compact('appointmentsLaboratoryExam'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $appointmentsLaboratoryExam = $this->AppointmentsLaboratoryExams->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->AppointmentsLaboratoryExams->save($appointmentsLaboratoryExam)) {
            $message = __('El appointments laboratory exam fue registrado correctamente');
        }
        else {
            $message = __('El appointments laboratory exam no fue registrado correctamente');
            $errors = $appointmentsLaboratoryExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('appointmentsLaboratoryExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointments Laboratory Exam id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $appointmentId = $this->getRequest()->getParam('appointment_id');
        $laboratoryExamId = $this->getRequest()->getParam('laboratory_exam_id');
        $appointmentsLaboratoryExam = $this->AppointmentsLaboratoryExams->patchEntity(
            $this->AppointmentsLaboratoryExams->get([$appointmentId, $laboratoryExamId]), $this->request->getData()
        );
        $errors = null;
        
        if ($this->AppointmentsLaboratoryExams->save($appointmentsLaboratoryExam)) {
            $message = __('El appointments laboratory exam fue modificado correctamente');
        } else {
            $message = __('El appointments laboratory exam no fue modificado correctamente');
            $errors = $appointmentsLaboratoryExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('appointmentsLaboratoryExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Appointments Laboratory Exam id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {    
        $this->getRequest()->allowMethod("DELETE");
        $appointmentsLaboratoryExam = $this->AppointmentsLaboratoryExams->get($id);
        $errors = null;
        
        if ($this->AppointmentsLaboratoryExams->delete($appointmentsLaboratoryExam)) {
            $message = __('El appointments laboratory exam fue eliminado correctamente');
        } else {
            $message = __('El appointments laboratory exam no fue eliminado correctamente');
            $errors = $appointmentsLaboratoryExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('appointmentsLaboratoryExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
