<h2>Validating if <span id="val_coin">btc</span> address</h2>

<?php echo form_input('address','', 'class="form-control" id="val_addr"'); ?>
			<br>	
				<?php echo new_button('Validate', 'check_addr','success'); ?>
						<br>
<span id="check_res"></span>

<script>


$('#check_addr').click(function(){

var addr = $('#val_addr').val();

		var decode = coinjs.addressDecode(addr);
		
		if(decode.version == coinjs.pub || decode.version == coinjs.multisig){ // regular address
			
 $('#check_res').html('<?php echo alert_msg('Valid address!','success'); ?>');


		} else {

         
 $('#check_res').html('<?php echo alert_msg('This is not a Valid address, please try another one','warning'); ?>');


		}


});

	

</script>