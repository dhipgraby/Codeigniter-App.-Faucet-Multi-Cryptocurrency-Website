
<style>
  
.form-control {

text-align :center;

}


</style>

<div class="card" align="center">

  <div class="card-body">



<div class="btn-group m-2" role="group" aria-label="First group">
 
 <?php echo new_button('Manual Bet', 'manual_set', 'dark submenu btn-lg','onclick="currentDiv(1)"'); ?> 
<?php echo new_button('Auto Bet', 'auto_set', 'dark btn-lg', 'onclick="currentDiv(2)"'); ?>

</div>

<div class="container">
  <div class="row">
    <div class="col-sm">
      <h4>Winnig Counter</h4><br>

      <?php echo new_button('<h2 id="winning">0</h2>','','light'); ?>
      <br>
      <small>Profit = <b id="profit">0</b> BTC</small>
    </div>

    <div class="col-sm">

 <h2>Lucky numer</h2>
<?php echo new_button('<h1 id="luckyNum">00</h1>','','light btn-bloc'); ?>

<br>
<br>
     <span id="diceresult"><?php echo alert_msg('Wellcome to Lotodice','info'); ?></span>
<div class="form-check form-check-inline">
  <div class="custom-control custom-checkbox">

  <p>BTC:  <?php echo form_checkbox('coin','',TRUE, 'type="checkbox" class="form-check-input" id="btc"'); ?>
   DOGE:  <?php echo form_checkbox('coin','',FALSE, 'type="checkbox" class="form-check-input" id="doge"'); ?></p>  

</div></div>
<a class="list-group-item list-group-item-action" onclick="Max()" style="cursor:pointer;"><span id="c_balance"><?php echo $btc_bal; ?></span>

</a>

      </div>

   
    <div class="col-sm">
        <h4>Loss Counter</h4><br>
              <?php echo new_button('<h2 id="losses">0</h2>','','light'); ?>
                 <br>
      <small>Losses = <b id="lost">0</b> BTC</small>
    </div>
  </div>
</div>
    


  </div>
  <div class="card-footer">
    

<br>
<div class="mySlides"><?php $this->load->view('buster/dice/manual_bet'); ?></div>
<div class="mySlides"><?php $this->load->view('buster/dice/auto_bet'); ?></div>


<?php $this->load->view($dice_script); ?>




  </div>

</div>
<br>
<div class="card">

  <div class="card-body" style="background-color: #fbb728 ;">

<h3 class="m-3">Previous Games</h3>

</div>


<div class="card-footer">
  
<span id="table_bet">
<?php $this->load->view($subview); ?>
  
</span>
  
</div>

</div>



<script>

var slideIndex = 1;
showDivs(slideIndex);

var myIndex = 0;
//carousel();

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }

  x[slideIndex-1].style.display = "block";
 
}


</script>