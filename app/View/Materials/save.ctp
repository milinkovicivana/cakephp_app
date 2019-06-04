<div class="col_5">
	<?php
	    echo $this->Form->create('Material',array('class'=>'vertical'));
	  	echo $this->element('itemForm');
	    echo $this->Form->input('Material.material_status',array('options'=>$statuses));
		echo $this->Form->input('Material.recommended_rating',array('options'=>$ratings));
		echo $this->Form->label('Material.service_production');
		echo $this->Form->checkbox('Material.service_production', array('hiddenField'=>false));
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>