  <?php $this->load->view('buster/components/head');
    ?>

<?php

if($this->login_m->loggedin() == TRUE){

 ?>

<script>
  
hidealert();

function hidealert() {
    setTimeout(function(){ 

$('[class="alert alert-info 2"]').fadeOut();


     }, 5000);

}

</script>
<div class="card" style="background-color:#fbb728; min-height: 50px; padding: 15px;margin-top: 10px;border-radius: 0">

<div id="balance_container" align="center">
Balances : 
<b>BTC</b><span style="margin-right: 8px;" id="btc_bal"><?php echo $btc_bal; ?>  </span>

<b>Doge</b><span id="doge_bal"> <?php echo $doge_bal; ?>  </span>

<b>Ltc</b><span id="ltc_bal"> <?php echo $ltc_bal; ?>   </span>

<b>Dgb</b><span id="dgb_bal"> <?php echo $dgb_bal; ?>   </span><br>
<small><b> <a  style="margin-right:2%;"  href="<?php echo base_url() ?>deposit"> Deposit </a> <a style="margin-left:2%;" href="<?php echo base_url() ?>withdraw"> Withdraw</a></b></small>


</div>
</div>
  <span id="reward" align="center"></span>
<?php }

else {


 ?>
<div align="center" class="mt-2">
  <img src="http://lotobitcoin.com/images/titlelogo.png" style="width:350px; height: 81px;">
</div>

<?php } ?>
    <br>

 <?php
//VIEWS OF LOGIN AND REGISTER
if(isset($loginview) && isset($register)){

?>

<span id="2fa_mod"></span>
<span id="secure_loggin"></span>


<?php
  $this->load->view($loginview);
  $this->load->view($register); 
}

?>


  <div class="container">
<div align="center">
  
  <h4><?php echo $pagetitle; ?></h4>

</div>


<?php $this->load->view($mainview); ?>

</div>
<br>
<!-- Button trigger modal

 


<div class="col-sm-2" style="margin-top: 40px;">

	<div class="card">
	<div class="card-body">
		
<h1>articles</h1>
	</div> 
   </div>
   	<div class="card">
	<div class="card-body">
		
<h1>news</h1>
	</div> 
   </div> -->


	

  <?php $this->load->view('buster/components/tail'); ?>