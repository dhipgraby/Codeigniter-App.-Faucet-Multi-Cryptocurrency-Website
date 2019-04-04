

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">


    <div class="modal-content">


      <div class="modal-header">
        <h5 class="modal-title"><?php echo $mod_title; ?></h5>
    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">



<h5>Enter email code</h5>
<p>in order to continue, click on "Send Email code" to receive your code to your email</p>
    <br>

<?php echo new_button('Send Email code','unlock_code','primary','style="margin-top: -60px;"'); ?>
<br>
<span id="message"></span>
<table class="table">
	
	<tr>
<td>Email code</td>
	<td><?php echo form_password('email_code', '', 'class="form-control" id="'.$input_id.'" '); ?></td></tr>

</table>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="<?php echo $mod_id; ?>" type="button" class="btn btn-primary"><?php echo $mod_button; ?></button>


<br>
      	<?php echo $mod_content; ?> </div>

      <div class="modal-footer">
        
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

                                      $('#message').slideUp(100).html('<?php echo alert_msg("Code sent. Please check your email","success"); ?>').slideDown(1000);
                                      $('#send_code').removeClass('btn-primary', 'slow').addClass('btn-secondary', 'slow');


                                    }
                                    else { 

                                     $('#message').slideUp(100).html('<?php echo alert_msg("Email error. try again in 1 minute or use other email.","warning"); ?>').slideDown(1000);

                                      

                                     }
                                    
      
                  }

                    });
                  }); 
  

$('input.form-control').click(function(){

$(this).keypress(function(e){
    if ( e.which == 13 ) return false;
    //or...
    if ( e.which == 13 ) e.preventDefault();
});

});

</script>