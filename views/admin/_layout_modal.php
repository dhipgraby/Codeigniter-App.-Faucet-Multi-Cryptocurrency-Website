  <?php $this->load->view('admin/components/page_head');
    ?>

  <body>

  
<div class="container">
  <h2>The LOMP</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Login</button>

 <!--  Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

      <?php $this->load->view($subview); ?>

        <div class="modal-footer">
        &copy; <?php echo  $meta_title; ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

  <?php $this->load->view('admin/components/page_tail'); ?>