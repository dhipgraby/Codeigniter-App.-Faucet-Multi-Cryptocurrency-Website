 <?php 

if(count($today_track)){

$chart_data .= '';
$i = 0;
for($i=0;$i < count($today_track); $i++) {

$chart_data .= "{ day:'".$today_track[$i]->datetime."', views:'".round($i/2)."', }, "; 


}


} else echo alert_msg('No data.. Promote your link and come back to see your progress...','info');



 ?>

<h3>Today views</h3>
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