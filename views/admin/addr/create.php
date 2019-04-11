	
<?php echo $this->load->view('admin/addr/settings_amd'); ?>

					<div class="tab-pane tab-content" id="verify">
						

<?php echo $this->load->view('admin/addr/verify'); ?>
						<div class="row" id="index_check">
						
<?php $this->load->view('admin/addr/index_check'); ?>

              	</div>
					</div>

<script>

</script>
					<script>
						$(document).ready(function(){

$('#verifyBtn').click();
						 });
			
					</script>

