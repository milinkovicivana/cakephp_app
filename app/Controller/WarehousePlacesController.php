<?php

App::uses('AppController','Controller');

class WarehousePlacesController extends AppController{

	public function index(){
		$wplaces = $this->paginate();
		$this->set('wplaces',$wplaces);
	}

	public function save($id=null){

		if($id==null){
			$this->WarehousePlace->create();
		}else{
			$this->WarehousePlace->id=$id;

			if(!$this->WarehousePlace->exists($id)){
				$this->Flash->error('Warehouse place not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		/*$currentTypes= $this->WarehousePlace->WarehouseItemType->find('list', array(
					'conditions' => array('WarehouseItemType.warehouse_place_id' => $id),
					'fields' => array('WarehouseItemType.id', 'WarehouseItemType.item_type')
				));*/

		if($this->request->is(array('post','put'))){

			$datasource=$this->WarehousePlace->getDataSource();
			try{
				$datasource->begin();
				if(!$this->WarehousePlace->save($this->request->data)){
					throw new Exception('Warehouse place could not be saved.');	
				}

				if($id==0){
					$id=$this->WarehousePlace->id;
				}
			
				//$result = array_diff($this->request->data['WarehouseItemType']['item_type'],$currentTypes);
				//var_dump($result);
				//exit();
				
				$item_types = array();
				foreach ($this->request->data['WarehouseItemType']['item_type'] as $item_type_form) {
					$item_type = array();
					$item_type['WarehouseItemType']['warehouse_place_id'] = $id;
					$item_type['WarehouseItemType']['item_type'] = $item_type_form;

					$item_types[] = $item_type;
				}

				if(!empty($this->request->data['WarehouseItemType']['item_type'])){
					$this->WarehousePlace->WarehouseItemType->deleteAll(array('WarehouseItemType.warehouse_place_id' => $id));
				}
				
				if(!$this->WarehousePlace->WarehouseItemType->saveMany($item_types)){
					throw new Exception('Warehouse type could not be saved.');	
				}
				$datasource->commit();

				$this->Flash->success('Warehouse place saved.');
				return $this->redirect(array('action'=>'index'));				
			}catch(Exception $e){
				$datasource->rollback();
			}
		}else{
			if($id != 0){
				$this->request->data=$this->WarehousePlace->findById($id);
				$this->request->data['WarehouseItemType']['item_type'] = $this->WarehousePlace->WarehouseItemType->find('list', array(
					'conditions' => array('WarehouseItemType.warehouse_place_id' => $id),
					'fields' => array('WarehouseItemType.item_type')
				));
			}
		}

		$this->set('active',array(1=>'Yes',0=>'No'));
		$this->set('default',array(1=>'Yes',0=>'No'));   
        //$itemTypes=$this->WarehousePlace->WarehouseItemType->find('list', ['fields' => ['id', 'item_type']]);
        //$this->set(compact('itemTypes'));
        $this->set('types',$this->WarehousePlace->WarehouseItemType->types);
	}

	public function delete($id=null){
    
        if($id != null){

            if(!$this->request->is('post') || !$this->WarehousePlace->exists($id)){
                $this->Flash->error('Warehouse place could not be found!');
                return $this->redirect(['action' => 'index']);
            }

            $datasource=$this->WarehousePlace->getDataSource();

            try{
            	$datasource->begin();

            	if(!$this->WarehousePlace->delete($id)){
                	throw new Exception('Warehouse place could not be deleted.');
            	}
	
            	$item_types=$this->WarehousePlace->WarehouseItemType->find('list', array(
					'conditions' => array('WarehouseItemType.warehouse_place_id' => $id)
				));
		
            	if(!$this->WarehousePlace->WarehouseItemType->delete($item_types)){
					throw new Exception('Warehouse type could not be deleted.');	
				}

				$datasource->commit();

				$this->Flash->success('Warehouse place deleted.');
				return $this->redirect(array('action'=>'index'));   	
            }catch(Exception $e){
            	$datasource->rollback();
            }          

        }

        return $this->redirect(['action' => 'index']);
    }

    public function details($id){

		if (!$this->WarehousePlace->exists($id)) {
			throw new NotFoundException(__('Invalid place.'));
		}
		$options = array('conditions' => array('WarehousePlace.' . $this->WarehousePlace->primaryKey => $id));
		$this->set('place', $this->WarehousePlace->find('first', $options));

		$joins=array(
	    	array('table' => 'items',
		        'alias' => 'Item',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Item.id = ItemsWarehousePlace.item_id',
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

		$items=$this->WarehousePlace->ItemsWarehousePlace->find('all', array(
			'joins'=>$joins,
			'conditions' => array('ItemsWarehousePlace.warehouse_place_id' => $id),
			'recursive'=> -1,
			'fields'=>array('Item.*','ItemType.*','MeasurementUnit.*')
		));
		$this->set('items',$items);
	}


}


?>