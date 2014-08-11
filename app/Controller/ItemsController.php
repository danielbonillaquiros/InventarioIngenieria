<?php
App::uses('UndoController', 'Controller');

include('AddObject.php');
include('EditObject.php');

/**
 * Items Controller
 *
 * @property Item $Item
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ItemsController extends UndoController {

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
	public function index($profile = null) {
		$this->Item->recursive = 0;
		$this->set('items', $this->Paginator->paginate());

    switch ($profile) {
      case "basic":
        $this->render("basicindex");
      break;
      case "editor":
        $this->render("editorindex");
      break;
    }
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $profile = null) {
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		$options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
		$this->set('item', $this->Item->find('first', $options));

    switch ($profile) {
      case "basic":
        $this->render("basicview");
      break;
      case "editor":
        $this->render("editorview");
      break;
    }
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$addInstance = new AddObject();
    $addInstance->add($this, "item");
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
    $editInstance = new EditObject();
    $editInstance->edit($this, "item", $id);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Item->id = $id;
    $data = $this->Item->find('first', array('conditions' => array('Item.item_id' => $id)));
    $data['id'] = $data['Item']['item_id'];
		if (!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Item->delete()) {
			$this->Session->setFlash(__('The item has been deleted.'));
      $this->createMemento('delete', 'item', $data);
		} else {
			$this->Session->setFlash(__('The item could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

  public function setMemento() {
    parent::setMemento();
  }
}
