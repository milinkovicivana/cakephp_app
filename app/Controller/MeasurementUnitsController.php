<?php

App::uses('AppController', 'Controller');

class MeasurementUnitsController extends AppController{

	public $helpers=array('Html','Form','Flash');
	public $components=array('Session');

	public function index(){
		$this->MeasurementUnit->recursive=0;
		$this->set('units',$this->paginate());
	}

	public function save($id=null){

		if($id==null){
			$this->MeasurementUnit->create();
		}else{
			$this->MeasurementUnit->id=$id;

			if(!$this->MeasurementUnit->exists($id)){
				$this->Flash->error('Unit not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->MeasurementUnit->saveAll($this->request->data)){
				$this->Flash->success('Unit has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Unit could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->MeasurementUnit->findById($id);
			}
		}

		 $this->set('active',array(1=>'Yes',0=>'No'));
	}

	public function delete($id=null){

		$this->MeasurementUnit->id=$id;
		if(!$this->MeasurementUnit->exists($id)){
			throw new NotFoundException('Unit not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->MeasurementUnit->delete()){
			$this->Flash->success(__('Unit has been deleted.'));
		}else{
			$this->Flash->error(__('Unit could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));


	}
}



?>