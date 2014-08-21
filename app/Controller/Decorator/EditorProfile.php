<?php

include("BasicProfile.php");

class EditorProfile {
  public function categoriesIndex($controller, $profile) {
    $basicProfile = new BasicProfile();
    $basicProfile->categoriesIndex($controller, $profile);
  }

  public function categoriesView($controller, $id, $profile) {
    $basicProfile = new BasicProfile();
    $basicProfile->categoriesView($controller, $id, $profile);
  }

  public function categoriesEdit($controller, $id, $profile) {
    $data = $controller->Category->find('first', array('conditions' => array('Category.category_id' => $id)));
		if (!$controller->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($controller->request->is(array('post', 'put'))) {
			if ($controller->Category->save($controller->request->data)) {
				$controller->Session->setFlash(__('The category has been saved.'));
        return $controller->redirect(array('action' => 'index'));
			} else {
				$controller->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $controller->Category->primaryKey => $id));
			$controller->request->data = $controller->Category->find('first', $options);
		}
    $categories = $controller->Category->find('list');
    $controller->set(compact('categories'));
  }

  public function itemsIndex($controller, $profile) {
    $basicProfile = new BasicProfile();
    $basicProfile->itemsIndex($controller, $profile);
  }

  public function itemsView($controller, $id, $profile) {
    $basicProfile = new BasicProfile();
    $basicProfile->itemsView($controller, $id, $profile);
  }

  public function itemsEdit($controller, $id, $profile) {
    $data = $controller->Item->find('first', array('conditions' => array('Item.item_id' => $id)));
		if (!$controller->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		if ($controller->request->is(array('post', 'put'))) {
			$___data = $controller->request->data['Item'];
      if (!$___data['item_picture']['name']) {
        unset($___data['item_picture']);
      }
			if ($controller->Item->save($___data)) {
				$controller->Session->setFlash(__('The item has been saved.'));
				return $controller->redirect(array('action' => 'index'));
			} else {
				$controller->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Item.' . $controller->Item->primaryKey => $id));
			$controller->request->data = $controller->Item->find('first', $options);
		}
		$units = $controller->Item->Unit->find('list');
		$categories = $controller->Item->Category->find('list');
		$controller->set(compact('units', 'categories'));
  }
}
