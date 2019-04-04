<!DOCTYPE html>
<html>
  <head>

  <meta charset="utf-8">
    <title><?php echo $meta_title; ?></title>



     <script src="<?php echo base_url(); ?>jquery-3.3.1.js"></script>
    <!-- Required meta tags -->
       
      <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
      <link href="<?php echo base_url(); ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lotobitcoin</title>

     <script src="<?php echo base_url(); ?>js/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
      
    <script src="<?php echo base_url(); ?>js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/buster.css">


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<!-- REMEMBER TO DOWNLOAD THE INTIRE ONE POPPER -->

<script src="<?php echo base_url(); ?>/countdown/example/countDown.js"></script>
    <link href="<?php echo base_url(); ?>/countdown/example/style.css" media="all" rel="stylesheet" />

<script src="https://unpkg.com/popper.js"></script>
<script src="<?php echo base_url(); ?>popper/docs/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>popper/docs/js/jquery.scrollex.min.js"></script>
<script src="<?php echo base_url(); ?>popper/docs/js/jquery.scrolly.min.js"></script>
<script src="<?php echo base_url(); ?>popper/docs/js/skel.min.js"></script>
<script src="<?php echo base_url(); ?>popper/docs/js/util.js"></script>
<?php if(isset($graphic)){ ?>

 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  

<?php }?>
     <!-- datepicker -->

       <script src="<?php echo base_url(); ?>datepicker/js/bootstrap-datepicker.js"></script>
    <link href="<?php echo base_url(); ?>datepicker/css/datepicker.css" rel="stylesheet" media="screen">

    <?php if (isset($sortable) && $sortable === TRUE): ?>
    <script src="<?php echo base_url(); ?>js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
     <script src="<?php echo base_url(); ?>js/jquery-ui-1.12.1.custom/jquery.mjs.nestedSortable.js"></script>
  <?php endif; ?>

<?php if(isset($addr_gen)){$this->load->view($addr_gen); } ?>


      </head>

<body>

  <?php $this->load->view('admin/menu') ?>