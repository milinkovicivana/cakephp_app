<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Measurement units</h3>
<?php echo $this->Html->link('Add unit',array('action'=>'save'),array('class'=>'button')); ?>
<div class="col_12">
<table class="sortable">
	<tr>
		<th>Name</th>
		<th>Symbol</th>
		<th>Active</th>
		<th>Actions</th>
	</tr>
	<?php foreach($units as $unit): ?>
	<tr>
		<td><?php echo $unit['MeasurementUnit']['name']; ?></td>
		<td><?php echo $unit['MeasurementUnit']['symbol']; ?></td>
		<td><?php echo $unit['MeasurementUnit']['active'] ? 'Yes':'No'; ?></td>
		<td>
			<?php echo $this->Html->link('Edit',array('action'=>'save',$unit['MeasurementUnit']['id']),array('class'=>'button')); ?>
			<?php echo $this->Form->postLink('Delete',array('action'=>'delete',$unit['MeasurementUnit']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?>
		</td>
	</tr>
<?php endforeach;
unset($unit);
?>
</table>	
</div>