
<style type="text/css">
  
.mytitle {
    font-style: italic;
    font-size: 40px;
color:#fbb728;text-shadow: 1px 1px 1px #000000;
}

.mytitle-mid {
 
    font-style: italic;
    color:#fbb728;text-shadow: 1px 1px 1px #000000;
    

}


.mysharebox {

    
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

</style>

<div class="card text-center mysharebox">
  <div class="card-header">
    <b style="color:#6c757d;">Lets work together.</b>
  </div>
  <div class="card-body">
    <h1 class="card-title mytitle mt-3">Share and Earn!</h1>
    <p style="font-size: 25px;" class="card-text"><i class="fas fa-coins"></i> <b style="font-style: italic;font-size: 30px;">Build a Huge passive income with us.</b>
      <br>
    
Become a promoter and get daily payments.<br>
Earn crypto-currency for each visit your referral link (URL) receive!


    </p>
    <br>
    <div align="center">
    <table>
      <tr>
     <td> <img style="width:60px; height: 60px; margin:5px;" src="<?php echo base_url() ?>img/coins/btclogo.png"></td>
     <td> <img style="width:60px; height: 60px; margin:5px;" src="<?php echo base_url() ?>img/coins/dogelogo.png"></td>
     <td> <img style="width:60px; height: 60px; margin:5px;" src="<?php echo base_url() ?>img/coins/digibyte.png"></td>
     <td> <img style="width:60px; height: 60px; margin:5px;" src="<?php echo base_url() ?>img/coins/ltc.png"></td>
      </tr>
    </table>
    </div>
   
    <br>
  <?php $this->load->view('buster/promo/calculator'); ?>

   <div class="btn-group">
    
    <a style="font-size: 20px;" href="<?php echo base_url() ?>article/13/become" class="btn btn-dark submenu">How its work?</a>
    <?php echo new_button('<i class="fas fa-calculator"></i> Profit Calculator','profit','dark submenu','onclick="open_calc()" style="margin-left:5px;"') ?>
    </div>
<script type="text/javascript">
  
function open_calc(){

    $('#modalcalc').modal('show');
  }

</script>


  </div>
  <div class="card-footer text-muted">
    Share is easy. Monetize yourself
  </div>
 
</div>
<div class="row mt-4">
  <div class="col-sm-6">
    <div class="card mysharebox">
      <div class="card-body">
          <h2><i class="fas fa-user-tie"></i></h2> 
        <h3 class="card-title mytitle-mid">Become a promoter today!</h3>
        <p class="card-text">Now everyone can work with lotobitcoin by just sharing your referral link (URL).<br>
        When someone access to Lotobitcoin.com using your referral Link, you will receive a payment for that visitor.</p>
        <a href="<?php echo base_url() ?>article/13/become" class="btn btn-dark submenu"><b>Become a promoter</b></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card mysharebox">
      <div class="card-body">
        <h2><i class="far fa-eye"></i></h2>    
        <h3 class="card-title mytitle-mid"> How to get thousands views/visits?  </h3>
          
        <p class="card-text">We show you the way to promote yourself for FREE as far as you wish.<br>
        Get thousands daily views is easy and not required investment or too much time.
      Learn from our <a href="<?php echo base_url() ?>article/14/autoguide">Autotraffic guide</a>. One click and wait for incomes.</p>
        <a href="<?php echo base_url() ?>article/14/autoguide" class="btn btn-dark submenu"><b>Get Views/Visitors</b></a>
      </div>
    </div>
  </div>
</div>
