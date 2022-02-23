<?php
declare(strict_types=1);

namespace App\Controller;


/**
 * AppointmentsImagingExams Controller
 *
 * @property \App\Model\Table\AppointmentsImagingExamsTable $AppointmentsImagingExams
 * @method \App\Model\Entity\AppointmentsImagingExam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AppointmentsImagingExamsController extends AppController
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
        $imagingExamId = $this->getRequest()->getQuery('imaging_exam_id');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');
       
        $query = $this->AppointmentsImagingExams->find();
        
        if ($sortColumn && $sortOrder) {
            $query->order([$sortColumn => $sortOrder]);
        }
        
        // filters    
        if ($appointmentId) {
           $query->where(['AppointmentsImagingExams.appointment_id' => $appointmentId]);
        }
    
        if ($imagingExamId) {
           $query->where(['AppointmentsImagingExams.imaging_exam_id' => $imagingExamId]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }
        
        $this->paginate = [
            'contain' => ['Appointments', 'ImagingExams'],
        ];
        $appointmentsImagingExams = $this->paginate($query, [
            'limit' => $itemsPerPage
        ]);
        $paginate = $this->request->getAttribute('paging')['AppointmentsImagingExams'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' =>  $paginate['perPage']
        ];
        
        $this->set(compact('appointmentsImagingExams', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id Appointments Imaging Exam id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */   
    public function view() {
        $this->getRequest()->allowMethod("GET");
        $appointmentId = $this->getRequest()->getParam('appointment_id');
        $imagingExamId = $this->getRequest()->getParam('imaging_exam_id');
        $appointmentsImagingExam = $this->AppointmentsImagingExams->get([$appointmentId, $imagingExamId], [
            'contain' => ['Appointments', 'ImagingExams'],
        ]);

        $this->set(compact('appointmentsImagingExam'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->getRequest()->allowMethod("POST");
        $appointmentsImagingExam = $this->AppointmentsImagingExams->newEntity($this->getRequest()->getData());
        $errors = null;
        
        if ($this->AppointmentsImagingExams->save($appointmentsImagingExam)) {
            $message = __('El appointments imaging exam fue registrado correctamente');
        }
        else {
            $message = __('El appointments imaging exam no fue registrado correctamente');
            $errors = $appointmentsImagingExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('appointmentsImagingExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointments Imaging Exam id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->getRequest()->allowMethod("PUT");
        $appointmentId = $this->getRequest()->getParam('appointment_id');
        $imagingExamId = $this->getRequest()->getParam('imaging_exam_id');
        $appointmentsImagingExam = $this->AppointmentsImagingExams->patchEntity(
            $this->AppointmentsImagingExams->get([$appointmentId, $imagingExamId]), $this->request->getData()
        );
        $errors = null;
        
        if ($this->AppointmentsImagingExams->save($appointmentsImagingExam)) {
            $message = __('El appointments imaging exam fue modificado correctamente');
        } else {
            $message = __('El appointments imaging exam no fue modificado correctamente');
            $errors = $appointmentsImagingExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        
        $this->set(compact('appointmentsImagingExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Delete method
     *
     * @param string|null $id Appointments Imaging Exam id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {    
        $this->getRequest()->allowMethod("DELETE");
        $appointmentsImagingExam = $this->AppointmentsImagingExams->get($id);
        $errors = null;
        
        if ($this->AppointmentsImagingExams->delete($appointmentsImagingExam)) {
            $message = __('El appointments imaging exam fue eliminado correctamente');
        } else {
            $message = __('El appointments imaging exam no fue eliminado correctamente');
            $errors = $appointmentsImagingExam->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('appointmentsImagingExam', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
