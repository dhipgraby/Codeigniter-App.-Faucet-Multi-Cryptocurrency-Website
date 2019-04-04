
  
  <h2>Lottery dashboard</h2>

<br>

<h4>Current round : <?php echo $current_round->round;?></h4>

<table class="table table-responsive">
  <tr>
        <td><b>Start</b></td>
    <td><b>End</b></td>
    <td><b>Tickets in game</b></td>
    <td><b>Tickets-sells</b></td>
  </tr>

  <tr>
    <td> <?php echo $current_round->start;?></td>
    <td> <?php echo $current_round->end;?></td>
    <td><?php echo $all_tickets; ?></td>
    <td><?php echo $t_purchases; ?></td>
    <td></td>


  </tr>
</table>



<br>
<h3>Last Ticket purchases</h3>
<table class="table table-responsive">
  <tr>
    <td><b>Id</b></td>
     <td><b>Item</b></td>
    <td><b>Qty</b></td>
      <td><b>coin</b></td>
    <td><b>Price</b></td>
    <td><b>Date</b></td>
    <td><b>Spend</b></td>
  </tr>

<?php if(count($purchases)) {

foreach ($purchases as $key) {  

$coin = ($key->coin == 'btc') ? ' <i class="fa fa-btc" aria-hidden="true">' : ' <b>doge</b>';

  ?>
<tr>
  <td><?php echo $key->id; ?></td>
    <td><?php echo $key->item; ?></td>
    <td><?php echo $key->quantity; ?></td>
        <td><?php echo $key->coin; ?></td>
      <td><?php echo $key->price; ?></td>
        <td><?php echo $key->datetime; ?></td>
          <td><?php echo number_format($key->price * $key->quantity,8).$coin; ?></i></td>
          </tr>

<?php } } else { echo 'no purchases'; } ?>

</table>

<h3>Last Lotteries</h3>
<table class="table table-responsive">
  <tr>
    
<td><b>Round</b></td>
<td><b>End</b></td>
<td><b>Total Tickets</b></td>
<td><b>Total Players</b></td>


  </tr>

<?php if(count($purchases)) {

foreach ($last_rounds as $round) {  ?>
<tr>
<td><?php echo $round->round; ?></td>
    <td><?php echo $round->end; ?></td>
      <td><?php echo $round->tot_tickets; ?></td>
        <td><?php echo $round->players; ?></td>
</tr>

<?php } } else { echo 'no records'; } ?>




</table>

