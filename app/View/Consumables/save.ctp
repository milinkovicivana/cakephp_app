<div class="col_5">
	<?php
	    echo $this->Form->create('Consumable',array('class'=>'vertical'));
	  	echo $this->element('itemForm');
	    echo $this->Form->input('Consumable.consumable_status',array('options'=>$statuses));
		echo $this->Form->input('Consumable.recommended_rating',array('options'=>$ratings));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>