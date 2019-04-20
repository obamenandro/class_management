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

    public function show_list() {
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
                'conditions' => $conditions,
                'fields' => ['Attendance.*', 'Student.name as student_name']
            ]);

            if (!empty($attendance)) {

                foreach ($attendance as $key => $value) {
                    $attendance[$key]['Attendance']['student_name'] = $value['Student']['student_name'];
                }

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
    public function edit() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is(['put', 'post'])) {
            try {
                $data = $this->request->data;
                $attendances = [];
                foreach($data['attendance'] as $value) {
                    $dataToSave = [
                        'student_id' => $value['student_id'],
                        'course_id'  => $value['course_id'],
                        'date_taken' => $value['date_taken'],
                        'is_present' => $value['is_present']
                    ];

                    if (isset($value['id']) && $value['id'] !== 'undefined') {
                        $dataToSave['id'] = $value['id'];
                    }

                    $attendances[]['Attendance'] = $dataToSave;
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
                    'message' => $e->getMessage()
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
            foreach($data['attendance'] as $value) {
                $attendances[]['Attendance'] = [
                    'student_id' => $value['student_id'],
                    'course_id'  => $value['course_id'],
                    'date_taken' => $value['date_taken'],
                    'is_present' => $value['is_present']
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
