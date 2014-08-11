<?php

class AddObject {
  public function add($model, $type) {
    if($type == "category") {
      if ($model->request->is('post')) {
        $model->Category->create();
        if ($model->Category->save($model->request->data)) {
          $model->Session->setFlash(__('The category has been saved.'));
          $model->createMemento('add', 'category', array('id' => $model->Category->id));
          return $model->redirect(array('action' => 'index'));
        } else {
          $model->Session->setFlash(__('The category could not be saved. Please, try again.'));
        }
      }
      $categories = $model->Category->find('list');
      $model->set(compact('categories'));
    } else {
      if ($model->request->is('post')) {
        $model->Item->create();
        $data = $model->request->data['Item'];
        if (!$data['item_picture']['name']) {
          unset($data['item_picture']);
        }
        if ($model->Item->save($data)) {
          $model->Session->setFlash(__('The item has been saved.'));
          $model->createMemento('add', 'item', array('id' => $model->Item->id));
          return $model->redirect(array('action' => 'index'));
        } else {
          $model->Session->setFlash(__('The item could not be saved. Please, try again.'));
        }
      }
      $units = $model->Item->Unit->find('list');
      $categories = $model->Item->Category->find('list');
      $model->set(compact('units', 'categories'));
    }
  }
}
