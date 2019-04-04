
<?php echo new_button('< Current','last','secondary','onclick="paginator(this.value); next_page('.($total_pages).');" value="'.$total_pages.'"') ?>



    <span id="pages"> 

    </span>
  <script>
    
$.ajax({

 url: "<?php echo base_url() ?>lottery/pages",
 type: "POST",
 data: { },

 success: function(data){

  
 $('#pages').html(data);

 }

});



  </script>

<?php echo new_button(' Older >','first','secondary','onclick="paginator(this.value); next_page(5);" value="1"') ?>
 


          <span id="txtHint2" align="center">
   <?php $this->load->view($paginator); ?> 
 
         </span>

