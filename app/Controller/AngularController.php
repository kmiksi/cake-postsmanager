<?php

App::uses('AppController', 'Controller');

/**
 * Controller for User in the system
 */
class AngularController extends AppController {

    /**
     * Define that we will use this model inside this controller
     * @var User Model Class
     */
    public $uses = array('User');

    /**
     * Set information needed by default template
     */
    public function beforeRender() {
        parent::beforeRender();
        $this->set('subpage', __('Angular'));
    }

    /**
     * Public area for authenticated users.
     * Here you can see all users details.
     * This page was changed to use Angular.js in front-end
     */
    public function index() {
        $this->set('page', __('User list'));
        $this->set('title_for_layout', __('list of current users'));
        $this->set('hasUsers', $this->User->hasUsers());

        $this->render('index', 'angular');
    }

    /**
     * This method serves as a simple User WebService, accepting these HTTP requests:
     *      - GET: search/list all users
     *      - POST: add a single user
     *      - DELETE: delete a single user
     * @param mixed $userids The selected ids of users, imploded by comma (,)
     * @return void As return, provide a json representation of userlist query. Or messages sended to view.
     */
    public function users($userids = NULL) {
        //$this->response->statusCode(500); // http://www.recessframework.org/page/towards-restful-php-5-basic-tips#tip3
        //$this->response->type('json'); // http://book.cakephp.org/2.0/pt/controllers/request-response.html

        @ini_set('display_errors', false); // prevent errors on json output

        if ($this->request->is('put')) { // edit
            // oh, no! PHP does not have a $_PUT ...
            $user = json_decode(file_get_contents("php://input"));

            $this->User->id = @$user->User->id;
            if (!$this->User->exists()) {
                $return = __('Error') . ": " . __('Can not find specifyed user');
                $this->response->statusCode(400); // invalid request
            } else if (!empty($user->User->password) && $user->User->password !== @$user->User->password2) {
                $return = __('Error') . ": " . __('Passwords did not match.');
                $this->response->statusCode(400); // invalid request
            } else {
                unset($user->User->username, $user->Level->description, $user->User->created, $user->User->password2);
                if (empty($user->User->password)) {
                    unset($user->User->password);
                }
                if ($this->User->save((array) $user->User)) {
                    $return = array('data' => __('Success: Profile updated'));
                } else {
                    $return = __('Error') . ": " . __('The user could not be saved. Please, try again.');
                    $this->response->statusCode(500); // server error
                }
            }
        } else if ($this->request->is('post')) { // add
            $user = json_decode(file_get_contents("php://input"));
            $this->User->create();
            if (!$this->User->hasUsers()) {
                $user->User->level = 1;
            }
            if (empty($user->User->password)) {
                $return = __('Error') . ": " . __('Please fill the password field.');
                $this->response->statusCode(400); // invalid request
            } else if ($user->User->password !== @$user->User->password2) {
                $return = __('Error') . ": " . __('Passwords did not match.');
                $this->response->statusCode(400); // invalid request
            } else if (!$this->User->save($user->User)) {
                $return = __('Error') . ": " . __('The user could not be saved. Please, try again.');
                $this->response->statusCode(500); // server error (when deletting)
            } else {
                $return = array('data' => __('Success: User correctly added.'));
                $this->response->statusCode(201); // created
            }
        } else if ($this->request->is('delete')) { // purge
            $this->User->id = $userids;
            if (!$this->User->exists()) {
                $return = __('Error') . ": " . __('Invalid user');
                $this->response->statusCode(404); // not found
            } else if (!$this->User->delete($userids, true)) {
                $return = __('Error: The user was not deleted');
                $this->response->statusCode(500); // server error
            } else {
                $return = array('data' => __('Note: User and his data was deleted'));
            }
        } else if ($this->request->is('get')) { // list
            $this->User->recursive = -1;
            $query = array(
                'fields' => array('User.id', 'User.username', 'User.name', 'User.created', 'User.level', 'Level.description',),
                'joins' => array(
                    array(
                        'table' => 'levels',
                        'alias' => 'Level',
                        'conditions' => array('User.level = Level.id',),
                    )
                ),
                'recursive' => -1,
            );
            if (!is_null($userids) && !empty($userids)) {
                $query['conditions'] = array(
                    'User.id' => explode(",", $userids),
                );
            }
            $return = $this->User->find('all', $query);
            //header('Content-Type: application/json');
            $this->response->type('json');
        }
        //die($return);
        $this->set('return', json_encode($return));
        $this->render('ajax', 'ajax');
    }

    /**
     * Set permissions, blocking access of non-admins on register, delete and config actions
     * Currently, it allow to see:
     * - users: index
     * - own user: profile
     * - admins: add, delete, profile
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
