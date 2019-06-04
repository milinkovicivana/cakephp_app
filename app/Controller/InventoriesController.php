<?php

App::uses('AppController', 'Controller');

class InventoriesController extends AppController{

	public function index(){
		$this->set('inventory',$this->paginate());
		$this->set('statuses',array('draft'=>'Draft','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete'));
		$this->set('ratings',array('platinum'=>'Platinum','gold'=>'Gold','silver'=>'Silver'));
	}

	public function save($id=null){

		if($id==null){
			$this->Inventory->create();
		}else{
			$this->Inventory->id=$id;
			$this->request->data['Item']['id']=$this->Inventory->findById($id)['Item']['id'];
			$this->request->data['Inventory']['id']=$id;

			if(!$this->Inventory->exists($id)){
				$this->Flash->error('Inventory not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->Inventory->saveAll($this->request->data)){
				$this->Flash->success('Inventory has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Inventory could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->Inventory->findById($id);
			}
		}

       	$this->set('statuses',array('draft'=>'Draft','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete'));  
		$this->set('ratings',array('platinum'=>'Platinum','gold'=>'Gold','silver'=>'Silver'));
		$measurementUnits = $this->Inventory->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->Inventory->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	public function delete($id=null){

		$this->Inventory->id=$id;

		if(!$this->request->is('post') || !$this->Inventory->exists($id)){
			$this->Flash->error('Item not found.');
			$this->redirect(array('action'=>'index'));
		}

		$itemId=$this->Inventory->field('item_id',['id'=>$id]);

		if($this->Inventory->Item->softDelete($itemId)){
			$this->Flash->success('Item has been deleted.');
		}else{
			$this->Flash->error('Item could not be deleted.');
		}

		return $this->redirect(array('action'=>'index'));
	}

}






?>