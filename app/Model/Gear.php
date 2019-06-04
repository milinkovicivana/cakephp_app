<?php

App::uses('AppModel','Model');

class Gear extends AppModel{

	public $validate=array(
		'permission_id'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'required'
			)
		),
		'warehouse_address_id'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'required'
			)
		),
		'status'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A status is required'
			),
			/*'valid'=>array(
				'rule'=>array('inList',array('opened','sent','ready','delivered','canceled')),
				'message'=>'Plese enter a valid status'
			)*/
		),
		'code'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Code is required'
			),
			'unique'=>array(
				'rule'=>array('isUnique'),
				'allowEmpty'=>true
			)
		),
		'date'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Date is required'
			)
		),
		'created_by'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Operater is required'
			)
		),
		'transmission_from'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Place is required'
			)
		),
		'transmission_to'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Place is required'
			)
		),
		/*'operater_goods_send'=>array(
			'rule1' => array(
	            'rule' => array('checkStatus'),
	            'message' => 'Operater is required for ready and delivered statuses',
	            'required' => true,
	        )
		),
		/*'operater_goods_receive'=>array(
			'rule1' => array(
	            'rule' => array('checkStatus'),
	            'message' => 'Operater is required for delivered status',
	            'required' => true,
	        )
		),*/
		'transmission_type'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'Transmission type is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array('standard','trebovanje')),
				'message'=>'Plese enter a valid type'
			),
			'rule1' => array(
	            'rule' => array('checkType'),
	            'message' => 'Operater is required for delivered status',
	            'required' => true,
	        )
		),
		'work_order'=>array(
			'rule1' => array(
	            'rule' => array('checkType'),
	            'message' => 'Work order is required for type trebovanje',
	            'required' => true,
	        )
		)
	);

	/*public function checkStatus($check){
		$value = array_pop($check);
		$status=$this->data['Gear']['status'];
		if($status=='ready' || $status=='delivered'){
			return !empty($value);
		}

		return true;

	}*/

	public function checkType($check){
		$value = array_pop($check);
		$type=$this->data['Gear']['transmission_type'];
		if($type=='trebovanje'){
			return !empty($value);
		}

		return true;

	}

	public function generateCode(){

		$gear=(int)$this->find('count');
		$numGear=$gear+1;

		$type=$this->data['Gear']['transmission_type'];
		if($type=='trebovanje'){
			$this->data['Gear']['code']='TRETMAT'. date('Y', strtotime($this->data['Gear']['date'])). str_pad($numGear,4,'0',STR_PAD_LEFT);
		}else{
			$this->data['Gear']['code']='INTPRE'. date('Y', strtotime($this->data['Gear']['date'])). str_pad($numGear,4,'0',STR_PAD_LEFT);
		}

	}

	public function beforeValidate($options=array()){

		if(empty($this->data['Gear']['code']) && !isset($this->data['Gear']['id'])){
			$this->generateCode();
		}

		if(empty($this->data['Gear']['created_by']) && empty($this->data['Gear']['operator_goods_send'])){
			$this->data['Gear']['status']=='opened';
		}

		if(!empty($this->data['Gear']['created_by']) && !empty($this->data['Gear']['operator_goods_send'])){
			$this->data['Gear']['status']=='sent';
		}

		if(!empty($this->data['Gear']['operator_goods_send']) && !empty($this->data['Gear']['operator_goods_received'])){
			$this->data['Gear']['status']=='delivered';
		}
	}

	public $belongsTo = array(
		'Operater' => array(
			'className' => 'Operater',
			'foreignKey' => 'operater_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WarehousePlace' => array(
			'className' => 'WarehousePlace',
			'foreignKey' => 'transmission_from',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)/*,
		'Permission' => array(
			'className' => 'Permission',
			'foreignKey' => 'permission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'WarehouseAddress' => array(
			'className' => 'WarehouseAddress',
			'foreignKey' => 'warehouse_address_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);

	public $hasMany = array(
		'GearsItem' => array(
			'className' => 'GearsItem',
			'foreignKey' => 'gear_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
		)
	);
}







?>