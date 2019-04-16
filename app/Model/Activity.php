<?php
App::uses('AppModel', 'Model');
/**
 * Activity Model
 *
 */
class Activity extends AppModel {

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
		),
		'Criterion' => array(
			'className' => 'Criterion',
			'foreignKey' => 'criteria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
