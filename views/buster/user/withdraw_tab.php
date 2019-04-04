
<table class="table table-responsive-sm">
<tr>
<td>Status</td>
<td>Address</td>
<td>Currency</td>
<td>Date</td>
<td>Amount</td>

</tr>

      <?php if(count($withdraw)): foreach($withdraw as $user): ?>
    
      <tr>
        <td><?php  if($user->status !== 'pending'){echo '<a style="color:#198337;" href="https://blockchain.info/tx/'.$user->status.'">Tx-id Here</a>'; } else echo 'pending'; ?></td>
          <td><?php echo $user->addy; ?></td>
         <td><?php echo $user->currency; ?></td>
         <td><?php echo $user->datetime; ?></td>
          <td><?php echo $user->amount; ?> <i class="fa fa-btc" aria-hidden="true"></i></td>
      </tr>
        <?php endforeach; ?>  
    <?php else: ?>
      <tr>
        <td colspan="3">No withdrawals yet.</td>
      </tr>
    <?php endif; ?>

</table>