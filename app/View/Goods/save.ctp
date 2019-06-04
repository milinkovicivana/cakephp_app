<div class="col_5">
	<?php 
		echo $this->Html->script('jquery-3.3.1.min', array('inline' => false)); 
		echo $this->Html->script('markRequired',array('inline'=>false)); 
		echo $this->Form->create('Good',array('class'=>'vertical'));
		echo $this->element('itemForm');
		echo $this->Form->input('Good.PID', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Good.hs_number', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Good.tax_group', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Good.eccn', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Good.for_distributors',array('options'=>$dist,'required' => false));
		echo $this->Form->input('Good.status',array('options'=>$statuses,'class'=>'statuses'));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>