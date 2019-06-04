<?php

App::uses('AppModel','Model');

class Item extends AppModel{

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
		'measurement_unit_id'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A measurement unit is required'
			)
		),
		'item_type_id'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A type is required'
			)
		)

	);

	public $itemTypeModels=array(
        'product'=>array(
            'controller'=>'products',
            'model'=>'Product'
        ),
        'material'=>array(
            'controller'=>'materials',
            'model'=>'Material'
        ),
        'semi_product'=>array(
            'controller'=>'semiproducts',
            'model'=>'SemiProduct'
        ),
        'service_product'=>array(
            'controller'=>'serviceproducts',
            'model'=>'ServiceProduct'
        ),
        'service_supplier'=>array(
            'controller'=>'servicesuppliers',
            'model'=>'ServiceSupplier'
        ),
        'consumable'=>array(
            'controller'=>'consumables',
            'model'=>'Consumable'
        ),
        'inventory'=>array(
            'controller'=>'inventories',
            'model'=>'Inventory'
        ),
        'goods'=>array(
            'controller'=>'goods',
            'model'=>'Good'
        ),
        'kit'=>array(
            'controller'=>'kits',
            'model'=>'Kit'
        ),
    );


	public $belongsTo = array(
		'ItemType' => array(
			'className' => 'ItemType',
			'foreignKey' => 'item_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MeasurementUnit' => array(
			'className' => 'MeasurementUnit',
			'foreignKey' => 'measurement_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)

	);

	public $hasMany = array(
		'Material' => array(
			'className' => 'Material',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'SemiProduct' => array(
			'className' => 'SemiProduct',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Kit' => array(
			'className' => 'Kit',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Good' => array(
			'className' => 'Good',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Consumable' => array(
			'className' => 'Consumable',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Inventory' => array(
			'className' => 'Inventory',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'ServiceProduct' => array(
			'className' => 'ServiceProduct',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'ServiceSupplier' => array(
			'className' => 'ServiceSupplier',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'ItemsWarehouseAddress' => array(
			'className' => 'ItemsWarehouseAddress',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'ItemsWarehousePlace' => array(
			'className' => 'ItemsWarehousePlace',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'GearsItem' => array(
			'className' => 'GearsItem',
			'foreignKey' => 'item_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		)
	);

	public function beforeValidate($options=array()){

		if(empty($this->data['Item']['code']) && !isset($this->data['Item']['id'])){
			$this->generateItemCode();
		}else{
			$currentItem=$this->find('first', array('contain'=>'ItemType', 'conditions'=>array('Item.id'=>$this->data['Item']['id'])));
			$itemTypeId = (int)($this->data['Item']['item_type_id']);

			if($currentItem['Item']['item_type_id'] != $itemTypeId) {
				$this->generateItemCode();
				return true;
			}

			$this->data['Item']['code']=$currentItem['Item']['code'];
			return true;
		}

	}

		
	public function generateItemCode(){
	
		$itemTypeId=$this->data['Item']['item_type_id'];
		$itemType=$this->ItemType->findById($itemTypeId)['ItemType'];
		$itemCount=(int)$this->find('count', array('conditions'=>array('item_type_id'=>$itemType['id'])));
		$this->data['Item']['code'] = $itemType['code'] . '-' . ($itemCount + 1);
	}

	public function softDelete($id=null){
	
		if(empty($id)){
			return false;
		}
		$this->id=$id;
		return $this->saveField('deleted', 1);
	}


}




?>