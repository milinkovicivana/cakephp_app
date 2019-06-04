<div class="col_5">
	<?php
	    echo $this->Form->create('Operater',array('class'=>'vertical'));
	    echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>