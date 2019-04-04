  <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
 
  <div class="card-body">
    <small style="float: left;"> Current round<b> <?php echo $lottery->round; ?></b></small><br>
    <h4 class="card-title"><b style="font-style: italic;">Lottery type: <?php echo $lottery->type; ?></b></h4>
    <br><h3>Round <?php echo $lottery->round; ?> is finished.</h3><br>
    <p style="font-size: 20px; font-style: italic;" class="card-text">
      
     <i class="fas fa-trophy"></i> <b style="border-bottom: solid 2px #fbb728;color:#fbb728;text-shadow: 1px 1px 1px #000000;"> Jackpot for Winner :<br>
     <span style=" color:#000000;text-shadow: 1px 1px 2px #989DA0;"> <?php echo number_format($lottery->perplayer,4).' '.$symbol;  ?> </i></span></b><br>
  
    </p>
    <ul class="list-group list-group-flush">
      <?php echo $message; ?>
    </ul>
  </div>

</div>