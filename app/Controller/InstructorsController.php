<?php
App::uses('AppController', 'Controller');
/**
 * Instructors Controller
 *
 * @property Instructor $Instructor
 * @property PaginatorComponent $Paginator
 */
class InstructorsController extends AppController {

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
     * Add instructor
     */
    public function add() {
        if ($this->request->is('post')) {
            try {
                $data = $this->request->data;
                if ($this->Instructor->save($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Instructor has been successfully saved.'
                    ];
                } 
            } catch (Exception $e) { 
                $response = [
                    'status' => 'failed',
                    'message' => $e->getMessage()
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
     * Edit instructor
     * param $id instructor_id
     */
    public function edit($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is(['put', 'post'])) {
            try {
                $data = $this->request->data;

                if ($data['password'] == 'null') {
                    unset($data['password']);
                }

                $this->Instructor->id = $id;
                if ($this->Instructor->save($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Instructor has been successfully updated.'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'message' => 'Instructor has been failed to update.'
                ];
            }
            $this->response->type('application/json');
            return $this->response->body(json_encode($response));
        }
    }
    /**
     * Delete instructor
     * * param $id instructor_id
     */
    public function delete($id) {
        $instructor = $this->Instructor->find('first' , [
            'conditions' => [
                'Instructor.id' => $id,
                'Instructor.deleted' => 0
            ]
        ]);
        if (!empty($instructor)) {
            $response = [
                'status' => 'failed',
                'message' => 'Instructor is not exists.'
            ];
        } else {
            $data['Instructor'] = [
                'id' => $id,
                'deleted' => 1,
                'deleted_date' => date('Y-m-d')
            ];
            if ($this->Instructor->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Instructor has been successfully deleted.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Instructor has been failed to delete.'
                ];
            }
        }
        $this->response->type('application/json');
        $this->response->body(json_encode($response));
        return $this->response->send();
    }

    /**
     * Instructor Login 
     */
    public function login() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $instructor = $this->Instructor->find('first', [
                'conditions' => [
                    'Instructor.password' => AuthComponent::password($data['password']),
                    'Instructor.username' => $data['username']
                ]
            ]);
            if (!empty($instructor)) {
                $this->Session->write('Auth', $instructor);
                $response = [
                    'status' => 'success',
                    'message' => 'Successfully login.',
                    'data' => [$instructor]
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Invalid Username or Password entered, please try again.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }

    public function logout() {
        $this->autoRender = false;
        if ($this->Auth->logout()) {
            $response = [
                'status' => 'success',
                'message' => 'Logout'
            ];
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }

    public function attendance() {
        $this->autRender = false;
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if ($this->Attendance->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Successfully save attendance.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Attendance has been failed to saved.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
}
