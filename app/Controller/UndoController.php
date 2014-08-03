<?php

App::uses('AppController', 'Controller');

class UndoController extends AppController {


  public function createMemento($action, $data) {
    $counter = $this->Session->check('Memento.counter') ? $this->Session->read('Memento.counter') + 1 : 1;
    $this->Session->write('Memento.counter', $counter);
    $memento = 'Memento.' . $counter;
    $this->Session->write($memento . '.action', $action);
    switch($action) {
      case 'add':
        $this->Session->write($memento . '.type', $data['type']);
        $this->Session->write($memento . '.id', $data['id']);
      break;
      case 'edit':
        $this->Session->write($memento . '.type', $data['type']);
        if($data['type'] == 'item') {
          $this->Session->write($memento . '.id', $data['item_id']);
          $this->Session->write($memento . '.item_description', $data['item_description']);
          $this->Session->write($memento . '.item_unit_id', $data['item_unit_id']);
          $this->Session->write($memento . '.item_price', $data['item_price']);
          $this->Session->write($memento . '.item_picture', $data['item_picture']);
          $this->Session->write($memento . '.item_category_id', $data['item_category_id']);
        } else {
          $this->Session->write($memento . '.id', $data['category_id']);
          $this->Session->write($memento . '.category_description', $data['category_description']);
          $this->Session->write($memento . '.category_level', $data['category_level']);
          $this->Session->write($memento . '.category_parent', $data['category_parent']);
        }
      break;
      case 'delete':
        $this->Session->write($memento . '.type', $data['type']);
        if($data['type'] == 'item') {
          $this->Session->write($memento . '.id', $data['item_id']);
          $this->Session->write($memento . '.item_description', $data['item_description']);
          $this->Session->write($memento . '.item_unit_id', $data['item_unit_id']);
          $this->Session->write($memento . '.item_price', $data['item_price']);
          $this->Session->write($memento . '.item_picture', $data['item_picture']);
          $this->Session->write($memento . '.item_category_id', $data['item_category_id']);
        } else {
          $this->Session->write($memento . '.id', $data['category_id']);
          $this->Session->write($memento . '.category_description', $data['category_description']);
          $this->Session->write($memento . '.category_level', $data['category_level']);
          $this->Session->write($memento . '.category_parent', $data['category_parent']);
        }
      break;
    }
    print "$this->Session->read('Memento.counter')";
  }

  /*public function setMemento() {
    $counter = $this->Session->check('Memento.counter') ? $this->Session->read('Memento.counter') : 0;
    $this->Session->write('Memento.counter', $counter > 0 ? $counter - 1 : 0);
    $memento = 'Memento.' . $counter;
    $action = $this->Session->read($memento . '.action');
    $type = $this->Session->read($memento . '.type');

    switch ($action) {
      case 'add':
        if($type == 'item') {
          $this->Item->id = $this->Session->read($memento . '.id');
          $this->request->allowMethod('post', 'delete');
          if($this->Item->delete()) {
            $this->Session->setFlash(__('The category has been deleted.'));
          } else {
            $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
          }
        } else {
          $this->Category->id = $this->Session->read($memento . '.id');
          $this->request->allowMethod('post', 'delete');
          if($this->Category->delete()) {
            $this->Session->setFlash(__('The category has been deleted.'));
          } else {
            $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
          }
        }
        $this->Session->delete($memento);
        return $this->redirect(array('action' => 'index'));
      break;
      case 'edit':

      break;
      case 'delete':

      break;
    }
  }*/
}
