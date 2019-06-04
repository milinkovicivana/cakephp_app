<div class="mn">
<?php echo $this->element('menu'); ?>
</div>
<h3>Products</h3>
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
			<th>Service production</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach ($products as $product): 
		if(empty($product['Item']['deleted'])){ ?>
		<tr>
			<td><?php echo $product['Item']['code']; ?></td>
			<td><?php echo $this->Html->link($product['Item']['name'],array('controller'=>'items','action'=>'details',$product['Item']['id'])); ?></td>
			<td><?php if(empty($product['Product']['PID'])){echo '/';}else{ echo $product['Product']['PID'];} ?></td>
			<td><?php if(empty($product['Product']['HS_number'])){echo '/';}else{ echo $product['Product']['HS_number'];} ?></td>
			<td><?php if(empty($product['Product']['tax_group'])){echo '/';}else{ echo $product['Product']['tax_group'];} ?></td>
			<td><?php if(empty($product['Product']['eccn'])){echo '/';}else{ echo $product['Product']['eccn'];} ?></td>
			<td><?php if(empty($product['Product']['release_date'])){echo '/';}else{ echo $product['Product']['release_date'];} ?></td>
			<td><?php if($product['Product']['for_distributors']==1){echo 'Da';}else{echo 'Ne';}; ?></td>
			<td><?php echo $statuses[$product['Product']['product_status']]; ?></td>
			<td><?php if($product['Product']['service_production']==1){echo 'Da';}else{echo 'Ne';}; ?></td>
			<?php echo $this->element('ActionButtons',array('id'=>$product['Product']['id'],'deleted'=>$product['Item']['deleted'])); } ?>
		</tr>
	<?php endforeach; 
	unset($product); ?>
	</table>	
</div>