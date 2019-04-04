	
<?php echo $this->load->view('admin/addr/settings_amd'); ?>

					<div class="tab-pane tab-content" id="verify">
						

<?php echo $this->load->view('admin/addr/verify'); ?>

<!-- 
						<h2>Create Address</h2>
						<br>

						
						<p>Pubk: <span id="mynewaddr"></span></p><br>
						<p>timejs: <span id="timejs"></span></p><br>
						<p>timephp: <?php
$myt = time();
						 echo $myt; ?><br>
<?php echo date('d-m-y h:i', $myt + 3600); ?>
						</p><br>
						<p>timeaddr: <span id="timeaddr"></span></p><br>
						<p>timescr: <span id="timescr"></span></p><br>
					    <p>script info: <span id="infoscr"></span></p><br> 
						<span id="myresult"></span>
						<button id="getaddr" class="btn btn-success">Get Addr</button>-->
						<div class="row" id="index_check">
						
<?php $this->load->view('admin/addr/index_check'); ?>

              	</div>
					</div>

<script>



/*

CREATE A NEW TIME ADDRESS AND POST THE DETAILS

var addr_arr = coinjs.newKeys();

var pubaddr = addr_arr.pubkey;

var d = new Date() / 1000;
var timejs = d;

var time_addr = coinjs.simpleHodlAddress(pubaddr,timejs);

var script = coinjs.script();
var decode = script.decodeRedeemScript(time_addr.redeemScript);

$('#timeaddr').html(time_addr.address);

$('#timescr').html(time_addr.redeemScript);

$('#timejs').html(timejs);

$('#mynewaddr').html(pubaddr);

$('#infoscr').html(decode.checklocktimeverify);
*/

</script>
					<script>
						$(document).ready(function(){

$('#verifyBtn').click();
						 });
			
					</script>

