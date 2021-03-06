<?php

App::uses('AppController', 'Controller');

/**
 * Controller for User in the system
 */
class UsersController extends AppController {

    /**
     * If we have no users, then allow anyone to register the first admin account
     */
    public function beforeFilter() {
        parent::beforeFilter();
        if ($this->User->hasUsers()) {
            $this->Auth->allow('login', 'logout');
        } else {
            $this->Auth->allow('register', 'login', 'logout');
        }
    }

    /**
     * Set information needed by default template
     */
    public function beforeRender() {
        parent::beforeRender();
        $this->set('subpage', __('Users'));
    }

    /**
     * Add a user into the system.
     * This method is public when have no users in database. In this case will create a admin user.
     * Otherwise, only admins can register.
     */
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            if (!$this->User->hasUsers()) {
                $this->request->data['level'] = 1;
            }
            if ($this->request->data['password'] !== $this->request->data['password2']) {
                $this->Session->setFlash(__('Passwords did not match.'));
            } else if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Success: User correctly added.'));
                $this->redirect(array('controller' => 'pages', 'action' => 'dashboard'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }

        $this->set('hasUsers', $this->User->hasUsers());
        $this->set('title_for_layout', __('Register an account'));
        $this->render('register', 'userform');
    }

    /**
     * An alias to register call
     * @see register
     */
    public function add() {
        return $this->register();
    }

    /**
     * Do login.
     * The authentication is made by POST, error messages are displayed on login page
     */
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }

        if (!$this->User->hasUsers()) {
            $this->redirect('register');
        }

        $this->set('page', __('Login'));
        $this->set('title_for_layout', __('Log into your account'));
        $this->render('login', 'userform');
    }

    /**
     * Do a logout
     */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    /**
     * Public area for authenticated users.
     * Here you can see all users details
     */
    public function index() {
        $this->User->recursive = -1;

        if (!empty($this->request->query['q'])) {
            $users = $this->User->find('all', array(
                'conditions' => array(
                    'or' => array(
                        'name LIKE' => '%' . $this->request->query['q'] . '%',
                        'username LIKE' => '%' . $this->request->query['q'] . '%',
                    )
                )
            ));
        } else {
            $users = $this->User->find('all');
        }

        $this->set('users', $users);

        $this->set('page', __('User list'));
        $this->set('title_for_layout', __('list of current users'));
        $this->set('hasUsers', $this->User->hasUsers());
    }

    /**
     * Edit a profile of a user.
     * These can be either the own user (id present or supressed), as another user (only for admins)
     * @param int $userid ID of user to see profile. If supressed, will edit the current user profile
     * @throws NotFoundException when id is invalid
     */
    public function profile($userid = null) {
        if ($this->request->is('post') && !empty($this->request->data['id'])) {
            $this->User->id = $this->request->data['id'];
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Can not find specifyed user'));
            }
            if (!empty($this->request->data['password']) && $this->request->data['password'] !== $this->request->data['password2']) {
                $this->Session->setFlash(__('Passwords did not match.'));
            } else {
                unset($this->request->data['username'], $this->request->data['level'], $this->request->data['created']);
                if (empty($this->request->data['password'])) {
                    unset($this->request->data['password']);
                }
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('Success: Profile updated'));
                    $this->redirect(array('controller' => 'pages', 'action' => 'dashboard'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }
        }

        $this->User->recursive = -1;

        if (empty($userid)) {
            $userid = AuthComponent::user('id');
        }

        $user = $this->User->findById($userid);
        if (empty($user['User'])) {
            throw new NotFoundException(__('User not found'));
        }

        $this->set('user', $user);

        $this->set('page', __('Edit your profile'));
        $this->set('hasUsers', $this->User->hasUsers());
        $this->set('title_for_layout', __('Profile for user %s', AuthComponent::user('name')));
        $this->render('profile', 'userform');
    }

    /**
     * Delete a user (only admins can delete users)
     * @param int $id
     * @throws NotFoundException when id is invalid
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        } else {
            if ($this->User->delete($id, true)) {
                $this->Session->setFlash(__('Note: User and his data was deleted'));
            } else {
                $this->Session->setFlash(__('Error: The user was not deleted'));
            }
        }
        $this->redirect('index');
    }

    /**
     * Empty page to check admin permissions
     */
    public function config() {
        $this->set('page', __('Configurations'));
        $this->set('title_for_layout', __('Checking admin permissions'));
    }

    /**
     * Set permissions, blocking access of non-admins on register, delete and config actions
     * Currently, it allow to see:
     * - visitors: login, logout, register when has no user ( @see self::beforeFilter() )
     * - users: index
     * - own user: profile
     * - admins: register, delete, config, profile
     * @param array $user User to check permissions
     * @return boolean
     */
    public function isAuthorized($user) {
        if (parent::isAuthorized($user)) {
            if ($this->action === 'index' || (isset($user['level']) && (int) $user['level'] === self::ADMIN_LEVEL)) {
                return true;
            } else if ($this->action === 'profile') {
                if (empty($this->request->params['pass'])) {
                    return true;
                }
                $id = $this->request->params['pass'][0];
                if (empty($id) || (int) $id === (int) $user['id']) {
                    return true;
                }
            }
        }
        $this->Session->setFlash(__('You can not access this page'));
        return false;
    }

}
