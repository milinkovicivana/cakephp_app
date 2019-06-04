<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Warehouse Addresses</h3>
<?php echo $this->Html->link('Add new',array('action'=>'save'),array('class'=>'button'))?>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Row</th>
			<th>Shelf</th>
			<th>Divider</th>
			<th>Warehouse place</th>
			<th>Active</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach($waddresses as $address): ?>	
		<tr>
			<td><?php echo $this->Html->link($address['WarehouseAddress']['code'], ['controller'=>'warehouseaddresses', 'action'=>'details', $address['WarehouseAddress']['id']]); ?></td>
			<td><?php echo $address['WarehouseAddress']['row']; ?></td>
			<td><?php echo $address['WarehouseAddress']['shelf']; ?></td>
			<td><?php echo $address['WarehouseAddress']['divider']; ?></td>
			<td><?php echo $address['WarehousePlace']['name']; ?></td>
			<td><?php echo $address['WarehouseAddress']['active'] ? 'Da' : 'Ne'; ?></td>
			<td><?php echo $this->Html->link('Edit',array('action'=>'save',$address['WarehouseAddress']['id']),array('class'=>'button')); ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$address['WarehouseAddress']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>
		</td>
		</tr>
	<?php endforeach; 
	unset($address); ?>
	</table>
</div>