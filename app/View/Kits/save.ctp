<div class="col_5">
	<?php 
		echo $this->Html->script('jquery-3.3.1.min', array('inline' => false)); 
		echo $this->Html->script('markRequired',array('inline'=>false)); 
		echo $this->Form->create('Kit',array('class'=>'vertical'));
		echo $this->element('itemForm');
		//echo $this->Form->input('Kit.PID', array('required' => false,'class'=>'required','label'=>array('class'=>'bold')));
		echo $this->Form->input('Kit.PID', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Kit.hs_number', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Kit.tax_group', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Kit.eccn', array('required' => false,'div'=>'req'));
		echo $this->Form->input('Kit.for_distributors',array('options'=>$dist,'required' => false));
		echo $this->Form->input('Kit.kit_status',array('options'=>$statuses,'class'=>'statuses'));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>