<div class="col_5">
	<?php 
		echo $this->Html->script('jquery-3.3.1.min', array('inline' => false)); 
		echo $this->Html->script('markRequired',array('inline'=>false)); 
		echo $this->Form->create('Product',array('class'=>'vertical'));
		echo $this->element('itemForm');
		echo $this->Form->input('Product.PID', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Product.HS_number', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Product.tax_group', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Product.eccn', array('required' => false,'div'=>'req'));
		//echo $this->Form->input('Product.release_date',array('type'=>'date','required' => false));
		echo $this->Form->input('Product.for_distributors',array('options'=>$dist,'required' => false));
		echo $this->Form->input('Product.product_status',array('options'=>$statuses,'class'=>'statuses'));
		echo $this->Form->input('Product.service_production',array('options'=>$service));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>