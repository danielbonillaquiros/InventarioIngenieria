<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 * @property ItemUnit $ItemUnit
 * @property ItemCategory $ItemCategory
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
				'rule' => array('blank'),
				'on' => 'create',
			),
		),
		'item_description' => array(
			'custom' => array(
				'rule' => array('custom', '/([\w.-]+ )+[\w+.-]/'),
				'message' => 'Item description must only contain numbers, letters and spaces.',
			),
			'maxLength' => array(
				'rule' => array('maxLength', 30),
				'message' => 'Item description must not be longer than 30 characters.',
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Item description must not be empty.',
			),
		),
		'item_unit_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Item unit must be a number.',
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Item unit must not be empty.',
			),
		),
		'item_price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Item price must be a number.',
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Item price must not be empty.',
			),
		),
		'item_picture' => array(
			'uploadError' => array(
				'rule' => array('uploadError'),
				'message' => 'The item picture upload failed.',
				'allowEmpty' => true,
			),
			'fileSize' => array(
				'rule' => array('fileSize', '<=', '1MB'),
        'message' => 'Cover image must be less than 1MB.',
				'allowEmpty' => true,
			),
			'mimeType' => array(
				'rule' => array('mimeType', array('image/gif', 'image/png', 'image/jpg', 'image/jpeg')),
        'message' => 'Please only upload images (gif, png, jpg).',
        'allowEmpty' => true,
			),
      'processPictureUpload' => array(
        'rule' => 'processPictureUpload',
        'message' => 'Unable to process item picture upload.',
        'allowEmpty' => true,
      ),
		),
		'item_category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Item category must be a number.',
			),
			/*'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Your custom message here',
			),*/
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'item_unit_id'
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'item_category_id'
		)
	);

  public function processPictureUpload($check = array()) {
    if (!is_uploaded_file($check['issue_cover']['tmp_name'])) {
      return false;
    }
    if (!move_uploaded_file($check['issue_cover']['tmp_name'], WWW_ROOT . 'img' . DS . 'uploads' . DS . $check['issue_cover']['name'])) {
      return false;
    }
    $this->data[$this->alias]['issue_cover'] = 'uploads' . DS . $check['issue_cover']['name'];
    return true;
  }
}
