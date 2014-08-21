<?php
App::uses('AppController', 'Controller');
App::uses('AdvancedProfile', 'Controller/Decorator');
App::uses('EditorProfile', 'Controller/Decorator');
App::uses('BasicProfile', 'Controller/Decorator');

/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {

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
        $advancedProfile->categoriesIndex($this, $profile);
      break;
      case "basic":
        $basicProfile = new BasicProfile();
        $basicProfile->categoriesIndex($this, $profile);
      break;
      case "editor":
        $editorProfile = new EditorProfile();
        $editorProfile->categoriesIndex($this, $profile);
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
		switch($profile) {
      case null:
        $advancedProfile = new AdvancedProfile();
        $advancedProfile->categoriesView($this, $id, $profile);
      break;
      case "basic":
        $basicProfile = new BasicProfile();
        $basicProfile->categoriesView($this, $id, $profile);
      break;
      case "editor":
        $editorProfile = new EditorProfile();
        $editorProfile->categoriesView($this, $id, $profile);
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
    return $advancedProfile->categoriesAdd($this);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null, $profile = null) {
    switch($profile) {
      case null:
        $advancedProfile = new AdvancedProfile();
        return $advancedProfile->categoriesEdit($this, $id, $profile);
      break;
      case "editor":
        $editorProfile = new EditorProfile();
        return $editorProfile->categoriesEdit($this, $id, $profile);
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
    return $advancedProfile->categoriesDelete($this, $id);
	}
}
