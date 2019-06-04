<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Inventory</h3>
<?php echo $this->Html->link('Add new',array('action'=>'save'),array('class'=>'button'))?>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Status</th>
			<th>Recommended rating</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach($inventory as $inv): 
		if(empty($inv['Item']['deleted'])){?>
		<tr>
			<td><?php echo $inv['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($inv['Item']['name'], array('controller'=>'items','action'=>'details',$inv['Item']['id'])); ?></td>
			<td><?php echo $statuses[$inv['Inventory']['status']]; ?></td>
			<td><?php echo $ratings[$inv['Inventory']['recommended_ratings']]; ?></td>
			<?php echo $this->element('ActionButtons', array('id'=>$inv['Inventory']['id'],'deleted'=>$inv['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($inv); ?>
	</table>
</div>
