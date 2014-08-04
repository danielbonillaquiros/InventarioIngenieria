<?php
App::uses('CategoriesController', 'Controller');

/**
 * CategoriesController Test Case
 *
 */
class CategoriesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.category',
		'app.item',
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/categories/index');
        debug($result);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$result = $this->testAction('/categories/index/view');
        debug($result);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$result = $this->testAction('/categories/index/Add');
        debug($result);
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$result = $this->testAction('/categories/index/edit');
        debug($result);
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$result = $this->testAction('/categories/index/delete');
        debug($result);
	}

}
