<div class="items form">
<?php echo $this->Form->create('Item'); ?>
	<fieldset>
		<legend><?php echo __('Edit Item'); ?></legend>
	<?php
		echo $this->Form->input('item_id');
		echo $this->Form->input('item_description');
		echo $this->Form->input('item_unit_type');
		echo $this->Form->input('item_price');
		echo $this->Form->input('item_picture');
		echo $this->Form->input('item_category_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Item.item_id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Item.item_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index')); ?></li>
	</ul>
</div>