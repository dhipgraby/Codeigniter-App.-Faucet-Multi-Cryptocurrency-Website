
		<div class="card">
		  <div class="card-header">
		  Reset <?php echo $method; ?>
		  </div>
		  <div class="card-body">

	<span id="message"></span>
<br>
	<span id="settings"></span>
		<span id="sec_method">
		<p>in order to continue, click on "Send Email code", and enter the code we just sent to your email</p>

<div class="input-group mb-1">
  <div class="input-group-prepend">

  
    <span class="input-group-text" id="basic-addon1"><b>Enter your email: </b></span>
  </div>
<?php echo form_input('email', '', 'class="form-control" id="email_res" '); ?>
<br>	<?php echo new_button('Send Email code','unlock_code','primary'); ?>
</div>


<br>
<div class="input-group mb-1">
  <div class="input-group-prepend">

  
    <span class="input-group-text" id="basic-addon1"><b>Email code:</b></span>
  </div>
<?php echo form_input('email_code', '', 'class="form-control" id="sec_password" '); ?>

	
</div>
<br>
<small>Send email code to your preset email <br> click on verify to reset <?php echo $method; ?></small><br><br>

<button class="btn btn-primary" id="unlock">Validate code</button>



		</span>




		  </div>
		</div>


 <script>



$('#unlock_code').click(function(event){
event.preventDefault();


var email = $('#email_res').val();

                      $.ajax({

                       url: "<?php echo base_url(); ?>reset/send_mailcode",
                  type: "POST",
                  data: { email : email },

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

    var email = $('#email_res').val();


			$.ajax({

			url: "<?php echo base_url(); ?>reset/change_box/<?php echo $method; ?>",
			type: "POST",
			data: { email_code : email_code, email : email, },

			success: function(data) {

					
			    $('#settings').html(data);

				}

			});

	});


                 </script>