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
        $this->response->body(json_encode($response));
        return $this->response->send();
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
            $this->response->body(json_encode($response));
            return $this->response->send();
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
        if (!empty($student)) {
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
        $this->response->body(json_encode($response));
        return $this->response->send();
    }
}
