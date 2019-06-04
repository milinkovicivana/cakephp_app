<?php

App::uses('AppController','Controller');

class ConsumablesController extends AppController{

	public function index(){
		$this->set('consumables',$this->paginate());
		$this->set('statuses',array('draft'=>'Draft','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete','nrnd'=>'Nrnd'));
		$this->set('ratings',array('platinum'=>'Platinum','gold'=>'Gold','silver'=>'Silver'));
	}

	public function save($id=null){

		if($id==null){
			$this->Consumable->create();
		}else{
			$this->Consumable->id=$id;
			$this->request->data['Item']['id']=$this->Consumable->findById($id)['Item']['id'];
			$this->request->data['Consumable']['id']=$id;

			if(!$this->Consumable->exists($id)){
				$this->Flash->error('Consumable not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->Consumable->saveAll($this->request->data)){
				$this->Flash->success('Consumable has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Consumable could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->Consumable->findById($id);
			}
		}

       	$this->set('statuses',array('draft'=>'Draft','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete','nrnd'=>'Nrnd'));  
		$this->set('ratings',array('platinum'=>'Platinum','gold'=>'Gold','silver'=>'Silver'));
		$measurementUnits = $this->Consumable->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->Consumable->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	public function delete($id=null){

		$this->Consumable->id=$id;

		if(!$this->request->is('post') || !$this->Consumable->exists($id)){
			$this->Flash->error('Item not found.');
			$this->redirect(array('action'=>'index'));
		}

		$itemId=$this->Consumable->field('item_id',['id'=>$id]);

		if($this->Consumable->Item->softDelete($itemId)){
			$this->Flash->success('Item has been deleted.');
		}else{
			$this->Flash->error('Item could not be deleted.');
		}

		return $this->redirect(array('action'=>'index'));
	}
}



?>