<?php echo new_button('< First','last','secondary','onclick="paginator(this.value); next_page('.($total_pages).');" value="'.$total_pages.'"') ?>



    <span id="pages"> 
<?php

echo new_button('<b>- 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.($next_pages - 10).'"');

echo '<div class="btn-group mr-2 ml-2" role="group" aria-label="First group">';

    for($x=$page; $x<= $left_pages; $x++) {
 

  echo new_button($x,'','light','type="button" name="'.$category.'" onclick="paginator(this.value,'.$id.',this.name)" value="'.$x.'"');

  }  

  echo '</div>';


echo new_button('<b>+ 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.$next_pages.'"');



 ?>
    </span>

<?php echo new_button(' Last >','first','secondary','onclick="paginator(this.value); next_page(5);" value="1"') ?>
 

<div class="table-responsive" id="mytable">


<table class="table">
	<tr>
		<td>Datetime</td>
		<td>Type</td>
		<td>id</td>
		<td>btc</td>
		<td>doge</td>
		<td>dgb</td>
		<td>ltc</td>
		<td>advert</td>

	</tr>

<?php if(isset($transactions)){

foreach($transactions as $key) {
	# code...


 ?>
  <tr>
 	
<td><?php echo $key->datetime; ?></td>
<td><?php echo $key->type; ?></td>
<td><a href="<?php echo base_url() ?>admin/user/edit/<?php echo $key->id ?>"><?php echo $key->id; ?></a></td>
<td><?php echo $key->btc; ?></td>
<td><?php echo $key->doge; ?></td>
<td><?php echo $key->dgb; ?></td>
<td><?php echo $key->ltc; ?></td>
<td><?php echo $key->advert; ?></td>


 </tr>

<?php 

}
 
 } ?>

</table>	

</div>