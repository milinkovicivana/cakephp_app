<?php

App::uses('AppModel','Model');

class Inventory extends AppModel{

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
				'rule'=>array('inList',array('draft','in use','phase out','obsolete')),
				'message'=>'Plese enter a valid status'
			)
		),
		'recommended_ratings'=>array(
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