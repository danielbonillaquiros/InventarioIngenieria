<div class="items index">
	<h2><?php echo __('Items'); ?></h2>
  <table cellpadding="0" cellspacing="0">
            <?php echo $this->Html->tableHeaders(array(
                $this->Paginator->sort('item_id'),
                $this->Paginator->sort('item_description'),
                $this->Paginator->sort('item_unit_id'),
                $this->Paginator->sort('item_price'),
                $this->Paginator->sort('item_picture'),
                $this->Paginator->sort('item_category_id'),
                __('Actions'),
            ));

            // Table contents.
            $rows = array();
            foreach ($items as $item) {
                $row = array();
                $row[] = h($item['Item']['item_id']);
                $row[] = h($item['Item']['item_description']);
                $row[] = h($item['Unit']['unit_name']);
                $row[] = h($item['Item']['item_price']);
                $row[] = $item['Item']['item_picture'] ? 'Y' : 'N';
                $row[] = $this->Html->link($item['Category']['category_description'], array('controller' => 'categories', 'action' => 'view', $item['Category']['category_id']));
                // Actions.
                $actions = array();
                $actions[] = $this->Html->link(__('View'), array('action' => 'view', $item['Item']['item_id']));
                $actions[] = $this->Html->link(__('Edit'), array('action' => 'edit', $item['Item']['item_id']));
                $actions[] = $this->Form->postLink(__('Delete'), array('action' => 'delete', $item['Item']['item_id']), null, __('Are you sure you want to delete # %s?', $item['Item']['item_id']));
                $row[] = array(
                    implode(' ', $actions),
                    array('class' => 'actions'),
                );
                $rows[] = $row;
            }
            if (!empty($rows)) {
                echo $this->Html->tableCells($rows);
            }
            ?>
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
		<li><?php echo $this->Html->link(__('New Item'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
	</ul>
</div>
