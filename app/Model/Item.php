<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 */
class Item extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'item_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'item_description';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'item_id' => array(
			'blank' => array(
				'rule' => 'blank',
				'on' => 'create',
			),
		),
		'item_description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'The item name cannot be empty',
			),
			'words' => array(
				'rule' => array('custom', '/([\w.-]+)+[\w+.-]/'),
			),
			'maxLength' => array(
				'rule' => array('maxLength', 30),
				'message' => 'The item name must not be longer than 30 characters',
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This item name already exists',
			),
		),
		'item_unit_type' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'The item price cannot be empty',
			),
			//'inList' => array(
				//'rule' => array('inList'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		),
		'item_price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'money' => array(
				'rule' => array('money'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
