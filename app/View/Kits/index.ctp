<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Kits</h3>
<?php echo $this->Html->link('Add new',array('action'=>'save'),array('class'=>'button')); ?>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Name</th>
			<th>PID</th>
			<th>HS number</th>
			<th>Tax group</th>
			<th>ECCN</th>
			<th>Release date</th>
			<th>For distributors</th>
			<th>Status</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach ($kits as $kit): 
		if(empty($kit['Item']['deleted'])){ ?>
		<tr>
			<td><?php echo $kit['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($kit['Item']['name'],array('controller'=>'items','action'=>'details',$kit['Item']['id'])); ?></td>
			<td><?php if(empty($kit['Kit']['PID'])){echo '/';}else{ echo $kit['Kit']['PID'];} ?></td>
			<td><?php if(empty($kit['Kit']['hs_number'])){echo '/';}else{ echo $kit['Kit']['hs_number'];} ?></td>
			<td><?php if(empty($kit['Kit']['tax_group'])){echo '/';}else{ echo $kit['Kit']['tax_group'];} ?></td>
			<td><?php if(empty($kit['Kit']['eccn'])){echo '/';}else{ echo $kit['Kit']['eccn'];} ?></td>
			<td><?php if(empty($kit['Kit']['kit_release_date'])){echo '/';}else{ echo $kit['Kit']['kit_release_date'];} ?></td>
			<td><?php if($kit['Kit']['for_distributors']==1){echo 'Da';}else{echo 'Ne';}; ?></td>
			<td><?php echo $statuses[$kit['Kit']['kit_status']]; ?></td>
			<?php echo $this->element('ActionButtons',array('id'=>$kit['Kit']['id'],'deleted'=>$kit['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($kit); ?>
	</table>	
</div>