<script type="text/javascript">
  
function update_t(array){

    var downloadTimer =  setTimeout(function(){

var ticket = array; 

var type = ticket.type;
var ticket_address = ticket.t_address;
var round =  ticket.round;
var currency = $('[name="coin"]:checked').attr('id');  

$.ajax({

      url: "games/sit_lottery/ticket_status",
      type: "POST",
      data: { type : type, ticket_address : ticket_address, round : round, currency : currency },

      success: function(data) {
           
                   var change = '#id'+ticket.t_address; 
           $(change).html(data);


            }       
        
      });


    },5000);


}


</script>


<style type="text/css">
  
body { font-family: sans-serif; }

.scene {

  perspective: 2000px;

}

.cardto {


  transform-style: preserve-3d;

  transition: transform 1s;
}

.cardto.is-flipped {

  backface-visibility: visible;
  transform:  rotateY(360deg);

}

.cardto.is-rotated {

  backface-visibility: visible;
  transform:  rotateX(-360deg);

}

.cardto__face {

 
}

.cardto__face--front {

}

.cardto__face--back {


}

#buy_result {

position: fixed;
z-index: 10;
  top: 50%;
left: 39%;
}


<?php

$blue = '<i style="color:#17a2b8" class="fas fa-circle"></i>';

$green = '<i style="color:#28a745;" class="fas fa-circle"></i>';

$purple = ' <i style="color:#A13494;" class="fas fa-circle"></i>';

 ?>

</style>

<div align="center" class="col-sm-12">
<h4>Payment method:</h4>

<div class="row">

<div class="col-sm-4">
<?php echo $blue; ?> <b style="font-style: italic;"> User Balance:</b> pay to lotobitcoin balance.
</div>

<div class="col-sm-4">

 <?php echo $green; ?> <b style="font-style: italic;">  Hybrid : Pay directly</b> to a BTC address or lotobitcoin balance.
</div>

<div class="col-sm-4">
 <?php echo $purple; ?>  <b style="font-style: italic;"> Blockchain:</b> Pay only to BTC address.

  

</div>

 </div>

<p>Address payment method, is a direct withdraw to the Btc address choosen by the winner.<br>
This trasaccion have no fees, takes 24 hours to proceed and show in your withdraw history.</p>
</div>

<br>
<div align="center" style="background-color: #f3f3f3; border-radius: 10px;">

<div class="btn-group mt-3">

  <button onclick="window.location.href = '<?php echo base_url() ?>sit_lottery';" type="button" class="btn btn-dark">BTC</button>

  <button onclick="window.location.href = '<?php echo base_url() ?>sit_lottery?coin=doge';" type="button" class="btn btn-dark">DOGE</button>


</div>
<div class="input-group" style="display:none;">

  <div class="input-group-append">


        <img src="<?php echo base_url() ?>images/btclogo.png" style="height: 28px; width: 28px;"> BTC
<?php echo form_checkbox('coin','',$btc_opt, 'type="checkbox" class="form-check-input" id="btc" style="margin-left:10px;" '); ?> 
      
 
        <img src="<?php echo base_url() ?>images/dogelogo.jpg" style="height: 24px; width: 24px"> DOGE 
        <?php echo form_checkbox('coin','',$doge_opt, 'type="checkbox" class="form-check-input" style="margin-left:10px;" id="doge"'); ?>

    </div>
    
  </div>

<br>
<br>
<div class="container">
<span id="buy_result"></span></div>
<span id="data_submited"></span>
<br>

<div class="col-sm-12">
  
  <div class="row">


<?php if(count($lotteries)){

for($i=-1;$i<count($lotteries);$i++){

  foreach($lotteries[$i] as $lottery) {


$Payment =  ($lottery->type == 10) ? $blue : $green; 

if($lottery->type == 1000) {

$Payment = $purple;

}

$this->data['lottery'] = $lottery;
$this->data['Payment'] = $Payment;

$this->load->view('buster/lottery/sit_lottery/loto_card',$this->data);

}

 }
}




?>
<!-- END FRONT -->    




  </div>


