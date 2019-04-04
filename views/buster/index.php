
<div class="row">
  <div class="col-sm-12">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol  class="carousel-indicators">
   <!-- INDICATORS LINES -->
  </ol>
  <div class="carousel-inner" style="align-items: center;">
    
 <div class="carousel-item active">   
<div class="card text-center mysharebox">
  <div class="card-header">
    <b style="color:#6c757d;">Lets work together.</b>
  </div>
  <div class="card-body">
    <h1 class="card-title mt-3" style="color:#fbb728;text-shadow: 1px 1px 1px #000000;font-style: italic;">Share and Earn!</h1>
    <p style="font-size: 25px;" class="card-text"><i class="fas fa-coins"></i> <b style="font-style: italic;font-size: 30px;">Build a Huge passive income with us.</b>
      <br>
    
Become a promoter and get daily payments.<br>
Earn crypto-currency for each visit your referral link (URL) receive!


    </p>
    <a style="font-size: 20px;" href="<?php echo base_url() ?>work" class="btn btn-dark submenu">How its work?</a>
  </div>
  <div class="card-footer text-muted">
    Share is easy. Monetize yourself
  </div>
 
</div></div>
    <div class="carousel-item">
     <div class="card text-center mysharebox">
  <div class="card-header">
    <b style="color:#6c757d;font-style: italic;">Just 10 Tickets, 1 Winner!</b>
  </div>
  <div class="card-body">
    <h1 class="card-title mt-3" style="font-style: italic;color:#fbb728;text-shadow: 1px 1px 1px #000000;"><i class="fas fa-rocket"></i>  New Sit and Go Lottery!</h1>
    <p style="font-size: 25px;" class="card-text"><b style="font-style: italic;font-size: 30px;">
     Just 10 players, 1 winner for the Jackpot!<br>
   Get your ticket and join to a jackpot per game.</b>
      <br>
    



    </p>
    <br>

    <a style="font-size: 20px;" href="<?php echo base_url() ?>packs" class="btn btn-dark submenu">Watch the Christmas Packs</a>
  </div>
  <div class="card-footer text-muted">
    Play with 1 or more Tikets, Earn x9 profit
  </div>
 
</div>
    </div>
        <div class="carousel-item">
     <div class="card text-center mysharebox">
  <div class="card-header">
    <b style="color:#6c757d;font-style: italic;">claim every 30 minutes!</b>
  </div>
  <div class="card-body" align="center">
    <h1 class="card-title mt-3" style="font-style: italic;color:#fbb728;text-shadow: 1px 1px 1px #000000;"><i class="fas fa-rocket"></i> Claim coins from faucet every 30 minutes!</h1>
    <p style="font-size: 25px;" class="card-text">
      <table><tr>
     <td> <img style="width:60px; height: 60px; margin:5px;" src="<?php echo base_url() ?>img/coins/btclogo.png"></td>
     <td> <img style="width:60px; height: 60px; margin:5px;" src="<?php echo base_url() ?>img/coins/dogelogo.png"></td>
     <td> <img style="width:60px; height: 60px; margin:5px;" src="<?php echo base_url() ?>img/coins/digibyte.png"></td>
     <td> <img style="width:60px; height: 60px; margin:5px;" src="<?php echo base_url() ?>img/coins/ltc.png"></td>
      </tr></table><br>
      <b style="font-style: italic;">
   + 1 free lottery ticket per claim.</b>

    </p>
    <br>


  </div>
  <div class="card-footer text-muted">
   Claim and join to free weekly jackot.
  </div>
 
</div>
    </div>

    
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span  style="background-color: #000000;" class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span style="background-color: #000000;" class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
</div>

<!--
// CLOSE OF DIV CONTAINER
-->
</div>

<br>
<div class="container" align="center">
<h2 style="font-style: italic;"><i class="fas fa-rocket"></i> Available Sit and Go Lotteries</h2><br>
     <div class="col-sm-12"><div class="row">

<?php foreach ($lotteries as $lottery) {

$this->data['lottery'] = $lottery;
 ?>

      <div class="col-sm-4"><?php $this->load->view('buster/components/sliders/sit_loto_promo',$this->data); ?></div>

<?php 

} ?>

  </div>

</div></div>
<br>



<br>
 <div class="col-sm-12" style="background-color: #fbb728;height: 50px;padding: 5px;"> 
   <h3 align="center">About us</h3>
 </div>

<br>
<div class="container">
  

<?php $this->load->view('buster/about'); ?>


</div>

<!--
</div>

  <div class="col-sm-4">

<div class="card" align="center">
  
<div class="card-header"><h4>NEWS section</h4></div>

<div class="card-body"></div>
<p>lastes news and updates</p>
</div>

    </div>
</div>

-->
