<?php
App::uses('AppController', 'Controller');
/**
 * Courses Controller
 *
 * @property Course $Course
 * @property PaginatorComponent $Paginator
 */
class CoursesController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');

    public $uses = ['Course', 'Criterion'];

    /** 
     * Get courses which belong to instructor using instructor id
    */
    public function show_list($id) {
        $this->autRender = false;
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($id) {
            $courses = $this->Course->find('all', [
                'conditions' => [
                    'Course.instructor_id' => $id,
                    'Course.deleted' => 0
                ]
            ]);

            if (!empty($courses)) {
                $response = [
                    'status' => 'success',
                    'data' => $courses
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'No courses available.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
    /**
     * Add Courses
     */
    public function add() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['name'] = ucwords($data['name']);
            if ($this->Course->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Successfully save course.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Course has been failed to saved.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
    /**
     * Edit courses
     */
    public function edit($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is(['put', 'post'])) {
            try {
                $data = $this->request->data;
                $this->Course->id = $id;
                if ($this->Course->save($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Course has been successfully updated.'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'message' => 'Course has been failed to update.'
                ];
            }
            $this->response->type('application/json');
            return $this->response->body(json_encode($response));
        }
    }
    /**
     * Delete Courses
     */
    public function delete($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        $check = $this->Course->find('first' , [
            'conditions' => [
                'Course.id' => $id,
                'Course.deleted' => 0
            ]
        ]);

        if (!empty($check)) {
            $course['Course'] = [
                'id' => $id,
                'deleted' => 1,
                'deleted_date' => date('Y-m-d')
            ];
            if ($this->Course->save($course)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Course successfully deleted.'
                ];
            } else {
                $response = [
                    'status' => 'failed', 
                    'message' => 'Course has been failed to delete.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }

    /** 
     * Download course csv
    */
    public function download_csv($id) {
        $this->autRender = false;
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($id) {

            $course = $this->Course->find('first', [
                'conditions' => [
                    'Course.id' => $id,
                    'Course.deleted' => 0
                ],
            ]);

            if (!empty($course)) {

                $this->Course->Behaviors->load('Containable');
                $data = $this->Course->find('first', [
                    'conditions' => [
                        'Course.id' => $id,
                        'Course.deleted' => 0
                    ],
                    'contain' => [
                        'Instructor',
                        'Student' => [
                            'conditions' => ['Student.deleted = 0'],
                            'ActivityResult' => [
                                'conditions' => ['ActivityResult.deleted = 0']
                            ]
                        ]
                    ]
                ]);

                $this->Criterion->Behaviors->load('Containable');
                $criteria = $this->Criterion->find('all', [
                    'conditions' => [
                        'Criterion.course_id' => $id,
                        'Criterion.deleted' => 0
                    ],
                    'contain' => [
                        'Activity' => [
                            'fields' => ['Activity.id', 'Activity.name'],
                            'conditions' => ['Activity.deleted = 0']
                        ]
                    ],
                    'fields' => [
                        'Criterion.name',
                        'Criterion.percentage',
                        'Criterion.id',
                    ]
                ]);

                $csvContent = '';
                $endLine = '"' . "\n";

                $csvContent .= '"Course code:","' . $course['Course']['code'] . ' - ' . $course['Course']['name'] . $endLine;
                $csvContent .= '"Schedule:","' . $course['Course']['schedule'] . $endLine;
                $csvContent .= '"Instructor:","' . $course['Instructor']['first_name'] . ' ' . $course['Instructor']['last_name'] . $endLine;
                $csvContent .= ',,';

                foreach ($criteria as $criterion) {
                    $csvContent .= ',"' . $criterion['Criterion']['name'] . '(' . $criterion['Criterion']['percentage'] . '%)' . '"';
                    $cellSpaces = count($criterion['Activity']);
                    if ($cellSpaces > 0) {
                        $cellSpaces++;
                    }
                    for ($i = 0; $i < $cellSpaces; $i++) { 
                        $csvContent .= ',';
                    }
                }

                $csvContent .= "\n";

                $csvContent .= ',"Student #","Student Name"';

                foreach ($criteria as $criterion) {
                    foreach ($criterion['Activity'] as $activity) {
                        $csvContent .= ',"' . $activity['name'] . '"';
                    }
                    if (count($criterion['Activity']) == 0) {
                        $csvContent .= ',';
                    } else {
                        $csvContent .= ',"AVERAGE","ACTUAL"';
                    }
                }

                $csvContent .= ',"FINAL AVE","FINAL ACTUAL"' . "\n";

                foreach ($data['Student'] as $student) {
                    $csvContent .= ',"' . $student['number'] . '","' . $student['name'] . '"';
                    $finalAverage = 0;
                    $finalActual = 0;
                    foreach ($criteria as $criterion) {
                        $totalGrade = 0;
                        foreach ($criterion['Activity'] as $activity) {
                            $hasResult = 0;
                            foreach ($student['ActivityResult'] as $activityResult) {
                                if ($activityResult['activity_id'] == $activity['id']) {
                                    $csvContent .= ',"' . $activityResult['score'] . '"';
                                    $totalGrade += $activityResult['score'];
                                    $hasResult = 1;
                                    break;
                                }
                            }
                            if ($hasResult == 0) {
                                $csvContent .= ',"0"';
                            }
                        }
                        if (count($criterion['Activity']) == 0) {
                            $csvContent .= ',';
                        } else {
                            $average = $totalGrade / count($criterion['Activity']);
                            $actual = $average * ($criterion['Criterion']['percentage'] / 100);
                            $csvContent .= ',"' . $average . '","' . $actual . '"';
                            $finalAverage += $average;
                            $finalActual += $actual;
                        }
                    }
                    $csvContent .= ',"' . $finalAverage . '","' . $finalActual . '"' . "\n";
                }       
                $fileName = $data['Course']['code'] . '-' . strtotime(date('Y-m-d H:i:s')) . '.csv';
                $filePath = APP . 'webroot' . DS . 'files' . DS . $fileName;
                file_put_contents($filePath, $csvContent);
                $response = [
                    'status' => 'success',
                    'message' => $fileName
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Course not found.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }

}
