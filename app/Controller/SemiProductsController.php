<?php

App::uses('AppController','Controller');

class SemiProductsController extends AppController{

	public function index(){

		$this->set('semiproducts',$this->paginate());
		$this->set('statuses',array('development'=>'Development','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete'));
	}

	public function save($id=null){

		if($id==null){
			$this->SemiProduct->create();
		}else{
			$this->SemiProduct->id=$id;
			$this->request->data['Item']['id']=$this->SemiProduct->findById($id)['Item']['id'];
			$this->request->data['SemiProduct']['id']=$id;

			if(!$this->SemiProduct->exists($id)){
				$this->Flash->error('Semi product not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->SemiProduct->saveAll($this->request->data)){
				$this->Flash->success('Semi product has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Semi product could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->SemiProduct->findById($id);
			}
		}

        $this->set('statuses',array('development'=>'Development','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete'));
        $this->set('service',array(1=>'Yes',0=>'No'));
		$measurementUnits = $this->SemiProduct->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->SemiProduct->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	public function delete($id=null){

		$this->SemiProduct->id=$id;

		if(!$this->request->is('post') || !$this->SemiProduct->exists($id)){
			$this->Flash->error('Item not found.');
			$this->redirect(array('action'=>'index'));
		}

		$itemId=$this->SemiProduct->field('item_id',['id'=>$id]);

		if($this->SemiProduct->Item->softDelete($itemId)){
			$this->Flash->success('Item has been deleted.');
		}else{
			$this->Flash->error('Item could not be deleted.');
		}

		return $this->redirect(array('action'=>'index'));
	}


}




?>