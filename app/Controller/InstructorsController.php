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

    /**
     * Add instructor
     */
    public function add() {
        $this->autoRender = false;
        if ($this->request->data('ajax')) {
            try {
                $this->dataSource->begin();
                $data = $this->request->data;
                if ($this->Instructor->save($data)) {
                    $this->dataSource->commit();
                    return json_encode(['status' => 'success']);
                } else {
                    $this->dataSource->rollback();
                    return json_encode(['status' => 'failed']);
                }
            } catch (Exception $e) { 
                $this->dataSource->rollback();
                return json_encode(['status' => 'failed']);
            }
        }
    }

    /**
     * Edit instructor
     * param $id instructor_id
     */
    public function edit($id) {
        if ($this->request->is(['put', 'post'])) {
            try {
                $this->dataSource->begin();
                $data = $this->request->data;
                $this->Instructor->id = $id;
                if ($this->Instructor->save($data)) {
                    $this->dataSource->commit();
                    return json_encode(['status' => 'success']);
                } else {
                    $this->dataSource->rollback();
                    return json_encode(['status' => 'failed']);
                }
            } catch (Exception $e) {
                $this->dataSource->rollback();
                return json_encode(['status' => 'failed']);
            }
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
            return json_encode(['status' => 'failed', 'message' => 'invalid instructor']);
        } 
        $data['Instructor'] = [
            'id' => $id,
            'deleted' => 1,
            'deleted_date' => date('Y-m-d')
        ];
        if ($this->Instructor->save($data)) {
            return json_encode(['status' => 'success']);
        } else {
            return json_encode(['status' => 'failed']);
        }
    }
}
