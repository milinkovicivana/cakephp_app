<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Operaters</h3>
<?php echo $this->Html->link('Add new',array('action'=>'save'),array('class'=>'button'))?>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Username</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach($operaters as $operater): ?>
		<tr>
			<td><?php echo $operater['Operater']['username']; ?></td>
			<td><?php echo $this->Html->link('Edit',array('action'=>'save',$operater['Operater']['id']),['class' => 'button']); ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$operater['Operater']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>			
		</tr>
	<?php endforeach; 
	unset($operater); ?>
	</table>
</div>
