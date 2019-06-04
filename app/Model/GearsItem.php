<?php

App::uses('AppModel','Model');

class GearsItem extends AppModel{

	public $belongsTo = array(
		'Gear' => array(
			'className' => 'Gear',
			'foreignKey' => 'gear_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WarehouseAddress' => array(
			'className' => 'WarehouseAddress',
			'foreignKey' => 'send_address',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)

	);

	public $validate=array(
		'wanted_amount'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'rule1'=>array(
				'rule'=>'/^[0-9]{1,}$/',
				'message'=>'Amount less than 0!'
			)
		),
		'send_amount'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'rule1'=>array(
				'rule'=>'/^[0-9]{1,}$/',
				'message'=>'Amount less than 0!'
			),
		)
	);
}




?>