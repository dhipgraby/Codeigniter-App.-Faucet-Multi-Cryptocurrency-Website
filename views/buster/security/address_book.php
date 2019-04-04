
<script>
function paginator(str,coin) {

var coin = $('option:selected','#coinjs_coin').attr('id');

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("list").innerHTML = this.response;

    }
  };



  xmlhttp.open("GET", "<?php echo base_url(); ?>account/addressbook_tab?page="+ str +"&coin=" + coin, true);
  xmlhttp.send();
}

function next_page(str,coin) {

  var coin = $('option:selected','#coinjs_coin').attr('id');

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("pages").innerHTML = this.response;

    }
  };



  xmlhttp.open("GET", "<?php echo base_url(); ?>account/page_buttons?page="+ str +"&coin=" + coin, true);
  xmlhttp.send();
}

  $("#coinjs_coin").change(function(){

setTimeout(
  function() 
  {

    $('#settingsBtn').click();

var currency = $('option:selected','#coinjs_coin').attr('id');

$('#currency').html(currency);

    paginator(1);
    next_page(0); 

  }, 100);

 });


</script>




<div class="modal fade" id="modal_book" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">


    <div class="modal-content">


      <div class="modal-header">
        

        <h4 class="modal-title">Address Book</h4>
        
        <button type="button" class="close" name="destroy" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body table-responsive">



<?php echo $this->load->view('admin/addr/settings_amd'); ?>


<br>

<h5>Add new <span id="add_info"></span> Address</h5>
<span id='add_err'></span>
  <table class='table-responsive-sm'>
<tr>
  <td>Label</td>
  <td>Address</td>

</tr> 
<tr>
  <td> <?php echo form_input('label', '', 'class="form-control" id="label"') ?></td>
    <td><?php echo form_input('address', '', 'class="form-control" id="address"') ?></td>
</tr>

</table><br>
<?php echo new_button('Confirm','add_confirm','primary'); ?>

<script>
  

 $("#coinjs_coin").change(function(){

setTimeout(
  function() 
  {

    $('#settingsBtn').click();

  }, 100);

 });


</script>
<br><br>
<span id="message"></span>

<div class="table-responsive" align="center" style="justify-content: center;">
  

<?php echo new_button('< Fist','firt','secondary','onclick="paginator(this.value); next_page(0);" value="1"') ?>
  

   <span id="pages">
      
<?php echo new_button('<b>- 5</b>','','light','type="button" onclick="next_page(this.value)" value="1"'); ?>

  <div class="btn-group mr-2 ml-2" role="group" aria-label="First group">  

<?php for($x=1; $x<= $left_pages; $x++) {

  echo new_button($x,'','light','type="button" onclick="paginator(this.value)" value="'.$x.'"');

  }  ?>  

   </div>

  <?php echo new_button('<b>+ 5</b>','','light','type="button" onclick="next_page(this.value)" value="6"'); ?>

    </span>

<?php echo new_button('Last >','last','secondary','onclick="paginator(this.value); next_page('.($total_pages - 4).');" value="'.$total_pages.'"') ?>
 


<span id="list"> 
<?php $this->load->view('buster/security/address_tab'); ?>
</span>

</div>

<br>

     </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" name="destroy"> Close</button>
     
      </div>

   
    </div>
  </div>

</div>