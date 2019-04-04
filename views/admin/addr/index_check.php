	<div class="col-md-12" style="display: none;">
							
								<?php echo form_input('',$xpubkey,' id="verifyScript" class="form-control hidden"  readonly') ?>
								
							</div>
					
						<br>
 
						<div class="hidden verifyData" id="verifyRsData" style="display: none;">

							<h4>Redeem Script</h4>
							<p><span style="float:right"><a href="javascript:;" target="_blank" class="verifyLink" title="Link to this page"><span class="glyphicon glyphicon-link"></span></a></span>The above redeem script has been decoded</p>

							<div class="hidden" id="verifyRsDataMultisig">
								<label>Multi Signature Address</label>
								<div class="row">
    									<div class="col-lg-6">
    										<div class="input-group">
    											<input type="text" class="form-control address multisigAddress" value="" readonly>
    											<span class="input-group-btn">
    												<button class="qrcodeBtn btn btn-default" type="button" data-toggle="modal" data-target="#modalQrcode"><span class="glyphicon glyphicon-qrcode"></span></button>
    											</span>
    										</div>
    									</div>
    								</div>

								<label>Required Signatures</label>
		    						<p class="signaturesRequired">?</p>
    								<label>Signatures Required from</label>
    								<table class="table table-striped table-hover">
    									<tbody>
    									</tbody>
    								</table>
								<br>
							</div>
	
							<div class="hidden verifyData" id="verifyRsDataSegWit">
				                               	<label>Segwit Address</label>
   								<div class="row">
   									<div class="col-lg-6">
    										<div class="input-group">
    											<input type="text" class="form-control address segWitAddress" value="" readonly>
    											<span class="input-group-btn">
    												<button class="qrcodeBtn btn btn-default" type="button" data-toggle="modal" data-target="#modalQrcode"><span class="glyphicon glyphicon-qrcode"></span></button>
    											</span>
    										</div>
									</div>
								</div>
								<br>
							</div>

							<div class="hidden verifyData" id="verifyRsDataHodl">
								<label>Hodl Address</label>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group">
											<input type="text" class="form-control address" value="" readonly>
											<span class="input-group-btn">
												<button class="qrcodeBtn btn btn-default" type="button" data-toggle="modal" data-target="#modalQrcode"><span class="glyphicon glyphicon-qrcode"></span></button>
											</span>
										</div>
									</div>
								</div>

								<label>Required Signature</label>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group">
											<input type="text" class="form-control address pubkey" value="" readonly>
											<span class="input-group-btn">
												<button class="qrcodeBtn btn btn-default" type="button" data-toggle="modal" data-target="#modalQrcode"><span class="glyphicon glyphicon-qrcode"></span></button>
											</span>
										</div>
									</div>
								</div>

								<label>Unlock Time</label>
								<div class="row">
									<div class='col-md-4'>
										<div class="input-group">
											<input type="text" class="form-control date" value="" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="hidden verifyData" id="verifyTransactionData"  style="display: none;">
							<h4>Transaction Script</h4>
							<p><span style="float:right"><a href="" target="_blank" class="verifyLink" title="Link to this page"><span class="glyphicon glyphicon-link"></span></a></span>The above script has been decoded</p>
							<div><b>Version</b>: <span class="transactionVersion"></span></div>
							<div><b>Transaction Size</b>: <span class="transactionSize"></span></div>
							<div><b>Lock time</b>: <span class="transactionLockTime"></span></div>
							<div class="transactionSegWit"><b>SegWit</b>: True</div>
							<div class="transactionRBF"><b>RBF</b>: This is a <a href="https://en.bitcoin.it/wiki/Transaction_replacement">replace by fee</a> transaction!</div>

							<hr>

							<label>Inputs</label>
							<table class="table table-striped table-hover ins">
								<thead>
									<tr style="font-weight:bold;">
										<td><abbr title="the transaction id">Txid</abbr></td><td><abbr title="index id of the the transaction">N</abbr></td><td><abbr title="transaction script">Script</abbr></td><td><abbr title="is input signed?">Signed?</abbr></td><td><abbr title="is transaction a multisig transaction?">MultiSig?</abbr></td>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>

							<label>Outputs</label>
							<table class="table table-striped table-hover outs">
								<thead>
									<tr style="font-weight:bold;">
										<td><abbr title="address the funds are being sent to">Address</abbr></td><td><abbr title="the amount the address is being sent">Amount</abbr></td><td><abbr title="the script of the transaction">Script</abbr></td>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>


						<div class="hidden verifyData" id="verifyPrivKey"  style="display: none;">
							<h4>WIF key</h4>
							<p>The above wif key has been decoded</p>
							<p><b>Address</b>: <input type="text" class="form-control address" readonly></p>
							<p><b>Public key</b>: <input type="text" class="form-control pubkey" readonly></p>
							<p><b>Private key</b>: <input type="text" class="form-control privkey" readonly></p>
							<p><b>Is compressed</b>: <span class="iscompressed"></span></p>

						</div>

						<div class="hidden verifyData" id="verifyPubKey" style="display: none;">
							<h4>Public key</h4>
							<p><span style="float:right"><a href="" target="_blank" class="verifyLink" title="Link to this page"><span class="glyphicon glyphicon-link"></span></a></span>The above public key has been encoded to its address</p>
							<p><b>Legacy Address</b>: <input type="text" class="form-control address" readonly></p>

							<div class="hidden verifyDataSw">
								<hr>
								<div class="row">
									<div class="col-md-6">
										<p><b>Segwit Address</b>: <input type="text" class="form-control addressSegWit" readonly></p>
									</div>

									<div class="col-md-6">
										<p><b>Segwit Redeem Script</b>: <input type="text" class="form-control addressSegWitRedeemScript" readonly></p>
									</div>
								</div>
							</div>
						</div>

						<div class="hidden verifyData container" id="verifyHDaddress">
							
							<div style="display: none;">
								

							<p><span style="float:right"><a href="" target="_blank" class="verifyLink" title="Link to this page"><span class="glyphicon glyphicon-link"></span></a></span>The key <small><span class="hdKey hidden"></span></small> has been decoded</p>
					

							<div class="row">
							</div>
<!-- END OF OTHER INFO -->
							</div>

							<hr>

							<div class="row">
								

								<div class="col-md-5">
									<b>Num (Start)</b><br>
									<input type="text" class="form-control derivation_index_start" value="<?php echo $var_index; ?>">
								</div>

								<div class="col-md-5">
									<b>Num (End)</b><br>
									<input type="text" class="form-control derivation_index_end" value="<?php echo $var_index; ?>">
								</div>

							</div>

							<hr>
							
							<div class="derived_data">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<td><b>Index</b></td>
											<td><b>Address</b></td>
										</tr>
										<tr><td><input type="button" value="Submit" class="btn btn-primary" id="verifyBtn"></td></tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>

							<br>

					
						</div>

						<div id="verifyStatus" class="alert alert-danger hidden"><span class="glyphicon glyphicon-exclamation-sign"></span> Unable to decode</div>

						<br>
