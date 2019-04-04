
<?php $this->load->view('admin/addr/change_coin'); ?>

					<script>
			
$(document).ready(function() {

myFunction();

function myFunction() {
    setTimeout(function(){ 


$("#coinjs_coin").change(function(){

setTimeout(
  function() 
  {

    $('#settingsBtn').click();

var currency = $('option:selected','#coinjs_coin').attr('id');
var currency_name = $('option:selected','#coinjs_coin').attr('name');

if(currency == 'btc'){

	var key = '<?php echo config_item('xpubkey'); ?>';
}

if(currency == 'doge'){

var key = '<?php echo config_item('dogexpubkey'); ?>';

}

$('#verifyScript').val(key);
$('#val_coin').html(currency);

  }, 100);

 });

    },100); 

}

});


					</script>