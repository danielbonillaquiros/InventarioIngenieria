<?php
App::uses('ItemsController', 'Controller');

/**
 * ItemsController Test Case
 *
 */
class ItemsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item',
		'app.unit',
		'app.category'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
		$result = $this->testAction('/items/index');
        debug($result);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
		$result = $this->testAction('items/index/view');
        debug($result);
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
		$result = $this->testAction('items/index/add');
        debug($result);
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
		$result = $this->testAction('items/index/edit');
        debug($result);
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
		$result = $this->testAction('items/index/delete');
        debug($result);
	}

}
