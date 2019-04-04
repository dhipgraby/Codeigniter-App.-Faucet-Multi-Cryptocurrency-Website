<?php $this->load->view('buster/components/menu_account'); ?> 


<script>
//AJAX Pagination for deposits
function paginator_dep(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("deposit").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>deposit/deposit_tab?page_dep="+str, true);
  xmlhttp.send();
}
</script>

<br>
<span  align="center" id="message"></span>

<!-- START OF THE ADDRESS BOX -->

<div class="list-group-item list-group-item-action"  align="center">
<?php $this->load->view('admin/addr/settings'); ?>
 </div>

<div id="currency_box" class="card"  align="center">
  <div class="card-body">

            <span id="qrcode"><img width="200px" height="200px" src="<?php echo base_url() ?>deposit/qrcode/<?php echo $dep_address; ?>"></span>

            <br>

            <p>

<b>This is your <span name="currency">Bitcoin</span> Address</b>
<br>
              <span id="myresult"> <?php echo $dep_address; ?></span></p>
<br>

<?php if(isset($create_btn)){ echo $create_btn; } ?>
<br>

<p>
 
Deposit only <b><span name="currency">Bitcoin</span></b> to this address to credit your user Balance.<br>
The deposit will credit after 5 <a href="http://bitcoinsimplified.org/learn-more/confirmations/" target="_blank">network confirmation</a>, minimum deposit <b><span id="minimum">0.0001 BTC</span></b></p>


<?php if(isset($newaddr)){$this->load->view($newaddr); } ?>

</div>
</div>
<br>


<div class="card"  align="center">

  <div class="card-body">
  <h3>Deposit History</h3>
<div class="btn-group  justify-content-center" role="group" aria-label="Basic example">
<button class="btn btn-primary mt-2" onclick="paginator_dep(this.value)" value="1">< First</button>

<?php for($x=1; $x<=$total_dep; $x++) {
    echo '<button class="btn btn-primary mt-2" onclick="paginator_dep(this.value)" value="'.$x.'">'.$x.'</button>';
  }  ?>

 <?php echo '<button class="btn btn-primary mt-2" onclick="paginator_dep(this.value)" value="'.$total_dep.'">Last ></button>'; ?>
</div>

</div>

<div class="card-footer">

  <span id="deposit">
    <?php $this->load->view($deposit_tab); ?> 
</span>


</div>
</div>

