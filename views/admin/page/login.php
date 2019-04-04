 <div class="modal-header">
				 
<?php echo validation_errors(); ?>

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Log in</h3>
          <p>Please log using your credentials</p>
        </div>
	
						<?php	echo form_open('', 'class="form-signin"'); ?>

  <div class="modal-body">
<table class="table">
	<tr><td><?php echo form_input('email', '', 'class="form-control"'); ?></td></tr>
	<tr><td><?php echo form_password('password', '', 'class="form-control"'); ?></td></tr>
	<tr><td><?php echo form_submit('','Login', 'class="btn btn-primary"'); ?>
</td></tr>

</table>
<?php echo form_close(); ?>
	

</div>