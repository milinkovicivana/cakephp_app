<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Warehouse Places</h3>
<?php echo $this->Html->link('Add new',array('action'=>'save'),array('class'=>'button'))?>
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
		<?php foreach($wplaces as $place): ?>	
		<tr>
			<td><?php echo $place['WarehousePlace']['code']; ?></td>
			<td><?php echo $this->Html->link($place['WarehousePlace']['name'],['action'=>'details', $place['WarehousePlace']['id']]); ?></td>
			<td>
				<?php foreach($place['WarehouseItemType'] as $item_type): ?>	
				<?php echo $item_type['item_type']; ?><br>				
				<?php endforeach; ?>
			</td>
			<td><?php echo $place['WarehousePlace']['description']; ?></td>
			<td><?php echo $place['WarehousePlace']['default'] ? 'Da' : 'Ne'; ?></td>
			<td><?php echo $place['WarehousePlace']['active'] ? 'Da' : 'Ne'; ?></td>
			<td><?php echo $this->Html->link('Edit',array('action'=>'save',$place['WarehousePlace']['id']),array('class'=>'button')); ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$place['WarehousePlace']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>
		</td>
		</tr>
	<?php endforeach; 
	unset($place); ?>
	</table>
</div>
