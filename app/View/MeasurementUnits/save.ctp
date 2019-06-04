<?php

echo $this->Form->create('MeasurementUnit');
echo $this->Form->input('name');
echo $this->Form->input('symbol');
echo $this->Form->input('active',array('options'=>$active));
echo $this->Form->end('Save');

?>