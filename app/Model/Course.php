<?php
App::uses('AppModel', 'Model');
/**
 * Course Model
 *
 */
class Course extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'name';

    public $hasMany = [
        'Criterion' => array(
            'className' => 'Criterion',
            'foreignKey' => 'course_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    ];

}
