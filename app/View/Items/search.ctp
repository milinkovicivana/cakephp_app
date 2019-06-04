<?php
	echo $this->Form->create('Item',array('class'=>'searchForm','role'=>'search','autocomplete'=>'off'));
	echo $this->Form->input('keyword',array('class'=>'form control input-sm','maxlength'=>'64','placeholder'=>'Search','div'=>false,'label'=>false));
	echo $this->Form->submit('Search');
	echo $this->Form->end(); ?>

<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Description</th>
			<th>Weight</th>
			<th>Measurement unit</th>
			<th>Item type</th>
			<th>Deleted</th>
			<th>Edit</th>
		</tr>
		<?php foreach($data as $d): 
		if(empty($d['Item']['deleted'])){ ?>
		<tr>
			<td><?php echo $d['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($d['Item']['name'], ['controller' => 'items', 'action' => 'details', $d['Item']['id']]) ?></td>
			<td><?php echo $d['Item']['description']; ?></td>
			<td><?php if(empty($d['Item']['weight'])){echo '/';}else{echo $d['Item']['weight'];} ?></td>
			<td><?php echo $d['MeasurementUnit']['name']; ?></td>
			<td><?php echo $d['ItemType']['name']; ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$d['Item']['id']),array('confirm'=>'Are you sure?', 'class'=>'button')); ?></td>
			<td><?php echo $this->Html->link('Edit',array('action'=>'edit',$d['Item']['id']),['class' => 'button']); ?></td>
		</tr>
	<?php } endforeach; 
	unset($d); ?>
	</table>
</div>