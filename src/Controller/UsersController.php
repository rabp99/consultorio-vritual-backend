<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Firebase\JWT\JWT;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Before Filter method when let login to users
     *
     * @param \Cake\Event\EventInterface $event Event instance.
     * @return void
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login']);
    }

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
        $username = $this->getRequest()->getQuery('username');
        $email = $this->getRequest()->getQuery('email');
        $password = $this->getRequest()->getQuery('password');
        $rol = $this->getRequest()->getQuery('rol');
        $employeePersonDocType = $this->getRequest()->getQuery('employee_person_doc_type');
        $employeePersonDocNum = $this->getRequest()->getQuery('employee_person_doc_num');
        $state = $this->getRequest()->getQuery('state');

        $itemsPerPage = $this->request->getQuery('itemsPerPage');

        $query = $this->Users->find();

        if ($sortColumn && $sortOrder && is_string($sortColumn)) {
            $query->order([$sortColumn => $sortOrder]);
        }

        // filters
        if ($id) {
            $query->where(['Users.id' => $id]);
        }

        if ($username) {
            $query->where(['Users.username' => $username]);
        }

        if ($email) {
            $query->where(['Users.email' => $email]);
        }

        if ($password) {
            $query->where(['Users.password' => $password]);
        }

        if ($rol) {
            $query->where(['Users.rol' => $rol]);
        }

        if ($employeePersonDocType) {
            $query->where(['Users.employee_person_doc_type' => $employeePersonDocType]);
        }

        if ($employeePersonDocNum) {
            $query->where(['Users.employee_person_doc_num' => $employeePersonDocNum]);
        }

        if ($state) {
            $query->where(['Users.state' => $state]);
        }

        $count = $query->count();
        if (!$itemsPerPage) {
            $itemsPerPage = $count;
        }

        $users = $this->paginate($query, [
            'limit' => $itemsPerPage,
        ]);
        $paginate = $this->request->getAttribute('paging')['Users'];
        $pagination = [
            'totalItems' => $paginate['count'],
            'itemsPerPage' => $paginate['perPage'],
        ];

        $this->set(compact('users', 'pagination', 'count'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->getRequest()->allowMethod('GET');
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
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
        $user = $this->Users->newEntity($this->getRequest()->getData());
        $errors = null;

        if ($this->Users->save($user)) {
            $message = __('El user fue registrado correctamente');
        } else {
            $message = __('El user no fue registrado correctamente');
            $errors = $user->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('user', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->getRequest()->allowMethod('PUT');
        $user = $this->Users->patchEntity(
            $this->Users->get($id),
            $this->request->getData()
        );
        $errors = null;

        if ($this->Users->save($user)) {
            $message = __('El user fue modificado correctamente');
        } else {
            $message = __('El user no fue modificado correctamente');
            $errors = $user->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }

        $this->set(compact('user', 'message', 'errors'));
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
        $user = $this->Users->get($id);
        $user->state = 'ACTIVO';
        $errors = null;

        if ($this->Users->save($user)) {
            $message = __('El user fue habilitado correctamente');
        } else {
            $message = __('El user no fue habilitado correctamente');
            $errors = $user->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('user', 'message', 'errors'));
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
        $user = $this->Users->get($id);
        $user->state = 'INACTIVO';
        $errors = null;

        if ($this->Users->save($user)) {
            $message = __('El user fue deshabilitado correctamente');
        } else {
            $message = __('El user no fue deshabilitado correctamente');
            $errors = $user->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('user', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function login()
    {
        $result = $this->Authentication->getResult();

        $privateKey = defined('CONFIG') ? file_get_contents(CONFIG . DS . 'jwt.key') : '';
        if ($result->isValid() && is_string($privateKey)) {
            $username = $result->getData()['username'];
            $user = $this->Users->get($username);

            $payload = [
                'iss' => 'consultorio_virtual',
                'sub' => $user->username,
                'exp' => time() + 604800,
            ];
            $json = [
                'token' => JWT::encode($payload, $privateKey, 'RS256'),
                'user' => $user,
            ];
        } else {
            $this->response = $this->response->withStatus(401);
            $json = [];
        }
        $this->set(compact('json'));
        $this->viewBuilder()->setOption('serialize', 'json');
    }

    /**
     * Change Password method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function changePassword()
    {
        $result = $this->Authentication->getResult();
        $user_id = $result->getData()['id'];
        $newPassword = $this->request->getData('new_password');
        $user = $this->Users->get($user_id);

        $user->password = $newPassword;

        if ($this->Users->save($user)) {
            $message = __('La contraseña fue modificada correctamente');
        } else {
            $message = __('La contraseña no fue modificada correctamente');
            $this->setResponse($this->response->withStatus(500));
        }

        $this->set(compact('message'));
        $this->viewBuilder()->setOption('serialize', true);
    }

    /**
     * Reset Password method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function resetPassword()
    {
        $this->getRequest()->allowMethod(['POST']);
        $username = $this->getRequest()->getData('username');
        $user = $this->Users->get($username);
        $user->password = $user->username;
        $errors = null;

        if ($this->Users->save($user)) {
            $message = __('La contraseña fue restablecida correctamente');
        } else {
            $message = __('La contraseña no fue restablecida correctamente');
            $errors = $user->getErrors();
            $this->setResponse($this->getResponse()->withStatus(500));
        }
        $this->set(compact('user', 'message', 'errors'));
        $this->viewBuilder()->setOption('serialize', true);
    }
}
