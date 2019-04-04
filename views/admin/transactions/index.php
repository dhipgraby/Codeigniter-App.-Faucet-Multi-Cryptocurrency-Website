<style type="text/css">
	
.btn-dark {

	margin:5px;
}

</style>
<script>


	// TABLE RESULT
function paginator(str,id=0,category=null) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("mytable").innerHTML = this.response;

    }
  };

  xmlhttp.open("GET", "<?php echo base_url(); ?>admin/transactions/table?page="+str+"&id="+id+"&category="+category, true);
  xmlhttp.send();
}


//PAGE BUTTONS
function next_page(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pages").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>/admin/transactions/pages?page="+str, true);
  xmlhttp.send();
}
</script>



<h1>Site transactions.</h1>
<br>

<h3>Last transactions</h3>

<br>
<p><b>Filter by:</b>

<br>

<b>Category</b><br>

<div class="btn-group table-responsive">	
	<?php echo new_button('Faucet','faucet','dark','onclick="search(this.id)"') ?>
		<?php echo new_button('Withdraw','withdraw','dark','onclick="search(this.id)"') ?>
		<?php echo new_button('Deposit','deposit','dark','onclick="search(this.id)"') ?>
		<?php echo new_button('Ref reward','ref-reward','dark','onclick="search(this.id)"') ?>
		<?php echo new_button('Dice','dicegame','dark','onclick="search(this.id)"') ?>
		<?php echo new_button('S lottery','ticket-','dark','onclick="search(this.id)"') ?>
		<?php echo new_button('Lottery','ticket','dark','onclick="search(this.id)"') ?>
       <?php echo new_button('Genesis','genesis','dark','onclick="search(this.id)"') ?>
 
</div>
<br>
<b>User ID:</b>

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <?php echo form_input('userid', '', 'class="form-control" id="userid"') ?>
  </div>
  <?php echo new_button('Search','search','primary','onclick="search()"') ?> 
</div>



</p>
<div id="pagination">

<?php $this->load->view('admin/transactions/pagination'); ?> 

</div>

<?php $this->load->view('admin/transactions/page_script'); ?>