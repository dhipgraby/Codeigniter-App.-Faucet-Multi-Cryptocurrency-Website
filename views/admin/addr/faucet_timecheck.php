<script>

$(document).ready(function() {


myFunction();

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


function myFunction() {
    setTimeout(function(){ 


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

var timelock = parseInt('<?php echo time(); ?>');
var time_left = parseInt('<?php echo $reward_time; ?>') * 1000;

    var cd = new Countdown({
        cont: document.querySelector('.countimer'),
        endDate: time_left,
        outputTranslation: {
            year: 'Years',
            week: 'Weeks',
            day: 'Days',
            hour: 'Hours',
            minute: 'Minutes',
            second: 'Seconds',
        },
        endCallback: null,
        outputFormat: 'minute|second',
    });
    cd.start();



if($('#claim').hasClass('btn btn-success') == true){
  
$('#hash_result').html('<?php echo alert_msg('Ready to Claim', 'info'); ?>');

}

else {

$('#hash_result').html('<?php echo alert_msg('Faucet Recharging, wait timer end to Claim', 'info'); ?>');

}



    function user_hash(){

var hash ='0480c0c45bb17541041c35e82553eec85c844268220427ac3f295440e9c1674c1e5a84cfbedf3bafc41caa721d8f39953a5b8e84840be0a821e3cc8ad97fc9b0e1c10cc862a5d1ab9dac';
var address = '<?php echo $c_addr; ?>';
var coin = $('[name="coin"]:checked').attr('id');

if(!coin){

    $('#hash_result').html('<?php echo alert_msg('Select a coin to Claim reward', 'warning') ?>');
 

 } 

 else {


     $.ajax({

            url: "<?php echo base_url(); ?>faucet/new_hash",
            type: "POST",
            data: { address : address, coin : coin,   },

            success: function(data) {

  var array = JSON.parse(data);

                         //Hash successfully created
                    if(array.number == 1){
                        
                        //$('#reward').html('<b style="color:#3DB04C;">+ '+ array.coin +' '+ coin + '</b>');
                        $('#hash_result').html(array.msg);
  
  
    var cd = new Countdown({
        cont: document.querySelector('.countimer'),
        endDate: array.timeleft,
        outputTranslation: {
            year: 'Years',
            week: 'Weeks',
            day: 'Days',
            hour: 'Hours',
            minute: 'Minutes',
            second: 'Seconds',
        },
        endCallback: null,
        outputFormat: 'minute|second',
    });
    cd.start();


 update_balance();
     return hash; 

                          }
                    //hash not created
                    if(array.number == 2){

                        $('#hash_result').html(array.msg);

                        
                    }
                       //not count user
                    if(array.number == 3){

                        $('#hash_result').html(array.msg);
                        
                          setTimeout(function(){ location.reload(true) }, 3000);
                    }           

                }

            }); 
 }
               

      
    }



function claim_hash(hash){


            $.ajax({

            url: "<?php echo base_url(); ?>faucet/claim/" + hash,
            type: "POST",
            data: {   },

            success: function(data) {

                         //Claim success
                    if(data == 1){
                        
                       
                    user_hash();
                     
                    }
                    //have to wait
                    if(data == 2){

                        $('#hash_result').html(<?php echo json_encode(alert_msg('faucet is recharging, please try to claim later', 'warning')) ?>);

                         
                    }
                       //error
                    if(data == 3){

                        $('#hash_result').html(<?php echo json_encode(alert_msg('Not faucet user found, contact support', 'warning')) ?>);

                        
                    }           

                }

            });





}

$('#claim').click(function(){

var hash = '<?php echo empty($hash) ? null : $hash; ?>';

if(hash == null || hash == ''){

 var hash = user_hash();

} else {

   claim_hash(hash); 
}
  

});
    




     }, 1000);
}



});

</script>