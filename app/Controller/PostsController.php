<?php

App::uses('AppController', 'Controller');

/**
 * Controller to manage Posts in the system
 */
class PostsController extends AppController {

    /**
     * Allow index access to anyone
     */
    public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow('index');
    }

    /**
     * Set information needed by default template
     */
    public function beforeRender() {
        parent::beforeRender();
        $this->set('subpage', __('Posts'));
    }

    /**
     * List posts in a timeline.
     * Non authenticated users can see a different page (not implemented at time of writing)
     * @todo pagination?
     */
    public function index() {
        if ($this->Auth->user()) {

            if (!empty($this->request->query['q'])) {
                $posts = $this->Post->find('all', array(
                    'conditions' => array(
                        'content LIKE' => '%' . $this->request->query['q'] . '%',
                    ),
                    'order' => 'Post.created DESC, Post.id DESC',
                ));
            } else {
                $posts = $this->Post->find('all', array('order' => 'Post.created DESC, Post.id DESC'));
            }

            $this->set('posts', $posts);

            $this->set('page', __('Posts'));
            $this->set('title_for_layout', __('List of posts'));
        } else {
            $this->set('title_for_layout', __('Do login to visualize posts'));
            $this->render('lowindex');
        }
    }

    /**
     * Add a new post into database.
     * After loaded page, the data is passed via POST
     */
    public function add() {
        if ($this->request->is('post')) {

            if (empty($this->request->data['id'])) {
                $this->Post->create();
                $this->request->data['user_id'] = AuthComponent::user('id');
            } else {
                $this->Post->id = $this->request->data['id'];
            }

            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Success: The post has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Error while saving post'));
            }
        }
        $this->set('page', __('Add a new post'));
        $this->render('post');
    }

    /**
     * Edit posts by ID
     * @param int $id ID of post
     */
    public function edit($id = null) {
        $this->Post->recursive = -1;
        $post = $this->Post->findById($id);
        if (empty($post)) {
            $this->Session->setFlash(__('Invalid post'));
            $this->redirect(array('action' => 'index'));
            //} else if (!$this->Post->isOwnedBy($id, AuthComponent::user('id'))) {
            //    $this->Session->setFlash(__('You are not allowed to edit'));
            //    $this->redirect(array('action' => 'index'));
        }
        $this->set('post', $post['Post']);
        $this->set('page', __('Edit post'));
        $this->set('title_for_layout', __("Post #%d", $id));
        $this->render('post');
    }

    /**
     * Delete posts by ID
     * @param int $id ID of post
     */
    public function delete($id = null) {
        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            $this->Session->setFlash(__('Invalid post'));
        } else {
            if ($this->Post->delete()) {
                $this->Session->setFlash(__('Note: Post deleted'));
            } else {
                $this->Session->setFlash(__('Error: Post was not deleted'));
            }
        }
        $this->redirect('index');
    }

    /**
     * Authorization rules.
     * Users can see index, add new posts, edit and delete your own posts.
     * Admins can edit and delete all posts.
     * @param array $user User to check permissions
     * @return boolean
     */
    public function isAuthorized($user) {
        if (in_array($this->action, array('edit', 'delete'))) {
            if (isset($user['level']) && (int) $user['level'] === self::ADMIN_LEVEL) {
                return true;
            }
            $id = $this->request->params['pass'][0];
            if (!$this->Post->isOwnedBy($id, $user['id'])) {
                $this->Session->setFlash(__('You are not allowed to edit or delete posts of another users'));
                return false;
            }
        }
        return true;
    }

}
