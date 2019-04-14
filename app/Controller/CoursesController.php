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
}
