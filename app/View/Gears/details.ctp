<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Gears</h3>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Date</th>
			<th>Created_by</th>
			<th>Transmission from</th>
			<th>Transmission to</th>
			<th>Operater who sent</th>
			<th>Status</th>
			<th>Type</th>
			<th>Operater who received</th>
			<th>Work order</th>
		</tr>
			<?php foreach ($gears as $gear => $value): ?>
		<tr>
			<td><?php echo $value['Gear']['code'];?></td>
			<td><?php echo $value['Gear']['date']; ?></td>
			<td><?php echo $value['Operater']['username']; ?></td>
			<td><?php echo $value['WarehousePlaceFrom']['name']; ?></td>
			<td><?php echo $value['WarehousePlaceTo']['name']; ?></td>
			<td><?php echo $value['OperaterSend']['username']; ?></td>
			<td><?php echo $statuses[$value['Gear']['status']]; ?></td>
			<td><?php echo $types[$value['Gear']['transmission_type']]; ?></td>
			<td><?php echo $value['OperaterReceive']['username']; ?></td>
			<td><?php echo $value['Gear']['work_order']; ?></td>
		</tr>
		<?php endforeach; 
		unset($gear); 
		?>
	</table>
	<?php 
		echo $this->Html->link('Add item',array('controller'=>'gearsitems','action'=>'save',$value['Gear']['id']),array('class'=>'button'));
	?>
	<table class="sortable">
		<tr>
			<th>Name</th>
			<th>Code</th>
			<th>Description</th>
		</tr>
		<?php foreach ($items as $item => $value): ?>
			<!-- <?php var_dump($value); ?> -->
		<tr>
			<td><?php echo $this->Html->link($value['It']['code'],['controller'=>'gearsitems','action'=>'edit',$value['GearsItem']['id'],$value['Gear']['id']]); ?></td>
			<td><?php echo $value['It']['name']; ?></td>
			<td><?php echo $value['It']['description']; ?></td>
		</tr>
		<?php endforeach; 
		unset($item); ?>
	</table>

</div>