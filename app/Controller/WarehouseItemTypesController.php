<?php

App::uses('AppController','Controller');

class WarehouseItemTypesController extends AppController{

	public function index(){

		$this->set('witemtypes',$this->paginate());
	}

}