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

    public function list() {
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
                'conditions' => $conditions
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
            if ($this->ActivityResult->save($data)) {
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
}
