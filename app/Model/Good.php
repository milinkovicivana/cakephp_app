<?php

App::uses('AppModel','Model');

class Good extends AppModel{

	public $validate=array(
		'item_id'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A item is required'
			)
		),
		'status'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A status is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array('draft','for sale','phase out','obsolete','nrnd')),
				'message'=>'Plese enter a valid status'
			)
		),
		'PID'=>array(
			'rule1' => array(
	            'rule' => array('checkStatus'),
	            'message' => 'PID is required for phase out, for sale and obsolete statuses',
	            'required' => true,
	        ),	
			'unique'=>array(
				'rule'=>array('isUnique'),
				'allowEmpty'=>true
			)
		),
		'hs_number'=>array(
			'rule1' => array(
	            'rule' => array('checkStatus'),
	            'message' => 'HS number is required for phase out, for sale and obsolete statuses',
	            'required' => true 
	        ),	
		),
		'tax_group'=>array(
			'rule1' => array(
	            'rule' => array('checkStatus'),
	            'message' => 'Tax group is required for phase out, for sale and obsolete statuses',
	            'required' => true 
	        ),	
		),
		'eccn'=>array(
	        'rule1' => array(
	            'rule' => array('checkStatus'),
	            'message' => 'ECCN is required for phase out, for sale and obsolete statuses',
	            'required' => true 
	        ),		
	        'rule2' => array(
	            'rule' => 'alphaNumeric',
	            'message' => 'Only alphabets and numbers allowed',
	            'allowEmpty' => true
	         ),
	        'rule3' => array(
	            'rule' => array('maxLength', 5),
	            'message' => 'Max length of 5 characters',
	            'allowEmpty' => true 
	        )			
		),
		'release_date'=>array(
			'rule1' => array(
	            'rule' => array('checkStatus'),
	            'message' => 'Date is required for phase out, for sale and obsolete statuses',
	            //'required' => true 
	        ),
		),
		'for_distributors'=>array(
			'valid'=>array(
				'rule'=>array('inList',array(1,0)),
			),
		)
	);

	public function checkStatus($check){
		$value = array_pop($check);
		$status=$this->data['Good']['status'];
		if($status=='for sale' || $status=='phase out' || $status=='obsolete'){
			return !empty($value);
		}

		return true;

	}

	public function beforeValidate($options=array()){

		if(!isset($this->data['Good']['id'])){
			$this->data['Good']['release_date']=$this->generateDate();
			return true;
		}else{
			$currentStatus=$this->find('first', array('contain'=>'Good', 'conditions'=>array('Good.id'=>$this->data['Good']['id'])));
			$status=$this->data['Good']['status'];

			if($currentStatus['Good']['status']=='draft' && $status=='for sale'){
				$this->data['Good']['release_date']=$this->generateDate();
				return true;
			}

			$this->data['Good']['release_date']=$currentStatus['Good']['release_date'];
			return true;
		}

	}

	public function generateDate(){

		if($this->data['Good']['status']=='for sale' || $this->data['Good']['status']=='phase out' || $this->data['Good']['status']=='obsolete'){
			return date('Y-m-d');
		}

		return null;
		
	}

	public $belongsTo = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}




?>