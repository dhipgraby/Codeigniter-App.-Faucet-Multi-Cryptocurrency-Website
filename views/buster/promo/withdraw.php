

<div class="modal fade hide" id="modaltransfer" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
   
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><i class="far fa-paper-plane"></i> Withdraw balance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body table-responsive">
        
<b>Promoter Balance: <?php echo $advert_bal; ?><i class="fa fa-btc" aria-hidden="true"></i></b><br>
<small>Minimum amount to transfer to address : 0.0002 <i class="fa fa-btc" aria-hidden="true"></i></small><br>
<small>Minimum amount to transfer to balance : 0.00001 <i class="fa fa-btc" aria-hidden="true"></i></small>

<br>

<p><b>Select method:</b>

<div class="btn-group">

<button name="address" onclick="set_check(this.name,'method')" class="btn btn-dark submenu">to Address: <?php echo form_checkbox('method','',FALSE, 'type="checkbox" style="margin-left:10px;" id="address"'); ?></button>
    
      <button name="balance" onclick="set_check(this.name,'method')" class="btn btn-dark submenu">to Balance: <?php echo form_checkbox('method','',TRUE, 'type="checkbox" style="margin-left:10px;" id="balance"'); ?></button>

</div>
<br>
<br>
<span id="r_address">

<?php echo $coin_list['btc']; ?>
  
</span>

</p>

<span id="check_res"></span>

<?php $this->load->view('admin/addr/settings_amd') ?>
<small>Selecting other currency than bitcoin will convert it with a 10% reduction</small>


  
<table class="table">
<tr>

    <td>Amount(<small>Amount in Bitcoin</small>): <?php echo form_input('amount', '', 'type="numeric" onkeyup="convert_coin()" class="form-control" id="amount" onkeypress="return isNumberKey(event)" '); ?>


    </td>
    <td><br><?php echo new_button('Transfer','transfer','dark submenu') ?></td>

  </tr>

<tr>
  
  <td>
<b>Convertion to <span name="coin_name"></span>:</b><br>
<?php echo form_input('convert', '', 'class="form-control w-50 mt-2" id="convert" readonly') ?><span name="coin_name"></span></td>

</tr>


</table>

<br>
<b>Withdrawal-fees:</b>
<br>
<b>To Balance: Not any fee.</b>
<p><b>To Address: </b>In order to send transaction to address, we change a little fee for miners comision. This fee will be take it from the amount you withdraw.
<br>
This are the fees: 
<table>

		<tr><td>Bitcoin : <b>0.00005 BTC</b></td></tr>
       <tr><td>Dodgecoin : <b>2 DOGE</b></td></tr>
       <tr><td>Digibyte : <b>0.1 DGB</b></td></tr>
       <tr><td>Litecoin : <b>0.001 LTC</b></td></tr>

</table>
<br>
Fees can change depending on the network miner fees.
</p>


<script type="text/javascript">

function convert_coin(){


var value = $('#amount').val();
var coin = $('option:selected','#coinjs_coin').attr('id');

if(coin == 'doge'){

var convertion = value / <?php echo $doge_convert; ?>;

$('#convert').val(parseFloat(convertion).toFixed(4)); 

}

  if(coin == 'ltc'){

      
var convertion = value / <?php echo $ltc_convert; ?>;
 $('#convert').val(parseFloat(convertion).toFixed(8)); 

  }

    if(coin == 'dgb'){

var convertion = value / <?php echo $dgb_convert; ?>;
$('#convert').val(parseFloat(convertion).toFixed(4)); 

    }

    if(coin == 'btc'){

$('#convert').val(''); 

    }


}  
  
$("#coinjs_coin").change(function(){ 


var currency_name = $('option:selected','#coinjs_coin').attr('name');

$('#val_addr').attr('placeholder','Enter a valid '+ currency_name + ' address');

var coin = $('option:selected','#coinjs_coin').attr('id');

if(coin == 'doge'){

  var inputs = '<?php echo  json_encode($coin_list['doge']); ?>';

 $('#r_address').html(inputs);
 $('[name="coin_name"]').html(currency_name);

 convert_coin();


}

  if(coin == 'ltc'){

  var inputs = '<?php echo  json_encode($coin_list['ltc']); ?>';

 $('#r_address').html(inputs);
 $('[name="coin_name"]').html(currency_name);
  convert_coin();

      
  }

    if(coin == 'dgb'){

      var inputs = '<?php echo  json_encode($coin_list['dgb']); ?>';

 $('#r_address').html(inputs);
 $('[name="coin_name"]').html(currency_name);
  convert_coin();



    }

       if(coin == 'btc'){

   var inputs = '<?php echo  json_encode($coin_list['btc']); ?>';


 $('#r_address').html(inputs);
$('[name="coin_name"]').html('');
$('#convert').val(''); 

    }



});

function set_check(id,method){

var btn = $('#'+id);

if(id == 'address'){

$('#val_addr').prop('readonly',false);

} else {

$('#val_addr').prop('readonly',true);

}

btn.prop('checked',true);

 if (btn.is(":checked")) {
  
    var group = "input:checkbox[name='"+method+"']";
    
    $(group).prop("checked", false);
    btn.prop("checked", true);
  } else {
    btn.prop("checked", false);
  }

}


$("input:checkbox[name='method']").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
  
    var group = "input:checkbox[name='method']";
    
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});





</script>


      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal"  class="btn btn-secondary">Close</button>
     
      </div>

   
    </div>
  </div>
</div>


