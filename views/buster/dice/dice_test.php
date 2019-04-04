
<div align="center">

<?php echo alert_msg('<b>Wellcome</b> to Lotodice! Doble your crypto-balance! <br>
This is a demo of the site dicegame. You play with a demo balance to discover new strategies to doble your coins<br>
Register to claim from faucet and playing real!','info') ?>




<style>
  
.form-control {

text-align :center;

}

td { margin : 5px; }


.auto_item {

  display: none;
}

</style>



<div class="btn-group m-2" role="group" aria-label="First group">
 
 <?php echo new_button('Manual Bet', 'manual_set', 'dark submenu btn-lg','onclick="change_off();"'); ?> 
<?php echo new_button('Auto Bet', 'auto_set', 'dark btn-lg', 'onclick="change_on();"'); ?>

</div>
<br>
  <div class="form-check form-check-inline">
  <div class="custom-control custom-checkbox">

  <p><span id="test_btc">0.05000000</span>
    <img src="<?php echo base_url() ?>images/btclogo.png" style="height: 28px; width: 28px"> BTC:  <?php echo form_checkbox('coin','',TRUE, 'type="checkbox" class="form-check-input" id="btc"'); ?>

   <span id="test_doge">10000</span>
   <img src="<?php echo base_url() ?>images/dogelogo.jpg" style="height: 24px; width: 24px"> DOGE:  <?php echo form_checkbox('coin','',FALSE, 'type="checkbox" class="form-check-input" id="doge"'); ?></p>  

</div>
 </div>

  </div>
<div class="card" align="center">

  <div class="card-body">


<div class="container sm-12" align="center">
  <div class="row">

    <!-- FIRST  BLOCK -->
    <div class="col-sm" align="center">
      <div class="row">
  
        <div class="col"  style="max-width: 100%;"><b>Winning Counter</b><br>

      <?php echo new_button('<p id="winning">0</p>','','light'); ?>
      <br>
      <small>Profit = <b id="profit">0</b></small></div>
       
              <div class="col" style="max-width: 100%;"><b>Losses Counter</b><br>

      <?php echo new_button('<p id="losses">0</p>','','light'); ?>
      <br>
      <small>Lost = <b id="lost">0</b></small></div>


      </div>
<br>
<div class="row">
  <div class="col">
<div class="form-row align-items-center">
    <div class="col">
       <div class="btn-group m-2" role="group" aria-label="First group">   

     <?php echo new_button('x2', 'doublebet','light', 'onClick="double()" type="button"'); ?>
     <?php echo new_button('Half', 'minbet','light', 'onClick="half()" type="button"'); ?>
     <?php echo new_button('Max', 'maxbet','light', 'onClick="Max()" type="button"'); ?>
     <?php echo new_button('Min', 'minbet','light', 'onClick="Min()" type="button"'); ?>

</div>
<table><tr><td><b>BET</b></td>

<td><b>/</b></td>

  <td><b>PROFIT</b></td></tr></table>
      <div class="input-group">

      
      <?php echo form_input('bet', '100', 'class="form-control" id="bet2" onchange="btcConvert(this); noteLimit(this, 6)" onkeyup="btcConvert(this); noteLimit(this, 6)" onkeydown="noteLimit(this, 6);"'); ?>
             <div class="input-group-prepend" style="width: 30%;">
               
         <input class="form-control input-group-text" id="reward_profit" value="0" readonly></div>
        </div>
      </div>
    </div></div>

     </div>



<br>

 <span name="autobet_item" class="auto_item">
<div class="row">
  
<div class="col">

                  <b>Base bet:<?php echo form_input('bet', '100', 'class="form-control" id="base_bet" onchange="btcConvert(this); noteLimit(this, 6)" onkeyup="btcConvert(this); noteLimit(this, 6)" onkeydown="noteLimit(this, 6);"'); ?> </b>
                </div>
              
                <div class="col">
                   
            <b>N°Rolls :
            <?php echo form_input('auto_bet','50', 'class="form-control" id="auto_bet"'); ?> </b>

                </div>   
</div> 
</span>           
     </div>
 
    <!-- MIDDLE  BLOCK -->
    <div class="col-sm">


 <h3>Lucky numer</h3>
<?php echo new_button('<h1 id="luckyNum">00</h1>','','light btn-bloc'); ?>
<br>

<small>btc bet in satoshis.</small>
<br>
<div class="input-group">
  <input id="c_balance"  type="text" class="form-control" aria-label="Text input with dropdown button" style="cursor: pointer;" readonly>
  <div class="input-group-append">
    <button class="btn btn-outline-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BTC</button>
  <div class="dropdown-menu">
      <a class="dropdown-item" onclick="select_btc();">

        <img src="<?php echo base_url() ?>images/btclogo.png" style="height: 28px; width: 28px"> BTC</a>
      
      <a class="dropdown-item" onclick="select_doge();">
        <img src="<?php echo base_url() ?>images/dogelogo.jpg" style="height: 24px; width: 24px"> DOGE</a>

    </div>
  </div>
</div>

        <div class="btn-group m-4" role="group" aria-label="First group">
<span id="manual_btn">
        <?php echo new_button('Roll Low', '','dark submenu btn-lg', 'onClick="roll(2);" type="button"'); ?>
<?php echo new_button('Roll Hi', 'roll','dark submenu btn-lg', 'onClick="roll(1);" type="button"'); ?>

<br>
 <small><span class="m-3" id="under"></span><span class="m-3"  id="over"></span>
</small>



</span>
  <span name="autobet_item" class="auto_item">
    
         <?php echo new_button('Play!','','dark submenu btn-lg','onClick="auto_bet();"'); ?>
<?php echo new_button('Stop','stopint','dark btn-lg','') ?>
 <br>

<p>Bet on:</p>

<div class="form-check form-check-inline">
<div class="custom-control custom-checkbox">

<p><?php echo form_checkbox('direction','',FALSE, 'type="checkbox" class="form-check-input" id="setHi"'); ?>Hi</p>
</div>
</div>

<div class="form-check form-check-inline">
  <div class="custom-control custom-checkbox">

<p><?php echo form_checkbox('direction','',TRUE, 'type="checkbox" class="form-check-input" id="setLow"'); ?>Low</p>
</div>
</div>

<div class="form-check form-check-inline">
 <div class="custom-control custom-checkbox">

<p><?php echo form_checkbox('direction','',FALSE, 'type="checkbox" class="form-check-input" id="setAlt"'); ?>Alternative</p>
</div>
</div>  


  </span>

 </div>
  
      </div>

   <!-- LAST  BLOCK -->
    <div class="col-sm">
           <span id="diceresult"><?php echo alert_msg('Wellcome to Lotodice','info'); ?></span>
    <b>Winning Change</b >
 <input class="form-control mt-0" id="multiplier" name="multiplier" value="<?php if(!isset($_POST['multiplier'])){ echo "47.5"; } else { echo $_POST['multiplier']; } ?>" placeholder="47.5" onchange="btcConvert(this); noteLimit(this, 4)" onkeyup="btcConvert(this); noteLimit(this, 4)" onkeydown="noteLimit(this, 4);"/>

<span name="autobet_item" class="auto_item">
    <br>  
 
    <div class="btn-group m-2" role="group" aria-label="First group">

<?php echo new_button('ON WIN','on','secondary','onClick="currentBet(1)"'); ?>
<?php echo new_button('ON LOSE','on','light', 'onClick="currentBet(2)"'); ?>

</div>

<br>
 

<div class="onbet">

<div class="form-check form-check-inline">
<div class="custom-control custom-checkbox">

  <b>Return to base bet</b>
   <?php echo form_checkbox('onwin','',TRUE, 'type="checkbox" class="form-check-input"  id="base"'); ?>


</div>
</div>

<div class="form-check form-check-inline">
  <div class="custom-control custom-checkbox">
  <b>Double your bet </b><?php echo form_checkbox('onwin','',FALSE, 'type="checkbox" class="form-check-input"  id="double_base"'); ?>

</div>
</div>

<div class="form-check form-check-inline">
 <div class="custom-control custom-checkbox">

  <b>Icrease bet by percent: </b><?php echo form_checkbox('onwin','',FALSE, 'type="checkbox" class="form-check-input"  id="increase"'); ?>
  <?php echo form_input('increase_bet','0', 'class="form-control"  id="increase_bet_win"'); ?>
</div>
</div> 


</div>
<div class="onbet">
  

<div class="form-check form-check-inline">
<div class="custom-control custom-checkbox">

  
  <b>Return to base bet</b>
  <?php echo form_checkbox('onlose','',FALSE, 'type="checkbox" class="form-check-input"  id="lose_base"'); ?>
</div>
</div>

<div class="form-check form-check-inline">
  <div class="custom-control custom-checkbox">

<b>Double your bet </b><?php echo form_checkbox('onlose','',TRUE, 'type="checkbox" class="form-check-input" id="lose_double_base"'); ?>

</div>
</div>


<div class="form-check form-check-inline">
 <div class="custom-control custom-checkbox">

<b>Icrease bet by percent: </b><?php echo form_checkbox('onlose','',FALSE, 'type="checkbox" class="form-check-input"  id="lose_increase"'); ?>  <?php echo form_input('increase_bet','0', 'class="form-control" id="increase_bet_lose"'); ?>
</div>
</div> 


</div>
</span>
 


    </div>

  </div>
</div>
    


  </div>
  <div class="card-footer">
    

<br>
<div class="mySlides"><?php $this->load->view('buster/dice/auto_bet'); ?></div>


<?php $this->load->view($dice_script); ?>




  </div>

</div>

<script>


function change_on(){
    $('#manual_btn').css('display','none');
  $('[name="autobet_item"]').css('display','block');
}


function change_off(){

  $('[name="autobet_item"]').css('display','none');
    $('#manual_btn').css('display','block');
}


</script>