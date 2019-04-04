<div class="cardto winner<?php echo $lottery->type; ?>">
    
   <span id="winner<?php echo $lottery->type; ?>">

    <div class="cardto__face cardto__face--front">

     <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
 
  <div class="card-body">
    <small style="float: left;"><?php


$rounds = $this->sit_lottery_m->_user_rounds($lottery->type,$lottery->coin);

echo '<span id="method">'.$Payment.'</span>';


?>   



Total rounds played<b> <?php echo count($rounds);; ?></b></small><br>


    <h4 class="card-title"><b style="font-style: italic;">Lottery type: <?php echo $lottery->type; ?></b></h4>
    <small><?php echo $lottery->players; ?> players, <?php echo number_format($lottery->perplayer,4).' '.$symbol; ?>  / per player, 1 winner</small><br><br>
    <p style="font-size: 20px; font-style: italic;" class="card-text">
      
     <i class="fas fa-trophy"></i> <b style="border-bottom: solid 2px #fbb728;color:#fbb728;text-shadow: 1px 1px 1px #000000;"> Jackpot for Winner :<br>
     <span style=" color:#000000;text-shadow: 1px 1px 2px #989DA0;"> <?php echo number_format($lottery->jackpot,4).' '.$symbol; ?></span></b><br>
     <br>



      Winner tickets:  <?php

$stock = $this->sit_lottery_m->_winner_tickets($lottery->type,$lottery->coin);
       echo '<b>'.count($stock).'</b>';

    ?>
    <br>

      Total tickets:  <?php

$tickets = $this->sit_lottery_m->_user_tickets($lottery->type,$lottery->coin);
       echo '<b>'.count($tickets).'</b>';

    ?>
<br>

    </p>



<?php if($lottery->type == 100){ ?>

<div class="form-check form-check-inline">
  <b>Payment: </b>
  
  <input class="form-check-input" type="radio" name="payment" id="balance" value="balance" <?php echo ($method == 'balance') ? 'checked' : '' ?>>
  <label class="form-check-label"><?php echo $blue ?> Balance</label>
    <input class="form-check-input" type="radio" name="payment" id="blockchain" value="address"  <?php echo ($method == 'address') ? 'checked' : '' ?>>
  <label class="form-check-label" for="inlineRadio2"><?php echo $purple ?> Address</label>
</div>


<script>
    $('[name="payment"]').click(function(event){
  event.preventDefault();

  var method = $(this).val();

      $.ajax({

      url: "<?php echo base_url(); ?>games/sit_lottery/set_method",
      type: "POST",
      data: { method : method },

      success: function(data) {

  $('#buy_result').html(data);

if(method == 'address'){

  $('#method').html('<?php echo $purple; ?>');
}


        }

      });

  });
</script>


<?php } ?>


<br><br>

 <?php if($lottery->type > 10)

{


echo (!empty($address->btc)) ? '<b>Payout address :</b>'.$address->btc.new_button('Change address','add_addr','info','onclick="open_addr()"') : new_button('Add payout address','add_addr','info','onclick="open_addr()"');
}

 ?>
  </div>

  <h4><b>Rounds:</b></h4>
  <div class="group btn">
    
    <?php echo new_button('Previews','0','info','onclick="next_page('.$lottery->type.',this.id)"  name="last'.$lottery->type.'"') ?>

    <?php echo new_button('Next page','20','info','onclick="next_page('.$lottery->type.',this.id)" name="next'.$lottery->type.'"') ?>

  </div>
  <ul class="list-group list-group-flush cardto round<?php echo $lottery->type; ?>">

<?php

 if(count($rounds)){

$this->db->order_by('round','desc')->limit(10);
$rounds = $this->sit_lottery_m->_user_rounds($lottery->type,$lottery->coin);


 foreach ($rounds as $round) { 
  
$this->data['round'] = $round;

 $winner =  $this->sit_lottery_m->_get_winner($round->type,$round->round,$lottery->coin); 

if($this->sit_lottery_m->check_ticket($winner->address,$round->type,$round->round,$lottery->coin)  == TRUE){

  $this->data['color'] = 'submenu';
}


  $this->data['winner'] = $winner;

  $this->load->view('buster/lottery/sit_lottery/single_round',$this->data);

}

} ?>

  </ul>
  <div class="card-body">
    
  </div>
</div>
    


</div>
  </span>
  </div>