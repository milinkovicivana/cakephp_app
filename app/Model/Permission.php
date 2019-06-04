<?php

App::uses('AppModel','Model');

class Permission extends AppModel{

	public $belongsTo = array(
		'WarehousePlace' => array(
			'className' => 'WarehousePlace',
			'foreignKey' => 'warehouse_place_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Operater' => array(
			'className' => 'Operater',
			'foreignKey' => 'operater_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

	);

	/*public $hasMany = array(
		'Gear' => array(
			'className' => 'Gear',
			'foreignKey' => 'permission_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		)
	);*/

	public $validate=array(
		'permission'=>array(
			'valid'=>array(
				'rule'=>array('inList',array(1,0)),
				'message'=>'Plese enter a valid status'
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A permission is required'
			)
		),
		'warehouse_place_id'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Warehouse place is required'
			)
		),
		'operater_id'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Operater is required'
			)
		)

	);
}




?>