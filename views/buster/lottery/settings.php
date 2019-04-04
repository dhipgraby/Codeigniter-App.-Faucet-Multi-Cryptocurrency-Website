
<script>

function update_balance(){

var coin_bal = $('#balance_container'); 


          $.ajax({

      url: "<?php echo base_url(); ?>dashboard/balances",
      type: "POST",
      data: {  },

      success: function(data) {

coin_bal.html(data);


      }
});

}


	function update_stats() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("stats").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>lottery/update_stats", true);
  xmlhttp.send();
}	


	function update_prizes() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("prizes").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>lottery/update_prizes", true);
  xmlhttp.send();
}	



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

totalAmount();
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
       update_balance();
}

function select_doge(){

check_opt('doge');

$('#coinopt').html('DOGE');
       update_balance();

}

$('[name="coin"').change(function(){

totalAmount();
update_balance();

});


$('[name="coin"').change(function(){

totalAmount();
update_balance();

});



$('#buy').click(function(){

var amount = $('#total').val();
var currency = $('[name="coin"]:checked').attr('id');  

    $.ajax({

      url: "<?php echo base_url(); ?>lottery/process",
      type: "POST",
      data: { amount : amount, currency : currency, },

      success: function(data) {

            $('#buy_result').html(data).fadeIn().delay(3000).fadeOut();  
            update_prizes();
            update_stats();
            update_balance();
   
            }       
        
      });

});


</script>