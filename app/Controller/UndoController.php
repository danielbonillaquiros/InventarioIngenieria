<?php

App::uses('AppController', 'Controller');

class UndoController extends AppController {


  public function createMemento($action, $type, $data) {
    $counter = $this->Session->check('Memento.counter') ? $this->Session->read('Memento.counter') + 1 : 1;
    $this->Session->write('Memento.counter', $counter);
    $memento = 'Memento.' . $counter;
    $this->Session->write($memento . '.action', $action);
    $this->Session->write($memento . '.id', $data['id']);
    $this->Session->write($memento . '.type', $type);
    $this->Session->write($memento . '.data', $data);
  }

  /**
   *  Returns to the last state of the database and changes the view to actual index.
   */
  public function setMemento() {
    $counter = $this->Session->check('Memento.counter') ? $this->Session->read('Memento.counter') : 0;
    $this->Session->write('Memento.counter', $counter > 0 ? $counter - 1 : 0);
    $memento = 'Memento.' . $counter;
    $action = $this->Session->read($memento . '.action');
    $type = $this->Session->read($memento . '.type');

    switch ($action) {
      case 'add':
      // this will reverse the last add action
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
        $this->Item->create();
        $data = $this->Session->read($memento . '.data');

        if ($this->Item->save($data)) {
          $this->Session->setFlash(__('The item has been saved.'));
        } else {
          $this->Session->setFlash(__('The item could not be saved. Please, try again.'));
        }
        $units = $this->Item->Unit->find('list');
        $categories = $this->Item->Category->find('list');
        $this->set(compact('units', 'categories'));
      break;
    }

    if($this->Session->read('Memento.counter') == 0) $this->Session->delete('Memento.counter');

    return $this->redirect(array('action' => 'index'));
  }
}
