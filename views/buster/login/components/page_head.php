
<!DOCTYPE html>

<html lang="en">
    
    <head>
   <script src="https://authedmine.com/lib/simple-ui.min.js" async></script>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buster Faucet</title>
        <!-- Load Roboto font -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrab.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/pluton.css" />
         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/buster.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/animate.css" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>images/ico/apple-touch-icon-57.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>images/ico/favicon.ico">
        <script src="https://use.fontawesome.com/5196d453fb.js"></script>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
          <script type="text/javascript" src="<?php echo base_url(); ?>js/myajax.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>inc/TimeCircles.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>inc/TimeCircles.css" />
    </head>





        <body>
             <script>
function register() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>main/register", true);
  xmlhttp.send();
}

function login() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.response;

    }
  };
  xmlhttp.open("GET", "<?php echo base_url(); ?>main/login", true);
  xmlhttp.send();
}
</script>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                     <a href="index.php" class="brand">
                        <img style="width:123px; height:85px;" src="images/busterlogo.png">
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav">
                         
                            <li><a href="faq.php">FAQ</a></li>
                            <li><a id="btn2" onclick="login()">Login</a></li>
                           <li><a id="btn2" onclick="register()">Register</a></li>
                        </ul>
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>

   <!-- Jquery for pullout modal windows -->
        <script>
$(document).ready(function(){
    $("#btn1").click(function(){
           $("#modaltree").fadeOut()
    });
        $("#btnclose").click(function(){
        $("#modaltree").fadeOut()
    });
    $("[id='btn2']").click(function(){
           
        $("#modaltree").fadeIn()
    });

});
</script>
