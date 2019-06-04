<div class="col_5">
	<?php 
		echo $this->Html->script('jquery-3.3.1.min', array('inline' => false)); 
		echo $this->Html->script('markRequired',array('inline'=>false)); 
		echo $this->Form->create('Gear',array('class'=>'vertical'));
		echo $this->Form->input('date');
		//echo $this->Form->input('created_by',array('value'=>$operater));
		echo $this->Form->input('transmission_from',array('options'=>$places));
		echo $this->Form->input('transmission_to',array('options'=>$places));
		//echo $this->Form->input('operater_goods_send', array('required' => false,'div'=>'req'));
		//echo $this->Form->input('status',array('options'=>$statuses,'class'=>'statuses'));
		echo $this->Form->input('transmission_type',array('options'=>$types,'class'=>'types'));
		//echo $this->Form->input('operater_goods_receive',array('required' => false,'div'=>'req1'));
		echo $this->Form->input('work_order',array('required' => false,'div'=>'order'));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>