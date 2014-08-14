<?php
App::uses('UndoController', 'Controller');

include('AddObject.php');
include('EditObject.php');
include('DeleteObject.php');

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
    return $addInstance->add($this, "item");
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
    return $editInstance->edit($this, "item", $id);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$deleteInstance = new DeleteObject();
    return $deleteInstance->delete($this, "item", $id);
	}

  public function setMemento() {
    parent::setMemento();
  }
}
