<table class="table table-responsive">
	
	<tr>

<td>Id</td>
<td>Promoter lvl</td>
<td><i class="far fa-eye"></i>Total Views</td>
<td><i class="fas fa-coins"></i> Advert</td>
<td>Datecreate</td>
<td></td>


</tr>


<?php

if(count($promoters)){

	foreach ($promoters as $promoter) {
		
		$btn = new_button('<i class="fas fa-chart-area"></i> Watch stats',$promoter->id,'dark submenu');

$info = $this->tracker_m->_promoter_info($promoter->id);
$views = $info['views'];
$paid = $info['paid'];

		echo '<tr><td>'.$promoter->id.'</td>';
		echo '<td>'.$promoter->boost.'</td>';
		echo '<td>'.$views.'</td>';
		echo '<td>'.number_format($paid,8).'</td>';
		echo '<td>'.$promoter->datetime.'</td>';
		echo '<td>'.anchor(base_url().'admin/promoters/user_stats/'.$promoter->id,'<i class="fas fa-chart-area"></i> Watch stats','class="btn btn-dark submenu"').'</td></tr>';


	}
} else { echo 'no promoter address fount'; }

?>
</table>