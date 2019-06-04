<?php

App::uses('AppModel','Model');

class Material extends AppModel{

	public $validate=array(

		'item_id'=>array(
			'numeric'=>array(
				'rule'=>array('numeric')
			),
			/*'required'=>array(
				'rule'=>'notEmpty',
				'message'=>'A item is required'
			)*/
		),
		'material_status'=>array(
			'required'=>array(
				'rule'=>'notBlank',
				'message'=>'A status is required'
			),
			'valid'=>array(
				'rule'=>array('inList',array('development','in use','phase out','obsolete')),
				'message'=>'Plese enter a valid status'
			)
		),
		'recommended_rating'=>array(
			'valid'=>array(
				'rule'=>array('inList',array('platinum','gold','silver')),
				'message'=>'Plese enter a valid rating'
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