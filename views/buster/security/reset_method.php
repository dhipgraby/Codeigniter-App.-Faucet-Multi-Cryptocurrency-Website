<table>
	<tr>

<td>New <?php echo $method; ?></td>
	<td><?php echo form_password('new_'.$method, '', 'class="form-control" id="new_'.$method.'" '); ?></td></tr>
	<tr>

<td>Confirm new <?php echo $method; ?></td>
	<td><?php echo form_password($method.'_confirm', '', 'class="form-control" id="'.$method.'_confirm" '); ?></td></tr>
	<tr><td><button class="btn btn-primary" id="change">Save</button>
</td></tr>

</table>


<script>
	
	$('#sec_method').slideUp(1000);


		$('#change').click(function(event){
	event.preventDefault();


var new_<?php echo $method; ?> = $('input#new_<?php echo $method; ?>').val();
var <?php echo $method; ?>_confirm = $('input#<?php echo $method; ?>_confirm').val();

			$.ajax({

			url: "reset_method/<?php echo $method; ?>",
			type: "POST",
			data: { new_<?php echo $method; ?> : new_<?php echo $method; ?>, <?php echo $method; ?>_confirm : <?php echo $method; ?>_confirm  },

			success: function(data) {

					
			    $('#message').html(data);

				}

			});

	});

</script>