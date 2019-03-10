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
        'firstname' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Firstname'
        ],
        'middlename' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Middlename'
        ],
        'lastname' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Lastname'
        ],
        'address' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Address'
        ],
        'contact' => [
            'type'     => 'biginteger', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'civil_status' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
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
        'firstname' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Firstname'
        ],
        'middlename' => [
            'type'    => 'string', 
            'null'    => true, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Middlename'
        ],
        'lastname' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Lastname'
        ],
        'image' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'username' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
        ],
        'job_title' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
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
        'address' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
            'comment' =>'Address'
        ],
        'gender' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'contact' => [
            'type'     => 'biginteger', 
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

    public $subjects = [
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
        'category_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'units' => [
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
        'instructor_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'status' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'note' => [
            'type'    => 'string', 
            'null'    => false, 
            'default' => null, 
            'collate' => 'utf8_general_ci', 
            'charset' => 'utf8', 
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

    public $instructor_subjects = [
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
        'subject_id' => [
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

    public $departments = [
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

    public $exams = [
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
        'subject_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'type' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false,
            'comment' =>'1:Mid 2:Final'
        ],
        'status' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false,
            'comment' =>'1:Pass 2:Failed'
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

    public $projects = [
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
        'subject_id' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false
        ],
        'status' => [
            'type'     => 'integer', 
            'null'     => false, 
            'default'  => null, 
            'unsigned' => false,
            'comment' =>'1:Pass 2:Failed'
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
