<?php

App::uses('AppController', 'Controller');

class GearsItemsController extends AppController{

	public function index(){
		//$this->set('gitems',$this->paginate());
		//$this->Paginator->settings = array(
			$joins=array(
				array('table' => 'gears',
		        'alias' => 'Gear',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.id = GearsItem.gear_id',
		        	)
		   		),
				array('table' => 'items',
		        'alias' => 'Item',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Item.id = GearsItem.item_id',
		        	)
		   		),
		   		array('table' => 'measurement_units',
		        'alias' => 'MeasUnit',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'MeasUnit.id = Item.measurement_unit_id',
		        	)
		   		),
		   		array('table' => 'warehouse_addresses',
		        'alias' => 'WarehouseAddressFrom',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'GearsItem.send_address = WarehouseAddressFrom.id',
		        	)
		    	),
		    	array('table' => 'warehouse_addresses',
		        'alias' => 'WarehouseAddressTo',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'GearsItem.receive_address = WarehouseAddressTo.id',
		        	)
		    	),

			);//);

			$gitems=$this->GearsItem->find('all',array(
		    	'joins'=>$joins,
		    	'recursive'=> -1,
		    	'fields'=>array('GearsItem.*','Item.*','MeasUnit.*','WarehouseAddressFrom.*','WarehouseAddressTo.*','Gear.*')
	   		));

	   		$this->set('gitems',$gitems);
		
		//var_dump($gitems);
		//exit();

	}

	public function save($id){

		$this->GearsItem->Gear->id=$id;

		if($id==null || !$this->GearsItem->Gear->exists($id)){
			$this->Flash->error('Gear not found.');
			return $this->redirect(array('action'=>'index'));
		}

		$idFrom=$this->GearsItem->Gear->find('list',array(
			'conditions'=>array('Gear.id='.$id),
			'fields'=>'Gear.transmission_from'
		));

		$idTo=$this->GearsItem->Gear->find('list',array(
			'conditions'=>array('Gear.id='.$id),
			'fields'=>'Gear.transmission_to'
		));

		//var_dump($idTo);
		//exit();


		$items=$this->GearsItem->Item->find('list',array(
			'joins'=>array(
				 array('table' => 'items_warehouse_places',
		        'alias' => 'ItemsWarehousePlace',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Item.id = ItemsWarehousePlace.item_id',
		        	)
		   		),
			),
			'conditions'=>array('ItemsWarehousePlace.warehouse_place_id' => $idFrom),
			'fields'=>array('Item.id','Item.name')
		));

		$this->set('items',$items);

		$addressTo=$this->GearsItem->Gear->WarehousePlace->find('first',array(
			'joins'=>array(
				 array('table' => 'warehouse_addresses',
		        'alias' => 'WarehouseAddress',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'WarehousePlace.id = WarehouseAddress.warehouse_place_id',
		        	)
		    	),
			),
			'conditions'=>array('WarehousePlace.id' => $idTo),
			'fields'=>array('WarehouseAddress.id','WarehouseAddress.code')
		));

		//var_dump($addressTo);
		//exit();

		if($this->request->is(array('post','put'))){

			$this->request->data['GearsItem']['gear_id']=$id;

			$addressFrom=$this->GearsItem->Item->ItemsWarehouseAddress->find('first',array(
			'conditions'=>array('ItemsWarehouseAddress.item_id' => $this->request->data['GearsItem']['item_id']),
			));

			$this->request->data['GearsItem']['send_address']=$addressFrom['WarehouseAddress']['id'];
			$this->request->data['GearsItem']['receive_address']=$addressTo['WarehouseAddress']['id'];

			//var_dump($addressFrom);
			//var_dump($this->request->data);
			//exit();

			if($this->GearsItem->save($this->request->data)){
				$this->Flash->success('Item has been saved.');
				return $this->redirect(array('controller'=>'gears','action'=>'details',$id));
			}else{
				$this->Flash->error('Item could not be saved.');
			}
		}

	}

	public function edit($gearItemId,$gearId){

		$this->GearsItem->id=$gearItemId;
		if(!$this->GearsItem->exists()){
			throw new NotFoundException(__('Invalid item.'));
		}

		if($this->request->is('post') || $this->request->is('put')){

			$this->request->data['GearsItem']['gear_id']=$gearId;
			if($this->GearsItem->save($this->request->data)){
				$this->Flash->success(__('Item has been saved.'));
				return $this->redirect(array('action'=>'index'));
			}

			$this->Flash->error(__('Item could not be saved.'));
		}else{
			$this->request->data=$this->GearsItem->findById($gearItemId);
		}

		$idFrom=$this->GearsItem->Gear->find('list',array(
			'conditions'=>array('Gear.id='.$gearId),
			'fields'=>'Gear.transmission_from'
		));

		$idTo=$this->GearsItem->Gear->find('list',array(
			'conditions'=>array('Gear.id='.$gearId),
			'fields'=>'Gear.transmission_to'
		));

		$items=$this->GearsItem->Item->find('list',array(
			'joins'=>array(
				 array('table' => 'items_warehouse_places',
		        'alias' => 'ItemsWarehousePlace',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Item.id = ItemsWarehousePlace.item_id',
		        	)
		   		),
			),
			'conditions'=>array('ItemsWarehousePlace.warehouse_place_id' => $idFrom),
			'fields'=>array('Item.id','Item.name')
		));

		$this->set('items',$items);
	}

	public function delete($id=null){

		$this->GearsItem->id=$id;
		if(!$this->GearsItem->exists($id)){
			throw new NotFoundException('Item not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->GearsItem->delete()){
			$this->Flash->success(__('Item has been deleted.'));
		}else{
			$this->Flash->error(__('Item could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));

	}
}




?>