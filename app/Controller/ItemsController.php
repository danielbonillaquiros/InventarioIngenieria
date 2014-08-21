<?php
App::uses('AppController', 'Controller');
App::uses('AdvancedProfile', 'Controller/Decorator');
App::uses('EditorProfile', 'Controller/Decorator');
App::uses('BasicProfile', 'Controller/Decorator');

/**
 * Items Controller
 *
 * @property Item $Item
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ItemsController extends AppController {
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
    switch ($profile) {
      case null:
        $advancedProfile = new AdvancedProfile();
        $advancedProfile->itemsIndex($this, $profile);
      break;
      case "basic":
        $basicProfile = new BasicProfile();
        $basicProfile->itemsIndex($this, $profile);
      break;
      case "editor":
        $editorProfile = new EditorProfile();
        $editorProfile->itemsIndex($this, $profile);
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
		switch ($profile) {
      case null:
        $advancedProfile = new AdvancedProfile();
        $advancedProfile->itemsView($this, $profile);
      break;
      case "basic":
        $basicProfile = new BasicProfile();
        $basicProfile->itemsView($this, $profile);
      break;
      case "editor":
        $editorProfile = new EditorProfile();
        $editorProfile->itemsView($this, $profile);
      break;
    }
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$advancedProfile = new AdvancedProfile();
    return $advancedProfile->itemsAdd($this);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
    switch($profile) {
      case null:
        $advancedProfile = new AdvancedProfile();
        return $advancedProfile->itemsEdit($this, $id, $profile);
      break;
      case "editor":
        $editorProfile = new EditorProfile();
        return $editorProfile->itemsEdit($this, $id, $profile);
      break;
    }
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$advancedProfile = new AdvancedProfile();
    return $advancedProfile->itemsDelete($this, $id);
	}
}
