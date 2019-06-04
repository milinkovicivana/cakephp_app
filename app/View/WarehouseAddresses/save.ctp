<div class="col_5">
	<?php 
		echo $this->Form->create('WarehouseAddress',array('class'=>'vertical'));
		//echo $this->Form->input('code');
		echo $this->Form->input('row');
		echo $this->Form->input('shelf');
		echo $this->Form->input('divider');
		echo $this->Form->input('wplaces',array('label'=>'Warehouse place'));
		echo $this->Form->input('barcode');
		echo $this->Form->input('active',array('options'=>$active));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>