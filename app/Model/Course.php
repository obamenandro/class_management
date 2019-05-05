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

    public $belongsTo = array(
        'Instructor' => array(
          'className' => 'Instructor',
          'foreignKey' => 'instructor_id',
          'conditions' => '',
          'fields' => '',
          'order' => ''
        )
    );

    public $hasMany = [
        'Criterion' => array(
            'className' => 'Criterion',
            'foreignKey' => 'course_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Student' => array(
            'className' => 'Student',
            'foreignKey' => 'course_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    ];

}
