<?php
App::uses('AppController', 'Controller');
/**
 * Criteria Controller
 *
 * @property Criterion $Criterion
 * @property PaginatorComponent $Paginator
 */
class CriteriaController extends AppController {

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
            if (!empty($this->request->query['course_id'])) {
                $conditions['Criterion.course_id'] = $this->request->query['course_id'];
            }

            $conditions['Criterion.deleted'] = 0;

            $criteria = $this->Criterion->find('all', [
                'conditions' => $conditions
            ]);

            if (!empty($criteria)) {
                $response = [
                    'status' => 'success',
                    'data' => $criteria
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
     * Add Criterion
     */
    public function add() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['name'] = ucwords($data['name']);
            if ($this->Criterion->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Successfully save criteria.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Criterion has been failed to saved.'
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
                $this->Criterion->id = $id;
                if ($this->Criterion->save($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Criterion has been successfully updated.'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'message' => 'Criterion has been failed to update.'
                ];
            }
            $this->response->type('application/json');
            return $this->response->body(json_encode($response));
        }
    }
    /**
     * Delete Criterion
     */
    public function delete($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        $check = $this->Criterion->find('first' , [
            'conditions' => [
                'Criterion.id' => $id,
                'Criterion.deleted' => 0
            ]
        ]);

        if (!empty($check)) {
            $criteria['Criterion'] = [
                'id' => $id,
                'deleted' => 1,
                'deleted_date' => date('Y-m-d')
            ];
            if ($this->Criterion->save($criteria)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Criterion successfully deleted.'
                ];
            } else {
                $response = [
                    'status' => 'failed', 
                    'message' => 'Criterion has been failed to delete.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
}
