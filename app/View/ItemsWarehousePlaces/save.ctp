<div class="col_5">
	<?php 
		echo $this->Form->create('ItemsWarehousePlace',array('class'=>'vertical'));
		//echo $this->Form->input('warehouse_address_id',array('options'=>$add));
		echo $this->Form->input('item_id',array('options'=>$items));
		echo $this->Form->input('warehouse_place_id',array('options'=>$places));
		echo $this->Form->input('total_amount');
		echo $this->Form->input('free_amount');
		echo $this->Form->input('reserved_amount');
		echo $this->Form->input('consumption');
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>