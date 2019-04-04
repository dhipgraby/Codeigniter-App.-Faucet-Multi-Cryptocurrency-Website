<div class="table-responsive">
	<span id="app_result"></span>
	<p>you got a total of <?php echo $total_withdrawals; ?></p>

<table class="table">
	
	<tr>
<td>Id</td>
<td>status</td>
<td>Address</td>
<td>Txid</td>
<td>Coin</td>
<td>Datetime</td>
<td>Amount</td>
<td>#</td>


</tr>


<?php

if(count($withdraws)){

	foreach ($withdraws as $withdraw) {
		
$btn = ($withdraw->status != 'pending') ? 'success' : 'info';
$btn_name = ($withdraw->status != 'pending') ? 'Approved' : 'Proceed';


		echo '<tr><td>'.$withdraw->id.'</td>';
		echo '<td name="'.$withdraw->count.'">'.$withdraw->status.'</td>';
		echo '<td>'.$withdraw->address.'</td>';
		echo '<td><a href="https://www.blockchain.com/btc/tx/'.$withdraw->txid.'">Txid</a></td>';
		echo '<td>'.$withdraw->coin.'</td>';
		echo '<td>'.$withdraw->datetime.'</td>';
		echo '<td>'.$withdraw->amount.'</td>';
        echo '<td>'.$withdraw->count.'<td>';
        echo '<td>'.new_button($btn_name,$withdraw->count,$btn,'name="approve"').'<tr>';

	}
} else { echo 'no withdrawals address fount'; }

?>
</table>

<script>
	
	$('[name="approve"]').click(function(event){
	event.preventDefault();


var id = $(this).attr('id');
			
			$.ajax({

			url: "<?php echo base_url(); ?>admin/withdraw/approve",
			type: "POST",
			data: { id : id, },

			success: function(data) {

              	$('#app_result').html(data + '<?php echo alert_msg("Approved!","success"); ?>');
               $('[name="'+id+'"]').html('TxId');
          	   $('#'+id).removeClass('btn-info');
          	   $('#'+id).addClass('btn-success') 
          	   $('#'+id).html('approved');
          

                    
					
			
               
				}

			});

	});
</script>

	
</div>