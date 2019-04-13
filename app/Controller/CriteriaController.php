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

    public function list() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if (!empty($this->request->query)) {
            $conditions = [];
            if (!empty($this->request->query['course_id'])) {
                $conditions['Criteria.course_id'] = $this->request->query['course_id'];
            }

            $conditions['Criteria.deleted'] = 0;

            $criteria = $this->Criteria->find('all', [
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
     * Add Criteria
     */
    public function add() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if ($this->Criteria->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Successfully save criteria.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Criteria has been failed to saved.'
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
                $this->Criteria->id = $id;
                if ($this->Criteria->save($data)) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Criteria has been successfully updated.'
                    ];
                }
            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'message' => 'Criteria has been failed to update.'
                ];
            }
            $this->response->type('application/json');
            return $this->response->body(json_encode($response));
        }
    }
    /**
     * Delete Criteria
     */
    public function delete($id) {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        $check = $this->Criteria->find('first' , [
            'conditions' => [
                'Criteria.id' => $id,
                'Criteria.deleted' => 0
            ]
        ]);

        if (!empty($check)) {
            $criteria['Criteria'] = [
                'id' => $id,
                'deleted' => 1,
                'deleted_date' => date('Y-m-d')
            ];
            if ($this->Criteria->save($criteria)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Criteria successfully deleted.'
                ];
            } else {
                $response = [
                    'status' => 'failed', 
                    'message' => 'Criteria has been failed to delete.'
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
}
