
<table class="table table-responsive-xl">
<tr>
<td>Address</td>
<td>Coin</td>
<td>Txid</td>
<td>Date</td>
<td>Amount</td>


</tr>

      <?php if(count($deposit)): foreach($deposit as $user):

$href = ($user->coin == "btc") ? 'href="https://blockchain.info/tx/'.$user->txid.'"' : 'href="https://chain.so/tx/DOGE/'.$user->txid.'"';
$href_address = ($user->coin == "btc") ? 'href="https://www.blockchain.com/btc/address/'.$user->address.'"' : 'href="https://chain.so/address/DOGE/'.$user->address.'"'; 
       ?>
    
      <tr>
                    <td><a <?php echo $href_address; ?> target="_blank"><?php echo $user->address; ?></a></td>
                    <td><?php echo $user->coin; ?></td>
        <td><a style="color:#198337;" <?php echo $href; ?>>Tx-id Here</a></td>
         <td><?php echo $user->deposit_date; ?></td>
          <td><?php echo $user->amount; ?> <b style="color: #3CC2F6;"><?php echo $user->coin; ?></b> </td>

      </tr>
        <?php endforeach; ?>  
    <?php else: ?>
      <tr>
        <td colspan="3">No deposits yet.</td>
      </tr>
    <?php endif; ?>

</table>