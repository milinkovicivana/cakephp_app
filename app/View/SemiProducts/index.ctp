<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Semi products</h3>
<?php echo $this->Html->link('Add new',array('action'=>'save'),array('class'=>'button')); ?>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>Status</th>
			<th>Service production</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach ($semiproducts as $semi): 
		if(empty($semi['Item']['deleted'])){ ?>
		<tr>
			<td><?php echo $semi['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($semi['Item']['name'],array('controller'=>'items','action'=>'details',$semi['Item']['id'])); ?></td>
			<td><?php echo $statuses[$semi['SemiProduct']['semi_product_status']]; ?></td>
			<td><?php if($semi['SemiProduct']['service_production']==1){echo 'Da';}else{echo 'Ne';}; ?></td>
			<?php echo $this->element('ActionButtons',array('id'=>$semi['SemiProduct']['id'],'deleted'=>$semi['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($semi); ?>
	</table>	
</div>