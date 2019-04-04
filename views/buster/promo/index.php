
<div class="table-responsive">



<div class="col-sm-12">

<span id="data_submited"></span>
  
<div class="row">
  <!-- FIRST BOX-->
<div class="col-sm-8">

<p class="mt-5">

<b>Promoter Balance: <?php echo $advert_bal; ?><i class="fa fa-btc" aria-hidden="true"></i></b><br>
<small>Minimum amount to transfer to address : 0.0002 <i class="fa fa-btc" aria-hidden="true"></i></small>
<br>
<small>Minimum amount to transfer to balance : 0.00002 <i class="fa fa-btc" aria-hidden="true"></i></small>

</p>

<div class="btn-group" role="group">

<?php echo new_button('<i class="far fa-paper-plane"></i> Withdraw','withdraw','dark submenu m-1','onclick="open_trans()"') ?>
<?php echo new_button('<i class="fas fa-calculator"></i> Profit calculator','calculator','dark submenu m-1','onclick="open_calc()"') ?>
<?php echo new_button('<i class="fas fa-clipboard-list"></i> History','history','dark submenu m-1','onclick="open_hist()"') ?>
<?php echo new_button('<i class="fas fa-info-circle"></i> Info','info','dark submenu m-1','onclick="open_info()"') ?>
</div>

<br>

<br>
<div class="input-group mb-3 w-80">
   <button  onclick="myFunction()" class="tooltiptext btn btn-light" id="myTooltip">Copy</button> 
  <div class="input-group-prepend">

  
    <span  class="input-group-text" id="basic-addon1"><b> Your Referral Link:</b>
    </span>
  </div>
<input id="myInput" class="form-control" type="text" name="refurl" value="<?php echo base_url() ?>work?ref=<?php echo $this->session->id; ?>" readonly>

 
</div>


<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
  
  var tooltip = document.getElementById("myTooltip");
  tooltip.innerHTML ="Copied to clipboard!";
}


</script>

<br>

<?php $this->load->view('buster/promo/withdraw') ?>

<?php $this->load->view('buster/promo/info') ?>

<?php $this->load->view('buster/promo/history') ?>

<?php $this->load->view('buster/promo/calculator') ?>

<script type="text/javascript">


  function open_trans(){

    $('#modaltransfer').modal('show');
  }

  function open_calc(){

    $('#modalcalc').modal('show');
  }
    function open_hist(){

    $('#modalhist').modal('show');
  }
       function open_info(){

    $('#modalinfo').modal('show');
  }

    function open_calc(){

    $('#modalcalc').modal('show');
  }



</script>


<h4><i class="far fa-eye"></i> Visits/Views stats</h4>
<br>
<table class="table">
  
<tr>
  <td>Today</td>
    <td>Last 7 days views</td>
      <td>Last 30 days views</td>
  <td><b>Total Views</b></td>

</tr>

<tr>
  <td><?php echo $today_views; ?></td>
    <td><?php echo $weekly_views; ?></td>
      <td><?php echo $monthly_views; ?></td>
        <td><?php echo $total_views; ?></td>


</tr>


</table>


<h4><i class="fas fa-coins"></i> Payment stats</h4>
<br>
<b>Promoters will get paid once everyday</b><br>
<table class="table">
  
<tr>
  <td>Today</td>
    <td>Last 7 days</td>
      <td>Last 30 days</td>
  <td><b>Total paid out</b></td>

</tr>

<tr>
  <td><?php echo $today_payout; ?> <i class="fa fa-btc" aria-hidden="true"></i></td>
    <td><?php echo $weekly_payout; ?> <i class="fa fa-btc" aria-hidden="true"></i></td>
      <td><?php echo $monthly_payout; ?> <i class="fa fa-btc" aria-hidden="true"></i></td>
        <td><?php echo $total_payout; ?> <i class="fa fa-btc" aria-hidden="true"></i></td>


</tr>


</table>

<br>

<div class="table-responsive">

<div class="btn-group" role="group">

<?php echo new_button('<i class="fas fa-chart-area"></i> Today','today','dark submenu','name="graphic"') ?>  
<?php echo new_button('<i class="fas fa-chart-area"></i> Last 7 days','week','dark submenu mr-1 ml-1','name="graphic"') ?>
<?php echo new_button('<i class="fas fa-chart-area"></i> Last 30 days','month','dark submenu','name="graphic"') ?>

</div>
<br><br>
<span id="graphic"><?php $this->load->view('buster/promo/today'); ?></span>

<br>

<div class="card" align="center">
  <div class="card-body">
<h3>Payment History</h3>


<div class="btn-group" role="group" aria-label="First group">
<?php echo new_button('< First ','','secondary','value="1" name="pagination" onclick="next_page(0);" '); ?>
<span id="pages">

<?php echo new_button('<b>- 5</b>','','light','type="button" onclick="next_page(this.value)" value="1"'); ?>

<?php for($x=1; $x<=$total_pages; $x++) {

    echo new_button($x,'','light','value="'.$x.'" name="pagination" '); 
  
  }  ?>

  <?php echo new_button('<b>+ 5</b>','','light','type="button" onclick="next_page(this.value)" value="6"'); ?>  
</span>

  <?php echo new_button('Last >','','secondary','value="'.$total_pages.'" name="pagination" onclick="next_page('.($total_pages).');" '); ?>
</div>
</div>
  <div class="card-footer">
    <span id="withdraw_tab">
    <?php $this->load->view($withdraw_tab); ?> 
</span></div>
</div>

<br>

</div>

<script>

  function next_page(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pages").innerHTML = this.response;

    }
  };

  xmlhttp.open("GET", "<?php echo base_url(); ?>promoter/page_buttons?page="+ str, true);
  xmlhttp.send();
}

    $('[name="pagination"]').on('click',function(){
                      

                        var page = $(this).val();

                      $.ajax({

                         url: "<?php echo base_url(); ?>promoter/withdraw_tab?page=" + page,
                    type: "GET",
                    data: { page : page },

                    success: function(data) { 
                                      
                                    
                                      $('#withdraw_tab').html(data);

        
                    }

                      });
                    });
</script>

  <!-- END RESPONSIVE DIV-->
</div>
  <!-- 2ND BOX-->
<div class="col-sm-4">

<?php $this->load->view($promo_box); ?>
<br>
<?php $this->load->view('buster/promo/promo_lvl'); ?>

</div>



</div>



</div>
  
</div>
<script>
  
$('[name="graphic"]').click(function(){


var view = $(this).attr('id');

    $.ajax({

      url: "<?php echo base_url(); ?>promoter/change_view",
      type: "POST",
      data: { view : view, },

      success: function(data) {

            $('#graphic').html(data);
   
            }       
        
      });

});

  
        $('#transfer').click(function(event){
      event.preventDefault();


      transfer();


        });



</script>

<?php $this->load->view('buster/promo/transfer_script') ?>