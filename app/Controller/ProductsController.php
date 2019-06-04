<?php

App::uses('AppController','Controller');

class ProductsController extends AppController{

	public function index(){

		$this->set('products',$this->paginate());

		$this->set('statuses',array('development'=>'Development','for sale'=>'For sale','phase out'=>'Phase out','obsolete'=>'Obsolete','nrnd'=>'Nrnd'));
	}

	public function save($id=null){

		if($id==null){
			$this->Product->create();
		}else{
			$this->Product->id=$id;
			$this->request->data['Item']['id']=$this->Product->findById($id)['Item']['id'];
			$this->request->data['Product']['id']=$id;

			if(!$this->Product->exists($id)){
				$this->Flash->error('Product not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->Product->saveAll($this->request->data)){
				$this->Flash->success('Product has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Product could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->Product->findById($id);
			}
		}

        $this->set('statuses',array('development'=>'Development','for sale'=>'For sale','phase out'=>'Phase out','obsolete'=>'Obsolete','nrnd'=>'Nrnd'));
        $this->set('service',array(1=>'Yes',0=>'No'));
        $this->set('dist',array(1=>'Yes',0=>'No'));
		$measurementUnits = $this->Product->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->Product->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	public function delete($id=null){

		$this->Product->id=$id;

		if(!$this->request->is('post') || !$this->Product->exists($id)){
			$this->Flash->error('Item not found.');
			$this->redirect(array('action'=>'index'));
		}

		$itemId=$this->Product->field('item_id',['id'=>$id]);

		if($this->Product->Item->softDelete($itemId)){
			$this->Flash->success('Item has been deleted.');
		}else{
			$this->Flash->error('Item could not be deleted.');
		}

		return $this->redirect(array('action'=>'index'));
	}


}



?>