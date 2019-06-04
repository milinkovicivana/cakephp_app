<?php

App::uses('AppModel','Model');

class WarehouseAddress extends AppModel{

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
		'row'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A row is required'
			)
		),
		'shelf'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A row is required'
			),
			'numeric'=>array(
				'rule'=>array('numeric')
			)
		),
		'divider'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A row is required'
			),
			'numeric'=>array(
				'rule'=>array('numeric')
			)
		),
		'wplaces'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A item is required'
			)
		),
		'barcode'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A row is required'
			),
			/*'rule1' => array(
	            'rule' => 'alphaNumeric',
	            'message' => 'Only alphabets and numbers allowed',
	            'allowEmpty' => true
	         ),*/
			'rule2' => array(
	            'rule' => array('maxLength', 13),
	            'message' => 'Max length of 13 characters',
	            'allowEmpty' => true 
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


	public $belongsTo = array(
		'WarehousePlace' => array(
			'className' => 'WarehousePlace',
			'foreignKey' => 'warehouse_place_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	public $hasMany = array(
		'ItemsWarehouseAddress' =>
			array(
			'className' => 'ItemsWarehouseAddress',
			'foreignKey' => 'warehouse_address_id',
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
		'GearsItem' => array(
			'className' => 'GearsItem',
			'foreignKey' => 'send_address',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		)
	);

	public function generateCode(){

		$placeId=$this->data['WarehouseAddress']['warehouse_place_id'];
		$place=$this->WarehousePlace->findById($placeId)['WarehousePlace'];
		$this->data['WarehouseAddress']['code']=$place['code']. '_' . $this->data['WarehouseAddress']['row']. '_' . $this->data['WarehouseAddress']['shelf']. '_' . $this->data['WarehouseAddress']['divider'];

	}

	public function beforeValidate($options=array()){

		if(empty($this->data['WarehouseAddress']['code']) && !isset($this->data['WarehouseAddress']['id'])){
			$this->generateCode();
		}

	}
}


?>