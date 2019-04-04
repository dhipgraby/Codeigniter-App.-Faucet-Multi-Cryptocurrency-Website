 <div class="modal-header">
				 
<?php echo validation_errors(); ?>

         
          <h3 class="modal-title"><?php echo empty($store->id) ? 'Add new Item' : 'Edit store '. $store->name; ?></h3>
         
        </div>
	
						<?php	echo form_open('', 'class="form-signin"'); ?>

  <div class="modal-body">
  <?php if(isset($test)){ echo $test; } ?>
<table class="table">
	<tr>
	<td>Parent</td>
	<td><?php echo form_dropdown('parent_id', $stores_no_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $store->parent_id); ?></td></tr>
	<tr>
<td>Price</td>
	<td><?php echo form_input('price', set_value('price', $store->price), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Title</td>
	<td><?php echo form_input('title', set_value('title', $store->title), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Slug</td>
	<td><?php echo form_input('slug', set_value('slug', $store->slug), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Body</td>
	<td><?php echo form_textarea('body', set_value('body', $store->body), 'class="form-control"'); ?></td></tr>
		<tr>
<td>Image</td>
	<td>

	 <img style="border-radius: 8px;" height="180px" width="260px" src="<?php echo base_url().'./uploads/'.$store->img; ?>">
	 <br>
	 <input type="file" name="img" multiple></td></tr>
	<tr>

	<tr><td><?php echo form_submit('','Save', 'class="btn btn-primary"'); ?>
</td></tr>

</table>
<?php echo form_close(); ?>
	

</div>


