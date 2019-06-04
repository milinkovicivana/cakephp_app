<?php

App::uses('AppController','Controller');

class ItemsController extends AppController{

	public function index(){
		$this->Item->recursive=0;
		//$this->set('items',$this->paginate());

        if(!empty($this->request->data['Item']['keyword'])){
            $cond=array();
            $cond['Item.code LIKE']='%'.trim($this->request->data['Item']['keyword']).'%';
            $cond['Item.name LIKE']='%'.trim($this->request->data['Item']['keyword']).'%';
            $cond['Item.description LIKE']='%'.trim($this->request->data['Item']['keyword']).'%';
            $conditions['OR']=$cond;
            $this->request->params['named']['Item.keyword']=$this->request->data['Item']['keyword'];
            $this->paginate=array('conditions'=>$conditions,'limit'=>'15');
        }

        if(!empty($this->request->data['Item']['weight'])){
            $weight=array();
            $weight['Item.weight LIKE']='%'.trim($this->request->data['Item']['weight']).'%';
            $conditions['OR']=$weight;
            $this->request->params['named']['Item.weight']=$this->request->data['Item']['weight'];
            $this->paginate=array('conditions'=>$conditions,'limit'=>'15');
        }

        if(!empty($this->request->data['Item']['item_type_id'])){
            $type=array();
            $type['ItemType.id']=trim($this->request->data['Item']['item_type_id']);
            $conditions['OR']=$type;
            $this->request->params['named']['item_type_id']=$this->request->data['Item']['item_type_id'];
            $this->paginate=array('conditions'=>$conditions,'limit'=>'15');

        }

        if(!empty($this->request->data['Item']['measurement_unit_id'])){
            $unit=array();
            $unit['MeasurementUnit.id']=trim($this->request->data['Item']['measurement_unit_id']);
            $conditions['OR']=$unit;
            $this->request->params['named']['measurement_unit_id']=$this->request->data['Item']['measurement_unit_id'];
            $this->paginate=array('conditions'=>$conditions,'limit'=>'15');

        }

        $result=$this->paginate('Item');
        $this->set('items',$result);
        $measurementUnits=$this->Item->MeasurementUnit->find('list', ['fields' => ['id', 'name']]);
        $itemTypes=$this->Item->ItemType->find('list', ['fields' => ['id', 'name']]);
        $this->set(compact('measurementUnits', 'itemTypes'));
	}

    public function edit($id=null){

        if($id == null && !$this->Item->exists($id)){
            $this->Flash->error('Item could not be found.');
            $this->redirect(array('action'=>'index'));
        }else{
            $item=$this->Item->find('first',array('contain'=>'ItemType','conditions'=>array('Item.id'=>$id)));
            $map=$this->Item->itemTypeModels[$item['ItemType']['class']];
            $model=$map['model'];
            $this->loadModel($model);
            $itemTypeId=$this->$model->field('id',array('item_id'=>$id));
            $path=array_merge($map,array('itemTypeId'=>$itemTypeId));
            $mapped=$path;
            return $this->redirect(['controller' => $mapped['controller'], 'action' => 'save', $mapped['itemTypeId']]);
        }

    }

	public function delete($id=null){
    
        if($id != null){

            if(!$this->request->is('post') || !$this->Item->exists($id)){
                $this->Flash->error('Item could not be found!');
                return $this->redirect(['action' => 'index']);
            }

            if($this->Item->softDelete($id)){
                $this->Flash->success('Item has been deleted!');
            }else{
                $this->Flash->error('Item could not be deleted!');
            }

        }

        return $this->redirect(['action' => 'index']);
    }

}



?>