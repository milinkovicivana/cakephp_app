<?php

App::uses('AppController','Controller');

class PermissionsController extends AppController{

	public function index(){
		$this->set('permissions',$this->paginate());
	}

	public function save($id=null){

		if($id==null){
			$this->Permission->create();
		}else{
			$this->Permission->id=$id;
			$this->request->data['Permission']['id']=$id;

			if(!$this->Permission->exists($id)){
				$this->Flash->error('Permission not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){

			$find=$this->Permission->find('list',array(
				'conditions'=>array('Permission.warehouse_place_id'=>$this->request->data['Permission']['warehouse_place_id'],
				'Permission.operater_id'=>$this->request->data['Permission']['operater_id'])
			));

			if(!empty($find)){
				$this->Flash->error('User already has permission for this place.');
				return $this->redirect(array('action'=>'index'));
			}

			if($this->Permission->saveAll($this->request->data)){
				$this->Flash->success('Permission has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Permission could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->Permission->findById($id);
			}
		}

		$operaters = $this->Permission->Operater->find('list', ['fields' => ['id', 'username']]);
		$places = $this->Permission->WarehousePlace->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('operaters','places'));
         $this->set('permission',array(1=>'Yes',0=>'No'));

	}

	public function delete($id=null){

		$this->Permission->id=$id;
		if(!$this->Permission->exists($id)){
			throw new NotFoundException('Permission not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->Permission->delete()){
			$this->Flash->success(__('Permission has been deleted.'));
		}else{
			$this->Flash->error(__('Permission could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));


	}
}





?>