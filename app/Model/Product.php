<?php

App::uses('AppModel','Model');
use Cake\Validation\Validator;

class Product extends AppModel{

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
		'product_status'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A status is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array('development','for sale','phase out','obsolete','nrnd')),
				'message'=>'Plese enter a valid status'
			)
		),
		'service_production'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A status production is required'
			),
		),
		'PID'=>array(
			/*'required'=>array(
				'rule'=>array('checkStatus'),
				'message'=>'PID is required for phase out, for sale and obsolete statuses'
			),*/
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
		'HS_number'=>array(
			/*'required'=>array(
				'rule'=>array('checkStatus'),
				'message'=>'Hs number is required for phase out, for sale and obsolete statuses'
			),*/
			'rule1' => array(
	            'rule' => array('checkStatus'),
	            'message' => 'HS number is required for phase out, for sale and obsolete statuses',
	            'required' => true 
	        ),	
		),
		'tax_group'=>array(
			/*'required'=>array(
				'rule'=>array('checkStatus'),
				'message'=>'Tax group is required for phase out, for sale and obsolete statuses'
			),*/
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
			/*
			'required'=>array(
				'rule'=>array('checkStatus','product_status'),'alphaNumeric',array('maxLength',5),
				'message'=>'ECCN is required for phase out, for sale and obsolete statuses'
			),
			*/
		),
		'release_date'=>array(
			/*'required'=>array(
				'rule'=>array('checkStatus'),
				'message'=>'Release date is required for phase out, for sale and obsolete statuses'
			),*/
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
		),
		'product_status'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A status is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array('development','for sale','phase out','obsolete','nrnd')),
				'message'=>'Plese enter a valid status'
			)
		),
		'service_production'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A service production is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array(1,0)),
				'message'=>'Plese enter a valid status'
			)
		)

	);

	public function checkStatus($check){
		$value = array_pop($check);
		$status=$this->data['Product']['product_status'];
		if($status=='for sale' || $status=='phase out' || $status=='obsolete'){
			return !empty($value);
		}

		return true;

	}

	public function beforeValidate($options=array()){

		if(!isset($this->data['Product']['id'])){
			$this->data['Product']['release_date']=$this->generateDate();
			return true;
		}else{
			$currentStatus=$this->find('first', array('contain'=>'Product', 'conditions'=>array('Product.id'=>$this->data['Product']['id'])));
			$status=$this->data['Product']['product_status'];

			if($currentStatus['Product']['product_status']=='development' && $status=='for sale'){
				$this->data['Product']['release_date']=$this->generateDate();
				return true;
			}

			$this->data['Product']['release_date']=$currentStatus['Product']['release_date'];
			return true;
		}	

	}

	public function generateDate(){

		if($this->data['Product']['product_status']=='for sale' || $this->data['Product']['product_status']=='phase out' || $this->data['Product']['product_status']=='obsolete'){
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