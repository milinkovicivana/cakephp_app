<?php

App::uses('AppController','Controller');

class OperatersController extends AppController{

	public $helpers=array('Html','Form','Flash');
	public $components=array('Session');

	public function beforeFilter() {
    parent::beforeFilter();
    // Allow users to register and logout.
    $this->Auth->allow('save', 'logout');
}


	public function index(){

		$this->set('operaters',$this->paginate());
	}

	public function save($id=null){

		if($id==null){
			$this->Operater->create();
		}else{
			$this->Operater->id=$id;

			if(!$this->Operater->exists($id)){
				$this->Flash->error('Operater not found.');
				return $this->redirect(array('action'=>'index'));
			}
		}

		if($this->request->is(array('post','put'))){
			if($this->Operater->save($this->request->data)){
				$this->Flash->success('Operater has been saved.');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error('Operater could not be saved.');
			}
		}else{
			if($id != 0){
				$this->request->data=$this->Operater->findById($id);
				unset($this->request->data['Operater']['password']);
			}
		}

	}

	public function login(){
		if($this->request->is('post')){
			//var_dump($this->request->data);
			//exit();
			if($this->Auth->login()){
				return $this->redirect($this->Auth->redirectUrl());
			}

			$this->Flash->error(__('Invalid username or password. Try again.'));
		}
	}

	public function logout(){
		return $this->redirect($this->Auth->logout());
	}

	public function delete($id=null){

		$this->Operater->id=$id;
		if(!$this->Operater->exists($id)){
			throw new NotFoundException('Operater not found.');		
		}

		$this->request->allowMethod('post','delete');
		if($this->Operater->delete()){
			$this->Flash->success(__('Operater has been deleted.'));
		}else{
			$this->Flash->error(__('Operater could not be deleted.'));
		}

		return $this->redirect(array('action'=>'index'));


	}
}






?>