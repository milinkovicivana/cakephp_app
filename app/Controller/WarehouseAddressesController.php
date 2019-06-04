<?php

App::uses('AppController','Controller');

class WarehouseAddressesController extends AppController{

	public function index(){

		$this->set('waddresses',$this->paginate());
	}

	public function save($id=null){

		if($id==null){
			$this->WarehouseAddress->create();
		}else{
			$this->WarehouseAddress->id=$id;

			if(!$this->WarehouseAddress->exists($id)){
				$this->Flash->error('Warehouse address not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
		
			$this->request->data['WarehouseAddress']['warehouse_place_id']=$this->request->data['WarehouseAddress']['wplaces'];

			if($this->WarehouseAddress->save($this->request->data)){
				$this->Flash->success(__('Warehouse address has been saved.'));
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error(__('Warehouse address could not be saved.'));
			}
		}else{
            if($id != null){
               $address=$this->WarehouseAddress->findById($id);
               $this->request->data=$address;
               $this->request->data['WarehouseAddress']['wplaces']=$address['WarehousePlace']['id'];
            }
        }

		$this->set('active',array(1=>'Yes',0=>'No'));  
        $wplaces=$this->WarehouseAddress->WarehousePlace->find('list', ['fields' => ['id', 'name']]);
       	$this->set(compact('wplaces'));  
	}

	public function delete($id=null){

		$this->WarehouseAddress->id=$id;
		if(!$this->WarehouseAddress->exists($id)){
			throw new NotFoundException('Address not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->WarehouseAddress->delete()){
			$this->Flash->success(__('Address has been deleted.'));
		}else{
			$this->Flash->error(__('Address could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));


	}

	public function details($id){

		if (!$this->WarehouseAddress->exists($id)) {
			throw new NotFoundException(__('Invalid address.'));
		}
		$options = array('conditions' => array('WarehouseAddress.' . $this->WarehouseAddress->primaryKey => $id));
		$this->set('address', $this->WarehouseAddress->find('first', $options));

		$joins=array(
	    	array('table' => 'items',
		        'alias' => 'Item',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Item.id = ItemsWarehouseAddress.item_id',
		        )
		    ),
	        array('table' => 'item_types',
		        'alias' => 'ItemType',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'ItemType.id = Item.item_type_id',
		        )
    		),
	        array('table' => 'measurement_units',
		        'alias' => 'MeasurementUnit',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'MeasurementUnit.id = Item.measurement_unit_id',
		        )
		    )
	);

		$items=$this->WarehouseAddress->ItemsWarehouseAddress->find('all', array(
			'joins'=>$joins,
			'conditions' => array('ItemsWarehouseAddress.warehouse_address_id' => $id),
			'recursive'=> -1,
			'fields'=>array('Item.*','ItemType.*','MeasurementUnit.*')
		));
		$this->set('items',$items);
		//var_dump($items);
		//exit();
	}
}



?>