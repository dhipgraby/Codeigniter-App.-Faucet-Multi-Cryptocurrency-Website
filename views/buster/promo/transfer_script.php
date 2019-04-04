



<script>



function transfer(){
   
    var amount = $('input#amount').val();
    var currency = 'advert';
    var method = $("input:checked[name='method']").attr('id');
    var coin = $('option:selected','#coinjs_coin').attr('id');
    var convert = $('#convert').val();

if(method == 'address'){

var addr = $('#val_addr').val();

    var decode = coinjs.addressDecode(addr);
    
    if(decode.version == coinjs.pub || decode.version == coinjs.multisig){ // regular address
      
 create_transfer(amount,convert,currency,method,coin,addr);


    } else {

         
 $('#check_res').html('<?php echo alert_msg('This is not a Valid address, please try another one','warning'); ?>');


    }


}  else {


  create_transfer(amount,convert,currency,method,coin,null);      


}


}


    function create_transfer(amount,convert,currency,method,coin,addr = null){


$.ajax({

        url: "<?php echo base_url(); ?>promoter/factor_box",
        type: "POST",
        data: { amount : amount, currency : currency, method : method, coin : coin, addr : addr, },


              success: function(data) { 
                             
                   
                    $('#modaltransfer').modal('hide');
                    $('#data_submited').html(data);
                      $('#modal').modal('show');


            $('#unlock').click(function(event){
            event.preventDefault();


     unlock(amount,convert,currency,coin,method,addr);


            });

              

          }


        });

    }

    function unlock(amount,convert,currency,coin,method,addr=null){

                var password = $('input#sec_password').val();
                var pincode =  $('input#sec_password').val();
                var email_code =  $('input#sec_password').val();
            


                $.ajax({

                url: "<?php echo base_url(); ?>promoter/confirm_box",
                type: "POST",
                data: { 
                 password : password ,
                 pincode : pincode ,
                 email_code : email_code,
                 amount : amount,
                 currency : currency,
                 method : method,
                 coin : coin,
                 convert : convert,
                 addr : addr,  },

                success: function(data) {
                  
          var array = JSON.parse(data);

          if(array.access == '1'){

            $('#modal').modal('dispose').modal('hide');
            $('.modal-backdrop').remove();
            $('#data_submited').html(array.info);
            $('#modal').modal('show');
            
                    //LAST STEP
                                  $('#w_confirm').click(function(){
                                
                                  
                                  withdraw_confirm(amount,convert,currency,coin,method);

                              });
          // END LAST STEP

          }

          if(array.access == '2') {

          $('#message').html(array.info);

          }

                
                 
                  }

                });



    }


   function withdraw_confirm(amount,convert,currency,coin,method){

var addr = $('#val_addr').val();

$.ajax({

                                   url: "<?php echo base_url(); ?>promoter/process",
                              type: "POST",
                              data: { amount : amount, convert : convert, currency : currency, coin : coin, method : method, addr : addr, },

                              success: function(data) { 

               $('#w_confirm').fadeOut(500);                                    
          $('#message').slideUp(100).html(data).slideDown(1000);

             setTimeout(function(){ location.reload(true) }, 6000);
                                                                  
                  
                              }

                                });


   } 




</script>