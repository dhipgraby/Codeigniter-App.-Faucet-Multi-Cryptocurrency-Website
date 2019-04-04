<div align="center">


<p>
  
  Enjoy Lotobitcoin with a special experience!<br>
  You can buy special packs to get a bonus in many areas in this website.<br>


</p>

<br>
<div class="container" align="center">
<h2 style="font-style: italic;"><i class="fas fa-rocket"></i> Available Sit and Go Lotteries</h2><br>
     <div class="col-sm-12"><div class="row">

<?php foreach ($lotteries as $lottery) {

$this->data['lottery'] = $lottery;
 ?>

      <div class="col-sm-4"><?php $this->load->view('buster/components/sliders/sit_loto_promo',$this->data); ?></div>

<?php 

} ?>

  </div></div></div>

<br><br>

 <h3><i class="fas fa-ticket-alt"></i> Weekly Lottery Packs:</h3> 

<br>
<span id="buy_result"></span>
<br><div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal"><b> 10% Discount </b></h4>
          </div>
          <div class="card-body">
            <h4 class="card-title pricing-card-title">Get 5.500 lottery tickets </h4>
            <ul class="list-unstyled mt-3 mb-4">
              
              <li>For 0.00049500 <i class="fab fa-btc"></i></li>
            <li>Price per ticket 0.00000009 <i class="fab fa-btc"></i></li>
         
            </ul>
                        <?php if($this->login_m->loggedin() == TRUE){  ?>
            <button id="10" type="button" name="buy" data-target="#Modal" data-toggle="modal" class="btn btn-lg btn-block  btn-dark submenu">Buy</button>
             <?php } ?>
          </div>
        </div>
      <div class="card mb-4 shadow-sm" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal"><b> 20% Discount </b></h4>
          </div>
          <div class="card-body">
            <h4 class="card-title pricing-card-title">Get 11.250 lottery tickets</i> </h4>
            <ul class="list-unstyled mt-3 mb-4">
              
              <li>For 0.0009 <i class="fab fa-btc"></i></li>
            <li>Price per ticket 0.00000008 <i class="fab fa-btc"></i></li>
         
            </ul>
            <?php if($this->login_m->loggedin() == TRUE){  ?>
            <button id="20" name="buy" type="button" data-target="#Modal" data-toggle="modal" class="btn btn-lg btn-block  btn-dark submenu">Buy</button>

                    <?php } ?>
          </div>
        </div><div class="card mb-4 shadow-sm" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal"><b> 30% Discount </b></h4>
          </div>
          <div class="card-body">
            <h4 class="card-title pricing-card-title">Get 25.714 lottery tickets  </h4>
            <ul class="list-unstyled mt-3 mb-4">
              
              <li>For 0.00179998 <i class="fab fa-btc"></i></li>
            <li>Price per ticket 0.00000007 <i class="fab fa-btc"></i></li>
         
            </ul>
<?php if($this->login_m->loggedin() == TRUE){  ?>
            <button id="30" name="buy" type="button" data-target="#Modal" data-toggle="modal" class="btn btn-lg btn-block  btn-dark submenu">Buy</button>
         <?php } ?>
          </div>
        </div>
      </div>

</div>

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



  $('[name="buy"]').click(function(){

var pack = $(this).attr('id');

    $.ajax({

      url: "<?php echo base_url(); ?>packs/process",
      type: "POST",
      data: { pack : pack },

      success: function(data) {

            $('#buy_result').html(data);  
           update_balance();
   
            }       
        
      });

});
</script>