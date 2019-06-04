<div class="col_5">
	<?php 
		echo $this->Form->create('GearsItem',array('class'=>'vertical'));
		echo $this->Form->input('item_id',array('empty'=>'Choose','options'=>$items));
		//echo $this->Form->input('send_address');
		//echo $this->Form->input('receive_address');
		//if($status==''){
		echo $this->Form->input('wanted_amount');
		//}
		//if($status!=''){
			//echo $this->Form->input('wanted_amount',array('value'=>$wantedamount));
		//}
		//if($status=='opened'){
		//echo $this->Form->input('send_amount');
		//}
		echo $this->Form->end('Save',array('class'=>'button'));
	?>
</div>