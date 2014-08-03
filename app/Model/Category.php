<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 */
class Category extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'category_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'category_description';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'category_id' => array(
			'blank' => array(
				'rule' => array('blank'),
				'on' => 'create',
			),
		),
		'category_description' => array(
			'custom' => array(
				'rule' => array('custom', '/([\w.-]+ )*[\w+.-]/'),
				'message' => 'Category description must only contain letters, numbers and spaces.',
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Category description must not be empty.',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 30),
				'message' => 'Category description must not be longer than 30 characters.',
			),
		),
		'category_level' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Category level must be a number.',
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Category level must not be empty.',
			),
		),
    'category_parent_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Parent category must be a number.',
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Parent category must not be empty.',
			),
		),
	);

  /**
 * hasMany associations
 *
 * @var array
 */
  public $hasMany = array(
    'CategoryItems' => array(
      'className' => 'Item',
      'foreignKey' => 'item_category_id'
    )
  );
}
