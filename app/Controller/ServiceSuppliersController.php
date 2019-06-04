<?php

App::uses('AppController', 'Controller');

class ServiceSuppliersController extends AppController{

	public function index(){
		$this->set('suppliers',$this->paginate());
		$this->set('statuses',array('draft'=>'Draft','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete'));
		$this->set('ratings',array('platinum'=>'Platinum','gold'=>'Gold','silver'=>'Silver'));
	}

	public function save($id=null){

		if($id==null){
			$this->ServiceSupplier->create();
		}else{
			$this->ServiceSupplier->id=$id;
			$this->request->data['Item']['id']=$this->ServiceSupplier->findById($id)['Item']['id'];
			$this->request->data['ServiceSupplier']['id']=$id;

			if(!$this->ServiceSupplier->exists($id)){
				$this->Flash->error('Service supplier not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->ServiceSupplier->saveAll($this->request->data)){
				$this->Flash->success('Service supplier has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Service supplier could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->ServiceSupplier->findById($id);
			}
		}

       	$this->set('statuses',array('draft'=>'Draft','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete'));  
		$this->set('ratings',array('platinum'=>'Platinum','gold'=>'Gold','silver'=>'Silver'));
		$measurementUnits = $this->ServiceSupplier->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->ServiceSupplier->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	public function delete($id=null){

		$this->ServiceSupplier->id=$id;

		if(!$this->request->is('post') || !$this->ServiceSupplier->exists($id)){
			$this->Flash->error('Item not found.');
			$this->redirect(array('action'=>'index'));
		}

		$itemId=$this->ServiceSupplier->field('item_id',['id'=>$id]);

		if($this->ServiceSupplier->Item->softDelete($itemId)){
			$this->Flash->success('Item has been deleted.');
		}else{
			$this->Flash->error('Item could not be deleted.');
		}

		return $this->redirect(array('action'=>'index'));
	}
}




?>