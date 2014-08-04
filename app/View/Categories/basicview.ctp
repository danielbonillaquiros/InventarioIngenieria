<div class="categories view">
<h2><?php echo __('Category - Basic'); ?></h2>
	<dl>
		<dt><?php echo __('Category ID'); ?></dt>
		<dd>
			<?php echo h($category['Category']['category_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Description'); ?></dt>
		<dd>
			<?php echo h($category['Category']['category_description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Level'); ?></dt>
		<dd>
			<?php echo h($category['Category']['category_level']); ?>
			&nbsp;
		</dd>
    <dt><?php echo __('Parent Category ID'); ?></dt>
		<dd>
			<?php echo h($category['Category']['category_parent_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index', "basic")); ?> </li>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index', "basic")); ?> </li>
	</ul>
  <h3><?php echo __('Profiles'); ?></h3>
  <ul>
    <li><?php echo $this->Html->link(__('Editor View'), array('controller' => 'categories', 'action' => 'view', $category['Category']['category_id'], "editor")); ?> </li>
    <li><?php echo $this->Html->link(__('Advanced View'), array('controller' => 'categories', 'action' => 'view', $category['Category']['category_id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Items'); ?></h3>
	<?php if (!empty($category['CategoryItems'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Item Description'); ?></th>
		<th><?php echo __('Item Unit Id'); ?></th>
		<th><?php echo __('Item Price'); ?></th>
		<th><?php echo __('Item Picture'); ?></th>
		<th><?php echo __('Item Category Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($category['CategoryItems'] as $categoryItems): ?>
		<tr>
			<td><?php echo $categoryItems['item_id']; ?></td>
			<td><?php echo $categoryItems['item_description']; ?></td>
			<td><?php echo $categoryItems['item_unit_id']; ?></td>
			<td><?php echo $categoryItems['item_price']; ?></td>
			<td><?php echo $categoryItems['item_picture']; ?></td>
			<td><?php echo $categoryItems['item_category_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'items', 'action' => 'view', $categoryItems['item_id'], "basic")); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
