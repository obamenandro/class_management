<?php
App::uses('AppController', 'Controller');
/**
 * ActivityResults Controller
 *
 * @property ActivityResult $ActivityResult
 * @property PaginatorComponent $Paginator
 */
class ActivityResultsController extends AppController {

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
            if (!empty($this->request->query['activity_id'])) {
                $conditions['ActivityResult.activity_id'] = $this->request->query['activity_id'];
            }

            $conditions['ActivityResult.deleted'] = 0;

            $activity_results = $this->ActivityResult->find('all', [
                'conditions' => $conditions,
                'fields' => [
                    'ActivityResult.*',
                    'Student.name'
                ]
            ]);

            if (!empty($activity_results)) {
                $response = [
                    'status' => 'success',
                    'data' => $activity_results
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
     * Add ActivityResults
     */
    public function add() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $results = [];
            foreach ($data['activity_result'] as $value) {
                $results[]['ActivityResult'] = [
                    'student_id'  => $value['student_id'],
                    'activity_id' => $value['activity_id'],
                    'score'       => $value['score'] != 'null' ? $value['score'] : 0,
                ];
            }
            if ($this->ActivityResult->saveMany($results)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Successfully save results.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Results has been failed to saved.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
    /**
     * Edit ActivityResults
     */
    public function Edit() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is(['put', 'post'])) {
            $data = $this->request->data;
            $results = [];
            foreach ($data['activity_result'] as $value) {
                $dataToSave = [
                    'student_id'  => $value['student_id'],
                    'activity_id' => $value['activity_id'],
                    'score'       => $value['score'] != 'null' ? $value['score'] : 0,
                ];

                if (isset($value['id']) && $value['id'] !== 'undefined') {
                    $dataToSave['id'] = $value['id'];
                }

                $results[]['ActivityResult'] = $dataToSave;
            }
            if ($this->ActivityResult->saveMany($results)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Successfully updated results.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Results has been failed to update.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
}
