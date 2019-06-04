<?php

App::uses('AppModel','Model');

class ItemType extends AppModel{

	public $validate=array(

		'code'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A code is required'
			),
			'unique'=>array(
				'rule'=>array('isUnique')
			)
		),
		'name'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A name is required'
			),
			'unique'=>array(
				'rule'=>array('isUnique')
			)
		),
		'tangible'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A triangible is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array(1,0)),
				'message'=>'Plese enter a valid status'
			)
		),
		'active'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A active is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array(1,0)),
				'message'=>'Plese enter a valid status'
			)
		),
		'class'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A class is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array('product','kit','material','semi_product','service_product','service_supplier','consumable','inventory','goods','other')),
				'message'=>'Plese enter a valid class'
			)
		)

	);

	public $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}




?>