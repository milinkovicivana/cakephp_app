<?php

App::uses('AppController', 'Controller');

class ItemTypesController extends AppController{

	public function index(){
		$this->ItemType->recursive=0;
		$this->set('types',$this->paginate());
		$this->set('classes',array('product'=>'Product','kit'=>'Kit','material'=>'Material','semi_product'=>'Semi product','service_product'=>'Service product','service_supplier'=>'Service supplier','consumable'=>'Consumable','inventory'=>'Inventory','goods'=>'Goods','other'=>'Other'));
	}

	public function save($id=null){

		if($id == null){
			$this->ItemType->create();
		}else{
			$this->ItemType->id=$id;

            if(!$this->ItemType->exists($id)){
                $this->Flash->error('Type could not be found!');
                return $this->redirect(['action' => 'index']);
            }    
		}

		if($this->request->is(array('post','put'))){
			if($this->ItemType->saveAll($this->request->data)){
				$this->Flash->success(__('Type has been saved.'));
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error(__('Type could not be saved.'));
			}
		}else{
            if($id != null){
               $this->request->data=$this->ItemType->findById($id);
            }
        }

		$this->set('classes',array('product'=>'Product','kit'=>'Kit','material'=>'Material','semi_product'=>'Semi product','service_product'=>'Service product','service_supplier'=>'Service supplier','consumable'=>'Consumable','inventory'=>'Inventory','goods'=>'Goods','other'=>'Other'));
		$this->set('tangible',array(1=>'Yes',0=>'No'));
		$this->set('active',array(1=>'Yes',0=>'No'));
	}

	public function delete($id=null){
		$this->ItemType->id=$id;
		if(!$this->ItemType->exists($id)){
			throw new NotFoundException('Type not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->ItemType->delete()){
			$this->Flash->success(__('Type has been deleted.'));
		}else{
			$this->Flash->error(__('Type could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));
	}
}


?>