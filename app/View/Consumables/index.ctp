<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Consumables</h3>
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
		<?php foreach($consumables as $con): 
		if(empty($con['Item']['deleted'])){?>
		<tr>
			<td><?php echo $con['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($con['Item']['name'], array('controller'=>'items','action'=>'details',$con['Item']['id'])); ?></td>
			<td><?php echo $statuses[$con['Consumable']['consumable_status']]; ?></td>
			<td><?php echo $ratings[$con['Consumable']['recommended_rating']]; ?></td>
			<?php echo $this->element('ActionButtons', array('id'=>$con['Consumable']['id'],'deleted'=>$con['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($con); ?>
	</table>
</div>
