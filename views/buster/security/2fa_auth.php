
<h4>Second factor options (2FA)</h4><br>
<h5>Login second factor (2FA).</h5>
<small>secure your account login using a second factor</small>
<table class="table">
	<tr>
        <td>Current factor:</td>
		<td><?php echo $log_options;?></td></tr>
<tr>
	<td>

		<?php if($current_login != 'password'){ echo '<button name="remove" class="btn btn-secondary" id="login">Remove Factor</button>';  }  ?>
	</td>
</tr>

</table>


<br>

<h5>Security access second factor (2FA).</h5>
<small>set a extra second factor to the access of securty section</small>
<table class="table">
	<tr>
        <td>Current factor:</td>
		<td><?php echo $sec_options;?></td></tr>
<tr>
	<td>
		<?php echo $current_security == 'password' ? '' :  '<button name="remove" class="btn btn-secondary" id="security">Remove Factor</button>'; ?>
	</td>
</tr>

</table>


<br>

<h5>Withdraw second factor (2FA).</h5>
<small>Second factor for withdrawals request</small>
<br>


<span id="book_r"><?php $this->load->view('buster/security/address_book'); ?></span>

<table class="table">
	<tr>
        <td>Current factor:</td>
		</tr>
<tr><td><?php echo $withdraw_options;?></td></tr>
		<tr>
<td>Withdraw only from Address list: </td>
			</tr>
			<tr><td>
			
		<label class="switch">
  <input type="checkbox" id="addr_only" <?php if($addr_only == 'on'){ echo 'checked'; } ?>>
  <span class="slider round"></span>
</label>	
		</td></tr>
<tr>
	<td>
				<?php echo $current_withdraw == 'password' ? '' :  '<button name="remove" class="btn btn-secondary" id="withdraw">Remove Factor</button>'; ?>

				<span id="open_book"></span>
		<button class="btn btn-<?php if($addr_only == 'on'){ echo 'primary'; } if($addr_only == 'off'){ echo 'secondary'; }  ?> m-l-2" id="addr_book">Manage Address list Book</button>
	</td>
</tr>

</table>