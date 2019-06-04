<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Items Warehouse Addresses</h3>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Item</th>
			<th>Address</th>
			<th>Delete</th>
		</tr>
		<?php foreach($iwaddresses as $address): ?>
		<tr>
			<td><?php echo $address['Item']['name'];?></td>
			<td><?php echo $address['WarehouseAddress']['code'];?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$address['WarehouseAddress']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>
		</td>
		</tr>
		<?php endforeach; 
		unset($address); ?>
	</table>
</div>