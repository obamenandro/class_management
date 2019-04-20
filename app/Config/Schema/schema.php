<?php 
class AppSchema extends CakeSchema {

    public function before($event = array()) {
        return true;
    }

    public function after($event = array()) {
    }

    public $students = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'name' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'name'
        ],
        'course_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'deleted' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 0, 
            'unsigned' => false
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    public $instructors = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'username' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'first_name' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Firstname'
        ],
        'last_name' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Lastname'
        ],
        'position' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Position'
        ],
        'password' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'birthday' => [
            'type'    => 'date', 
            'null'    => false
        ],
        'gender' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'contact_no' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8',
        ],
        'deleted' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 0, 
            'unsigned' => false
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    // public $subjects = [
    //     'id' => [
    //         'type'     => 'integer', 
    //         'null'     => false, 
    //         'default'  => null, 
    //         'unsigned' => false, 
    //         'key'      => 'primary'
    //     ],
    //     'name' => [
    //         'type'    => 'string', 
    //         'null'    => false, 
    //         'default' => null, 
    //         'collate' => 'utf8_general_ci', 
    //         'charset' => 'utf8', 
    //     ],
    //     'category_id' => [
    //         'type'     => 'integer', 
    //         'null'     => false, 
    //         'default'  => null, 
    //         'unsigned' => false
    //     ],
    //     'units' => [
    //         'type'     => 'integer', 
    //         'null'     => false, 
    //         'default'  => null, 
    //         'unsigned' => false
    //     ],
    //     'deleted_date' => [
    //         'type'    => 'datetime', 
    //         'null'    => true, 
    //         'default' => null
    //     ],
    //     'created' => [
    //         'type'    => 'datetime', 
    //         'null'    => true, 
    //         'default' => null,
    //         'comment' =>'Created Date'
    //     ],
    //     'modified' => [
    //         'type'    => 'datetime', 
    //         'null'    => true, 
    //         'default' => null,
    //         'comment' =>'Modified Date'
    //     ],
    //     'indexes' => [
    //         'PRIMARY' => ['column' => 'id', 'unique' => 1],
    //     ],
    //     'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    // ];

    public $categories = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'name' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'code' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    public $courses = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'instructor_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'name' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'code' => [
            'type'     => 'string', 
            'null'     => false, 
            'default'  => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'schedule' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'deleted' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 0, 
            'unsigned' => false
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    public $attendances = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'student_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'course_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'date_taken' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null
        ],
        'is_present' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 0, 
            'unsigned' => false
        ],
        'deleted' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 0, 
            'unsigned' => false
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    // public $instructor_subjects = [
    //     'id' => [
    //         'type'     => 'integer', 
    //         'null'     => false, 
    //         'default'  => null, 
    //         'unsigned' => false, 
    //         'key'      => 'primary'
    //     ],
    //     'instructor_id' => [
    //         'type'     => 'integer', 
    //         'null'     => false, 
    //         'default'  => null, 
    //         'unsigned' => false
    //     ],
    //     'subject_id' => [
    //         'type'     => 'integer', 
    //         'null'     => false, 
    //         'default'  => null, 
    //         'unsigned' => false
    //     ],
    //     'deleted_date' => [
    //         'type'    => 'datetime', 
    //         'null'    => true, 
    //         'default' => null
    //     ],
    //     'created' => [
    //         'type'    => 'datetime', 
    //         'null'    => true, 
    //         'default' => null,
    //         'comment' =>'Created Date'
    //     ],
    //     'modified' => [
    //         'type'    => 'datetime', 
    //         'null'    => true, 
    //         'default' => null,
    //         'comment' =>'Modified Date'
    //     ],
    //     'indexes' => [
    //         'PRIMARY' => ['column' => 'id', 'unique' => 1],
    //     ],
    //     'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    // ];

    public $activities = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'name' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'course_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'criteria_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'deleted' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 0, 
            'unsigned' => false
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    public $criteria = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'name' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'percentage' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'course_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
        ],
        'deleted' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 0, 
            'unsigned' => false
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];

    public $activity_results = [
        'id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false, 
            'key'      => 'primary'
        ],
        'student_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'activity_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'score' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false,
            'comment' =>'1:Pass 2:Failed'
        ],
        'deleted' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => 0, 
            'unsigned' => false
        ],
        'deleted_date' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null
        ],
        'created' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Created Date'
        ],
        'modified' => [
            'type'    => 'datetime', 
            'null'    => true, 
            'default' => null,
            'comment' =>'Modified Date'
        ],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1],
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];
}
