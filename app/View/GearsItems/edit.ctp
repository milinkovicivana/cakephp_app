<div class="col_5">
	<?php 
		echo $this->Form->create('GearsItem',array('class'=>'vertical'));
		echo $this->Form->input('item_id',array('empty'=>'Choose','options'=>$items));
		echo $this->Form->input('wanted_amount');
		echo $this->Form->input('send_amount');
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>