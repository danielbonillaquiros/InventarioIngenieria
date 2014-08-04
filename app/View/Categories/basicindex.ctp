<div class="categories index">
	<h2><?php echo __('Categories - Basic'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('category_description'); ?></th>
			<th><?php echo $this->Paginator->sort('category_level'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo h($category['Category']['category_id']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['category_description']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['category_level']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['category_id'], "basic")); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Items'), array('controller' => 'items', 'action' => 'index', "basic")); ?> </li>
	</ul>
  <h3><?php echo __('Profiles'); ?></h3>
	<ul>
    <li><?php echo $this->Html->link(__('Editor View'), array('controller' => 'categories', 'action' => 'index', "editor")); ?> </li>
    <li><?php echo $this->Html->link(__('Advanced View'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
	</ul>
</div>