</div>



<script type="text/javascript">
  

$("input:checkbox[name='coin']").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
  
    var group = "input:checkbox[name='coin']";
    
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

function check_opt(input_id){

var input = $('input#'+input_id);
  
input.click();
  var $box = input;
  if ($box.is(":checked")) {
  
    var group = "input:checkbox[name='coin']";
    
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false); }

  }


function select_btc(){

check_opt('btc');

$('#coinopt').html('BTC');
  
}

function select_doge(){

check_opt('doge');

$('#coinopt').html('DOGE');
 

}

  function buy(t_address,type,round){

var round = round;
var ticket = t_address;
var type = type;
var currency = $('[name="coin"]:checked').attr('id');  

    $.ajax({

      url: "games/sit_lottery/process",
      type: "POST",
      data: { round : round, ticket : ticket, type : type, currency : currency, },

      success: function(data) {

            $("#buy_result").html(data);  
   
               update_balance();
   
            }       
        
      });

}

function show_result(round,type){

var currency = $('[name="coin"]:checked').attr('id');  

if(round > 0){

$.ajax({

      url: "games/sit_lottery/last_winner",
      type: "POST",
      data: { type : type, round : round, currency : currency, },

      success: function(data) {
     
     var flipcar = '.winner'+type;
         var card = document.querySelector(flipcar);
             card.classList.toggle("is-flipped");
   
           $(flipcar).html(data);

            }       
        
      });



}

  
}
function show_round(type){

var check_id = 'check'+type;
var currency = $('[name="coin"]:checked').attr('id');  
var round = $('#'+check_id).val();

if(round > 0){

$.ajax({

      url: "games/sit_lottery/last_winner",
      type: "POST",
      data: { type : type, round : round, currency : currency },

      success: function(data) {
     
     var flipcar = '.winner'+type;
         var card = document.querySelector(flipcar);
             card.classList.toggle("is-flipped");
   
           $(flipcar).html(data);

            }       
        
      });



}

  
}

function show_stats(type){

var currency = $('[name="coin"]:checked').attr('id');  

$.ajax({

      url: "games/sit_lottery/user_round",
      type: "POST",
      data: { type : type, currency : currency },

      success: function(data) {
     
     var flipcar = '.winner'+type;
         var card = document.querySelector(flipcar);
             card.classList.toggle("is-flipped");
   
           $(flipcar).html(data);

            }       
        
      });

  
}



function next_page(type,start){

var currency = $('[name="coin"]:checked').attr('id');  

if(start < 1){

  var start = 0;
}

var c_id =parseInt(start);

var id = c_id + 10;

$('[name="next'+type+'"]').attr('id',id);
$('[name="last'+type+'"]').attr('id',id-20);

$(this).attr

$.ajax({

      url: "games/sit_lottery/next_page",
      type: "POST",
      data: { type : type, start : start, currency : currency, },

      success: function(data) {
     
     var flipcar = '.round'+type;
         var card = document.querySelector(flipcar);
             card.classList.toggle("is-flipped");

              
           $(flipcar).html(data);

            }       
        
      });

  
}

function open_addr(){

var currency = $('[name="coin"]:checked').attr('id');  

var Pindiv ='<?php echo json_encode(modal_content("Add address","

<table>
  <tr>
<td>Address:</td>
<td>". form_input('address', '', 'class="form-control" id="address" ') . "</td>
</tr>

</table>

","set address","set_address")) ?>';
          
          $('#data_submited').html(Pindiv);
           $('#modal').modal('show');
    
    $('#set_address').click(function(event){
  event.preventDefault();

  var new_address = $('input#address').val();

      $.ajax({

      url: "<?php echo base_url(); ?>games/sit_lottery/set_address",
      type: "POST",
      data: { new_address : new_address, currency : currency, },

      success: function(data) {

           $('#modal').modal('hide').fadeOut(1000, function (e) {
  $('#buy_result').html(data);


});

        
        }

      });

  });

}

</script>

<br>

 <!-- This is the modal to pullout info -->

<!-- END OF MODAL -->


</div>



