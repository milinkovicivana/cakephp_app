<?php

App::uses('AppModel','Model');

class ItemsWarehousePlace extends AppModel{

	public $belongsTo = array(
		'WarehousePlace' => array(
			'className' => 'WarehousePlace',
			'foreignKey' => 'warehouse_place_id',
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

	);

	public $validate=array(

		'total_amount'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'rule1'=>array(
				'rule'=>'/^[0-9]{1,}$/',
				'message'=>'Error'
			)
		),
		'free_amount'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'rule1'=>array(
				'rule'=>'/^[0-9]{1,}$/',
				'message'=>'Error'
			),
		),
		'reserved_amount'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'rule1'=>array(
				'rule'=>'/^[0-9]{1,}$/',
				'message'=>'Error'
			),
		),
		'consumption'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'rule1'=>array(
				'rule'=>'/^[0-9]{1,}$/',
				'message'=>'Error'
			)
		)

	);
}





?>