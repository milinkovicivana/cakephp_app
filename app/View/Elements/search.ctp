<div class="search">
<?php
	echo $this->Form->create('Item',array('class'=>'searchForm','role'=>'search','autocomplete'=>'off'));
	echo $this->Form->input('keyword',array('class'=>'searchinput','maxlength'=>'64','placeholder'=>'code, name, description','div'=>false,'label'=>false)); 
	echo $this->Form->input('weight',array('class'=>'searchinput','placeholder'=>'weight','div'=>false,'label'=>false));
	echo $this->Form->input('Item.measurement_unit_id',array('class'=>'searchinput','maxlength'=>'64','placeholder'=>'unit','div'=>false,'label'=>false,'empty'=>'select unit','required'=>false));
	echo $this->Form->input('Item.item_type_id',array('class'=>'searchinput','maxlength'=>'64','placeholder'=>'type','div'=>false,'label'=>false,
		'empty'=>'select type','required'=>false));
	echo $this->Form->submit('Search');
	echo $this->Form->end(); 
?>
</div>


	
