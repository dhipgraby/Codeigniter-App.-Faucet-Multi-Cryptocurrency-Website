       <span id="qrcode"><img width="200px" height="200px" src="<?php echo base_url() ?>deposit/qrcode/<?php echo $dep_address; ?>"></span>

            <br>

            <p>

<b>This is your <span name="currency">Bitcoin</span> Address</b>
<br>
              <span id="myresult"> <?php echo $dep_address; ?></span></p>



<br>

<p>
 
Deposit only <b><span name="currency">Bitcoin</span></b> to this address to credit your user Balance.<br>
The deposit will credit after 5 <a href="http://bitcoinsimplified.org/learn-more/confirmations/" target="_blank">network confirmation</a>, minimum deposit <b><span id="minimum">0.0001 BTC</span></b></p>
<br>

<?php if(isset($create_btn)){ echo $create_btn; } ?>
<br>
<?php if(isset($newaddr)){$this->load->view($newaddr); } ?>