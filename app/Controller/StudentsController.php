<?php
App::uses('AppController', 'Controller');
/**
 * Students Controller
 *
 * @property Student $Student
 * @property PaginatorComponent $Paginator
 */
class StudentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');

    public $uses = ['Attendance', 'Course', 'Student'];

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','logout','add','edit', 'delete');
    }

    /** 
     * Get students which belong to course using course id
    */
    public function show_list($id) {
        $this->autoRender = false;
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($id) {
            $student = $this->Student->find('all', [
                'conditions' => [
                    'Student.course_id' => $id,
                    'Student.deleted' => 0
                ],
                'order' => [
                    ['Student.name' => 'ASC']
                ]
            ]);

            if (!empty($student)) {
                $response = [
                    'status' => 'success',
                    'data' => $student
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'No student available.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }

    /**
     * Add Student
     */
    public function add() {
        if ($this->request->is('POST')) {
            try {
                $data = $this->request->data;
                $data['name'] = ucwords($data['name']);
                if ($this->Student->save($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Student has been successfully saved.'
                    ];
                }
            } catch (Exception $e) { 
                $response = [
                    'status' => 'failed',
                    'message' => 'Student has been failed to saved.'
                ];
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'HTTP method not allowed.'
            ];
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }

    /**
     * Edit student
     * param $id student_id
     */
    public function edit($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is(['put', 'post'])) {
            try {
                $data = $this->request->data;
                $this->Student->id = $id;
                if ($this->Student->save($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Student has been successfully updated.'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'message' => 'Student has been failed to update.'
                ];
            }
            $this->response->type('application/json');
            return $this->response->body(json_encode($response));
        }
    }

    /**
     * Delete student
     * * param $id student_id
     */
    public function delete($id) {
        $student = $this->Student->find('first' , [
            'conditions' => [
                'Student.id' => $id,
                'Student.deleted' => 0
            ]
        ]);
        if (empty($student)) {
            $response = [
                'status' => 'failed',
                'message' => 'Student is not exists.'
            ];
        } else {
            $data['Student'] = [
                'id' => $id,
                'deleted' => 1,
                'deleted_date' => date('Y-m-d')
            ];
            if ($this->Student->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Student has been successfully deleted.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Student has been failed to delete.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
    /**
     * Seach student
     */
    public function search() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->query) {
            $data = $this->request->query;
            $conditions = [];
            if (!empty($data['instructor_id']) && isset($data['instructor_id'])) {
                $courses = $this->Course->find('list', [
                    'conditions' => [
                        'Course.instructor_id' => $data['instructor_id'],
                        'Course.deleted' => 0
                    ],
                    'fields' => ['Course.id']
                ]);

                $conditions['Student.course_id'] = $courses;
            
                if (!empty($data['name']) && isset($data['name'])) {
                    $conditions['Student.name LIKE'] = '%' . $data['name'] . '%';
                }
                if (!empty($data['student_id']) && isset($data['student_id'])) {
                    $conditions['Student.student_id'] = $data['student_id'];
                }
                $conditions['Student.deleted_date'] = NULL;

                $students = $this->Student->find('all', [
                    'conditions' => $conditions,
                    'fields' => [
                        'Student.*',
                        'Course.code'
                    ],
                    'order' => [
                        ['Student.name' => 'ASC']
                    ]
                ]);

                if (!empty($students)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Record found.',
                        'data' => $students
                    ];
                } else {
                    $response = [
                        'status' => 'failed',
                        'message' => 'No record found.'
                    ];
                }
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }

    /** 
     * Get students which belong to course using course id
    */
    public function final_grade($id) {
        $this->autoRender = false;
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($id) {
            $student = $this->Student->find('first', [
                'conditions' => [
                    'Student.id' => $id,
                    'Student.deleted' => 0
                ],
            ]);

            if (!empty($student)) {

                $this->Course->Behaviors->load('Containable');
                $data = $this->Course->find('first', [
                    'conditions' => [
                        'Course.id' => $student['Student']['course_id'],
                        'Course.deleted' => 0
                    ],
                    'contain' => [
                        'Criterion' => [
                            'conditions' => [
                                'Criterion.deleted = 0'
                            ],
                            'Activity' => [
                                'conditions' => [
                                    'Activity.deleted = 0'
                                ],
                                'ActivityResult' => [
                                    'conditions' => [
                                        'ActivityResult.student_id' => $student['Student']['id'],
                                        'ActivityResult.deleted' => 0
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);

                $gradePerCriterion = [];
                foreach ($data['Criterion'] as $criterion) {
                    $gradePerCriterion[$criterion['id']]['name'] = $criterion['name'];
                    $gradePerCriterion[$criterion['id']]['grade'] = 0;
                    $averageCriteriaGrade = 0;

                    foreach ($criterion['Activity'] as $activity) {
                        if (!empty($activity['ActivityResult'])) {
                           $averageCriteriaGrade += $activity['ActivityResult'][0]['score'];
                        }
                    }

                    if (!empty($criterion['Activity'])) {
                        $averageCriteriaGrade /= count($criterion['Activity']);
                    } else {
                        $averageCriteriaGrade = 100;
                    }

                    $gradePerCriterion[$criterion['id']]['grade'] =
                        $averageCriteriaGrade * ($criterion['percentage']/100);
                }

                $finalGrade = 0;

                $responseData = [
                    'Criterion' => [],
                    'final_grade' => 0,
                    'present_count' => 0,
                    'absent_count' => 0
                ];

                foreach ($gradePerCriterion as $grade) {
                    $responseData['Criterion'][] = [
                        'name' => $grade['name'],
                        'grade' => $grade['grade']
                    ];
                    $finalGrade += $grade['grade'];
                }

                $responseData['final_grade'] = $finalGrade;

                // Count attendance

                $totalAttendanceDays = $this->Attendance->find('count', [
                    'conditions' => [
                        'Attendance.course_id' => $student['Student']['course_id'],
                        'Attendance.deleted' => 0
                    ],
                    'fields' => 'DISTINCT Attendance.date_taken'
                ]);

                $studentAttendanceDays = $this->Attendance->find('count', [
                    'conditions' => [
                        'Attendance.student_id' => $student['Student']['id'],
                        'Attendance.is_present' => 1,
                        'Attendance.deleted' => 0
                    ]
                ]);

                $responseData['present_count'] = $studentAttendanceDays;
                $responseData['absent_count'] = $totalAttendanceDays - $studentAttendanceDays;

                $response = [
                    'status' => 'success',
                    'data' => $responseData
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'No student available.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
}
