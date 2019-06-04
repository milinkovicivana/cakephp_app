<?php

App::uses('AppModel','Model');

class WarehousePlace extends AppModel{

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
		'default'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Default is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array(1,0)),
				'message'=>'Plese enter a valid status'
			)
		),
		'active'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Active is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array(1,0)),
				'message'=>'Plese enter a valid status'
			)
		)

	);


	public $hasMany = array(
		'WarehouseItemType' => array(
			'className' => 'WarehouseItemType',
			'foreignKey' => 'warehouse_place_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'WarehouseAddress' => array(
			'className' => 'WarehouseAddress',
			'foreignKey' => 'warehouse_place_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ItemsWarehousePlace' =>
			array(
			'className' => 'ItemsWarehousePlace',
			'foreignKey' => 'warehouse_place_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Permission' =>
			array(
			'className' => 'Permission',
			'foreignKey' => 'warehouse_place_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Gear' => array(
			'className' => 'Gear',
			'foreignKey' => 'transmission_from',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)

	);

}






?>