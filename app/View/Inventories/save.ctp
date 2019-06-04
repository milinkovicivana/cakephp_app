<div class="col_5">
	<?php
	    echo $this->Form->create('Inventory',array('class'=>'vertical'));
	  	echo $this->element('itemForm');
	    echo $this->Form->input('Inventory.status',array('options'=>$statuses));
		echo $this->Form->input('Inventory.recommended_ratings',array('options'=>$ratings));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>