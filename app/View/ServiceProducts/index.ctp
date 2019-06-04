<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Service Products</h3>
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
		<?php foreach ($serproducts as $serprod): 
		if(empty($serprod['Item']['deleted'])){ ?>
		<tr>
			<td><?php echo $serprod['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($serprod['Item']['name'],array('controller'=>'items','action'=>'details',$serprod['Item']['id'])); ?></td>
			<td><?php if(empty($serprod['ServiceProduct']['PID'])){
				echo '/';
			}else{ 
				echo $serprod['ServiceProduct']['PID'];
			} ?></td>
			<td><?php if(empty($serprod['ServiceProduct']['hs_number'])){
				echo '/';
			}else{ 
				echo $serprod['ServiceProduct']['hs_number'];
			} ?></td>
			<td><?php if(empty($serprod['ServiceProduct']['tax_group'])){
				echo '/';
			}else{ 
				echo $serprod['ServiceProduct']['tax_group'];
			} ?></td>
			<td><?php if(empty($serprod['ServiceProduct']['eccn'])){
				echo '/';
			}else{ 
				echo $serprod['ServiceProduct']['eccn'];
			} ?></td>
			<td><?php if(empty($serprod['ServiceProduct']['release_date'])){
				echo '/';
			}else{ 
				echo $serprod['ServiceProduct']['release_date'];
			} ?></td>
			<td><?php if($serprod['ServiceProduct']['for_distributors']==1){
				echo 'Da';
			}else{
				echo 'Ne';
			} ?></td>
			<td><?php echo $statuses[$serprod['ServiceProduct']['service_status']]; ?></td>
			<?php echo $this->element('ActionButtons',array('id'=>$serprod['ServiceProduct']['id'],'deleted'=>$serprod['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($serprod); ?>
	</table>	
</div>