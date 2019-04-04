
<div class="card" align="center">

  <div class="card-body">


<div class="row table-responsive">

<!--  COLUM MIDDLE-->
		
<table style="text-align: center;" align="center">

<br>    
<tr><td>
<div class="img-thumbnail w-100" style="margin-right: 8px; padding: 15px;">

      <img style="width:100px; height: 100px;" src="<?php echo base_url() ?>img/coins/btclogo.png">
<br>
<small><b>Bitcoin</b>
<br>

</small>
<br>
<label class="switch">
<?php echo form_checkbox('coin','',TRUE, ' id="btc"'); ?><span class="slider round"></span></label>
<br>

<b>Reward:</b>
<br>
<?php echo number_format(config_item('btc_reward'),8); ?> BTC
</div>

   </td>


<td>
    
<div class="img-thumbnail w-100" style="margin-left: 8px; padding: 15px;">

      <img style="width:100px; height: 100px;" src="<?php echo base_url() ?>img/coins/dogelogo.png">
<br>
<small><b>Dogecoin</b>
<br>

</small>
<br>
<label class="switch">
<?php echo form_checkbox('coin','',FALSE, ' id="doge"'); ?><span class="slider round"></span></label>
<br>

<b>Reward:</b>
<br>
<?php echo number_format(faucet_reward('DOGE'),8); ?> DOGE
</div>

</td>


<td>
    
<div class="img-thumbnail w-100" style="margin-left: 8px; padding: 15px;">

      <img style="width:100px; height: 100px;" src="<?php echo base_url() ?>img/coins/digibyte.png">
<br>
<small><b>Digibyte</b>
<br>

</small>
<br>
<label class="switch">
<?php echo form_checkbox('coin','',FALSE, ' id="dgb"'); ?><span class="slider round"></span></label>
<br>

<b>Reward:</b>
<br>
<?php echo number_format(faucet_reward('DGB'),8); ?> DGB
</div>

</td>




<td>
    
<div class="img-thumbnail w-100" style="margin-left: 8px; padding: 15px;">

      <img style="width:100px; height: 100px;" src="<?php echo base_url() ?>img/coins/ltc.png">
<br>
<small><b>Litecoin</b>
<br>

</small>
<br>
<label class="switch">
<?php echo form_checkbox('coin','',FALSE, ' id="ltc"'); ?><span class="slider round"></span></label>
<br>

<b>Reward:</b>
<br>
<?php echo number_format(faucet_reward('LTC'),8); ?> DGB
</div>

</td>




</tr>

</table>


</div>


</div>
<br>

<div class="countimer"></div>

 </div>

 <div class="card-footer" align="center">
 	<span id="hash_result"></span>
<h2> <?php echo $claim_btn; ?> </h2>


 </div>

</div>
<!--END HERE -->


<br>



<?php if(isset($faucet_timecheck)){ $this->load->view($faucet_timecheck); } ?>
