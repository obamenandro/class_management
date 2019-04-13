<?php
App::uses('AppController', 'Controller');
/**
 * Activities Controller
 *
 * @property Activity $Activity
 * @property PaginatorComponent $Paginator
 */
class ActivitiesController extends AppController {

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
            if (!empty($this->request->query['course_id'])) {
                $conditions['Activity.course_id'] = $this->request->query['course_id'];
            }

            $conditions['Activity.deleted'] = 0;

            $activities = $this->Activity->find('all', [
                'conditions' => $conditions
            ]);

            if (!empty($activities)) {
                $response = [
                    'status' => 'success',
                    'data' => $activities
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
     * Add Activity
     */
    public function add() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if ($this->Activity->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Successfully save activities.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Activities has been failed to saved.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
    /**
     * Edit Activity
     */
    public function edit($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is(['put', 'post'])) {
            try {
                $data = $this->request->data;
                $this->Activity->id = $id;
                if ($this->Activity->save($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Activities has been successfully updated.'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'message' => 'Activities has been failed to update.'
                ];
            }
            $this->response->type('application/json');
            return $this->response->body(json_encode($response));
        }
    }
    /**
     * Delete Activity
     */
    public function delete($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        $check = $this->Activity->find('first' , [
            'conditions' => [
                'Activity.id' => $id,
                'Activity.deleted' => 0
            ]
        ]);

        if (!empty($check)) {
            $activity['Activity'] = [
                'id' => $id,
                'deleted' => 1,
                'deleted_date' => date('Y-m-d')
            ];
            if ($this->Activity->save($activity)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Activity successfully deleted.'
                ];
            } else {
                $response = [
                    'status' => 'failed', 
                    'message' => 'Activity has been failed to delete.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
}
