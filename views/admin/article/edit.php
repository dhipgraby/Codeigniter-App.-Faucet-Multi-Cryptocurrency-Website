 <div class="modal-header">
				 
<?php echo validation_errors(); ?>

         
          <h3 class="modal-title"><?php echo empty($article->id) ? 'Add new article' : 'Edit article '. $article->name; ?></h3>
         
        </div>
	
						<?php	echo form_open('', 'class="form-signin"'); ?>

  <div class="modal-body">
<table class="table">
	<tr>
<tr>
<td>Publication date</td>
	<td><?php echo form_input('pubdate', set_value('pubdate', $article->pubdate), 'class="datepicker"'); ?></td></tr>
	<tr>
<td>Title</td>
	<td><?php echo form_input('title', set_value('title', $article->title), 'class="form-control" id="text_edit2"'); ?></td></tr>
	<tr>
<td>Slug</td>
	<td><?php echo form_input('slug', set_value('slug', $article->slug), 'class="form-control"'); ?></td></tr>
		<tr>
<td>Link</td>
	<td><?php echo form_input('link', set_value('link', $article->link), 'class="form-control"'); ?></td></tr>
		<tr>
<td>Image</td>
	<td><?php echo form_input('image', set_value('image', $article->image), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Video</td>
	<td><?php echo form_input('video', set_value('video', $article->video), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Body</td>
	<td><?php echo form_textarea('body', set_value('body', $article->body), 'class="form-control" id="text_edit"'); ?></td></tr>
	<tr><td><?php echo form_submit('','Save', 'class="btn btn-primary"'); ?>
</td></tr>

</table>
<?php echo form_close(); ?>
	

</div>

<script>



    $(function(){
    	$('.datepicker').datepicker( { format: 'yyyy-mm-dd' });
    });


</script>