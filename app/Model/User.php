<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User model
 */
class User extends AppModel {

    public $name = 'User';

    /** @var array A user has many posts */
    public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id',
            'dependent' => true,
        )
    );

    /** @var array Validations of Users data */
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
    );

    /**
     * Passwords encription before creation of user ;)
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

    /**
     * Verify if has users in the database
     * @return boolean
     */
    public function hasUsers() {
        return $this->find('count') > 0;
    }

}
