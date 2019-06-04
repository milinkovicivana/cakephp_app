<?php

App::uses('AppController','Controller');

class ServiceProductsController extends AppController{

	public function index(){

		$this->set('serproducts',$this->paginate());
		$this->set('statuses',array('development'=>'Development','for sale'=>'For sale','phase out'=>'Phase out','obsolete'=>'Obsolete'));
	}

	public function save($id=null){

		if($id==null){
			$this->ServiceProduct->create();
		}else{
			$this->ServiceProduct->id=$id;
			$this->request->data['Item']['id']=$this->ServiceProduct->findById($id)['Item']['id'];
			$this->request->data['ServiceProduct']['id']=$id;

			if(!$this->ServiceProduct->exists($id)){
				$this->Flash->error('Service product not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->ServiceProduct->saveAll($this->request->data)){
				$this->Flash->success('Service product has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Service product could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->ServiceProduct->findById($id);
			}
		}

        $this->set('statuses',array('development'=>'Development','for sale'=>'For sale','phase out'=>'Phase out','obsolete'=>'Obsolete'));
        $this->set('dist',array(1=>'Yes',0=>'No'));
		$measurementUnits = $this->ServiceProduct->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->ServiceProduct->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	public function delete($id=null){

		$this->ServiceProduct->id=$id;

		if(!$this->request->is('post') || !$this->ServiceProduct->exists($id)){
			$this->Flash->error('Item not found.');
			$this->redirect(array('action'=>'index'));
		}

		$itemId=$this->ServiceProduct->field('item_id',['id'=>$id]);

		if($this->ServiceProduct->Item->softDelete($itemId)){
			$this->Flash->success('Item has been deleted.');
		}else{
			$this->Flash->error('Item could not be deleted.');
		}

		return $this->redirect(array('action'=>'index'));
	}
}





?>