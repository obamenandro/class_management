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

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','logout','add','edit', 'delete');
    }

    /** 
     * Get students which belong to course using course id
    */
    public function show_list($id) {
        $this->autRender = false;
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($id) {
            $student = $this->Student->find('all', [
                'conditions' => [
                    'Student.course_id' => $id,
                    'Student.deleted' => 0
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
            if (!empty($data['name']) && isset($data['name'])) {
                $conditions['Student.name LIKE'] = '%' . $data['name'] . '%';
            }
            if (!empty($data['student_id']) && isset($data['student_id'])) {
                $conditions['Student.student_id'] = $data['student_id'];
            }
            $conditions['Student.deleted_date'] = NULL;

            $students = $this->Student->find('all', [
                'conditions' => $conditions
            ]);

            if (!empty($students)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Record found.',
                    'data' => [$students]
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'No record found.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
}
