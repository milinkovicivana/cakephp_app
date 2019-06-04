<?php

App::uses('App Model','Model');

class SemiProduct extends AppModel{

	public $validate=array(
		'item_id'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			/*'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A item is required'
			)*/
		),
		'semi_product_status'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A status is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array('development','in use','phase out','obsolete')),
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