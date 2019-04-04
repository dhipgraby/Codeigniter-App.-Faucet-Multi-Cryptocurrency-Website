<span id="sec_method">
<?php

	echo form_open('', 'class="form-signin"'); ?>


<h3>Enter Pincode</h3>
<p>in order to access please enter your pincode</p>
<table class="table">
	
	<tr>
<td>Pincode</td>
	<td><?php echo form_password('pincode', '', 'class="form-control" id="sec_pincode" '); ?></td></tr>

	<tr><td><button class="btn btn-primary" id="unlock">Unlock</button>
</td></tr>

</table>


<?php echo form_close(); ?>
<br>
<small>forgot pin? you can reset it using your email by receiving a code</small>
<?php echo anchor('secure_reset/pincode','Reset Pincode'); ?>
</span>


<script>
	
	$(document).ready(function(){

	$('#unlock').click(function(event){
	event.preventDefault();


	var pincode = $('input#sec_pincode').val();



			$.ajax({

			url: "<?php echo base_url(); ?>account/access_security",
			type: "POST",
			data: { pincode : pincode },

			success: function(data) {

		
			    $('#settings').slideUp(1000).html(data).slideDown(1000);

				}

			});

	});

});


</script>

