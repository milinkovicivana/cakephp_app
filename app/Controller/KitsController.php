<?php

App::uses('AppController', 'Controller');

class KitsController extends AppController{

	public function index(){

		$this->set('kits',$this->paginate());
		$this->set('statuses',array('draft'=>'Draft','for sale'=>'For sale','phase out'=>'Phase out','obsolete'=>'Obsolete','nrnd'=>'Nrnd'));
	}

	public function save($id=null){

		if($id==null){
			$this->Kit->create();
		}else{
			$this->Kit->id=$id;
			$this->request->data['Item']['id']=$this->Kit->findById($id)['Item']['id'];
			$this->request->data['Kit']['id']=$id;

			if(!$this->Kit->exists($id)){
				$this->Flash->error('Kit not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->Kit->saveAll($this->request->data)){
				$this->Flash->success('Kit has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Kit could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->Kit->findById($id);
			}
		}

        $this->set('statuses',array('draft'=>'Draft','for sale'=>'For sale','phase out'=>'Phase out','obsolete'=>'Obsolete','nrnd'=>'Nrnd'));
        $this->set('dist',array(1=>'Yes',0=>'No'));
		$measurementUnits = $this->Kit->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->Kit->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	public function delete($id=null){

		$this->Kit->id=$id;

		if(!$this->request->is('post') || !$this->Kit->exists($id)){
			$this->Flash->error('Item not found.');
			$this->redirect(array('action'=>'index'));
		}

		$itemId=$this->Kit->field('item_id',['id'=>$id]);

		if($this->Kit->Item->softDelete($itemId)){
			$this->Flash->success('Item has been deleted.');
		}else{
			$this->Flash->error('Item could not be deleted.');
		}

		return $this->redirect(array('action'=>'index'));
	}



}




?>