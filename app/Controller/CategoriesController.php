<?php
App::uses('UndoController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends UndoController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
    $categories = $this->Category->find('list');
    $this->set(compact('categories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
    $categories = $this->Category->find('list');
    $this->set(compact('categories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

  public function setMemento() {
    $counter = $this->Session->check('Memento.counter') ? $this->Session->read('Memento.counter') : 0;
    $this->Session->write('Memento.counter', $counter > 0 ? $counter - 1 : 0);
    $memento = 'Memento.' . $counter;
    $action = $this->Session->read($memento . '.action');
    $type = $this->Session->read($memento . '.type');

    switch ($action) {
      case 'add':
        if($type == 'item') {
          $this->Item->id = $this->Session->read($memento . '.id');
          $this->request->allowMethod('post', 'delete');
          if($this->Item->delete()) {
            $this->Session->setFlash(__('The category has been deleted.'));
          } else {
            $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
          }
        } else {
          $this->Category->id = $this->Session->read($memento . '.id');
          $this->request->allowMethod('post', 'delete');
          if($this->Category->delete()) {
            $this->Session->setFlash(__('The category has been deleted.'));
          } else {
            $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
          }
        }
        $this->Session->delete($memento);
      break;
      case 'edit':

      break;
      case 'delete':

      break;
    }
    return $this->redirect(array('action' => 'index'));
  }
}
