<?php
App::uses('AppController', 'Controller');
/**
 * Attendances Controller
 *
 * @property Attendance $Attendance
 * @property PaginatorComponent $Paginator
 */
class AttendancesController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');

    public function list() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if (!empty($this->request->query)) {
            $conditions = [];
            if (!empty($this->request->query['date_taken'])) {
                $conditions['Attendance.date_taken'] = $this->request->query['date_taken'];
            }

            if (!empty($this->request->query['course_id'])) {
                $conditions['Attendance.course_id'] = $this->request->query['course_id'];
            }
            $conditions['Attendance.deleted'] = 0;

            $attendance = $this->Attendance->find('all', [
                'conditions' => $conditions
            ]);

            if (!empty($attendance)) {
                $response = [
                    'status' => 'success',
                    'data' => $attendance
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'data' => 'No record found.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
    /**
     * Edit attendance
     */
    public function edit($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is(['put', 'post'])) {
            try {
                $data = $this->request->data;
                $attendances = [];
                foreach($data as $value) {
                    $attendances[]['Attendance'] = [
                        'id'         => $value['id'],
                        'student_id' => $value['student_id'],
                        'course_id'  => $value['course_id'],
                        'date_taken' => $value['date_taken'],
                    ];
                } 
                if ($this->Attendance->saveMany($attendances)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Attendance has been successfully updated.'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'message' => 'Attendance has been failed to update.'
                ];
            }
            $this->response->type('application/json');
            return $this->response->body(json_encode($response));
        }
    }
    /**
     * Add Attendance
     */
    public function add() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $attendances = [];
            foreach($data as $value) {
                $attendances[]['Attendance'] = [
                    'student_id' => $value['student_id'],
                    'course_id'  => $value['course_id'],
                    'date_taken' => $value['date_taken'],
                ];
            } 
            if ($this->Attendance->saveMany($attendances)) {
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
