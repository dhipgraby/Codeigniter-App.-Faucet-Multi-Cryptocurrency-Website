
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
 
     <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Login<br>
        <small>Please log using your credentials</small></h5>

 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

<span id="log_errors"></span>
   
<table class="table">
	<tr>
		<td>Name or email</td>
		<td><?php echo form_input('name', '', 'class="form-control" id="name" '); ?></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><?php echo form_password('password', '', 'class="form-control" id="password"'); ?></td>
	</tr>
	<tr><td><span id="btn_log"><?php echo new_button('Login','login','primary'); ?></span>
</td>
<td>Remember me: <?php echo form_checkbox('remember', 'accept', FALSE,'id="remember"'); ?></td></tr>

</table> 
<br>
<small>forgot password? you can reset it using your email by receiving a code</small>
<?php echo anchor('reset/password','Reset Password'); ?>


</div>

 
       <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  
                      $('#login').click(function(){

var name = $('input#name').val();
var password = $('input#password').val();
var box = $('#remember');  

  if (box.is(":checked")) {
                              
                 var remember = box.val();
                               }

                      $.ajax({

                       url: "<?php echo base_url(); ?>main/login",
                  type: "POST",
                  data: { name : name, password : password, remember : remember, },

                  success: function(data) { 
                                    

    var array = JSON.parse(data);

    if(array.log == 'success'){

$('#log_errors').html(array.view); 

    }

    if(array.log == 'secure'){

$('#secure_loggin').html(array.view);

    }
                             
      
                  }

                    });
                  });


</script>