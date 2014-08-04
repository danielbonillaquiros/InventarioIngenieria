<div class="items view">
<h2><?php echo __('Item - Basic'); ?></h2>
	<dl>
		<dt><?php echo __('Item Id'); ?></dt>
		<dd>
			<?php echo h($item['Item']['item_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Description'); ?></dt>
		<dd>
			<?php echo h($item['Item']['item_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unit'); ?></dt>
		<dd>
			<?php echo h($item['Unit']['unit_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Price'); ?></dt>
		<dd>
			<?php echo h($item['Item']['item_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item Picture'); ?></dt>
		<dd>
			<?php if ($item['Item']['item_picture']) echo $this->Html->image($item['Item']['item_picture']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($item['Category']['category_description'], array('controller' => 'categories', 'action' => 'view', $item['Category']['category_id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Items'), array('action' => 'index', "basic")); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index', "basic")); ?> </li>
	</ul>
	<h3><?php echo __('Profiles'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Editor View'), array('action' => 'view', $item['Item']['item_id'], "editor")); ?> </li>
		<li><?php echo $this->Html->link(__('Advanced View'), array('action' => 'view', $item['Item']['item_id'])); ?> </li>
	</ul>
</div>
