

<script>

update_balance();

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
       update_balance();
}

function select_doge(){

check_opt('doge');
       update_balance();

}

$('[name="coin"').change(function(){

update_balance();

});

function btcConvert(input){

 if (isNaN(input.value)){
 input.value = 0;
 }

 var multi = document.getElementById('multiplier').value;
 var multi2 = 100 / multi;
 var multi3 = multi2 - 0.15; 
 var betAmount = document.getElementById('bet2').value;
 var grossProfit = multi3 * betAmount;
 var profit2 = grossProfit - betAmount;
 document.getElementById('reward_profit').value = profit2.toFixed(0);;
 var multi = document.getElementById('multiplier').value;
 document.getElementById('under').innerHTML = "Roll under " + multi;
 var rollHiC = 100 - multi;
 document.getElementById('over').innerHTML = "Roll over " + rollHiC;
}


window.onload = function() {
  var multiIn = document.getElementById('multiplier');
  btcConvert(multiIn);
};

function double(){
 var oba = document.getElementById('bet2').value;
 var dbl = 2 * oba;
 document.getElementById('bet2').value = dbl.toFixed(0);
 var multi = document.getElementById('multiplier').value;
 var multi2 = 100 / multi;
 var multi3 = multi2 - 0.15; 
 var betAmount = document.getElementById('bet2').value;
 var grossProfit = multi3 * betAmount;
 var profit2 = grossProfit - betAmount;
 document.getElementById('reward_profit').value = profit2.toFixed(0);
}

function half(){
 var oba = document.getElementById('bet2').value;
 var dbl = oba / 2;
 document.getElementById('bet2').value = dbl.toFixed(0);
 var multi = document.getElementById('multiplier').value;
 var multi2 = 100 / multi;
 var multi3 = multi2 - 0.15; 
 var betAmount = document.getElementById('bet2').value;
 var grossProfit = multi3 * betAmount;
 var profit2 = grossProfit - betAmount;
 document.getElementById('reward_profit').value = profit2.toFixed(0);
}


function Max(){
 
var coin = $('[name="coin"]:checked').attr('id');  

 var balance = $('#test_'+coin).html() * 100000000;

if(coin == 'doge'){

 var balance = $('#test_'+coin).html();

}

  $('#bet2').val(balance);
}


function Min(){
 
 document.getElementById('bet2').value = 25;
 var multi = document.getElementById('multiplier').value;
 var multi2 = 100 / multi;
 var multi3 = multi2 - 0.15; 
 var betAmount = document.getElementById('bet2').value;
 var grossProfit = multi3 * betAmount;
 var profit2 = grossProfit - betAmount;
 document.getElementById('reward_profit').value = profit2.toFixed(0);
}

function noteLimit(element, stopAt)
{
    var max_chars = stopAt;

    if(element.value.length > max_chars) {
        element.value = element.value.substr(0, max_chars);
    }
}




function roll(n) {


var roll = '';

var coin = $('[name="coin"]:checked').attr('id');  

roll = (n % 2 == 1) ? 1 : 2;


   var amount = parseFloat(document.getElementById('bet2').value);
   var multi = document.getElementById('multiplier').value;
    var profit2 =  parseFloat(document.getElementById('reward_profit').value);
   var balance = parseFloat($('#c_balance').val());


$.ajax({

url: "<?php echo base_url(); ?>dicetry/check_bet/"+ amount + "/" + multi +"/" + roll + '/'+ coin,
type: "POST",
data: { balance : balance, },

success: function(data) {

      var array = JSON.parse(data);

var winStake = parseFloat($('#winning').html());
var lostStake = parseFloat($('#losses').html());
var profit = parseFloat($('#profit').html());
var lost = parseFloat($('#lost').html());

        $('#diceresult').html(array.message);
       $('#luckyNum').html(array.luckyNum);
 

  if(array.type == 'win'){

var new_balance = balance + amount;

if(coin == 'btc'){ new_balance = new_balance /100000000; }
    $('#test_'+coin).html(new_balance);
  $('#winning').html(winStake + 1);
  $('#profit').html(profit + profit2);
  //$('#reward').html(array.netProfit);

   update_balance();

}

else if(array.type == 'lose'){

var new_balance = balance - amount;

if(coin == 'btc'){ new_balance = new_balance /100000000; }
  $('#test_'+coin).html(new_balance);
  $('#losses').html(lostStake + 1);
  $('#lost').html(lost - amount);

 //$('#reward').html(array.netProfit);
   update_balance();
}


update_table();

}


});

}

