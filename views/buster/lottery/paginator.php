  <h3 class="modal-title">Round: <?php echo $page; ?></h3>
<table class="table table-responsive-lg">
  <tr>
 
  <td>Place</td>
  <td>user Id</td>
  <td>Amount Won</td>
  <td>User tickets</td>

  </tr>

   <?php if(count($winners)) { 
  
foreach ($winners as $winner) {    ?>

<tr>
<td><?php echo $winner->position; ?></td>
<td><?php echo $winner->id; ?></td>
<td><?php echo number_format($winner->amount,8); ?></td>
<td><?php echo $winner->tickets; ?></td></tr>

<?php
}
     
    }
    else {

         echo '<tr>
        <td colspan="3">No winners.</td>
      </tr>';
    }
?>

  </table>
