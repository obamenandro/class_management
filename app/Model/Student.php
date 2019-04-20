<?php
App::uses('AppModel', 'Model');
/**
 * Student Model
 *
 */
class Student extends AppModel {

  /**
   * belongsTo associations
   *
   * @var array
   */
  public $belongsTo = array(
    'Course' => array(
      'className' => 'Course',
      'foreignKey' => 'course_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

}
