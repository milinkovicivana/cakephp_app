<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Warehouse Addresses</h3>
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
		<tr>
			<td><?php echo $address['WarehouseAddress']['code'];?></td>
			<td><?php echo $address['WarehouseAddress']['row']; ?></td>
			<td><?php echo $address['WarehouseAddress']['shelf']; ?></td>
			<td><?php echo $address['WarehouseAddress']['divider']; ?></td>
			<td><?php echo $address['WarehousePlace']['name']; ?></td>
			<td><?php echo $address['WarehouseAddress']['active'] ? 'Da' : 'Ne'; ?></td>
			<td><?php echo $this->Html->link('Edit',array('action'=>'save',$address['WarehouseAddress']['id']),array('class'=>'button')); ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$address['WarehouseAddress']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>
		</td>
		</tr>
	</table>
	<?php 
		echo $this->Html->link('Add item',array('controller'=>'itemswarehouseaddresses','action'=>'save',$address['WarehouseAddress']['id']),array('class'=>'button'));
	?>
	<h6>Items</h6>
	<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Description</th>
			<th>Weight</th>
			<th>Measurement unit</th>
			<th>Item type</th>
			<!-- <th>Delete</th> -->
		</tr>
		<?php foreach($items as $item): 
		if(empty($item['Item']['deleted'])){ ?>
		<tr>
			<td><?php echo $item['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($item['Item']['name'], ['controller' => 'items', 'action' => 'details', $item['Item']['id']]) ?></td>
			<td><?php echo $item['Item']['description']; ?></td>
			<td><?php if(empty($item['Item']['weight'])){echo '/';}else{echo $item['Item']['weight'];} ?></td>
			<td><?php echo $item['MeasurementUnit']['name']; ?></td>
			<td><?php echo $item['ItemType']['name']; ?></td>
			<!-- <td><?php echo $this->Form->postLink('Delete',array('action'=>'delete', $item['Item']['id'],$address['WarehouseAddress']['id']),array('confirm'=>'Are you sure?', 'class'=>'button')); ?></td> -->
		</tr>
	<?php } endforeach; 
	unset($item); ?>
	</table>
</div>