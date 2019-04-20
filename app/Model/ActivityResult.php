<?php
App::uses('AppModel', 'Model');
/**
 * ActivityResult Model
 *
 */
class ActivityResult extends AppModel {

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'student_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

}
