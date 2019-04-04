<div class="container">
	
<div class="container p-3" align="center">
			

		<div class="card">
		  <div class="card-header">
		  Reset <?php echo $method; ?>
		  </div>
		  <div class="card-body">

	<span id="message"></span>

	<span id="settings"></span>
		<span id="sec_method">
	

		<h3>Enter email code</h3>
		<p>in order to continue, click on "Send Email code", and enter the code we just sent to your email</p>

		<table class="table">
			
			<tr>
		<td>Email code</td>
			<td><?php echo form_password('email_code', '', 'class="form-control" id="sec_password" '); ?>

			<br>

				<?php echo new_button('Send Email code','unlock_code','primary'); ?>
				<small>Send email code to your preset email</small></td></tr>

			<tr><td><button class="btn btn-primary" id="unlock">Verify</button>
		</td></tr>

		</table>


		</span>




		  </div>
		</div>
</div>


</div>


 <script>



$('#unlock_code').click(function(event){
event.preventDefault();
                      $.ajax({

                       url: "<?php echo base_url(); ?>account/send_mailcode",
                  type: "POST",
                  data: { },

                  success: function(data) { 
                                    
                                    if(data == "true"){

                                      $('#message').slideUp(100).html('<?php echo alert_msg('Code sent. Please check your email','success'); ?>').slideDown(1000);
                                      $('#send_code').removeClass('btn-primary', 'slow').addClass('btn-secondary', 'slow');


                                    }
                                    else { 

                                     $('#message').slideUp(100).html('<?php echo alert_msg("Email error. try again in 1 minute or use other email.","warning"); ?>').slideDown(1000);

                                      

                                     }
                                    
      
                  }

                    });
                  }); 


	$('#unlock').click(function(event){
	event.preventDefault();


	var email_code = $('input#sec_password').val();



			$.ajax({

			url: "<?php echo base_url(); ?>secure_reset/change_box/<?php echo $method; ?>",
			type: "POST",
			data: { email_code : email_code },

			success: function(data) {

					
			    $('#settings').html(data);

				}

			});

	});


                 </script>