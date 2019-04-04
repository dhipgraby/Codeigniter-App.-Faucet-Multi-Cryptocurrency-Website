

<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


     <div class="modal-header">

        <h3 class="modal-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</h3>
        
<p>Complete the form to register as new user</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          
      

	  <div class="modal-body">

<span id="regist_errors"></span>
     
						

<table class="table">
	
		<tr>
<td>Name</td>
	<td><?php echo form_input('name', set_value('name'), 'class="form-control" id="new_name"'); ?></td></tr>
	<tr>
<td>Email</td>
	<td><?php echo form_input('email', set_value('email'), 'class="form-control" id="email" '); ?></td></tr>
	
	<tr>
<td>Password</td>
	<td><?php echo form_password('password', '', 'class="form-control" id="new_password"'); ?></td></tr>
	<tr>
<td>Confirm Password</td>
	<td><?php echo form_password('password_confirm', '', 'class="form-control" id="confirm_password" '); ?></td></tr>
	<tr><td><span id="btn_regist"><?php echo new_button('Register','register','primary'); ?></span>
</td></tr>

</table>

	
<br>
<p>Your referrer</p>
<?php
 echo form_input('refer', $refer, ' id="refer"onkeypress="return isNumber(event)" readonly class="form-control"');

?>

</div>

       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	
	    $('#register').click(function(){

                    
var name = $('input#new_name').val();
var email = $('input#email').val();
var password = $('input#new_password').val();
var password_confirm = $('input#confirm_password').val();
var refer = $('input#refer').val();

                      $.ajax({

                       url: "<?php echo base_url(); ?>main/register",
                  type: "POST",
                  data: { refer : refer , name : name, email : email, password : password, password_confirm : password_confirm },

                  success: function(data) { 
                                    
                         $('#regist_errors').html(data);     
      
                  }

                    });
                  });

</script>