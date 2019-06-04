<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Gears items</h3>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Item</th>
			<th>Measurement unit</th>
			<th>Gear</th>
			<th>Wanted amount</th>
			<th>Send amount</th>
			<th>Send address</th>
			<th>Receive address</th>
			<th>Delete</th>
		</tr>
		<?php foreach ($gitems as $gitem => $value): ?>
		<tr>
			<td><?php echo $value['Item']['name']; ?></td>
			<td><?php echo $value['MeasUnit']['name']; ?></td>
			<td><?php echo $value['Gear']['code']; ?></td>
			<td><?php echo $value['GearsItem']['wanted_amount']; ?></td>
			<td><?php echo $value['GearsItem']['send_amount']; ?></td>
			<td><?php echo $value['WarehouseAddressFrom']['code']; ?></td>
			<td><?php echo $value['WarehouseAddressTo']['code']; ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$value['GearsItem']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>
		</tr>
	<?php endforeach; 
	unset($gitem); ?>
	</table>	
</div>