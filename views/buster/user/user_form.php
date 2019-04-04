
<table class="table">
	<tr>
<td>Name:</td>
	<td><?php echo form_input('name', set_value('name', $user->name), 'class="form-control" id="name"'); ?></td></tr>
	<tr>
<td>Email:</td>
	<td><?php echo form_input('email', set_value('email', $user->email), 'class="form-control" id="email"'); ?></button>
		<br>
		<?php echo $mail_button; ?>
	</td>

</tr>
<tr><td>Email code:</td>

<td>

<div class="input-group mb-3">
  <?php echo form_input('email_code', '', 'class="form-control" id="change_email_code"'); ?>
  <div class="input-group-append">
<?php echo new_button('Send','send_code','primary') ?>
  </div>
</div>
</td></tr>
	<tr>
<td>Password</td>
	<td><?php echo form_password('password', '', 'class="form-control" id="password"'); ?></td></tr>


	<tr><td><button class="btn btn-primary" id="save">Save</button>
</td></tr>

</table>
<br>


<small>forgot password? you can reset it using your email by receiving a code</small><br>
<?php echo anchor('secure_reset/password','Reset Password'); ?>


<script>
	
	$(document).ready(function(){

		function countback_reload(time){
 
 var timeleft = time;
    var downloadTimer = setInterval(function(){
    
    if(time > 0){ document.getElementById("countdowntimer").textContent = 'wait '  + timeleft + ' seconds';
     timeleft--; }
    
  
    },1000);

}


$(document).keyup(function (evt) {

	    if (evt.keyCode == 27) {

       $('.modal-backdrop').remove();
    }

});

$('#save').click(function(event){
event.preventDefault();

var name = $('input#name').val();
var email = $('input#email').val();
var password = $('input#password').val();
var email_code = $('input#change_email_code').val();

$.ajax({

url: "<?php echo base_url(); ?>account/save_settings",
type: "POST",
data: { email_code : email_code, name : name, email : email, password : password },

success: function(data) {

	if(data == 1){

		$('#data_submited').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>successfully updated</div>');

			setTimeout(function(){ location.reload(); }, 2000);
	}

	else { $('#data_submited').html('<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>'+ data +'</div>');  }
}


});

});


});

</script>
