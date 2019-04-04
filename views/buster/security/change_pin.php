
<span id="data_pin"></span>
<?php if(!empty($pin)){ 

?>

<h4>Change pin code</h4>
	<small>Use a 4-6 digit pincode to protect your account</small>
<table class="table">
	<tr>
<td>Current pincode: </td>
	<td><?php echo form_password('pincode', '', 'class="form-control" id="pincode" '); ?></td>
   </tr>

	<tr>
<td>New pin: </td>
	<td><?php echo form_password('new_pinconde', '', 'class="form-control" id="new_pincode" '); ?></td>
   </tr>

<tr>
<td>Confirm new pin: </td>
	<td><?php echo form_password('pincode_confirm', '', 'class="form-control" id="pincode_confirm" '); ?></td></tr>
	
	<tr>
		<td>
			<button class="btn btn-primary" id="change_pin"s>Save</button>
</td>
</tr>

</table>
<small>forgot pin? you can reset it using your email by receiving a code</small>
<?php echo anchor('secure_reset/pincode','Reset Pincode'); ?>
<?php

 } 

 else {


 	echo '<h4>Pin code</h4>
 	<small>Use a 4-6 digit pincode to protect your account</small>
 	<br>
 	<br>
 	<p>
 	<button id="open_pin" class="btn btn-primary">Set Pin code</button></p>';
 }

 ?>