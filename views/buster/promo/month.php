 <?php 

if(count($tracker)){

$chart_data .= '';
$i = 0;
for($i=0;$i < 30; $i++) {

$chart_data .= "{ day:'".$tracker[$i]->datetime."', views:'".$tracker[$i]->validviews."', }, "; 


}

if(count($tracker) < 30){ echo alert_msg('no data for last 30 days...','info');  }

} else echo alert_msg('No of a month data.. Promote your link and wait one day...','info');



 ?>

<h3>Monthly views</h3>
<br>
 <div class="container" style="width:600px;">

   <div id="chart"></div>
  </div>

 


<script>
Morris.Area({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'day',
 ykeys:['views'],
 labels:['views'],
 hideHover:'auto',
 stacked:true
});</script>