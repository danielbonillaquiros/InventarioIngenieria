<?php
/**
 * ItemFixture
 *
 */
class ItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'item_description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'item_unit_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'item_price' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'item_picture' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'item_category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'item_id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'item_id' => 1,
			'item_description' => 'Lorem ipsum dolor sit amet',
			'item_unit_id' => 1,
			'item_price' => 1,
			'item_picture' => 'Lorem ipsum dolor sit amet',
			'item_category_id' => 1
		),
	);

}
