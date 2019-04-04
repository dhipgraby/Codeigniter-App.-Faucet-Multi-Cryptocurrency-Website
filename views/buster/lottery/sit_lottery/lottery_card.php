 <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">

  <div class="card-body">
    <small style="float: left;"> Current round<b> <?php echo $current_lottery->round; ?></b></small><br>
    <h4 class="card-title"><b style="font-style: italic;">Lottery type: <?php echo $current_lottery->type; ?></b></h4>
    <small><?php echo $current_lottery->players; ?> players, <?php echo $current_lottery->perplayer; ?> <i class="fab fa-btc"></i> / per player, 1 winner</small><br><br>
    <p style="font-size: 20px; font-style: italic;" class="card-text">
      
     <i class="fas fa-trophy"></i> <b style="border-bottom: solid 2px #fbb728;color:#fbb728;text-shadow: 1px 1px 1px #000000;"> Jackpot for Winner :<br>
     <span style=" color:#000000;text-shadow: 1px 1px 2px #989DA0;"> <?php echo $current_lottery->jackpot; ?> <i class="fab fa-btc"></i></span></b><br>
     <br>
      Sits available:  <?php

$stock = $this->sit_lottery_m->_ticket_left($current_lottery->type,$current_lottery->round,$current_lottery->coin);
       echo new_button(count($stock),$current_lottery->type.'num','info'); ?><br>
      

    </p>
  </div>
  <ul class="list-group list-group-flush">
<?php

$tickets = $this->sit_lottery_m->_ticket_array($current_lottery->type,$current_lottery->round,$current_lottery->coin);

 if(count($tickets)){

foreach ($tickets as $ticket) {
  
$status = ($ticket->status == 'stock') ? new_button('Buy',$ticket->t_address,'success',' onclick="buy(this.id,'.$current_lottery->type.')"') : new_button('Sold',$ticket->cout,'secondary');
   ?>

   
    <li class="list-group-item">

      <small style="float:left;">Ticket id:</small><small style="float:right;">Status: <b id="status<?php echo $ticket->t_address; ?>"><?php echo $ticket->status == 'sold' ? 'Sold' : 'Available'; ?></b></small>
      
      <br>
       <b style="font-size: 18px; float:left;"><i class="fas fa-ticket-alt"></i> <?php echo $ticket->t_address ?></b><span style="float:right" name="<?php echo $ticket->t_address; ?>">  <?php echo $status; ?></span>
      <p style="margin:0;color:#fbb728;font-style: italic;">+ 10%</p> winning chance</li>

<?php 

}

} ?>
  </ul>
  <div class="card-body">
   
  </div>
</div>