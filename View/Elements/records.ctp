<p><span class="label">Filter:</span> | <?php  echo $this->Html->link('ALL', array('action' => 'index')) ?> |
	<?php
	foreach(range('A','Z') as $letter) {
		echo ' ' . $this->Html->link($letter, array('start:lastName' => $letter)) . ' |';
	}?>
</p>