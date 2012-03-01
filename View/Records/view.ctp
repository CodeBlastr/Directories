<div class="project view">
    <h2><?php  echo __('%s %s', $contactDirectory['Record']['first_name'], $contactDirectory['Record']['last_name']); ?></h2>
    <div id="n1" class="info-block">
      <div class="viewRow">
        <ul class="metaData">
          <li><span class="metaDataLabel"> <?php echo __('Email: '); ?> </span><span class="metaDataDetail"><?php echo $contactDirectory['Record']['email']; ?></span></li>
        </ul>
        <div class="recordData">
          <p><?php echo __('Street Address : '); ?> <span><?php echo $contactDirectory['Record']['street_address_1']; ?></span></p>
          <p><?php echo __('Street Address 2 : '); ?> <span><?php echo $contactDirectory['Record']['street_address_2']; ?></span></p>
          <p><?php echo __('City : '); ?> <span><?php echo $contactDirectory['Record']['city']; ?></span></p>
          <p><?php echo __('State : '); ?> <span><?php echo $contactDirectory['Record']['state']; ?></span></p>
          <p><?php echo __('Zip : '); ?> <span><?php echo $contactDirectory['Record']['zip']; ?></span></p>
          <p><?php echo __('Country : '); ?> <span><?php echo $contactDirectory['Record']['country']; ?></span></p>
          <p><?php echo __('Phone : '); ?> <span><?php echo $contactDirectory['Record']['phone1']; ?></span></p>
        </div>
      </div>
    </div>
  <!-- /info-block end -->
</div>

<?php
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Records',
		'items' => array(
			$this->Html->link(__('List'), array('action' => 'index'), array('class' => 'index')),
			$this->Html->link(__('Edit'), array('action' => 'edit', $contactDirectory['Record']['id']), array('class' => 'edit')),
			$this->Html->link(__('Delete'), array('action' => 'delete', $contactDirectory['Record']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $contactDirectory['Record']['id']), array('class' => 'delete')),
			$this->Html->link(__('Add'), array('action' => 'add'), array('class' => 'add')),
			)
		),
	))); ?>
