 <div class="modal-header">
				 
<?php echo validation_errors(); ?>

         
          <h3 class="modal-title"><?php echo empty($page->id) ? 'Add new page' : 'Edit page '. $page->name; ?></h3>
         
        </div>
	
						<?php	echo form_open('', 'class="form-signin"'); ?>

  <div class="modal-body">
<table class="table">
	<tr>
	<td>Parent</td>
	<td><?php echo form_dropdown('parent_id', $pages_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $page->parent_id); ?></td></tr>

	<tr>
<td>Title</td>
	<td><?php echo form_input('title', set_value('title', $page->title), 'class="form-control" id="text_edit"'); ?></td></tr>
	<tr>
<td>Slug</td>
	<td><?php echo form_input('slug', set_value('slug', $page->slug), 'class="form-control"'); ?></td></tr>

 	
	<tr><td><?php echo form_submit('','Save', 'class="btn btn-primary"'); ?>
</td></tr>

</table>

<?php echo form_close(); ?>
	

</div>
<script>
	$('#text_edit').each(function(){
    var $this = $(this);
    var t = $this.val();
    $this.val(t.replace('&lt;','<').replace('&quot;','"').replace('&gt;', '>').replace('&quot;','"').replace('&lt;','<').replace('&quot;','"').replace('&quot;','"').replace('&gt;', '>'));
   
});
</script>