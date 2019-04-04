

<div class="table-responsive">
  


<table class="table">
<tr>
<td>Status</td>
<td>Method</td>
<td>Currency</td>
<td>Address</td>
<td>Amount</td>
<td>Convertion</td>
<td>Date</td>


</tr>

      <?php if(count($withdraw)): foreach($withdraw as $user): ?>
    
      <tr>
        <td><?php echo $user->status; ?></td>
        <td><?php echo $user->method; ?></td>
           <td><?php echo strtoupper($user->coin); ?></td>
          <td><?php echo $user->address; ?></td>
          <td><?php echo $user->amount; ?> <i class="fa fa-btc" aria-hidden="true"></i></td>
          <td><?php echo $user->convertion; ?></td>
          <td><?php echo $user->datetime; ?></td>
      </tr>
        <?php endforeach; ?>  
    <?php else: ?>
      <tr>
        <td colspan="3">No withdrawals yet.</td>
      </tr>
    <?php endif; ?>

</table>

</div>