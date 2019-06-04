<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Item types</h3>
<?php echo $this->Html->link('Add type',array('action'=>'save'),array('class'=>'button'));?>
<div class="col_12">
<table class="sortable">
	<tr>
		<th>Code</th>
		<th>Name</th>
		<th>Class</th>
		<th>Tangible</th>
		<th>Active</th>
		<th>Actions</th>
	</tr>
	<?php foreach($types as $type): ?>
	<tr>
		<td><?php echo $type['ItemType']['code']; ?></td>
		<td><?php echo $type['ItemType']['name']; ?></td>
		<td><?php echo $classes[$type['ItemType']['class']]; ?></td>
		<td><?php echo $type['ItemType']['tangible'] ? 'Yes' : 'No'; ?></td>
		<td><?php echo $type['ItemType']['active'] ? 'Yes' : 'No'; ?></td>
		<td>
			<?php echo $this->Html->link('Edit',array('action'=>'save',$type['ItemType']['id']),array('class'=>'button')); ?>
			<?php echo $this->Form->postLink('Delete',array('action'=>'delete',$type['ItemType']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?>
		</td>
	</tr>
<?php endforeach; 
unset($type); ?>
</table>
</div>