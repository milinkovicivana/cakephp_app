<?php

App::uses('AppController', 'Controller');

class GearsController extends AppController{

	public $helpers=array('Html','Form','Session');
	public $components=array('Paginator');

	public function index(){
		$logOperater=$this->Auth->user('id');

	    $this->Paginator->settings = array(
	        $joins=array(	        
		    array('table' => 'operaters',
		        'alias' => 'Operater',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Operater.id = Gear.operater_id',
		        )
		    ),
		    array('table' => 'operaters',
		        'alias' => 'OperaterSend',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.operator_goods_send = OperaterSend.id',
		        )
		    ),
		    array('table' => 'operaters',
		        'alias' => 'OperaterReceive',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.operator_goods_receive = OperaterReceive.id',
		        )
		    ),
	    	array('table' => 'warehouse_places',
		        'alias' => 'WarehousePlaceFrom',
		        'type' => 'LEFT',
		        'conditions' => array(
		            //'WarehouseP.id = Permission.warehouse_place_id',
		            'Gear.transmission_from = WarehousePlaceFrom.id',
		        )
		    ),
	    	array('table' => 'permissions',
		        'alias' => 'PermissionFrom',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'PermissionFrom.operater_id = '.$logOperater,
		            'PermissionFrom.warehouse_place_id = WarehousePlaceFrom.id',
		        )
		    ),
	    	array('table' => 'warehouse_places',
		        'alias' => 'WarehousePlaceTo',
		        'type' => 'LEFT',
		        'conditions' => array(
		            //'WarehouseP.id = Permission.warehouse_place_id',
		            'Gear.transmission_to = WarehousePlaceTo.id',
		        )
		    ),
	    	array('table' => 'permissions',
		        'alias' => 'PermissionTo',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'PermissionTo.operater_id = '.$logOperater,
		            'PermissionTo.warehouse_place_id = WarehousePlaceTo.id',
		        )
		    ),
		    array('table' => 'gears_items',
		        'alias' => 'GearsItem',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.id = GearsItem.gear_id',
		        )
		    )
		 ));

	    $gears=$this->Gear->find('all',array(
	    	'joins'=>$joins,
	    	'recursive'=> -1,
	    	'fields'=>array('Gear.*','Operater.*','OperaterSend.*','OperaterReceive.*','WarehousePlaceFrom.*','WarehousePlaceTo.*', 'PermissionFrom.*', 'PermissionTo.*','GearsItem.*')
	   	));

		$this->set('gears',$gears);
		$this->set('log',$logOperater);
		$this->set('statuses',array('opened'=>'Opened','sent'=>'Sent','ready'=>'Ready','delivered'=>'Delivered','canceled'=>'Canceled'));
		$this->set('types',array('standard'=>'Standard','trebovanje'=>'Trebovanje'));
	}

	public function save($id=null){

		if($id==null){
			$this->Gear->create();
		}else{
			$this->Gear->id=$id;

			if(!$this->Gear->exists($id)){
				$this->Flash->error('Gear not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){

			if(empty($this->data['Gear']['created_by'])){
				$this->request->data['Gear']['created_by']=$this->Auth->user('id');
				$this->request->data['Gear']['operater_id']=$this->Auth->user('id');
			}
			//var_dump($this->request->data);
			//exit();
			if($this->Gear->save($this->request->data)){
				$this->Flash->success('Gear has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Gear could not be saved.');
				//var_dump($this->Gear->validationErrors);
				//exit();
			}
		}else{
			if($id != 0){
				$this->request->data=$this->Gear->findById($id);
			}
		}

		$this->set('statuses',array('opened'=>'Opened','sent'=>'Sent','ready'=>'Ready','delivered'=>'Delivered','canceled'=>'Canceled'));
		$this->set('types',array('standard'=>'Standard','trebovanje'=>'Trebovanje'));

		$logOperater=$this->Auth->user('id');
		if(!empty($logOperater)){
    
			$placesId=$this->Gear->Operater->Permission->find('list',array(
				//'joins'=>$joins,
				'conditions'=>array('Permission.operater_id'=>$logOperater,'Permission.permission'=>1),
				'fields'=>array('Permission.warehouse_place_id')
			));

			$places=$this->Gear->Operater->Permission->WarehousePlace->find('list',array(
				//'joins'=>$joins,
				'conditions'=>array('WarehousePlace.id'=>$placesId),
				'fields'=>array('WarehousePlace.name')
			));


			//var_dump($places);
			//exit();
	
			$this->set('places',$places);
		}else{
			$this->redirect(array('controller'=>'users','action'=>'login'));
		};

		
	}

	public function send($id){

		if(!$this->Gear->exists($id)){
			$this->Flash->error('Gear not found.');
			return $this->redirect(array('action'=>'index'));
		}

		$this->Gear->id=$id;

			/*$logOperater=$this->Auth->user('id');

	        $joins=array(	        
		    array('table' => 'operaters',
		        'alias' => 'Operater',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Operater.id = Gear.operater_id',
		        )
		    ),
		    array('table' => 'operaters',
		        'alias' => 'OperaterSend',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.operator_goods_send = OperaterSend.id',
		        )
		    ),
		    array('table' => 'operaters',
		        'alias' => 'OperaterReceive',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.operator_goods_receive = OperaterReceive.id',
		        )
		    ),
	    	array('table' => 'warehouse_places',
		        'alias' => 'WarehousePlaceFrom',
		        'type' => 'LEFT',
		        'conditions' => array(
		            //'WarehouseP.id = Permission.warehouse_place_id',
		            'Gear.transmission_from = WarehousePlaceFrom.id',
		        )
		    ),
	    	array('table' => 'permissions',
		        'alias' => 'PermissionFrom',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'PermissionFrom.operater_id = '.$logOperater,
		            'PermissionFrom.warehouse_place_id = WarehousePlaceFrom.id',
		        )
		    ),
	    	array('table' => 'warehouse_places',
		        'alias' => 'WarehousePlaceTo',
		        'type' => 'LEFT',
		        'conditions' => array(
		            //'WarehouseP.id = Permission.warehouse_place_id',
		            'Gear.transmission_to = WarehousePlaceTo.id',
		        )
		    ),
	    	array('table' => 'permissions',
		        'alias' => 'PermissionTo',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'PermissionTo.operater_id = '.$logOperater,
		            'PermissionTo.warehouse_place_id = WarehousePlaceTo.id',
		        )
		    ),
		    array('table' => 'gears_items',
		        'alias' => 'GearsItem',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.id = GearsItem.gear_id',
		        )
		    )
		 );

	    $gears=$this->Gear->find('all',array(
	    	'joins'=>$joins,
	    	'recursive'=> -1,
	    	'conditions'=>array('Gear.id='.$id),
	    	'fields'=>array('Gear.*','Operater.*','OperaterSend.*','OperaterReceive.*','WarehousePlaceFrom.*','WarehousePlaceTo.*', 'PermissionFrom.*', 'PermissionTo.*','GearsItem.*')
	   	));

	   	//var_dump($gears);
	   	//exit();

	   	if($gears['PermissionFrom']['permission']==null){
	   		$this->Flash->error('You are not allowed.');
			return $this->redirect(array('action'=>'index'));
	   	}*/
	
		$status=$this->Gear->field('status');

		if($status=='sent'){
			$this->Flash->error('Gear has already been sent.');
			return $this->redirect(array('action'=>'index'));
		}

		$this->Gear->id=$id;

		$this->Gear->query('UPDATE gears SET operator_goods_send='.$this->Auth->user('id').', status="sent" WHERE id='.$id);

		return $this->redirect(array('action'=>'index'));
	}

	public function receive($id){

		if(!$this->Gear->exists($id)){
			$this->Flash->error('Gear not found.');
			return $this->redirect(array('action'=>'index'));
		}

		$this->Gear->id=$id;
		$status=$this->Gear->field('status');

		if($status=='delivered'){
			$this->Flash->error('Gear has already been delivered.');
			return $this->redirect(array('action'=>'index'));
		}

		$this->Gear->query('UPDATE gears SET operator_goods_receive='.$this->Auth->user('id').', status="delivered" WHERE id='.$id);

		return $this->redirect(array('action'=>'index'));
	}

	public function cancel($id){

		if(!$this->Gear->exists($id)){
			$this->Flash->error('Gear not found.');
			return $this->redirect(array('action'=>'index'));
		}

		$status=$this->Gear->field('status');

		if($status=='canceled'){
			$this->Flash->error('Gear has already been delivered.');
			return $this->redirect(array('action'=>'index'));
		}

		$this->Gear->id=$id;

		$this->Gear->query('UPDATE gears SET status="canceled" WHERE id='.$id);

		return $this->redirect(array('action'=>'index'));
	}


	public function delete($id=null){

		$this->Gear->id=$id;
		if(!$this->Gear->exists($id)){
			throw new NotFoundException('Gear not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->Gear->delete()){
			$this->Flash->success(__('Gear has been deleted.'));
		}else{
			$this->Flash->error(__('Gear could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));
	}

	public function details($id){

		if (!$this->Gear->exists($id)) {
			throw new NotFoundException(__('Invalid gear.'));
		}
		$options = array('conditions' => array('Gear.' . $this->Gear->primaryKey => $id));
		//$this->set('gear', $this->Gear->find('first', $options));

		$this->Paginator->settings = array(
	        $joins=array(	        
		    array('table' => 'operaters',
		        'alias' => 'Operater',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Operater.id = Gear.operater_id',
		        )
		    ),
		    array('table' => 'operaters',
		        'alias' => 'OperaterSend',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.operator_goods_send = OperaterSend.id',
		        )
		    ),
		    array('table' => 'operaters',
		        'alias' => 'OperaterReceive',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.operator_goods_receive = OperaterReceive.id',
		        )
		    ),
	    	array('table' => 'warehouse_places',
		        'alias' => 'WarehousePlaceFrom',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.transmission_from = WarehousePlaceFrom.id',
		        )
		    ),
	    	array('table' => 'warehouse_places',
		        'alias' => 'WarehousePlaceTo',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'Gear.transmission_to = WarehousePlaceTo.id',
		        )
		    )
		 ));

	    $gears=$this->Gear->find('all',array(
	    	'joins'=>$joins,
	    	'recursive'=> -1,
	    	'conditions'=>array('Gear.id='.$id),
	    	'fields'=>array('Gear.*','Operater.*','OperaterSend.*','OperaterReceive.*','WarehousePlaceFrom.*','WarehousePlaceTo.*')
	   	));

	   	//var_dump($gears);
	   	//exit();

	    //$this->set('gears', $this->Gear->find('first', $options));
	   
	   	$this->set('gears', $gears);
	   	$this->set('statuses',array('opened'=>'Opened','sent'=>'Sent','ready'=>'Ready','delivered'=>'Delivered','canceled'=>'Canceled'));
		$this->set('types',array('standard'=>'Standard','trebovanje'=>'Trebovanje'));

		$items=$this->Gear->GearsItem->find('all',array(
			'joins'=>array(
				 array('table' => 'items',
		        'alias' => 'It',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'It.id = GearsItem.item_id',
		        	)
		   		),
			),
			'conditions'=>array('GearsItem.gear_id='.$id),
			'fields'=>array('It.*','GearsItem.*','Gear.*')
		));	

		//var_dump($items);
		//exit();
		$this->set('items',$items);
	}

}






?>