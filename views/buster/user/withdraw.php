<?php $this->load->view('buster/components/menu_account'); ?> 


<script>
  function paginator(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("withdraw_tab").innerHTML = this.response;

    }
  };

  xmlhttp.open("GET", "<?php echo base_url(); ?>withdraw/withdraw_tab?page="+ str, true);
  xmlhttp.send();
}
</script>


<?php $this->load->view('buster/user/withdraw_form'); ?>
  

<br>
<div class="card" align="center">
  <div class="card-body">
<h3>Withdrawal History</h3>


<div class="btn-group m-3" role="group" aria-label="First group">
<?php echo new_button('< First ','','secondary','value="1" name="pagination" onclick="next_page(0);" '); ?>
<span id="pages">

<?php echo new_button('<b>- 5</b>','','light','type="button" onclick="next_page(this.value)" value="1"'); ?>

<?php for($x=1; $x<=5; $x++) {

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

  xmlhttp.open("GET", "<?php echo base_url(); ?>withdraw/page_buttons?page="+ str, true);
  xmlhttp.send();
}

    $('[name="pagination"]').on('click',function(){
                      

                        var page = $(this).val();

                      $.ajax({

                         url: "<?php echo base_url(); ?>withdraw/withdraw_tab?page=" + page,
                    type: "GET",
                    data: { page : page },

                    success: function(data) { 
                                      
                                    
                                      $('#withdraw_tab').html(data);

        
                    }

                      });
                    });
</script>
