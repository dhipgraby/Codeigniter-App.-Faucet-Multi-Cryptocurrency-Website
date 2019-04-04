<?php $this->load->view('admin/addr/change_coin'); ?>

					<script>

$("#coinjs_coin").change(function(){

setTimeout(
  function() 
  {

    $('#settingsBtn').click();

var currency = $('option:selected','#coinjs_coin').attr('id');
var currency_name = $('option:selected','#coinjs_coin').attr('name');

          $.ajax({

      url: "<?php echo base_url(); ?>deposit/currency_box/" + currency,
      type: "POST",
      data: {  },

      success: function(data) {

$('#currency_box').html(data);

$('[name="currency"]').html(currency_name);

if(currency == 'btc'){

	$('#minimum').html('<?php echo config_item('btc_mindep'); ?> ' + currency);   

        }

if(currency == 'doge'){

	$('#minimum').html('<?php echo config_item('doge_mindep'); ?> ' + currency);   

        }

if(currency == 'ltc'){

  $('#minimum').html('<?php echo config_item('ltc_mindep'); ?> ' + currency);   

        }

if(currency == 'dgb'){

  $('#minimum').html('<?php echo config_item('dgb_mindep'); ?> ' + currency);   

        }


      }
});

  }, 100);

 });

					</script>