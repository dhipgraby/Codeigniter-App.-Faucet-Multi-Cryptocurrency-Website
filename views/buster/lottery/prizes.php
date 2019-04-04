
<style type="text/css">

    td {

          text-align: center;
  vertical-align: middle;

    }

</style>

<div align="center">


<h4><b>1°</b></h4>
<br>
 <p><?php echo number_format($this->lottery_m->amount_to_share(1),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </p>

 

<div class="row justify-content-center" align="center">

  
      <div class="col-sm-3"><h4><b>2°</b></h4>
<br>
 <p><?php echo number_format($this->lottery_m->amount_to_share(2),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </p>
  </div>

           <div class="col-sm-3"><h4><b>3°</b></h4>
<br>
 <p><?php echo number_format($this->lottery_m->amount_to_share(3),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </p>

           </div>

</div>


<div class="row table-responsive">
    
<table class="table"> 
<tr>
    <td>4°</td>
        <td><?php echo number_format($this->lottery_m->amount_to_share(4),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </td>
</tr>
<tr>
    <td>5°</td>
    <td ><?php echo number_format($this->lottery_m->amount_to_share(5),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </td>
    </tr>

<tr>
<td>6°</td>
 <td ><?php echo number_format($this->lottery_m->amount_to_share(6),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </td></tr>
<tr><td>7°</td>
<td> <?php echo number_format($this->lottery_m->amount_to_share(7),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </td></tr>
<tr><td>8°</td>
<td><?php echo number_format($this->lottery_m->amount_to_share(8),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </td></tr>
<tr><td>9°</td>
    <td ><?php echo number_format($this->lottery_m->amount_to_share(9),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </td></tr>
<tr>
<td>10°</td>

    <td ><?php echo number_format($this->lottery_m->amount_to_share(10),8); ?>  <i class="fa fa-btc" aria-hidden="true"></i> </td></tr>


</table>  

</div>


 </div>

<script>
 
 $('#winners').click(function(){

 $('#modal').modal('show');

    
 });


</script>