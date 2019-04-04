

<table class="table" style="text-align: center">

<tr>

<td>
Nº of tickets :

</td>
<td>
<input class="form-control" onClick="totalAmount" onChange="totalAmount()" type="number" name="quantity" id="quantity" min="1" value="1">
</td>

</tr>

<tr>
    
<td><b>Pricer per ticket</b></td>
<td><input class="form-control" type="number" name="cprice" id="cprice" value="0.00000010" readonly>
</td>

</tr>

<tr>

<td><b>Total</b> </i>
</td>
<td>
<div class="input-group">

  <div class="input-group-append">
    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="coinopt" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BTC</button>
    <div class="dropdown-menu">
      <a class="dropdown-item" onclick="select_btc();">

        <img src="<?php echo base_url() ?>images/btclogo.png" style="height: 28px; width: 28px"> BTC
<?php echo form_checkbox('coin','',TRUE, 'type="checkbox" class="form-check-input" id="btc" style="margin-left:10px;"'); ?>  </a>
      
      <a class="dropdown-item" onclick="select_doge();">
        <img src="<?php echo base_url() ?>images/dogelogo.jpg" style="height: 24px; width: 24px"> DOGE 
        <?php echo form_checkbox('coin','',FALSE, 'type="checkbox" class="form-check-input" style="margin-left:10px;" id="doge"'); ?></a>

    </div>
    
  </div>
<?php echo form_input('total',number_format(config_item('lottery_ticket'),8),' readonly id="total" class="form-control"'); ?>
<div class="input-group-append">
   	<?php echo new_button('Buy','buy','dark submenu') ?>
  </div>
</div>





</td>
 
</tr>

</table>

<script type="text/javascript">

totalAmount();

function totalAmount(){

var price =  document.getElementById('cprice').value;
var currency = $('[name="coin"]:checked').attr('id');  	
document.getElementById('cprice').value = <?php echo number_format(config_item('lottery_ticket'),8); ?>.toFixed(8);
if(currency != 'btc'){

	price = <?php echo ticket_price('doge'); ?>;
	document.getElementById('cprice').value = price.toFixed(8);
}

var numbers = document.getElementById('quantity').value;

var total = numbers * price;

document.getElementById('total').value = total.toFixed(8);
}
</script>
