<div class="records index">
<?php echo $this->element('records'); ?>
<?php echo $this->Element('scaffolds/index', array('data' => $records, 'actions' => false)); ?> 
</div>

<?php
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Records',
		'items' => array(
			$this->Html->link(__('Add'), array('action' => 'add'), array('class' => 'add')),
			)
		),
	))); ?>
