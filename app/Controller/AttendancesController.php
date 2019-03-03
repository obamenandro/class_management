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

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Attendance->recursive = 0;
		$this->set('attendances', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Attendance->exists($id)) {
			throw new NotFoundException(__('Invalid attendance'));
		}
		$options = array('conditions' => array('Attendance.' . $this->Attendance->primaryKey => $id));
		$this->set('attendance', $this->Attendance->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Attendance->create();
			if ($this->Attendance->save($this->request->data)) {
				$this->Flash->success(__('The attendance has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The attendance could not be saved. Please, try again.'));
			}
		}
		$students = $this->Attendance->Student->find('list');
		$instructors = $this->Attendance->Instructor->find('list');
		$this->set(compact('students', 'instructors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Attendance->exists($id)) {
			throw new NotFoundException(__('Invalid attendance'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Attendance->save($this->request->data)) {
				$this->Flash->success(__('The attendance has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The attendance could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Attendance.' . $this->Attendance->primaryKey => $id));
			$this->request->data = $this->Attendance->find('first', $options);
		}
		$students = $this->Attendance->Student->find('list');
		$instructors = $this->Attendance->Instructor->find('list');
		$this->set(compact('students', 'instructors'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Attendance->exists($id)) {
			throw new NotFoundException(__('Invalid attendance'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Attendance->delete($id)) {
			$this->Flash->success(__('The attendance has been deleted.'));
		} else {
			$this->Flash->error(__('The attendance could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
