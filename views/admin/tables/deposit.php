<table class="table table-responsive">
	
	<tr>
<td>Id</td>
<td>status</td>
<td>Address</td>
<td>Txid</td>
<td>Coin</td>
<td>Datetime</td>
<td>Amount</td>
<td>Num</td>

</tr>


<?php

if(count($deposits)){

	foreach ($deposits as $deposit) {
		
		echo '<tr><td>'.$deposit->id.'</td>';
		echo '<td>'.$deposit->status.'</td>';
		echo '<td>'.$deposit->address.'</td>';
		echo '<td><a href="https://www.blockchain.com/btc/tx/'.$deposit->txid.'">Txid</a></td>';
		echo '<td>'.$deposit->coin.'</td>';
		echo '<td>'.$deposit->datetime.'</td>';
		echo '<td>'.$deposit->amount.'</td>';
		echo '<td>'.$deposit->num.'</td></tr>';


	}
} else { echo 'no deposit address fount'; }

?>
</table>