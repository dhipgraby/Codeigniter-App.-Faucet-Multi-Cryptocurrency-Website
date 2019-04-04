
<div align="center">
	
	  <div class="btn-group "  role="group" aria-label="Basic example">

  <button onclick="currentDiv(1)" type="button" class="btn btn-dark submenu" id="account_btn">Account</button>
  <button onclick="window.location.href = '<?php echo base_url() ?>withdraw';" type="button" class="btn btn-dark submenu" id="withdraw_btn">Withdraw</button>
  <button onclick="window.location.href = '<?php echo base_url() ?>deposit';" type="button" class="btn btn-dark submenu" id="deposit_btn">Deposit</button>
    <button onclick="window.location.href = '<?php echo base_url() ?>refer';" type="button" class="btn btn-dark submenu" id="refer_btn">Refer</button>
    

</div><br>


<script>
	
var url = $(location).attr('href');

var segments = url.split( '/' );

var seg4 = segments[3];



$('#'+seg4+'_btn').addClass('active');


if(seg4 != 'account'){


$('#account_btn').click(function(){

window.location.href = '<?php echo base_url() ?>account';

});

}




</script>


</div>

<br>