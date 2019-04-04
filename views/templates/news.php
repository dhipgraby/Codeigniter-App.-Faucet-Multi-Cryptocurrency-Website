<?php $this->load->view('components/page_head'); ?>
  <body>

  <div class="container" style="margin-top: 5px;">

  <h1 style="color: #16C6E5;"><img src="img/market.png" height="50px;" width="60px;"><?php echo anchor('home', config_item('site_name')); ?></h1>
 <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
           <a class="navbar-brand" href="<?php echo base_url(); ?>admin/dashboard">AMD</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
<?php echo get_menu($menu); ?>
           
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
       

    <div class="container">
          
  
          
         <?php $this->load->view('templates/' . $subview); ?>
                

</div>
  <?php $this->load->view('components/page_tail'); ?>

 </div>