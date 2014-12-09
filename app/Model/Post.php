<?php

App::uses('AppModel', 'Model');
App::uses('CakeTime', 'Utility');

/**
 * Posts model
 */
class Post extends AppModel {

    public $name = 'Post';

    /** @var array A post belongs to one user */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'fields' => 'id, name, username, level',
        )
    );

    /** @var array Validations of Post data */
    public $validate = array(
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'content' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
        'priority' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        ),
    );

    /**
     * With this, selects will return formatted info.
     * 
     * @param array $results results of query
     * @param boolean $primary 
     * @return array resuts
     */
    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $value) {
            if (!empty($value['Post']['created'])) {
                $time = explode(' ', $value['Post']['created']);
                $results[$key]['Post']['day'] = CakeTime::format('D, d M Y', $time[0], 'Unknow');
                $results[$key]['Post']['time'] = CakeTime::format('H\hi', $time[1], 'Unknow');
            }
        }
        return $results;
    }

    /**
     * Check if user is owner of post
     * 
     * @param int $post_id ID of Post
     * @param int $user_id ID of User
     * @return boolean
     */
    public function isOwnedBy($post_id, $user_id) {
        return $this->field('id', array('id' => $post_id, 'user_id' => $user_id)) === $post_id;
    }

}
