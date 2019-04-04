
<script>

$(document).ready(function() {

var timecheck = <?php echo time() + 120; ?> * 1000;
var addr_arr = coinjs.newKeys();
var pubaddr = addr_arr.pubkey;
var d = timecheck;
var timejs = new Date() / 1000;
var time_addr = coinjs.simpleHodlAddress(pubaddr,timecheck);
var hash = time_addr.redeemScript;
var address = time_addr.address;

if(parseInt(timecheck) > parseInt(timejs)){

            $.ajax({

            url: "<?php echo base_url(); ?>faucet/new_hash",
            type: "POST",
            data: {  hash : hash , address : address,   },

            success: function(data) {

                         //Hash successfully created
                    if(data == 1){
                        
                      $('#hash_result').html('<?php echo json_encode(alert_msg('Hash created', "success")); ?>');

        var cd = new Countdown({
        cont: document.querySelector('.countimer'),
        endDate: timecheck,
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

                    }
                    //hash not created
                    if(data == 2){

                        $('#hash_result').html('<?php echo json_encode(alert_msg("hash not created, try again later or contact support","warning")) ?>');

                        
                    }
                       //not count user
                    if(data == 3){

                        $('#hash_result').html('<?php echo json_encode(alert_msg("user not found","warning")) ?>');
                        
                    }           

                }

            });     
}


});

</script>