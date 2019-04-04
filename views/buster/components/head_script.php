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

  

  
$('.nav-link').css('color','#ffffff;');

function switch_nav() {

var header = document.getElementById('mynavbar');
var text = document.getElementById('switch_text');
var tail = document.getElementById('tail');

  var $box = $('input#switch');
  if ($box.is(":checked"))
   {


text.setAttribute('style','color:#ffffff;margin-right: 5px;');
text.innerHTML = 'switch Light';
header.setAttribute('class', 'navbar navbar-expand-lg navbar-dark bg-dark');
tail.setAttribute('style', 'color:#ffffff;text-shadow: 2px 2px 4px #000000;background: url("<?php echo base_url() ?>/images/dark1bg.png") no-repeat;');

    } else {
text.setAttribute('style','color:#000000;margin-right: 5px;');
text.innerHTML = 'switch Dark';
header.setAttribute('class', 'navbar navbar-expand-lg navbar-light bg-light');
tail.setAttribute('style', 'color:#000000;background: url("<?php echo base_url() ?>images/whitebg.png") no-repeat;');
    }

}    


  </script>

<?php

if($this->login_m->loggedin() == TRUE){

 ?>

<script>
  $(document).ready(function(){


var coin_bal = $('#balance_container'); 


          $.ajax({

      url: "<?php echo base_url(); ?>dashboard/balances",
      type: "POST",
      data: {  },

      success: function(data) {

coin_bal.html(data);


      }
});



check_dep('doge');
check_dep('btc');

function check_dep(coin){


          $.ajax({

      url: "<?php echo base_url(); ?>deposit/datos/" + coin,
      type: "POST",
      data: {  },

      success: function(data) {

$('#reward').html(data);


      }
});

}


   });

</script>
  

 <?php

  }

  ?>
      


