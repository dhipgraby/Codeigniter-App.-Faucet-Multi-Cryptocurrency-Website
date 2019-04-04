<?php	echo form_open('', 'class="form-signin" id="form-new"'); ?>



<table class="table">
	<tr>
<td>User name:</td>
	<td><?php echo form_input('name', set_value('name', $user->name), 'class="form-control" id="name"'); ?></td></tr>
	<tr>
<td>Confirm Email:</td>
	<td><?php echo form_input('email', set_value('email', $user->email), 'class="form-control" id="email"'); ?></td></tr>
	<tr>
<td>Password</td>
	<td><?php echo form_password('password', '', 'class="form-control" id="password"'); ?></td></tr>
	<tr>
<td>Confirm Password</td>
	<td><?php echo form_password('password_confirm', '', 'class="form-control" id="psw"'); ?></td></tr>
	<tr><td><button class="btn btn-primary" id="save">Save</button>
</td></tr>

</table>

<br>

<small>forgot password? you can reset it using your email by receiving a code</small><br>
<?php echo anchor('secure_reset/password','Reset Password'); ?>


<?php echo form_close(); ?>

<script>
	
	$(document).ready(function(){

$('#save').click(function(event){
event.preventDefault();

var name = $('input#name').val();
var email = $('input#email').val();
var password = $('input#password').val();
var password_confirm = $('input#psw').val();

$.ajax({

url: "<?php echo base_url(); ?>account/save_settings",
type: "POST",
data: { name : name, email : email, password : password, password_confirm : password_confirm },

success: function(data) {

	if(data == 1){

		$('#data_submited').html('<?php echo alert_msg("succesfully updated", "success") ?>');

		setTimeout(function(){ location.reload(); }, 3000);
	}

	else { $('#data_submited').html(data);  }
}


});

});


	});


</script>
