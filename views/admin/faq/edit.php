 <div class="modal-header">
				 
<?php echo validation_errors(); ?>

         
          <h3 class="modal-title"><?php echo empty($article->id) ? 'Add new FAQ' : 'Edit FAQ '. $article->name; ?></h3>
         
        </div>
	
						<?php	echo form_open('', 'class="form-signin"'); ?>

  <div class="modal-body">
<table class="table">
	<tr>
<td>Topic</td>
	<td><?php echo form_input('topic', set_value('topic', $article->topic), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Title</td>
	<td><?php echo form_input('title', set_value('title', $article->title), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Video</td>
	<td><?php echo form_input('slug', set_value('slug', $article->slug), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Body</td>
	<td><?php echo form_textarea('body', $article->body, 'class="form-control" id="text_edit"'); ?></td></tr>
	
	<tr><td><?php echo form_submit('','Save', 'class="btn btn-primary"'); ?>
</td></tr>

</table>
<?php echo form_close(); ?>
	

</div>
