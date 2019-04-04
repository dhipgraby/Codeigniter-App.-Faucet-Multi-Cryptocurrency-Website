<h3>Security settings</h3>


<?php if(isset($addr_gen)){$this->load->view($addr_gen); } ?>
<br>
<?php $this->load->view('buster/security/change_password'); ?> 
<br>
<?php $this->load->view('buster/security/change_pin'); ?> 
<br>
<?php $this->load->view('buster/security/2fa_auth'); ?> 



<script>
	
	$(document).ready(function(){


$('#sec_method').slideUp(1000);

function countback_reload(time){

 var timeleft = time;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft <= 0)
        location.reload();
    },1000);

}

   

	$('#change').click(function(event){
	event.preventDefault();


    var password = $('input#current_password').val();
	var new_password = $('input#new_password').val();
	var password_confirm = $('input#password_confirm').val();

			$.ajax({

			url: "<?php echo base_url(); ?>account/change_password",
			type: "POST",
			data: { password : password, new_password : new_password, password_confirm : password_confirm },

			success: function(data) {

					
			    $('#data_submited').html(data);

				}

			});

	});

	$('#change_pin').click(function(event){
	event.preventDefault();


    var pincode = $('input#pincode').val();
	var new_pincode = $('input#new_pincode').val();
	var pincode_confirm = $('input#pincode_confirm').val();

			$.ajax({

			url: "<?php echo base_url(); ?>account/change_pincode",
			type: "POST",
			data: { pincode : pincode, new_pincode : new_pincode, pincode_confirm : pincode_confirm },

			success: function(data) {

					
			   $('#data_pin').html(data);

				}

			});

	});



		$('#open_pin').click(function(event){


var Pindiv ='<?php echo json_encode(modal_content("Set pincode","

<table>
	<tr>
<td>Pin code:</td>
<td>". form_password('new_pincode', '', 'class="form-control" id="pincode" ') . "</td>
</tr>
	<tr>

<td>Confirm new pin</td>
	<td>" . form_password('pincode_confirm', '', 'class="form-control" id="pincode_confirm" ') . "</td></tr>


</table>



","set pin","set_pin")) ?>';
					
			    $('#data_submited').html(Pindiv);
			     $('#modal').modal('show');
		
		$('#set_pin').click(function(event){
	event.preventDefault();


    var new_pincode = $('input#pincode').val();
	var pincode_confirm = $('input#pincode_confirm').val();

			$.ajax({

			url: "<?php echo base_url(); ?>account/set_new_pin",
			type: "POST",
			data: { new_pincode : new_pincode, pincode_confirm : pincode_confirm },

			success: function(data) {

					 $('#modal').modal('hide').fadeOut(1000, function (e) {
  $('#data_pin').html(data).slideDown();


});

  			
				}

			});

	});


	});		

		$('[name="2fa"]').change(function(event){
	event.preventDefault();


    var method = $(this).val();
    var secure_name = $(this).attr('id');

			$.ajax({

			url: "<?php echo base_url(); ?>account/set_method/" + method + "/" + secure_name,
			type: "POST",
			data: { method : method },

			success: function(data) {
							
						
 $('#data_submited').html(data);

 $('#modal').modal('show');

$('#2fa' + method).click(function(event){
event.preventDefault();


var password = $('input#sec_password').val();
var pincode =  $('input#sec_password').val();
var email_code =  $('input#sec_password').val();

$.ajax({

url: "<?php echo base_url(); ?>/account/factor_message/"+ method +"/"+ secure_name,
type: "POST",
data: { password : password , pincode : pincode , email_code : email_code },

	success: function(data) {


$('#message').slideUp(100).html(data).slideDown(1000);

	}
});


});



				}

			});

	});

		$('[name="remove"]').click(function(event){
	event.preventDefault();

       var secure_name = $(this).attr('id');

		$.ajax({

						url: "<?php echo base_url(); ?>account/modal_remove/" + secure_name,
						type: "POST",
						data: { secure_name : secure_name },

									success: function(data) {			
																
						 $('#data_submited').html(data);

						 $('#modal').modal('show');

						$('#remove_' + secure_name).click(function(event){
						event.preventDefault();


								var password = $('input#sec_password').val();
								var pincode =  $('input#sec_password').val();
								var email_code =  $('input#sec_password').val();

								$.ajax({

										url: "<?php echo base_url(); ?>account/remove_factor/" + secure_name,
										type: "POST",
										data: { password : password , pincode : pincode , email_code : email_code },

											success: function(data) {


										$('#message').slideUp(100).html(data).slideDown(1000);
										
											}
								});

						});

						    	}

			});

	});

				$('#addr_book').on('click', function(){


  var $box = $('input#addr_only');
  if ($box.is(":checked")) {

												
													$('#book_r #modal_book').modal('show');
$('[name="destroy"]').click(function(){

remove_modal_window('book_r div#modal_book');


}); 


var coin = $('option:selected','#coinjs_coin').attr('id');


$('#add_coin').html(coin);


                     $('#add_confirm').on('click', function(){

var coin = $('option:selected','#coinjs_coin').attr('id');

                                                 var address = $('input#address').val();
                                                 var label = $('input#label').val();

var decode = coinjs.addressDecode(address);
		
		if(decode.version == coinjs.pub || decode.version == coinjs.multisig){ 


$.ajax({

												url: "<?php echo base_url(); ?>account/add_new_coin",
												type: "POST",
												data: { coin : coin, address : address, label : label, },

													success: function(data) {

														$('#add_err').html(data);

														paginator(1,coin);

													}

												         });

		 } else { $('#add_err').html('<?php echo alert_msg('Not valid address, please try another', 'warning'); ?>'); }

	


												
												});

															                         
                               

				 }

				});

		$('input#addr_only').on('click', function(){
	
  var $box = $(this);
  if ($box.is(":checked")) {

  		$.ajax({

										url: "<?php echo base_url(); ?>account/addr_list/on",
										type: "POST",
										data: { },

											success: function(data) {

  $('#addr_book').removeClass('btn-secondary');
$('#addr_book').addClass('btn-primary');


                                          
										$('#book_r').slideUp(100).html(data).slideDown(1000);


										
											}
								});




  } else {


	$.ajax({

										url: "<?php echo base_url(); ?>account/addr_list/off",
										type: "POST",
										data: { },

											success: function(data) {

	$('#addr_book').removeClass('btn-primary');
    $('#addr_book').addClass('btn-secondary');


                                           
										$('#book_r').slideUp(100).html(data).slideDown(1000);


										
											}
								});


       }
     
});


function remove_modal_window(id){

$('#'+id).modal('hide');
$("[class='modal-backdrop fade show']").remove();


}

/*
		function paginator(){

var coin = $('#currency');
var page = $(this).val();

$.ajax({

										url: "<?php echo base_url(); ?>account/addressbook_tab",
										type: "POST",
										data: { coin : coin, page : page, },

											success: function(data) {

	                                      $('#list').html(data)
										
											}
								});

		}

        function next_page(){

var coin = $('#currency');
var page = $(this).val();

        	$.ajax({

										url: "<?php echo base_url(); ?>account/page_buttons",
										type: "POST",
										data: { coin : coin , page : page, },

											success: function(data) {

		                                      $('#pages').html(data)

										
											}
								});
			
		}*/
		});
	</script>
