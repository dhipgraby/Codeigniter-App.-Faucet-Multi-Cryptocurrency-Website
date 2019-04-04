 <style type="text/css">
 	
 	.selected_coin {

color :#33AAFB;
cursor: pointer;

 	}
 </style>

 <div class="modal-header">
				 
<?php echo validation_errors(); ?>

         
          <h3 class="modal-title"><?php echo empty($user->id) ? 'Add new user' : 'Edit user '. $user->name; ?><br>
          	<?php echo form_input('id',$user->id,'class="form-control" id="userid" readonly') ?></h3>
         <small>Created: <?php echo date('Y-m-d',$user->datetime); ?></small>
        </div>
	
				

  <div class="modal-body table-responsive">
<table class="table">
	<tr>
<td>Name</td>
	<td><?php echo form_input('name', set_value('name', $user->name), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Email</td>
	<td><?php echo form_input('email', set_value('email', $user->email), 'class="form-control"'); ?></td></tr>
	<tr>
<td>Password</td>
	<td><?php echo form_password('password', '', 'class="form-control"'); ?></td></tr>
	<tr>
<td>Confirm Password</td>
	<td><?php echo form_password('password_confirm', '', 'class="form-control"'); ?></td></tr>
	<tr><td><?php echo form_submit('','Save', 'class="btn btn-primary"'); ?>
</td></tr>

</table>


<br>

<h3>Balances</h3>	
<br>

<table class="table">
	
	<tr>
		
		<td>Reward</td>
		<td>datetime</td>
		<td><b class="selected_coin">txid</b></td>
		<td><b class="selected_coin" onclick="search(null,'btc')">BTC</b></td>
		<td><b class="selected_coin" onclick="search(null,'doge')">DOGE</b></td>
		<td><b class="selected_coin" onclick="search(null,'dgb')">DGB</b></td>
		<td><b class="selected_coin" onclick="search(null,'ltc')">LTC</b></td>

	</tr>

<tr>
	
<td><?php echo date('Y-m-d h:i',$credit->reward); ?></td>
<td><?php echo date('Y-m-d h:i',$credit->datetime); ?></td>
<td><?php echo $credit->txid; ?></td>
<td><?php echo number_format($credit->btc,8); ?></td>
<td><?php echo number_format($credit->doge,8); ?></td>
<td><?php echo number_format($credit->dgb,8); ?></td>
<td><?php echo number_format($credit->ltc,8); ?></td>
</tr>



</table>
<br>

<h3>Transactions</h3>
<small>last 10 transactions</small>
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
<br>

<script>


	// TABLE RESULT
function paginator(str,id='<?php echo $user->id; ?>',category=null) {
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

var id = '<?php echo $user->id; ?>';

  xmlhttp.open("GET", "<?php echo base_url(); ?>/admin/transactions/pages?page="+str+"&id="+id, true);
  xmlhttp.send();
}
</script>



<div id="pagination">


</div>

</div>
<?php $this->load->view('admin/transactions/page_script'); ?>

<script type="text/javascript">
	
search();

</script>