

<div class="modal fade hide" id="modalcalc" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
   
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-calculator"></i> Profit Calculator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

<p><br>
A valid view is a unique IP visiting our site, from the referral or promoter URL.<br>
We count the unique IP once in a day. Thats mean, you get paid for a unique visitor, once every 24 hours. 
	<br>

	<br>
<b>Earn per each view depending on your promoter lvl.</b>
	</p>

<table class="table">
	<tr>
		<td>Lvl</td>
		<td>Bonus</td>
		<td><i class="far fa-eye"></i> Paid per view</td>
	</tr>
 <tr onclick="calc_percent(0.4)" style="cursor: pointer;">
 <td><i class="fas fa-user"></i> Beginner</td>
 <td></td>	
  <td><b>0.4 satoshi</b></td>
 </tr>
  <tr  onclick="calc_percent(0.6)" style="cursor: pointer;">
 <td><i class="fas fa-user-graduate"></i> Amateur</td>
 <td style="color:#42B2F1;">+25%</td>	
  <td><b>0.6 satoshi</b></td>
  </tr>
  <tr onclick="calc_percent(0.8)"  style="cursor: pointer;">
 <td><i class="fas fa-user-tie"></i> Expert</td>
 <td style="color:#42B2F1;">+50%</td>	
  <td><b>0.8 satoshi</b></td>
 </tr>
  <tr onclick="calc_percent(1)"  style="cursor: pointer;">
 <td ><i class="fas fa-user-secret"></i> Professional</td>
 <td style="color:#42B2F1;">+75%</td>
  <td><b>1 satoshi</b></td>
 </tr>
  
</table>
<br>

Views : <input type="number" name="views" class="form-control" id="validviews" onkeyup="convert_views()" value="1000"><br>
BTC paid in satoshis:  <input type="number" name="views" class="form-control"  id="paid" readonly>

      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal"  class="btn btn-secondary">Close</button>
     
      </div>

   
    </div>
  </div>
</div>
<script type="text/javascript">
	
convert_views();
  
function convert_views(){

var views = $('#validviews').val();

var btcpaid = Number(views) * 0.4;

$('#paid').val(btcpaid);

}

 function calc_percent(num){

var views = $('#validviews').val();

var btcpaid = Number(views) * num;

$('#paid').val(btcpaid);


 }

</script>