<?php
App::uses('UndoController', 'Controller');

include('AddObject.php');
include('EditObject.php');

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
	public function index($profile = null) {
		$this->Category->recursive = 0;
		$this->set('categories', $this->Paginator->paginate());

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
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));

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
    return $addInstance->add($this, "category");
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
    return $editInstance->edit($this, "category", $id);
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
    return $deleteInstance->delete($this, "category", $id);
	}

  public function setMemento() {
    parent::setMemento();
  }
}
