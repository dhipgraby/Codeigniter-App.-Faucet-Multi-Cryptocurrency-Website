    
<!-- MENU NAVBAR -->
<div class="row" align="center">
  <div class="col-sm-10 justify-content-center" style="background-color: #000000;color:#ffffff;">
        <nav class="navbar navbar-expand-lg justify-content-center" id="mynavbar">
       <a class="navbar-brand" href="<?php base_url() ?>dashboard"><img src="<?php echo base_url() ?>images/logo.png" width="55px;" height="46px;" style="border-radius: 10px;"></a>

    <button style="color:#ffffff;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<i style="color:#ffffff;" class="fas fa-bars"></i>
  </button>

  <div align="center" class="collapse navbar-collapse" style="justify-content: center;" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">

  <?php echo my_menu($menu); ?>
            
    </ul>
    <!-- Translate -->

<div id="google_translate_element" style="float:right; padding: 10px;"></div> 
  </div>
  <!-- End Translate -->
</nav>

  </div>
<div style="background-color: #fbb728;color:#000000; padding: 15px;left: 0;" class="row col-sm-2 justify-content-center">
  

<?php

if($this->login_m->loggedin() == FALSE){

 ?>

 <a style="margin-right: 5px; cursor: pointer;" class="nav-link log_buttons" data-toggle="modal" data-target="#myModal"><b style="color:#000000;" >Login</b></a>
  <a class="nav-link log_buttons" data-toggle="modal" data-target="#Modal"><b style="color:#000000; cursor: pointer;
" >Register</b></a>

 <?php } else { ?> 

<a class="nav-link log_buttons" href="<?php base_url() ?>account" style="margin-right: 5px; cursor: pointer;"><b style="color:#000000;">Account</b></a>
<a class="nav-link log_buttons" href="<?php base_url() ?>logout"><b style="color:#000000;cursor: pointer;" >Logout</b></a>

  <?php }?>

</div>

</div>
