<div class="row">

<?php if(count($articles)){

for ($i=0; $i < count($articles); $i++) { 

?>

<div class="col-md-6" style="padding: 5px;" ><div style="background-color: #f7f7f7; border: 1px solid #999; margin-top: 10px;margin-right: 10px; padding-left:  15px; opacity: 0.8;border-radius: 5px;background: url(http://lotobitcoin.com/images/whitebg.png);">
<article>

  <?php echo get_excerpt($articles[$i]); ?>

  
</article>
   </div></div>





<?php

}

} ?>
  



</div>
    