

  <?php 
$status = ($ticket->status == 'stock') ? new_button('Buy',$ticket->t_address,'success','onclick="buy(this.id,'.$lottery->type.','.$lottery->round.')"') : new_button('Sold',$ticket->cout,'secondary');

$check_tickect = ($this->sit_lottery_m->check_ticket($ticket->t_address,$ticket->type,$ticket->round,$ticket->coin) == TRUE) ? 'owned' : '';

   ?>
  <span id="id<?php echo $ticket->t_address; ?>"  class="cardto id<?php echo $ticket->t_address; ?>">
   <li class="list-group-item <?php if($ticket->t_address == $winner_address){ echo "submenu"; } ?>">


      <small style="float:left;">Ticket id:</small><small style="float:right;">Status: <b id="status<?php echo $ticket->t_address; ?>"><?php echo $ticket->status; ?></b></small>
      
      <br>
<p>       <b style="font-size: 18px; float:left;"><i class="fas fa-ticket-alt"></i> <?php echo $ticket->t_address ?></b><span style="float:right" name="<?php echo $ticket->t_address; ?>">  <?php echo $status; ?></span>

</p>
<h3><?php if($ticket->t_address == $winner_address){ echo "<i class='fas fa-crown'></i>"; } ?></h3>
      
<span id="ownership<?php echo $ticket->t_address; ?>" class="badge badge-dark"><?php echo $check_tickect; ?></span>
       <span class="badge badge"  style="color:#fbb728;margin:0;font-style: italic;"> + 10% winning chance</span>

<?php $ticket_let = count($this->sit_lottery_m->_ticket_left($ticket->type,$ticket->round,$ticket->coin));
if($ticket_let < 1){

  $ticket_let = 0;

}


 ?>



<script>$('#<?php echo $ticket->type ?>num').html('<?php echo $ticket_let; ?>');</script>


</script>

</li>
</span>

<?php if(isset($script)){

  echo $script;
}




 ?>