
<script>

$(document).ready(function() {

  setTimeout(
  function() 
  {
    $('#get_addr').click(function(){


 MyJax('<?php echo $var_index; ?>');

$(this).remove();

    });



      function Myaddr(index) {
        
        if(index == null){

          var index = '<?php echo empty($var_index) ? 0 : $var_index; ?>'; 
        }
        else { var index = index; }

        var xpubkey  = '<?php echo $pubkey; ?>';
    var hd = coinjs.hd(xpubkey);  
    var derived = hd.derive(index);
    
  
    return derived.keys.address;
  }

      function MyJax(index){

var coin = '<?php echo $coin; ?>';

           if(index == null){

          var index = '<?php echo empty($var_index) ? 0 : $var_index; ?>'; 
        }
        else { var index = index; }

var addr = Myaddr(index);       


          $.ajax({

      url: "<?php echo base_url(); ?>deposit/verify_addr/"+ addr + "/" + coin,
      type: "POST",
      data: { addr : addr , num : index, },

      success: function(data) {

                         //Existing address
          if(data == 1){                      

              $('#message').html('<b>loading...</b>');
            $('#qrcode').html('<img width="200px" height="200px" src="<?php echo base_url() ?>img/loading_12.gif">');

            setTimeout(function(){

index++;
MyJax(index);

    }, 2500);
         

          }
                    //not existing address
                    if(data == 2){

                  var qr_url = '<?php echo base_url() ?>deposit/qrcode/' + addr;

             $('#message').html('<b>loading...</b>');
            $('#qrcode').html('<img width="200px" height="200px" src="<?php echo base_url() ?>img/loading_12.gif">');

            setTimeout(function(){

                      $('#myresult').html(addr);
                      $('#message').html('New address has been created');
                      $('#qrcode').html('<img width="200px" height="200px" src="'+ qr_url +'">');
    }, 2500);

                  
                    }
                       //error
                    if(data == 3){

                      $('#message').html('functional error, please contact support');
                    }     

        }

      });
      }
          
   


    }, 100);



  });

</script>
      
