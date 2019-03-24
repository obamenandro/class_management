<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 */
class ProjectsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = array('Paginator');

    /**
     * project per students
     */
    public function index() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $projects = $this->Project->find('all', [
                'conditions' => [
                    'Project.deleted_date' => NULL,
                    'Project.student_id' => $data['student_id']
                ]
            ]);
            
            if (empty($projects)) {
                $response = [
                    'status' => 'success',
                    'message' => 'No projects found'
                ];
            } else {
                $response = [
                    'status' => 'success',
                    'data' => [$projects]
                ];
            }
        }
        $this->response->type('application/json');
        return $this->response->body(json_encode($response));
    }
    /**
     * add projects
     */
    public function add() {
        $response = [
            'status' => 'failed',
            'message' => 'HTTP method not allowed.'
        ];
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if ($this->Project->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Projects has been successfully added.'
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Projects has been failed to added.'
                ];
            }
        }
    }
}
