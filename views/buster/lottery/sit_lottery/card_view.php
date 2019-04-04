<div class="cardto winner<?php echo $lottery->type; ?>">
    
   <span id="winner<?php echo $lottery->type; ?>">

    <div class="cardto__face cardto__face--front">

     <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
 
  <div class="card-body">
    <small style="float: left;"><?php


echo $Payment;
?>   Current round<b> <?php echo $lottery->round; ?></b></small><br>
    <h4 class="card-title"><b style="font-style: italic;">Lottery type: <?php echo $lottery->type; ?></b></h4>
    <small><?php echo $lottery->players; ?> players, <?php echo number_format($lottery->perplayer,4).' '.$symbol; ?> </i> / per player, 1 winner</small><br><br>
    <p style="font-size: 20px; font-style: italic;" class="card-text">
      
     <i class="fas fa-trophy"></i> <b style="border-bottom: solid 2px #fbb728;color:#fbb728;text-shadow: 1px 1px 1px #000000;"> Jackpot for Winner :<br>
     <span style=" color:#000000;text-shadow: 1px 1px 2px #989DA0;"> <?php echo number_format($lottery->jackpot,3).' '.$symbol; ?></span></b><br>
     <br>

<?php if(empty($lottery->address)){

 ?>

      Sits available:  <?php

$stock = $this->sit_lottery_m->_ticket_left($lottery->type,$lottery->round,$lottery->coin);
       echo new_button(count($stock),$lottery->type.'num','info');


} else { ?>


<h3 style="color:#fbb728;font-style:italic;text-shadow:1px 1px 1px #000000;"><i class="fas fa-crown"></i> Winner is : <h3 style="color:#000000"><i class="fas fa-ticket-alt"></i> <?php echo $lottery->address; ?></h3></h3>

<?php }
         ?>
      

    </p>
  </div>
  <ul class="list-group list-group-flush">
<?php
$this->data['lottery'] = $lottery;
$this->data['winner_address'] = $lottery->address;
 $this->load->view('buster/lottery/sit_lottery/ticket_status',$this->data) ?>

  </ul>
  <div class="card-body">
    
  </div>
</div>
    


</div>
  </span>
  </div>