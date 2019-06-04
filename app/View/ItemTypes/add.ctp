<h1>Add type</h1>
<?php

echo $this->Form->create('ItemType');
echo $this->Form->input('code'); 
echo $this->Form->input('name'); 
echo $this->Form->input('class',array('options'=>$classes)); 
echo $this->Form->input('tangible'); 
echo $this->Form->input('active'); 
echo $this->Form->end('Create'); 
?>