<div class="col_5">
	<?php 
		echo $this->Form->create('SemiProduct',array('class'=>'vertical'));
		echo $this->element('itemForm');
		echo $this->Form->input('SemiProduct.semi_product_status',array('options'=>$statuses));
		//echo $this->Form->label('SemiProduct.service_production');
		//echo $this->Form->checkbox('SemiProduct.service_production',array('hiddenField'=>false));
		echo $this->Form->input('SemiProduct.service_production',array('options'=>$service));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>