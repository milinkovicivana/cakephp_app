<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Service suppliers</h3>
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
		<?php foreach($suppliers as $sup): 
		if(empty($sup['Item']['deleted'])){?>
		<tr>
			<td><?php echo $sup['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($sup['Item']['name'], array('controller'=>'items','action'=>'details',$sup['Item']['id'])); ?></td>
			<td><?php echo $statuses[$sup['ServiceSupplier']['service_status']]; ?></td>
			<td><?php echo $ratings[$sup['ServiceSupplier']['service_rating']]; ?></td>
			<?php echo $this->element('ActionButtons', array('id'=>$sup['ServiceSupplier']['id'],'deleted'=>$sup['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($sup); ?>
	</table>
</div>