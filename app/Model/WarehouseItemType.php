<?php

App::uses('AppModel','Model');

class WarehouseItemType extends AppModel{

	public $validate=array(

		'item_type'=>array(
			/*'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A type is required'
			),*/
			'allowedChoice' => array(
				'rule' => array('checkInListTypes'),
				'message' => 'Plese enter a valid type'
			)
			/*'valid'=>array(
				'rule'=>array('inList',array('product','material','semi_product','service_product','consumable','inventory','goods')),
				'message'=>'Plese enter a valid type'
			)*/
		)
	);

	public $types = [
		'product' => 'Product',
		'goods' => 'Goods',
		'service_product' => 'Service product',
		'material' => 'Material',
		'semi_product' => 'Semi product',
		'consumable' => 'Consumable',
		'inventory' => 'Inventory'
	];

	public $belongsTo = array(
		'WarehousePlace' => array(
			'className' => 'WarehousePlace',
			'foreignKey' => 'warehouse_place_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	public function checkInListTypes(){
	
		return array_key_exists($this->data['WarehouseItemType']['item_type'], $this->types);
	}

}


?>