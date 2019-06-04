<?php

App::uses('AppController','Controller');

class ItemsWarehousePlacesController extends AppController{

	public function index(){
		$this->set('iwplaces',$this->paginate());
	}

	public function save($id=null){

		if($id==null){
			$this->ItemsWarehousePlace->create();
		}else{
			$this->ItemsWarehousePlace->id=$id;
			$this->request->data['ItemsWarehousePlace']['id']=$id;

			if(!$this->ItemsWarehousePlace->exists($id)){
				$this->Flash->error('Place not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->ItemsWarehousePlace->saveAll($this->request->data)){
				$this->Flash->success('Place has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Place could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->ItemsWarehousePlace->findById($id);
			}
		}

		$items = $this->ItemsWarehousePlace->Item->find('list', ['fields' => ['id', 'name']]);
		$places = $this->ItemsWarehousePlace->WarehousePlace->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('items','places'));

	}

	public function delete($id=null){

		$this->ItemsWarehousePlace->id=$id;
		if(!$this->ItemsWarehousePlace->exists($id)){
			throw new NotFoundException('Place not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->ItemsWarehousePlace->delete()){
			$this->Flash->success(__('Place has been deleted.'));
		}else{
			$this->Flash->error(__('Place could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));


	}

}




?>