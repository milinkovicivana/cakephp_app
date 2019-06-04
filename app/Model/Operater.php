<?php

App::uses('AppModel','Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class Operater extends AppModel{

	public $validate=array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank')
			)
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank')
			)
		)
	);

	public function beforeSave($options=array()){
		if(isset($this->data['Operater']['password'])){
			$passwordHasher=new BlowfishPasswordHasher();
			$this->data['Operater']['password']=$passwordHasher->hash($this->data['Operater']['password']);
		}

		return true;
	}

	public $hasMany = array(
		'Permission' => array(
			'className' => 'Permission',
			'foreignKey' => 'operater_id',
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
		'Gear' => array(
			'className' => 'Gear',
			'foreignKey' => 'operater_id',
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