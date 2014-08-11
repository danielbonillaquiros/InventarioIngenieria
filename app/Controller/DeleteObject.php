<?php

class DeleteObject {
  delete($model, $type, $id) {
    if($type == "category") {
      $model->Category->id = $id;
      $data = $model->Category->find('first', array('conditions' => array('Category.category_id' => $id)));
      $data['id'] = $data['Category']['category_id'];
      if (!$model->Category->exists()) {
        throw new NotFoundException(__('Invalid category'));
      }
      $model->request->allowMethod('post', 'delete');
      if ($model->Category->delete()) {
        $model->Session->setFlash(__('The category has been deleted.'));
        $model->createMemento('delete', 'category', $data);

        // set items category with model category to Not categorized
        /*$items = $model->find('all', array('conditions' => array('Item.item_category_id' => $id)));
        if(count($items) > 0) {
          foreach($items as $item) {
            $model->Item->query("UPDATE inventario.items SET " .
                         "item_category_id = '-1' " .
                         "WHERE items.item_id = '" . $item['item_id'] . "';");
          }
        }*/

      } else {
        $model->Session->setFlash(__('The category could not be deleted. Please, try again.'));
      }
      return $model->redirect(array('action' => 'index'));
    } else {
      $model->Item->id = $id;
      $data = $model->Item->find('first', array('conditions' => array('Item.item_id' => $id)));
      $data['id'] = $data['Item']['item_id'];
      if (!$model->Item->exists()) {
        throw new NotFoundException(__('Invalid item'));
      }
      $model->request->allowMethod('post', 'delete');
      if ($model->Item->delete()) {
        $model->Session->setFlash(__('The item has been deleted.'));
        $model->createMemento('delete', 'item', $data);
      } else {
        $model->Session->setFlash(__('The item could not be deleted. Please, try again.'));
      }
      return $model->redirect(array('action' => 'index'));
    }
  }
}
