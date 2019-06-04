<div class="col_4">
<ul class="menu">
	<li><?php echo $this->Html->link('All items',array('controller'=>'items','action'=>'index')); ?>
		<ul>
			<li><?php echo $this->Html->link('Materials',array('controller'=>'materials','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Products',array('controller'=>'products','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Semi products',array('controller'=>'semiproducts','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Goods',array('controller'=>'goods','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Kits',array('controller'=>'kits','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Consumable',array('controller'=>'consumables','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Inventory',array('controller'=>'inventories','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Service products',array('controller'=>'serviceproducts','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Service suppliers',array('controller'=>'servicesuppliers','action'=>'index'));?></li>
		</ul>
	</li>
	<li><?php echo $this->Html->link('Item types',array('controller'=>'itemtypes','action'=>'index'));?></li>
	<li><?php echo $this->Html->link('Measurement units',array('controller'=>'measurementunits','action'=>'index'));?></li>
	<li><?php echo $this->Html->link('Warehouse',array('controller'=>'warehouseplaces','action'=>'index'));?>
		<ul>
			<li><?php echo $this->Html->link('Warehouse places',array('controller'=>'warehouseplaces','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Warehouse addresses',array('controller'=>'warehouseaddresses','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Items warehouse addresses',array('controller'=>'itemswarehouseaddresses','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Items warehouse places',array('controller'=>'itemswarehouseplaces','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Operaters',array('controller'=>'operaters','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Permissions',array('controller'=>'permissions','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Gears',array('controller'=>'gears','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Gears items',array('controller'=>'gearsitems','action'=>'index'));?></li>
		</ul>
	</li>
	<li><?php echo $this->Html->link('Logout',array('controller'=>'operaters','action'=>'logout'));?></li>
</ul>
</div>