<?php $this->load->view('admin/components/page_head'); ?>

 <?php echo new_button('< atras','gback','primary'); ?>
 
    <div class="container">
          
          <!-- Main Colum -->
             
        <div class="col-sm-12 blog-main">
<?php $this->load->view($subview); ?>
                  </div>
                   <!-- Sidebar -->
                  

                

</div>
  <?php $this->load->view('admin/components/page_tail'); ?>