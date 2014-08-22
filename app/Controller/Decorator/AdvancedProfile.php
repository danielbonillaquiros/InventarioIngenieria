<?php

include("EditorProfile.php");

class AdvancedProfile {
  public function categoriesIndex($controller, $profile) {
    $editorProfile = new EditorProfile();
    $editorProfile->categoriesIndex($controller, $profile);
  }

  public function categoriesView($controller, $id, $profile) {
    $editorProfile = new EditorProfile();
    $editorProfile->categoriesView($controller, $id, $profile);
  }

  public function categoriesAdd($controller) {
    if ($controller->request->is('post')) {
			$controller->Category->create();
			if ($controller->Category->save($controller->request->data)) {
				$controller->Session->setFlash(__('The category has been saved.'));
				return $controller->redirect(array('action' => 'index'));
			} else {
				$controller->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
    $categories = $controller->Category->find('list');
    $controller->set(compact('categories'));
  }

  public function categoriesEdit($controller, $id, $profile) {
    $editorProfile = new EditorProfile();
    return $editorProfile->categoriesEdit($controller, $id, $profile);
  }

  public function categoriesDelete($controller, $id) {
    $controller->Category->id = $id;
    $data = $controller->Category->find('first', array('conditions' => array('Category.category_id' => $id)));
    $data['id'] = $data['Category']['category_id'];
		if (!$controller->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$controller->request->allowMethod('post', 'delete');
		if ($controller->Category->delete()) {
			$controller->Session->setFlash(__('The category has been deleted.'));
		} else {
			$controller->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $controller->redirect(array('action' => 'index'));
  }

  public function itemsIndex($controller, $profile) {
    $editorProfile = new EditorProfile();
    $editorProfile->itemsIndex($controller, $profile);
  }

  public function itemsView($controller, $id, $profile) {
    $editorProfile = new EditorProfile();
    $editorProfile->itemsView($controller, $id ,$profile);
  }

  public function itemsAdd($controller) {
    if ($controller->request->is('post')) {
			$controller->Item->create();
      $data = $controller->request->data['Item'];
      if (!$data['item_picture']['name']) {
        unset($data['item_picture']);
      }
			if ($controller->Item->save($data)) {
				$controller->Session->setFlash(__('The item has been saved.'));
				return $controller->redirect(array('action' => 'index'));
			} else {
				$controller->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		}
		$units = $controller->Item->Unit->find('list');
		$categories = $controller->Item->Category->find('list');
		$controller->set(compact('units', 'categories'));
  }

  public function itemsEdit($controller, $id, $profile) {
    $editorProfile = new EditorProfile();
    return $editorProfile->itemsEdit($controller, $id, $profile);
  }

  public function itemsDelete($controller, $id) {
    $controller->Item->id = $id;
    $data = $controller->Item->find('first', array('conditions' => array('Item.item_id' => $id)));
    $data['id'] = $data['Item']['item_id'];
		if (!$controller->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$controller->request->allowMethod('post', 'delete');
		if ($controller->Item->delete()) {
			$controller->Session->setFlash(__('The item has been deleted.'));
		} else {
			$controller->Session->setFlash(__('The item could not be deleted. Please, try again.'));
		}
		return $controller->redirect(array('action' => 'index'));
  }
}
