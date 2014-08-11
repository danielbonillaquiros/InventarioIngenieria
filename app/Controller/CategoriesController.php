<?php
App::uses('UndoController', 'Controller');

include('AddObject.php');

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
    $add = new AddObject();
    $add->add($this);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
    $data = $this->Category->find('first', array('conditions' => array('Category.category_id' => $id)));
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
        $this->createMemento('edit', 'category', $data);
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
    $data = $this->Category->find('first', array('conditions' => array('Category.category_id' => $id)));
    $data['id'] = $data['Category']['category_id'];
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
      $this->createMemento('delete', 'category', $data);

      // set items category with this category to Not categorized
      /*$items = $this->find('all', array('conditions' => array('Item.item_category_id' => $id)));
      if(count($items) > 0) {
        foreach($items as $item) {
          $this->Item->query("UPDATE inventario.items SET " .
                       "item_category_id = '-1' " .
                       "WHERE items.item_id = '" . $item['item_id'] . "';");
        }
      }*/

		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

  public function setMemento() {
    parent::setMemento();
  }
}
