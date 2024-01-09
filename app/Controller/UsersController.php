<?php

/**
 * Users Controller
 *
 */
App::uses('AppController', 'Controller');

class UsersController extends AppController
{

    /**
     * beforeFilter method
     *
     * @return void
     */
    function beforeFilter() {
        $this->Auth->allow(['signIn', 'signUp', 'checkEmail']);
        parent::beforeFilter();
    }//end beforeFilter()


    /**
     * function to sign-up & Displays a view with get request
     *
     * @return CakeResponse|null
     * @throws ForbiddenException When a directory traversal attempt.
     * @throws NotFoundException When the view file could not be found
     *   or MissingViewException in debug mode.
     */
    public function signUp()
    {
        if ($this->request->is(['post'])) {

            $response = ['success' => false, 'id' => null];

            if (!empty($this->request->data['User']['password'])) {
                $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                $this->request->data['User']['password'] = $passwordHasher->hash(
                    $this->request->data['User']['password']
                );
            }

            $requestData = $this->request->data;

            $this->User->create();
            if($this->User->save($requestData)) {
                $id = $this->User->id;
                $response['success'] = true;
                $response['id'] = $id;
                $response['redirectUrl'] = Router::url(['controller' => 'users', 'action' => 'index']);

                unset($this->request->data['User']['password']);
                $this->request->data['User']['id'] = $id;
                $this->Auth->login($this->request->data['User']);
            }

            return $this->returnJsonData($response);
        }
    }//end signUp()


    /**
     *  function to check the email already exists & Displays a view with get request
     *
     * @return CakeResponse|null
     */
    public function checkEmail()
    {

        $response = ['success' => false];

        if ($this->request->is(['post'])) {
            $email = $this->request->data['email'];
            $id = !empty($this->request->data['id']) ? $this->request->data['id'] : null;
            $response['success'] = $this->User->checkUserEmail($email, $id);
        }

        return $this->returnJsonData($response);

    }//end checkEmail()

    /**
     * function to list the user
     *
     * @return CakeResponse|null
     */
    public function index()
    {

    }//end index()

    /**
     * function to list the user by AJAX
     *
     * @return CakeResponse|null
     */
    public function listUsers()
    {

        $this->layout = false;

        if ($this->request->is(['ajax'])) {

            $this->paginate = [
                'conditions' => [
                    'User.is_deleted' => 0,
                ],
                'limit' => 5
            ];
            $users = $this->paginate();
            $this->set(['users' => $users]);
        }

    }//end listUsers()

    /**
     * function to edit the user
     *
     * @param $id | numeric
     * @return CakeResponse|null
     */
    function edit($id = null)
    {

        if (empty($id) || !is_numeric($id)) {
            $setMessage = 'Invalid User ID!';
            $this->Flash->set($setMessage);
            return $this->redirect($this->referer());
        }

        $user = $this->User->find('first',[
            'conditions' => [
                'User.id' => $id,
                'User.is_deleted' => 0,
            ]
        ]);
        if (empty($user)) {
            $setMessage = 'Invalid User ID!';
            $this->Flash->set($setMessage);
            return $this->redirect($this->referer());
        }

        if ($this->request->is(['post', 'put'])) {

            $response = ['success' => false, 'id' => null];
            $requestData = $this->request->data;
            $requestData['User']['is_admin'] = !empty($requestData['User']['is_admin']) ? 1 : 0;

            if($this->User->save($requestData, false, array_keys($requestData['User']))) {
                $id = $this->User->id;
                $response['success'] = true;
                $response['id'] = $id;
                $response['redirectUrl'] = Router::url(['controller' => 'users', 'action' => 'index']);
            }
            return $this->returnJsonData($response);

        } else {
            $this->request->data = $user;
        }

        $this->set('user', $user);

    }//end edit()

    /**
     * function to soft-delete the user
     *
     * @param id | numeric
     * @return CakeResponse|JSON/String
     */
    function delete($id = null) {

        $response = ['success' => false];

        if (
            !$this->request->is('post')
            || empty($id)
            || !is_numeric($id)
            || !$this->User->find('first', [
                'conditions' => [
                    'User.id' => $id,
                    'User.is_deleted' => 0,
                ]
            ])
        ) {
            return $this->returnJsonData($response);
        }

        $userToUpdate = [
            'id' => $id,
            'is_deleted' => 1
        ];

        if ($this->User->save($userToUpdate, false, array_keys($userToUpdate))) {
            $response['success'] = true;
            $response['redirectUrl'] = Router::url(['controller' => 'users', 'action' => 'index']);
            return $this->returnJsonData($response);
        }

        return $this->returnJsonData($response);

    }//end delete()


    /**
     * function to login the user
     *
     * @return CakeResponse|null
     */
    function signIn() {

        if ($this->Auth->loggedIn()) {
            return $this->redirect(['controller' => 'users', 'action' => 'index']);
        }

        $response = ['success' => false];

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $response['success'] = true;
                $response['redirectUrl'] = Router::url(['controller' => 'users', 'action' => 'index']);
                return $this->returnJsonData($response);
            }
            return $this->returnJsonData($response);
        }
    }//end signIn()


    /**
     * function to Sign-Out the user
     *
     * @return CakeResponse|null
     */
    function signOut() {

        if (!$this->Auth->loggedIn()) {
            return $this->redirect($this->referer());
        }

        $this->Auth->logout();
        $setMessage = 'You are logged out successfully!';
        $this->Flash->set($setMessage);
        return $this->redirect(['controller' => 'users', 'action' => 'signIn']);
    }//end signOut()

}//end UsersController
