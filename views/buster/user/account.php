

<?php $this->load->view('buster/components/menu_account'); ?> 
<div align="center"> 

	  <div class="btn-group "role="group" aria-label="Basic example">

  <button onclick="currentDiv(1)" type="button" class="btn btn-dark submenu"><i class="fas fa-user-tie"></i> Profile</button>
  <button onclick="currentDiv(2)" type="button" class="btn btn-dark submenu" id="security_btn"><i class="fas fa-cogs"></i> Security</button>
</div><br>


</div>

		    <div class="col-lg-12" align="center">
		    	<div class="card">
		    		
		    	<div class="card-body">
	 <?php if(isset($message)){

  echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span></button>'.$message. '

</div>';
  
}	    	       
       

?>
<span id="email_validation"></span>
<span id="data_submited"></span>
<span id="message"></span>
<!-- Settings -->
<div class="mySlides">



<?php 
		
$this->load->view($settings);

 ?>

</div>

<!-- Security -->
<div class="mySlides">

<span id="settings"></span>


<?php

if($u_data->permission == 2){



$this->load->view($security);


}  else {  echo alert_msg('First, verify your email to access security', 'warning');  }


 ?>

	
</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

var myIndex = 0;
//carousel();

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }

  x[slideIndex-1].style.display = "block";
 
}

</script>
</div>	
		    	</div>

		    </div>
		    
	

<script>
	
	  $('#send_code').click(function(){
					          
					          	$.ajax({

					             url: "<?php echo base_url(); ?>account/send_mailcode",
							    type: "POST",
							    data: { },

							    success: function(data) { 
                                    
                                  	if(data == "true"){

                                  		$('#message').slideUp(100).html('<?php echo alert_msg("Code sent. Please check your email","success"); ?>').slideDown(1000);
                                  		$('#send_code').removeClass('btn-primary', 'slow').addClass('btn-secondary', 'slow');


                                  	}
                                  	else { 

                                     $('#message').slideUp(100).html('<?php echo alert_msg("Email error. try again in 1 minute or use other email.","warning"); ?>').slideDown(1000);

                                      

                                  	 }
                                  	
      
							    }

					        	});
					        });

			$('[id="verify"]').click(function(event){
		event.preventDefault();

    
	   		$.ajax({

			url: "<?php echo base_url(); ?>account/activate_box",
			type: "POST",
			data: {  },


				success: function(data) { 
                 

				$('#email_validation').html(data);
				$('#email_validation  div#modal').modal('show');

				              $('#send_code').click(function(){
					          
					          	$.ajax({

					             url: "<?php echo base_url(); ?>account/send_mailcode",
							    type: "POST",
							    data: { },

							    success: function(data) { 
                                    
                                  	if(data == "true"){

                                  		$('#message').slideUp(100).html('<?php echo alert_msg("Code sent. Please check your email","success"); ?>').slideDown(1000);
                                  		$('#send_code').removeClass('btn-primary', 'slow').addClass('btn-secondary', 'slow');


                                  	}
                                  	else { 

                                     $('#message').slideUp(100).html('<?php echo alert_msg("Email error. try again in 1 minute or use other email.","warning"); ?>').slideDown(1000);

                                      

                                  	 }
                                  	
      
							    }

					        	});
					        });

					        $('#v_confirm').click(function(){
					          

					            var email_code = $('input#email_val').val();

					        	$.ajax({

					             url: "<?php echo base_url(); ?>account/activation",
							    type: "POST",
							    data: { email_code : email_code },

							    success: function(data) { 
                                    
                                  
                                  	$('#message').slideUp(100).html(data).slideDown(1000);

      
							    }

					        	});
					        });

					  

				}


			});

			});
</script>