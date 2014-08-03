<?php

App::uses('AppController', 'Controller');

class UndoController extends AppController {


  public function createMemento($action, $data) {
    $counter = $this->Session->check('Memento.counter') ? $this->Session->read('Memento.counter') + 1 : 1;
    $this->Session->write('Memento.counter', $counter);
    $memento = 'Memento.' . $counter;
    $this->Session->write($memento . '.action', $action);
    $this->Session->write($memento . '.id', $data['id']);
    switch($action) {
      case 'add':
        $this->Session->write($memento . '.type', $data['type']);
      break;
      case 'edit':
        $this->Session->write($memento . '.type', $data['type']);
        if($data['type'] == 'item') {
          $this->Session->write($memento . '.item_description', $data['item_description']);
          $this->Session->write($memento . '.item_unit_id', $data['item_unit_id']);
          $this->Session->write($memento . '.item_price', $data['item_price']);
          $this->Session->write($memento . '.item_picture', $data['item_picture']);
          $this->Session->write($memento . '.item_category_id', $data['item_category_id']);
        } else {
          $this->Session->write($memento . '.category_description', $data['category_description']);
          $this->Session->write($memento . '.category_level', $data['category_level']);
          $this->Session->write($memento . '.category_parent', $data['category_parent']);
        }
      break;
      case 'delete':
        $this->Session->write($memento . '.type', $data['type']);
        if($data['type'] == 'item') {
          $this->Session->write($memento . '.item_description', $data['item_description']);
          $this->Session->write($memento . '.item_unit_id', $data['item_unit_id']);
          $this->Session->write($memento . '.item_price', $data['item_price']);
          $this->Session->write($memento . '.item_picture', $data['item_picture']);
          $this->Session->write($memento . '.item_category_id', $data['item_category_id']);
        } else {
          $this->Session->write($memento . '.category_description', $data['category_description']);
          $this->Session->write($memento . '.category_level', $data['category_level']);
          $this->Session->write($memento . '.category_parent', $data['category_parent']);
        }
      break;
    }
    print "$this->Session->read('Memento.counter')";
  }

  public function setMemento() {
    $counter = $this->Session->check('Memento.counter') ? $this->Session->read('Memento.counter') : 0;
    $this->Session->write('Memento.counter', $counter > 0 ? $counter - 1 : 0);
    $memento = 'Memento.' . $counter;
    $action = $this->Session->read($memento . '.action');
    $type = $this->Session->read($memento . '.type');

    switch ($action) {
      case 'add':
        if($type == 'item') {
          $this->request->allowMethod('post', 'delete');
          if($this->Item->delete($this->Session->read($memento . '.id'))) {
            $this->Session->setFlash(__('Action has been reversed and the item has been deleted.'));
          } else {
            $this->Session->setFlash(__('The action could not be reversed and item could not be deleted. Please, try again.'));
          }
        } else {
          $this->Category->id = $this->Session->read($memento . '.id');
          $this->request->allowMethod('post', 'delete');
          if($this->Category->delete()) {
            $this->Session->setFlash(__('Action has been reversed and the category has been deleted.'));
          } else {
            $this->Session->setFlash(__('The action could not be reversed and category could not be deleted. Please, try again.'));
          }
        }
        $this->Session->delete($memento);
      break;
      case 'edit':

      break;
      case 'delete':

      /////////////////////////////////////////////////////////////////////////////////////////
        /*if ($this->request->is('post')) {
          $this->Item->create();
          $data = $this->request->data['Item'];
          if (!$data['item_picture']['name']) {
            unset($data['item_picture']);
          }
          if ($this->Item->save($data)) {
            $this->Session->setFlash(__('The item has been saved.'));
            $this->createMemento('add', array('type' => 'item', 'id' => $this->Item->id));
            return $this->redirect(array('action' => 'index'));
          } else {
            $this->Session->setFlash(__('The item could not be saved. Please, try again.'));
          }
        }
        $units = $this->Item->Unit->find('list');
        $categories = $this->Item->Category->find('list');
        $this->set(compact('units', 'categories'));*/
      /////////////////////////////////////////////////////////////////////////////////////////
      break;
    }

    if($this->Session->read('Memento.counter') == 0) $this->Session->delete('Memento.counter');

    return $this->redirect(array('action' => 'index'));
  }
}
