<script>
function paginator(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint2").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>lottery/paginator?page="+str, true);
  xmlhttp.send();
}

function next_page(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pages").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>lottery/pages?page="+str, true);
  xmlhttp.send();
}
</script>

<br>
<div align="center" style="background-color: #f3f3f3;">

<div class="row" style="padding: 3%;">

<!--  SIDEBAR PRIZES -->  
  <div class="col-sm-6" style="padding: 10px;">

  <?php if($this->login_m->loggedin() == TRUE){  ?>

<h4><i class="fas fa-ticket-alt"></i> Your user Id : <span class="btn dark submenu"><b><?php echo $playerID; ?></b></span></h4>

  <?php } ?>
<br>
<h4 style="color:#7B7A7A;font-style: italic;">
Winners of this lottery Round, will receive a email with the winner notification and


 get Paid directly to lotobitcoin balance or address you specify in the email</h4>
<br>
<h4><b>Reward to share for Lottery Round <?php echo $rounder; ?>.</b></h4>
<div style="background-color: #d4d2d2;padding: 10px;">
   <span id="prizes">
 <?php $this->load->view('buster/lottery/prizes'); ?> 
</span>


</div>
   
</div>







<!--  SIDEBAR STATS -->  
  <div class="col-sm-6" style="padding: 10px;">
  <h4><b>Stats</b></h4>
<div style="background-color: #d4d2d2;">

    <span id="stats">
          <?php $this->load->view('buster/lottery/stats') ?>
   </span>


</div>

  <h4><b>Buy tickets</b></h4>
<span id="buy_result"><?php if (isset($finish_message)){ echo $finish_message; } ?></span>
<div style="background-color: #d4d2d2;">
<!--  BUY TICKETS -->  

  <?php if($this->login_m->loggedin() == TRUE){ 

$this->load->view('buster/lottery/buy_tickets');  

   } ?></div>

  <h4>Round <?php echo $rounder; ?> will conclude in: </h4>
<!--  SIDEBAR NEXT ROUND-->
<div style="background-color: #d4d2d2; padding: 15px;">

<span id="status"></span>

<div class="countimer" style="padding: 10px;"></div>

<script>

var checklock = <?php echo (strtotime($time_left)) * 1000;  ?>;

    var cd = new Countdown({
        cont: document.querySelector('.countimer'),
        endDate: checklock,
        outputTranslation: {
            year: 'Years',
            week: 'Weeks',
            day: 'Days',
            hour: 'Hours',
            minute: 'Minutes',
            second: 'Seconds',
        },
        endCallback: null,
        outputFormat: 'day|hour|minute|second',
    });
    cd.start();

</script>
<?php $this->load->view('buster/lottery/settings') ?>
</div>


</div>




</div>


<br>
<header style="background-color: #fbb728; min-height:60px; padding: 10px;"><h4>Winners</h4></header>
 <br>
 <!-- This is the modal to pullout info -->
<?php $this->load->view('buster/lottery/winners'); ?>
<!-- END OF MODAL -->


</div>



