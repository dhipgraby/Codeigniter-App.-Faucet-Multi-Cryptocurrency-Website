<span id="sec_method">
<?php

	echo form_open('', 'class="form-signin"'); ?>


<h3>Enter password</h3>
<p>in order to access please enter your password</p>
<table class="table">
	
	<tr>
<td>Password</td>
	<td><?php echo form_password('password', '', 'class="form-control" id="sec_password" '); ?></td></tr>

	<tr><td><button class="btn btn-primary" id="unlock">Unlock</button>
</td></tr>

</table>
<br>
<small>forgot password? you can reset it using your email by receiving a code</small>
<?php echo anchor('secure_reset/password','Reset Password'); ?>

<?php echo form_close(); ?>
</span>

<span id="settings"></span>
<script>
	
	$(document).ready(function(){

	$('#unlock').click(function(event){
	event.preventDefault();


	var password = $('input#sec_password').val();



			$.ajax({

			url: "<?php echo base_url(); ?>account/access_security",
			type: "POST",
			data: { password : password },

			success: function(data) {

					
				    $('#settings').slideUp(1000).html(data).slideDown(1000);

				}

			});

	});

});


</script>

