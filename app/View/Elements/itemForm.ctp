<?php
echo $this->Form->input('Item.name');
echo $this->Form->input('Item.description'); 
echo $this->Form->input('Item.weight');
echo $this->Form->input('Item.measurement_unit_id');
//echo $this->Form->label('Item.deleted');
//echo $this->Form->checkbox('Item.deleted', array('hiddenField' => false));
echo $this->Form->input('Item.item_type_id');
?>