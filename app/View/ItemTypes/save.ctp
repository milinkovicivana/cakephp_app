<div class="col_5">
<?php
echo $this->Form->create('ItemType');
echo $this->Form->input('code');
echo $this->Form->input('name');
echo $this->Form->input('class',array('options'=>$classes)); 
echo $this->Form->input('tangible',array('options'=>$tangible));
echo $this->Form->input('active',array('options'=>$active));
echo $this->Form->end('Save');
?>
</div>