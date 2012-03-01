<div class="records form">
<?php echo $this->Form->create('Record');?>
	<fieldset>
 		<legend><?php echo __('Edit Contact Directory'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('street_address_1');
		echo $this->Form->input('street_address_2');
		echo $this->Form->input('city');
		echo $this->Form->input('state');
		echo $this->Form->input('zip');
		echo $this->Form->input('country');
		echo $this->Form->input('phone1');
		echo $this->Form->input('email');
		echo $this->Form->input('phone2');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>



<?php
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Records',
		'items' => array(
			$this->Html->link(__('List'), array('action' => 'index'), array('class' => 'index')),
			$this->Html->link(__('Add'), array('action' => 'add'), array('class' => 'add')),
			$this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Record.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Record.id')), array('class' => 'delete')),
			)
		),
	))); ?>