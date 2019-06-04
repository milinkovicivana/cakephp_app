<?php

App::uses('AppModel','Model');

class ItemsWarehouseAddress extends AppModel{

	public $belongsTo = array(
		'WarehouseAddress' => array(
			'className' => 'WarehouseAddress',
			'foreignKey' => 'warehouse_address_id',
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
}




?>