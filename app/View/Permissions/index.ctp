<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Permissions</h3>
<?php echo $this->Html->link('Add',array('action'=>'save'),array('class'=>'button')); ?>
<div class="col_12">
<table class="sortable">
	<tr>
		<th>Operater</th>
		<th>Warehouse place</th>
		<th>Permission</th>
		<th>Actions</th>
	</tr>
	<?php foreach($permissions as $per): ?>
	<tr>
		<td><?php echo $per['Operater']['username']; ?></td>
		<td><?php echo $per['WarehousePlace']['name']; ?></td>
		<td><?php echo $per['Permission']['permission'] ? 'Yes':'No'; ?></td>
		<td>
			<?php echo $this->Html->link('Edit',array('action'=>'save',$per['Permission']['id']),array('class'=>'button')); ?>
			<?php echo $this->Form->postLink('Delete',array('action'=>'delete',$per['Permission']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?>
		</td>
	</tr>
<?php endforeach;
unset($per);
?>
</table>	
</div>