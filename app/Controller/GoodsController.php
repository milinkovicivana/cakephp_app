<?php

App::uses('AppController','Controller');

class GoodsController extends AppController{

	public function index(){

		$this->set('goods',$this->paginate());
		$this->set('statuses',array('draft'=>'Draft','for sale'=>'For sale','phase out'=>'Phase out','obsolete'=>'Obsolete','nrnd'=>'Nrnd'));
	}

	public function save($id=null){

		if($id==null){
			$this->Good->create();
		}else{
			$this->Good->id=$id;
			$this->request->data['Item']['id']=$this->Good->findById($id)['Item']['id'];
			$this->request->data['Good']['id']=$id;

			if(!$this->Good->exists($id)){
				$this->Flash->error('Good not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->Good->saveAll($this->request->data)){
				$this->Flash->success('Good has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Good could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->Good->findById($id);
			}
		}

        $this->set('statuses',array('draft'=>'Draft','for sale'=>'For sale','phase out'=>'Phase out','obsolete'=>'Obsolete','nrnd'=>'Nrnd'));
        $this->set('dist',array(1=>'Yes',0=>'No'));
		$measurementUnits = $this->Good->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->Good->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	public function delete($id=null){

		$this->Good->id=$id;

		if(!$this->request->is('post') || !$this->Good->exists($id)){
			$this->Flash->error('Item not found.');
			$this->redirect(array('action'=>'index'));
		}

		$itemId=$this->Good->field('item_id',['id'=>$id]);

		if($this->Good->Item->softDelete($itemId)){
			$this->Flash->success('Item has been deleted.');
		}else{
			$this->Flash->error('Item could not be deleted.');
		}

		return $this->redirect(array('action'=>'index'));
	}

}




?>