<?php

App::uses('AppModel','Model');

class MeasurementUnit extends AppModel{

	public $validate=array(
		'name'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A name is required'
			),
			'unique'=>array(
				'rule'=>array('isUnique')
			)
		),
		'symbol'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A symbol is required'
			),
			'unique'=>array(
				'rule'=>array('isUnique')
			)
		),
		'active'=>array(
			'valid'=>array(
				'rule'=>array('inList',array(1,0)),
				'message'=>'Plese enter a valid status'
			)
		)
	);

	public $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'measurement_unit_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}



?>