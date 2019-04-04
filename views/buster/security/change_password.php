<h4>Change password</h4>
<table class="table">
	<tr>
<td>Current password:</td>
	<td><?php echo form_password('password', '', 'class="form-control" id="current_password" '); ?></td></tr>
	
	<tr>
<td>New password</td>
	<td><?php echo form_password('new_password', '', 'class="form-control" id="new_password" '); ?></td></tr>
	<tr>

<td>Confirm new password</td>
	<td><?php echo form_password('password_confirm', '', 'class="form-control" id="password_confirm" '); ?></td></tr>
	<tr><td><button class="btn btn-primary" id="change">Save</button>
</td></tr>

</table>
<br>
<small>forgot password? you can reset it using your email by receiving a code</small>
<?php echo anchor('secure_reset/password','Reset Password'); ?>

<br>