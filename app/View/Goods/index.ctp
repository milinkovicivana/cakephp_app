<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Goods</h3>
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
		<?php foreach ($goods as $good): 
		if(empty($good['Item']['deleted'])){ ?>
		<tr>
			<td><?php echo $good['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($good['Item']['name'],array('controller'=>'items','action'=>'details',$good['Item']['id'])); ?></td>
			<td><?php if(empty($good['Good']['PID'])){
				echo '/';
			}else{ 
				echo $good['Good']['PID'];
			} ?></td>
			<td><?php if(empty($good['Good']['hs_number'])){
				echo '/';
			}else{ 
				echo $good['Good']['hs_number'];
			} ?></td>
			<td><?php if(empty($good['Good']['tax_group'])){
				echo '/';
			}else{ 
				echo $good['Good']['tax_group'];
			} ?></td>
			<td><?php if(empty($good['Good']['eccn'])){
				echo '/';
			}else{ 
				echo $good['Good']['eccn'];
			} ?></td>
			<td><?php if(empty($good['Good']['release_date'])){
				echo '/';
			}else{ 
				echo $good['Good']['release_date'];
			} ?></td>
			<td><?php if($good['Good']['for_distributors']==1){
				echo 'Da';
			}else{
				echo 'Ne';
			} ?></td>
			<td><?php echo $statuses[$good['Good']['status']]; ?></td>
			<?php echo $this->element('ActionButtons',array('id'=>$good['Good']['id'],'deleted'=>$good['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($good); ?>
	</table>	
</div>