<div class="col_5">
	<?php 
		echo $this->Form->create('WarehousePlace',array('class'=>'vertical'));
		echo $this->Form->input('code');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('default',array('options'=>$default));
		echo $this->Form->input('active',array('options'=>$active));
		echo $this->Form->input('WarehouseItemType.item_type',array('options'=>$types,'multiple'=>true));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>