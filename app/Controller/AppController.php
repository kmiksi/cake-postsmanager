<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /** @var int ID corresponding to Admin userlevel */
    const ADMIN_LEVEL = 1;

    /** @var int ID corresponding to User userlevel */
    const USER_LEVEL = 2;

    /** @var array Set components and yur configurations (like auth redirections) */
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'dashboard'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'authorize' => array('Controller'),
        )
    );

    /**
     * @ignore
     * For compatibility purposes only.
     * To integrate with NetBeans xdebug that launch url with webroot
     * @param mixed $params
     */
    public function webroot($params = null) {
        $this->redirect('/');
    }

    /**
     * Set the language of system
     * @param string $lang The language, like eng or por
     */
    public function lang($lang = null) {
        $this->Session->write('Config.language', $lang);
        $this->redirect('/pages/dashboard');
    }

    public function beforeFilter() {
        $this->Auth->authenticate = array('Form');
        $this->set('ADMIN_LEVEL', self::ADMIN_LEVEL);
        $this->set('avatars', array(
            "avatar5",
            "avatar",
            "avatar3",
            "avatar04",
            "avatar2",
        ));
        if ($this->Session->check('Config.language')) {
            Configure::write('Config.language', $this->Session->read('Config.language'));
        }
    }

    public function isAuthorized($user) {
        return true;
    }

}
