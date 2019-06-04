<?php

App::uses('AppController','Controller');

class ItemsWarehouseAddressesController extends AppController{

	public function index(){
		$this->set('iwaddresses',$this->paginate());
	}

	public function save($id){

		$this->ItemsWarehouseAddress->WarehouseAddress->id=$id;

		if($id==null || !$this->ItemsWarehouseAddress->WarehouseAddress->exists($id)){
			$this->Flash->error('Address not found.');
			return $this->redirect(array('action'=>'index'));
		}

		if($this->request->is(array('post','put'))){

			$this->request->data['ItemsWarehouseAddress']['warehouse_address_id']=$id;

			if($this->ItemsWarehouseAddress->save($this->request->data)){
				$this->Flash->success('Address has been saved.');
				return $this->redirect(array('controller'=>'warehouseaddresses','action'=>'details',$id));
			}else{
				$this->Flash->error('Address could not be saved.');
			}
		}

		$place=$this->ItemsWarehouseAddress->WarehouseAddress->find('list', array('fields'=>array('warehouse_place_id'),
				'conditions'=>array('id'=>$id)));

		$types=$this->ItemsWarehouseAddress->WarehouseAddress->WarehousePlace->WarehouseItemType->find('list',array(
			'conditions'=>array('warehouse_place_id'=>$place),
			'fields'=>array('WarehouseItemType.item_type')
		));

		$items=$this->ItemsWarehouseAddress->Item->find('list',array(
			'conditions'=>array(
				'ItemType.class'=>$types,
				'ItemType.tangible'=>1,
				'Item.deleted'=>null
			),
			'fields'=>array('Item.id','Item.name'),
			'recursive'=>0
		));
	
       	$this->set('items',$items); 
	}

	public function delete($id){

		$this->ItemsWarehouseAddress->id=$id;
		if(!$this->ItemsWarehouseAddress->exists($id)){
			throw new NotFoundException('Address not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->ItemsWarehouseAddress->delete()){
			$this->Flash->success(__('Address has been deleted.'));
		}else{
			$this->Flash->error(__('Address could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));

	}


}




?>