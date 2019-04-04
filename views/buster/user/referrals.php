<?php $this->load->view('buster/components/menu_account'); ?> 


<script>
  function paginator(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint2").innerHTML = this.response;

    }
  };

  xmlhttp.open("GET", "<?php echo base_url(); ?>refer/paginator?page="+ str, true);
  xmlhttp.send();
}
</script>


<div class="card" align="center">
  <div class="card-header">
Referral promo Material
  </div>
  <div class="card-body">
  

   
<div class="input-group mb-1">
  <div class="input-group-prepend">

  
    <span class="input-group-text" id="basic-addon1"><b> Your Referral Url:</b></span>
  </div>
<input class="form-control" type="text" name="refurl" value="<?php echo base_url() ?>main?ref=<?php echo $this->session->id; ?>" readonly>
</div>
<div class="input-group mb-1">
  <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"><b><i style="margin-left: 4px;" class="fa fa-users" aria-hidden="true"></i>  Total referrals:</b></span>
  </div>
  <input type="text" class="form-control" value="+ <?php echo count($total_ref); ?>" readonly>
</div>


         <br>

<p>Promote your referral Url to got more Referrals and earn from comision<br>
Use Banners into your website or social media to attract more users as your referrals.

</p><br>
<?php echo new_button('Banners','banners','dark submenu','data-toggle="modal"  data-target="#modal"') ?>

<br>
<!-- MODAL CONTENT-->
<div class="modal fade hide" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
   
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Banners</h5>
        <button type="button" class="close" aria-label="Close"  data-dismiss="modal" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body table-responsive">
    <?php $this->load->view('buster/promo/banners'); ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  data-dismiss="modal" >Close</button>
       
       </div>

   
    </div>
  </div>
</div>

<!-- -->
<br>
<p>
<b>How its work?</b>
<br>
When a new user register using your promote URL, this user will be your referral and you will Earn 25 % lifetime of all referrals claims

</p>

<br>

<b> Total BTC earned Referral comision:</b>   
<div class="input-group mb-1">
<input class="form-control" type="text" value="<?php echo $total_btc; ?>" readonly>
</div>

<br>
<b> Total DOGE earned Referral comision:</b>

<div class="input-group mb-1">
<input class="form-control" type="text" value="<?php echo number_format($total_doge,0); ?>" readonly>
</div>

<h3><b>Referral Activity</b></h3><br>
<div class="btn-group" role="group" aria-label="Basic example">
<button class="btn" onclick="paginator(this.value)" value="1">< First</button>

<?php for($x=1; $x<=$total_ref_pages; $x++) {
  echo '<button class="btn" onclick="paginator(this.value)" value="'.$x.'">'.$x.'</button>';
  }  ?>

 <?php echo '<button class="btn" onclick="paginator(this.value)" value="'.$total_ref_pages.'">Last ></button>'; ?>
</div>


   </div>
<div class="card-footer">
  

<span id="txtHint2">
   <?php $this->load->view($paginator); ?> 
</span>

</div>



</div>