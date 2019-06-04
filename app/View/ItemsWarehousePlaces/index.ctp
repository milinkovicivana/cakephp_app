<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Items Warehouse Places</h3>
<?php echo $this->Html->link('Add',array('action'=>'save'),array('class'=>'button')); ?>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Item code</th>
			<th>Item name</th>
			<th>Place</th>
			<th>Total amount</th>
			<th>Free amount</th>
			<th>Reserved amount</th>
			<th>Consumption</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach($iwplaces as $place): ?>
		<tr>
			<td><?php echo $place['Item']['code'];?></td>
			<td><?php echo $place['Item']['name'];?></td>
			<td><?php echo $place['WarehousePlace']['name'];?></td>
			<td><?php echo $place['ItemsWarehousePlace']['total_amount'];?></td>
			<td><?php echo $place['ItemsWarehousePlace']['free_amount'];?></td>
			<td><?php echo $place['ItemsWarehousePlace']['reserved_amount'];?></td>
			<td><?php echo $place['ItemsWarehousePlace']['consumption'];?></td>
			<td><?php echo $this->Html->link('Edit',array('action'=>'save',$place['ItemsWarehousePlace']['id']),['class' => 'button']); ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$place['ItemsWarehousePlace']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>
		</td>
		</tr>
		<?php endforeach; 
		unset($place); ?>
	</table>
</div>