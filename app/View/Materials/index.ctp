<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Materials</h3>
<?php echo $this->Html->link('Add new',array('action'=>'save'),array('class'=>'button'))?>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Status</th>
			<th>Service production</th>
			<th>Recommended rating</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach($materials as $item): 
		if(empty($item['Item']['deleted'])){?>
		<tr>
			<td><?php echo $item['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($item['Item']['name'], array('controller'=>'items','action'=>'details',$item['Item']['id'])); ?></td>
			<td><?php echo $statuses[$item['Material']['material_status']]; ?></td>
			<td><?php echo $item['Material']['service_production'] ? 'Da' : 'Ne' ?></td>
			<td><?php echo $rating[$item['Material']['recommended_rating']]; ?></td>
			<?php echo $this->element('ActionButtons', array('id'=>$item['Material']['id'],'deleted'=>$item['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($item); ?>
	</table>
</div>
