<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo base_url() ?>">Administrator</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    
<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-users"></i>  User Manager
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php echo anchor('admin/transactions', '<i class="fas fa-exchange-alt"></i> Transactions','class="dropdown-item"'); ?>
  <div class="dropdown-divider"></div>
          <?php echo anchor('admin/user', 'Users','class="dropdown-item"'); ?>
           <?php echo anchor('admin/promoters', '<i class="fas fa-user-graduate"></i> Promoters','class="dropdown-item"'); ?>
  
              <div class="dropdown-divider"></div>
           <?php echo anchor('admin/withdraw', 'Withdrawals',' class="dropdown-item"'); ?>
           <?php echo anchor('admin/deposits', 'Deposits','class="dropdown-item"'); ?>
         
        </div>
      </li>
         
    
<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-gamepad"></i> Games
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php echo anchor('admin/lottery', '<i class="fas fa-ticket-alt"></i> Lottery','class="dropdown-item"'); ?>
           <?php echo anchor('admin/dice', '<i class="fas fa-dice"></i> Dice','class="dropdown-item"'); ?>
  
        </div>
      </li>
       

<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <i class="far fa-file-alt"></i> Info
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <?php echo anchor('admin/news', 'News','class="dropdown-item"'); ?>
          <?php echo anchor('admin/article', 'Articles','class="dropdown-item"'); ?>
           <?php echo anchor('admin/faq', 'FAQs','class="dropdown-item"'); ?>
  
        </div>
      </li>
  
    
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-bars"></i>   Menu manager
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <?php echo anchor('admin/page', 'Menu members','class="dropdown-item"'); ?>
         <?php echo anchor('admin/page/order', 'Order pages','class="dropdown-item"'); ?>
              <div class="dropdown-divider"></div>
            <?php echo anchor('admin/menu', 'Menu Visitors','class="dropdown-item"'); ?>
            <?php echo anchor('admin/menu/order', 'Order pages','class="dropdown-item"'); ?>
         
        </div>
      </li>

            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="far fa-address-book"></i> Address Manager
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <?php echo anchor('admin/addresses', 'Address checking','class="dropdown-item"'); ?>
       
         
        </div>
      </li>
               </ul>
   
    <div class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" id="searchid" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" id="mysearch">Search</button>
    </div>
 </div>
</nav>