//ROLL FOR AUTO DICE
function auto_dice(n) {


var roll = '';

var coin = $('[name="coin"]:checked').attr('id');  


roll = (n % 2 == 1) ? 1 : 2;

  var current_bet =  parseFloat(document.getElementById('bet2').value);
  var base_bet = parseFloat(document.getElementById('base_bet').value);
 var amount = parseFloat(document.getElementById('bet2').value);
  var multi = document.getElementById('multiplier').value;
  var profit2 =  parseFloat(document.getElementById('reward_profit').value);
  var onwin = $('[name="onwin"]:checked');
var onwin_id = onwin.attr('id');
var onlose = $('[name="onlose"]:checked');
var onlose_id = onlose.attr('id');  
   var balance = parseFloat($('#c_balance').val());



if(onwin_id == 'double_base'){

amount = current_bet;

}

if(onlose_id == 'lose_double_base'){

amount = current_bet;


}


if(onwin_id == 'increase'){

amount = current_bet;

}

if(onlose_id == 'lose_increase'){

amount = current_bet;


}


$.ajax({

url: "<?php echo base_url(); ?>dicetry/check_bet/"+ amount + "/" + multi +"/" + roll + '/' + coin,
type: "POST",
data: { balance : balance, },

success: function(data) {

      var array = JSON.parse(data);

var winStake = parseFloat($('#winning').html());
var lostStake = parseFloat($('#losses').html());
var profit = parseFloat($('#profit').html());
var lost = parseFloat($('#lost').html());
var increse =  parseFloat(document.getElementById('increase_bet_win').value);
var increse_lose = parseFloat(document.getElementById('increase_bet_lose').value);
 
 var in_w = (increse / 100) * current_bet;
  var in_l =(increse_lose / 100) * current_bet;



        $('#diceresult').html(array.message);
       $('#luckyNum').html(array.luckyNum);
 

  if(array.type == 'win'){

if (onwin_id == "base") {

$("#bet2").val(base_bet);

}

if(onwin_id == "double_base"){

$('#bet2').val(current_bet * 2);

}

if(onwin_id == "increase"){

$('#bet2').val(current_bet + parseInt(in_w));

}

var new_balance = balance + amount;

if(coin == 'btc'){ new_balance = new_balance /100000000; }
    $('#test_'+coin).html(new_balance);

  $('#winning').html(winStake + 1);
  $('#profit').html(profit + profit2);
    //$('#reward').html(array.netProfit);
       update_balance();


}

else if(array.type == 'lose'){

if (onlose_id == 'lose_base') {

$('#bet2').val(base_bet);

}

if(onlose_id == 'lose_double_base'){

  $('#bet2').val(current_bet * 2);


}

if(onlose_id == "lose_increase"){

$('#bet2').val(current_bet + parseInt(in_l));

}
var new_balance = balance - amount;

if(coin == 'btc'){ new_balance = new_balance /100000000; }
  $('#test_'+coin).html(new_balance);
  $('#losses').html(lostStake + 1);
  $('#lost').html(lost - amount);
   // $('#reward').html(array.netProfit);
       update_balance();

}


update_table();

}


});

}


function update_balance(){

 
var coin = $('[name="coin"]:checked').attr('id');  

var c_bal = $('#test_'+coin).text();

if(coin == 'btc'){ var c_bal  = c_bal *100000000; }

$('#c_balance').val(c_bal);




}


function update_table() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("table_bet").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>dicetry/result_table", true);
  xmlhttp.send();
}	



function update_autobet() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("autobet_result").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>dicetry/autobet_result", true);
  xmlhttp.send();
} 

// PLAY AUTO_DICE
function auto_bet(){

update_autobet();

var downloadTimer;

$('#current_bet').val(parseFloat(document.getElementById('base_bet').value));
var row =  parseInt(document.getElementById('auto_bet').value);
var i = 0;
var n = 1;

if(row > 0){

 downloadTimer = setInterval(function(){
    row--;
    i++;
    n++;

var direction = $('[name="direction"]:checked');
var direction_id = direction.attr('id');

var win = parseInt($('#profit').html());
var lost = parseInt($('#lost').html());

document.getElementById('game_profit').value = win + lost;
document.getElementById('played_rolls').value = i;
document.getElementById('rolls_left').value = row;

if(direction_id == 'setLow'){

auto_dice(2);

}

if(direction_id == 'setHi'){

auto_dice(1);

}


if(direction_id == 'setAlt'){

auto_dice(n);

}

if(direction_id == '' || direction_id == null){

auto_dice(2);

}


        if(row <= 0){  clearInterval(downloadTimer); }

    },1000);

$('#stopint').click(function(){ clearInterval(downloadTimer); });

}



}



   
</script>

