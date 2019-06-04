<?php

App::uses('AppController', 'Controller');

class MaterialsController extends AppController{

	public function index(){

		$this->set('materials',$this->paginate());
        $this->set('statuses',array('development'=>'Development','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete'));
        $this->set('rating',array('silver'=>'Silver','platinum'=>'Platinum','gold'=>'Gold'));
	}

	public function save($id=null){

		if($id==null){
			$this->Material->create();
		}else{
			$this->Material->id=$id;
			$this->request->data['Item']['id']=$this->Material->findById($id)['Item']['id'];
            $this->request->data['Material']['id']=$id;
    
            if(!$this->Material->exists($id)){
                $this->Flash->error('Item could not be found!');
                return $this->redirect(['action' => 'index']);
            }    
		}

		if($this->request->is(array('post','put'))){
			if($this->Material->saveAll($this->request->data)){
				$this->Flash->success(__('Material has been saved.'));
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Flash->error(__('Material could not be saved.'));
			}
		}else{
            if($id != null){
               $this->request->data=$this->Material->findById($id);
            }
        }

        
        $this->set('ratings',array('platinum'=>'Platinum','gold'=>'Gold','silver'=>'Silver'));
        $this->set('statuses',array('development'=>'Development','in use'=>'In use','phase out'=>'Phase out','obsolete'=>'Obsolete'));
		$measurementUnits = $this->Material->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes = $this->Material->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));

	}

	 public function delete($id=null){

        $this->Material->id=$id;
        if (!$this->request->is('post') || !$this->Material->exists()) {
            $this->Flash->error('Item not found!');
            return $this->redirect(['action' => 'index']);
        }

        $itemId = $this->Material->field('item_id', ['id'=>$id]);

        if($this->Material->Item->softDelete($itemId)){
            $this->Flash->success('Item has been deleted!');
        }else{
            $this->Flash->error('Item could not be deleted!');
        }

        return $this->redirect(['action' => 'index']);

    }


}


?>