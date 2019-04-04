<table class="table">
	<tr>
		<td>Datetime</td>
		<td>Type</td>
		<td>id</td>
		<td>btc</td>
		<td>doge</td>
		<td>dgb</td>
		<td>ltc</td>

	</tr>

<?php if(isset($transactions)){

foreach($transactions as $key) {
	# code...


 ?>
  <tr>
 	
<td><?php echo $key->datetime; ?></td>
<td><?php echo $key->type; ?></td>
<td><?php echo $key->id; ?></td>
<td><?php echo $key->btc; ?></td>
<td><?php echo $key->doge; ?></td>
<td><?php echo $key->dgb; ?></td>
<td><?php echo $key->ltc; ?></td>

 </tr>

<?php 

}
 
 } ?>

</table>	