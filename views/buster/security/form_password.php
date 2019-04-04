


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

   <?php

	echo form_open('', 'class="form-signin"'); ?>


<h5>Enter password</h5>
<p>in order to access please enter your password</p>
<br>
<span id="message"></span>
<table class="table">
	
	<tr>
<td>Password</td>
	<td><?php echo form_password('password', '', 'class="form-control" id="'.$input_id.'" '); ?></td></tr>

</table>

<?php echo form_close(); ?>
<br>
      	<?php echo $mod_content; ?> </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="<?php echo $mod_id; ?>" type="button" class="btn btn-primary"><?php echo $mod_button; ?></button>
      </div>

   
    </div>
  </div>
</div>

<script>
  

$('input.form-control').click(function(){

$(this).keypress(function(e){
    if ( e.which == 13 ) return false;
    //or...
    if ( e.which == 13 ) e.preventDefault();
});

});


</script>