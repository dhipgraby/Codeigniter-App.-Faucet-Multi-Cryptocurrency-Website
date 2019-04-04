<table class="table table-responsive-lg">
<tr>
	
	<td>Time</td>
	<td>Target</td>
	<td>Bet</td>
	<td>Roll</td>
	<td>Profit</td>

</tr>	


	
   <?php if(count($games)) { 
  
foreach ($games as $game) {  

$ltgt = ($game->ltgt == 1) ? '<i class="fas fa-angle-double-up"></i>' : '<i class="fas fa-angle-double-down"></i>';
  ?>


<tr>
<td><?php echo date('h:i:s', strtotime($game->datetime)); ?></td>
<td><?php echo $ltgt.$game->utarget; ?></td>
<td><?php echo $game->bet; ?></td>
<td><?php echo $game->roll; ?></td>
<td><?php echo $game->profit; ?></td>

</tr>

<?php
}
     
    }
    else {

         echo '<tr>
        <td colspan="3">No rolls.</td>
      </tr>';
    }
?>

</table>