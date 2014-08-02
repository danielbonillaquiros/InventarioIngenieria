<?php
App::uses('AppModel', 'Model');
/**
 * Unit Model
 *
 */
class Unit extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'unit_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'unit_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'unit_id' => array(
			'blank' => array(
				'rule' => array('blank'),
				'on' => 'create',
			),
		),
		'unit_name' => array(
			'custom' => array(
				'rule' => array('custom', '/([\w.-]+ )+[\w+.-]/'),
				'message' => 'Unit name must only contain letters, numbers and spaces.',
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Unit name must not be empty.',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 30),
				'message' => 'Unit name must not be longer than 30 characters.',
			),
		),
	);

  /**
 * hasMany associations
 *
 * @var array
 */
  public $hasMany = array(
    'UnitItems' => array(
      'className' => 'Item',
      'foreignKey' => 'item_unit_id'
    )
  );
}
