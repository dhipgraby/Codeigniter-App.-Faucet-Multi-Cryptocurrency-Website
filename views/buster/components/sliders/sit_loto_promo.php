
     <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
 
  <div class="card-body">
    
    <small style="float: left;">  Current round<b> <?php echo $lottery->round; ?></b></small>

    <br>
    
    <h4 class="card-title"><b style="font-style: italic;">Lottery type: <?php echo $lottery->type; ?></b></h4>
    
    <small><?php echo $lottery->players; ?> players, <?php echo $lottery->perplayer; ?> <i class="fab fa-btc"></i> / per player, 1 winner</small>

    <br><br>
    
    <p style="font-size: 20px; font-style: italic;" class="card-text">
      
     <i class="fas fa-trophy"></i> <b style="border-bottom: solid 2px #fbb728;color:#fbb728;text-shadow: 1px 1px 1px #000000;"> Jackpot for Winner :<br>
     <span style=" color:#000000;text-shadow: 1px 1px 2px #989DA0;"> <?php echo $lottery->jackpot; ?> <i class="fab fa-btc"></i></span></b><br>
     <br>

      Sits left:  <?php

$stock = $this->sit_lottery_m->_ticket_left($lottery->type,$lottery->round,'btc');
       echo new_button(count($stock),$lottery->type.'num','info');
 ?>

    </p>
 
<br>

  </div>

</div>
    

