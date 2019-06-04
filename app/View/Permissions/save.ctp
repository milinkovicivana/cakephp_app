<div class="col_5">
	<?php 
		echo $this->Form->create('Permission',array('class'=>'vertical'));
		echo $this->Form->input('operater_id',array('options'=>$operaters,'empty'=>'Choose'));
		echo $this->Form->input('warehouse_place_id',array('options'=>$places,'empty'=>'Choose'));
		echo $this->Form->input('permission',array('options'=>$permission,'empty'=>'Choose'));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>