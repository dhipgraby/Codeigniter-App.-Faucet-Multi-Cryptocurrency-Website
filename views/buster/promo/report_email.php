<!DOCTYPE html>
<html>
<head>
	<title>Promoters Report</title>
</head>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<style type="text/css">
	
body {


font-family: 'Montserrat', sans-serif;

}

.factura {
	background:url(http://lotobitcoin.com/images/whitebg.png);border: solid #000000 1px; width: 500px;height: auto;
}

.factura-head {

background-color: #ffffff;
margin:0px;


}

</style>

<body>

<h1 style="margin-left: 50px;">Promoter <?php echo $type; ?> report</h1>

<br>

<p>This is a report from lotobitcoin promoters team. Your stats and weekly ernings.<br>
Keep promoting to incresse your profit high!</p>

<br>

<div class="factura">

<div class="factura-head" style="padding: 20px;">


<img src="http://localhost/lotobackup/images/logo.png" width="55px;" height="46px;" style="border-radius: 10px;float: right; margin: 5px;">


<h3 style="padding-left: 50px;">Your last 7 days.</h3>
	

</div>

<div style="padding:20px;padding-left: 50px;">
	

<br>
	<h4><b>Promoter Lvl: </b> <?php echo $promoter_lvl; ?></h4>
<br>
<table class="table">

<tr>
  <td>Date</td>
  <td>Valid views</td>
  <td>Paid (BTC)</td>
</tr>
<?php if(count($history)){

foreach ($history as $key) {

 ?>
<tr>
  <td><?php echo substr($key->datetime, 0, -8); ?></td>
    <td><?php echo $key->validviews; ?></td>
      <td><?php echo number_format($key->paid,8); ?></td>
</tr>
  
<?php } } else { echo 'No History to show.'; } ?>

<tr>
	
	<td><br><b>Total Views: </b><?php echo $total_views; ?></td>
	<td><br><b>Total paid: </b><?php echo $earnings; ?> (BTC)</td>
	<td><br><b>Views for next Lvl: </b><?php echo $views_left; ?></td>
</tr>


</table>

</div>


</div>



</body>

</html>
