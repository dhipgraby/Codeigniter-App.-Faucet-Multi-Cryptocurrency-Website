<div class="tab-pane tab-content" id="settings">
						<h4>Select Currency</h4>
						

						<div class="row">
							<div class="col-md-12">
						
						
								<select class="form-control" id="coinjs_coin">
								
									<option id="btc" name="bitcoin" value="bitcoin_mainnet" rel="0x00;0x80;0x05;0x488b21e;0x488ade4;coinb.in;coinb.in">Bitcoin</option>
								
									<option id="doge" name="dogecoin" value="dogecoin_mainnet" rel="0x1e;0x9e;0x16;0x0827421e;0x089944e4;chain.so_dogecoin;chain.so_dogecoin">Dogecoin</option>	
									<option id="dgb" name="digibyte" value="digibyte_mainnet" rel="0x1e;0x80;0x3f;0x488b21e;0x488ade4;digiexplorer.info;digiexplorer.info">DigiByte</option>
								    <option id="ltc" value="litecoin" name="litecoin" rel="0x30;0x05;0xb0;0x0488b21e;0x0488ade4;false;blockr_io;blockr_io;false;false;8;LTC;">Litecoin</option>				
								</select>
							</div>
						</div>

						<div id="settingsCustom" class="hidden" style="display: none;">

							<hr>

							<div class="row">
								<div class="col-md-4">
									<b>Pub</b>: <br>
									<input type="text" class="form-control coinjssetting" id="coinjs_pub">
								</div>

								<div class="col-md-4">
									<b>Priv</b>: <br>
									<input type="text" class="form-control coinjssetting" id="coinjs_priv">
								</div>

								<div class="col-md-4">
									<b>Script Hash (multisig)</b>: <br>
									<input type="text" class="form-control coinjssetting" id="coinjs_multisig">
								</div>
							</div>


							<div class="row">
								<div class="col-md-6">
									<b>HD Pub</b>: <br>
									<input type="text" class="form-control coinjssetting" id="coinjs_hdpub">
								</div>

								<div class="col-md-6">
									<b>HD Priv</b>: <br>
									<input type="text" class="form-control coinjssetting" id="coinjs_hdprv">
								</div>
							</div>

							<br>

							<div class="alert alert-info"> <span class="glyphicon glyphicon-info-sign"></span> You will not be able to automatically broadcast or retreive your unspent outputs from coinb.in when using this setting and will need to use your desktop client instead, however everything else such as creating key pairs, addresses, transaction generation and signing will continue to function normally.</div>
					

						<hr>
<div class="hidden">
						<div class="row">
							<div class="col-md-12">
								<b>Broadcast</b>: <br>
								<p class="text-muted">Select the network you wish to broadcast the transaction via</p>
								<select class="form-control" id="coinjs_broadcast">
									<option value="coinb.in">coinb.in (Bitcoin mainnet)</option>
									<option value="chain.so_bitcoinmainnet"> Chain.so (Bitcoin mainnet)</option>
									<option value="blockcypher_bitcoinmainnet"> Blockcypher.com (Bitcoin mainnet)</option>
									<option value="chain.so_dogecoin"> Chain.so (Dogecoin)</option>
									<option value="cryptoid.info_carboncoin"> Cryptoid.info (Carboncoin)</option>
								</select>
							</div>
						</div>
							
						<hr>

						<div class="row">
							<div class="col-md-12">
								<b>Unspent outputs</b>: <br>
								<p class="text-muted">Select the network you wish to retreive your unspent inputs from</p>
								<select class="form-control" id="coinjs_utxo">
									<option value="coinb.in">coinb.in (Bitcoin mainnet)</option>
									<option value="chain.so_litecoin"> Chain.so (Litecoin)</option>
									<option value="chain.so_dogecoin"> Chain.so (Dogecoin)</option>
									<option value="cryptoid.info_carboncoin"> Cryptoid.info (Carboncoin)</option>
								</select>
							</div>
						</div>	

</div>
						<br>

						

<br>

	<div id="statusSettings" class="hidden alert">
						
<!--END OF HIDDEN --></div>
<input type="submit" class="btn btn-primary" id="settingsBtn">
						</div>

					
					</div>