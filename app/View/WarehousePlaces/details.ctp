<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Warehouse Places</h3>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Item type</th>
			<th>Description</th>
			<th>Default</th>
			<th>Active</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<tr>
			<td><?php echo $place['WarehousePlace']['code'];?></td>
			<td><?php echo $place['WarehousePlace']['name']; ?></td>
			<td>
				<?php foreach($place['WarehouseItemType'] as $item_type): ?>	
				<?php echo $item_type['item_type']; ?><br>				
				<?php endforeach; ?>
			</td>
			<td><?php echo $place['WarehousePlace']['description']; ?></td>
			<td><?php echo $place['WarehousePlace']['default'] ? 'Da' : 'Ne';?></td>
			<td><?php echo $place['WarehousePlace']['active'] ? 'Da' : 'Ne'; ?></td>
			<td><?php echo $this->Html->link('Edit',array('action'=>'save',$place['WarehousePlace']['id']),array('class'=>'button')); ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$place['WarehousePlace']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>
		</td>
		</tr>
	</table>
	<?php 
		//echo $this->Html->link('Add',array('controller'=>'itemswarehouseplaces','action'=>'save',$place['WarehousePlace']['id']),array('class'=>'button'));
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