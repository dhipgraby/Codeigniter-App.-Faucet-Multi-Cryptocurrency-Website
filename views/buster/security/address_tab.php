
<table class='table table-responsive-sm'>
	<?php if(isset($addr_list)){ ?> 
	<tr>

<td>Currency</td>
<td>Address</td>
<td>Label</td>
<td>Date-create</td>
</tr>

<tr>
<?php foreach ($addr_list as $key) { ?>
<td><?php echo $key->coin; ?></td>
<td><?php echo $key->address; ?></td>
<td><?php echo $key->label; ?></td>
<td><?php echo $key->datetime; ?></td>
</tr>

<?php } } else { ?>

<tr><td>Empty Address book</td></tr>

<?php  } ?>
</table>

