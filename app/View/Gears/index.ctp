<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Gears</h3>
<?php echo $this->Html->link('Add new',array('action'=>'save'),array('class'=>'button')); ?>
<div class="col_12">
	<table class="sortable">
		<tr>
			<th>Code</th>
			<th>Date</th>
			<th>Created by</th>
			<th>Transmission from</th>
			<th>Transmission to</th>
			<th>Operater who sent</th>
			<th>Status</th>
			<th>Type</th>
			<th>Operater who received</th>
			<th>Word order</th>
			<!-- <th>Send</th>  -->
			<!-- <th>Receive</th> -->
			<!-- <th>Cancel</th> -->
			<th>Actions</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach ($gears as $gear): ?>
		<tr>
			<td><?php echo $this->Html->link($gear['Gear']['code'],['action'=>'details', $gear['Gear']['id']]); ?></td>
			<td><?php echo $gear['Gear']['date']; ?></td>
			<td><?php echo $gear['Operater']['username']; ?></td>
			<td><?php echo $gear['WarehousePlaceFrom']['name']; ?></td>
			<td><?php echo $gear['WarehousePlaceTo']['name']; ?></td>
			<td><?php echo $gear['OperaterSend']['username']; ?></td>
			<td><?php echo $statuses[$gear['Gear']['status']]; ?></td>
			<td><?php echo $types[$gear['Gear']['transmission_type']]; ?></td>
			<td><?php echo $gear['OperaterReceive']['username']; ?></td>
			<td><?php echo $gear['Gear']['work_order']; ?></td>
			<td><?php if($gear['PermissionFrom']['permission']==1 && $gear['Gear']['status']=='opened') { ?>
			<?php echo $this->Html->link('Send',array('action'=>'send',$gear['Gear']['id']),array('class'=>'button')); ?>
			<?php } ?>
			<?php if($gear['PermissionTo']['permission']==1  && $gear['Gear']['status']=='sent' || $gear['Gear']['status']=='opened') { ?>
			<?php echo $this->Html->link('Receive',array('action'=>'receive',$gear['Gear']['id']),array('class'=>'button')); ?>
			<?php } ?>
			<?php if($gear['Gear']['created_by']==$log && $gear['Gear']['status']=='opened') { ?>
			<?php echo $this->Html->link('Cancel',array('action'=>'cancel',$gear['Gear']['id']),array('class'=>'button')); ?> 
			<?php } ?>
			</td> 
			<td><?php echo $this->Html->link('Edit',array('action'=>'save',$gear['Gear']['id']),array('class'=>'button')); ?></td>
			<td><?php echo $this->Form->postLink('Delete',array('action'=>'delete',$gear['Gear']['id']),array('confirm'=>'Are you sure?','class'=>'button')); ?></td>
		</tr>
	<?php endforeach; 
	unset($gear); ?>
	</table>	
</div>