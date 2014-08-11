<?php

class EditObject {
  public function edit($model, $type, $id) {
    if ($type == "category") {
      $data = $model->Category->find('first', array('conditions' => array('Category.category_id' => $id)));
      if (!$model->Category->exists($id)) {
        throw new NotFoundException(__('Invalid category'));
      }
      if ($model->request->is(array('post', 'put'))) {
        if ($model->Category->save($model->request->data)) {
          $model->Session->setFlash(__('The category has been saved.'));
          $model->createMemento('edit', 'category', $data);
          return $model->redirect(array('action' => 'index'));
        } else {
          $model->Session->setFlash(__('The category could not be saved. Please, try again.'));
        }
      } else {
        $options = array('conditions' => array('Category.' . $model->Category->primaryKey => $id));
        $model->request->data = $model->Category->find('first', $options);
      }
      $categories = $model->Category->find('list');
      $model->set(compact('categories'));
    } else {
      $data = $model->Item->find('first', array('conditions' => array('Item.item_id' => $id)));
      if (!$model->Item->exists($id)) {
        throw new NotFoundException(__('Invalid item'));
      }
      if ($model->request->is(array('post', 'put'))) {
        $___data = $model->request->data['Item'];
        if (!$___data['item_picture']['name']) {
          unset($___data['item_picture']);
        }
        if ($model->Item->save($___data)) {
          $model->Session->setFlash(__('The item has been saved.'));
          $model->createMemento('edit', 'item', $data);
          return $model->redirect(array('action' => 'index'));
        } else {
          $model->Session->setFlash(__('The item could not be saved. Please, try again.'));
        }
      } else {
        $options = array('conditions' => array('Item.' . $model->Item->primaryKey => $id));
        $model->request->data = $model->Item->find('first', $options);
      }
      $units = $model->Item->Unit->find('list');
      $categories = $model->Item->Category->find('list');
      $model->set(compact('units', 'categories'));
    }
  }
}
