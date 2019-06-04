<?php

App::uses('AppModel','Model');

class ServiceSupplier extends AppModel{

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
		'service_status'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A status is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array('draft','in use','phase out','obsolete')),
				'message'=>'Plese enter a valid status'
			)
		),
		'service_rating'=>array(
			'valid'=>array(
				'rule'=>array('inList',array('platinum','silver','gold')),
				'message'=>'Please enter a valid rating'
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