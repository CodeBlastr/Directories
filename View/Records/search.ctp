<div class="records form">
<?php 
	echo $this->Form->create('Record');
	echo $this->Form->input('first_name');
	echo $this->Form->input('street_address_1');
	echo $this->Form->input('city');
	echo $this->Form->input('state');
	echo $this->Form->input('phone1');
	echo $this->Form->select('Category.id', $categories);
	echo $this->Form->end(__('Search', true));
?>
</div>

<?php 
	if(!empty($records)) {
?>
		<div class="records index">
			<h2><?php echo __('Contact Directories');?></h2>
			<table cellpadding="0" cellspacing="0">
			<tr>
				<th><?php echo $this->Paginator->sort('first_name');?></th>
				<th><?php echo $this->Paginator->sort('last_name');?></th>
				<th><?php echo $this->Paginator->sort('street_address_1');?></th>
				<th><?php echo $this->Paginator->sort('street_address_2');?></th>
				<th><?php echo $this->Paginator->sort('city');?></th>
				<th><?php echo $this->Paginator->sort('state');?></th>
				<th><?php echo $this->Paginator->sort('zip');?></th>
				<th><?php echo $this->Paginator->sort('country');?></th>
				<th><?php echo $this->Paginator->sort('phone1');?></th>
				<th><?php echo $this->Paginator->sort('email');?></th>
				<th><?php echo $this->Paginator->sort('user_id');?></th>
				<th><?php echo $this->Paginator->sort('phone2');?></th>
			</tr>
			<?php
			$i = 0;
			foreach ($records as $record):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr<?php echo $class;?>>
				<td><?php echo $record['Record']['first_name']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['last_name']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['street_address_1']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['street_address_2']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['city']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['state']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['zip']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['country']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['phone1']; ?>&nbsp;</td>
				<td><?php echo $record['Record']['email']; ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($record['User']['full_name'], array('controller' => 'users', 'action' => 'view', $record['User']['id'])); ?>
				</td>
				<td><?php echo $record['Record']['phone2']; ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View', true), array('action' => 'view', $record['Record']['id'])); ?>
					<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $record['Record']['id'])); ?>
					<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $record['Record']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $record['Record']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
			</table>
			<p>
			<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
			));
			?>	</p>
		
			<div class="paging">
				<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
			 | 	<?php echo $this->Paginator->numbers();?>
		 |
				<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
			</div>
		</div>
<?php 		
	}
?>