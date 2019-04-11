
<div class="container" align="left">
  


<?php

if(count($news)){

foreach($news as $new){

?>

<h4><?php echo $new->title; ?></h4>
<small><b><?php echo $new->created; ?></b></small>
<br>
<p>
  <?php echo $new->body; ?>
</p>


<?php 

}

}


 ?>
 
</div>
