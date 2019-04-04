
<span align="center" id="data_submited"></span>

       
    <div class="card"  align="center">
      <div class="card-header">

Create withdraw transaction.


 </div>
      <div class="card-body">


<table class="table">
	
<tr>

	
     <?php $this->load->view('admin/addr/change_coin'); ?>

<script>
	

$("#coinjs_coin").change(function(){

setTimeout(
  function() 
  {

    $('#settingsBtn').click();

var currency = $('option:selected','#coinjs_coin').attr('id');
var currency_name = $('option:selected','#coinjs_coin').attr('name');

 

  }, 100);

 });

</script>
</tr>

	<tr>
<td>Receiving Address:</td>
<td><span id="r_address"><?php echo $coin_list; ?></span>
</td>


</tr>
	
	<tr>
<td>Amount:</td>
	<td><?php echo form_input('amount', '', 'type="numeric" class="form-control" id="amount" onkeypress="return isNumberKey(event)" '); ?>
</td>

</tr>


<tr>
	<td>
<?php echo new_button('Continue withdrawal', 'withdraw','primary'); ?></td>

</tr>

</table>

<br>
<p>  When status change from <b style="color:#198337;">"pending"</b> to <b style="color:#198337;">"TxID Here"</b>, <br> you will be able to check it by just clicking on it.
<br>
<b style="color:#198337;">Transaction FEES</b><br>

<br>
A Transaction fee is a little comision that we charge to keep the website running.<br>
Fees are taken from the amount you withdraw. So if you withdraw minimum 0.01 BTC, you will receive 0.0099 BTC.
<br>

Here you have a description of fees we charge for each withdraw:
<br>
Bitcoin (BTC) : 0.0001 <img src="<?php echo base_url() ?>img/coins/btclogo.png" style="height: 28px; width: 28px"><br>
Dogecoin (DOGE) : 60 <img src="<?php echo base_url() ?>img/coins/dogelogo.png"  style="height: 24px; width: 24px"><br>
Digibyte (DGB) : 1  <img src="<?php echo base_url() ?>img/coins/digibyte.png" style="height: 24px; width: 24px"><br>
LTC (LTC) : 0.001  <img src="<?php echo base_url() ?>img/coins/ltc.png" style="height: 24px; width: 24px"><br>

</p>

 </div>
    </div>




<script>
	
		$('#coinjs_coin').change(function(event){
	event.preventDefault(); 


	var coin = $('option:selected','#coinjs_coin').attr('id');

	          	$.ajax({	

						             url: "<?php echo base_url(); ?>withdraw/receiving_addr/" + coin,
								    type: "POST",
								    data: { },

								    success: function(data) { 

	                                         
									$('#r_address').html(data);            	
	      
								    }

						        	});


});


				$('#withdraw').click(function(event){
			event.preventDefault();

			var coin = $('option:selected','#coinjs_coin').attr('id');

var address = $('#address').val();
var amount = $('input#amount').val();
var password = $('input#password').val();
var currency = coin;


var decode = coinjs.addressDecode(address);
		
		if(decode.version == coinjs.pub || decode.version == coinjs.multisig){ 

$.ajax({

				url: "<?php echo base_url(); ?>withdraw/factor_box",
				type: "POST",
				data: { address : address, amount : amount, currency : currency, },


					success: function(data) { 
	                 
	       
					$('#data_submited').html(data);
						$('#modal').modal('show');


	$('#unlock').click(function(event){
	event.preventDefault();


	                            var password = $('input#sec_password').val();
								var pincode =  $('input#sec_password').val();
								var email_code =  $('input#sec_password').val();
 


			$.ajax({

			url: "<?php echo base_url(); ?>withdraw/confirm_box",
			type: "POST",
			data: { password : password , pincode : pincode , email_code : email_code,  address : address, amount : amount, currency : currency, },

			success: function(data) {
				
var array = JSON.parse(data);

if(array.access == '1'){

    $('#modal').modal('dispose').modal('hide');
	$('.modal-backdrop').remove();
    $('#data_submited').html(array.info);
	$('#modal').modal('show');
	
					//LAST STEP
					              $('#w_confirm').click(function(){
						          
						          	$.ajax({

						             url: "<?php echo base_url(); ?>withdraw/process",
								    type: "POST",
								    data: { address : address, amount : amount, currency : currency, },

								    success: function(data) { 

     $('#w_confirm').fadeOut(500);                                    
$('#message').slideUp(100).html(data).slideDown(1000);

   setInterval(function(){ location.reload(true) }, 4000);
	                                                     	
	      
								    }

						        	});
						        });
// END LAST STEP

}

if(array.access == '2') {

$('#message').html(array.info);

}

			
			 
				}

			});

	});


							  

					}


				});

} else { 	$('#data_submited').html('<?php echo alert_msg('Not valid address, please try another', 'warning'); ?>'); }


if(currency == null || currency == ''){

	$('#data_submited').html(data);

}
		   		

				});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>