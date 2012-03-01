<div class="records form">
<?php echo $this->Form->create('Record');?>
	<fieldset>
 		<legend><?php echo __('Add Record'); ?></legend>
	<?php
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
		echo $this->Form->input('user_id');
		echo $this->Form->input('phone2');
		echo $this->Form->label('Category');
		echo $this->Form->select('Category.id', $categories);
	?>
		<div id="categorySelect">		</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php 
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Records',
		'items' => array(
			$this->Html->link(__('List Contact Directories', true), array('action' => 'index'), array('class' => 'index')),
			$this->Html->link(__('List Categories', true), array('controller' => 'categories', 'action' => 'index')),
			$this->Html->link(__('New Category', true), array('controller' => 'categories', 'action' => 'add')),
			)
		),
	)));
?>

<script>
$('#CategoryId').change(function(e){
		$('#selected').empty().html('<?php echo $this->Html->image('ajax-loader.gif'); ?>');
	    $this = $(e.target);
	    $.ajax({
            type: "POST",
            url: "<?php echo $this->Html->url('/categories/categories/get_children');?>" + '/parentId:' + $(this).attr("value"),
            success:function(data){
                create_select(data, 1);
            }
        });
	});
	$('.category').live("change", function(e){
		$('#selected').empty().html('<?php echo $this->Html->image('ajax-loader.gif'); ?>');
		id = $(this).attr('id');
	    $.ajax({
            type: "POST",
            url: "<?php echo $this->Html->url('/categories/categories/get_children//parentId:');?>" + $('#'+id).val(),
            success:function(data){
                create_select(data, id);
            }
        });
	});

	function create_select(data, num) {
		num = parseFloat(num) + 1;
		if (data.length > 2) {
			var response = JSON.parse(data);
			var res = '<select class="category" id="' + num + '" multiple="multiple" name="data[Category][id]">';
			for (i in response) {
		    	res += '<option value="' + i + '">' + response[i] + '</option>';
			}
			res +='</select></div><div id="selected"></div>';
		}
		else {
			$("#assign").removeAttr("disabled");
		}
		for (i = num	; ;++i) {
			if (($('#'+i).length == 0)) 
				break;
			$('#wrap_'+i).remove();
		}
		$('#selected').remove();
		$('#categorySelect').append(res);
	}
</script>	