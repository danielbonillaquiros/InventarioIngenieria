<?php

class BasicProfile {
  public function categoriesIndex($controller, $profile) {
    $controller->Category->recursive = 0;
		$controller->set('categories', $controller->Paginator->paginate());

    switch ($profile) {
      case "basic":
        $controller->render("basicindex");
      break;
      case "editor":
        $controller->render("editorindex");
      break;
    }
  }

  public function categoriesView($controller, $id, $profile) {
    if (!$controller->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$options = array('conditions' => array('Category.' . $controller->Category->primaryKey => $id));
		$controller->set('category', $controller->Category->find('first', $options));

    switch ($profile) {
      case "basic":
        $controller->render("basicview");
      break;
      case "editor":
        $controller->render("editorview");
      break;
    }
  }

  public function itemsIndex($controller, $profile) {
		$controller->Item->recursive = 0;
		$controller->set('items', $controller->Paginator->paginate());

    switch ($profile) {
      case "basic":
        $controller->render("basicindex");
      break;
      case "editor":
        $controller->render("editorindex");
      break;
    }
  }

  public function itemsView($controller, $id, $profile) {
    if (!$controller->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		$options = array('conditions' => array('Item.' . $controller->Item->primaryKey => $id));
		$controller->set('item', $controller->Item->find('first', $options));

    switch ($profile) {
      case "basic":
        $controller->render("basicview");
      break;
      case "editor":
        $controller->render("editorview");
      break;
    }
  }
}
