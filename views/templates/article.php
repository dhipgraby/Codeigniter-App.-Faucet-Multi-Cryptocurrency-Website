<div class="row">
  


  <div class="col-sm-8 table-responsive">
<br>
<?php echo new_button('< Back','gback','dark submenu'); ?>  
<br>
<br>
<script>
      
    
$('#gback').click(function(){

window.history.go(-1);


});

</script>

<article>
  
<h1><?php echo $article->title; ?></h1>
<small><?php echo $article->pubdate; ?></small>
<br>
<?php echo !empty($article->link) ? new_button('Visit site','visit','dark submenu','style="float:right; margin-right:25%;"') : ''; ?>
<br>
<script>
  $('#visit').click(function(){

  var url = '<?php echo $article->link ?>';
    window.open(url, '_blank');
  });

</script>



<br>
<br>
<p><?php echo $article->body; ?></p>

</article>


      </div>

     <div class="col-sm-4">
<b>Lastest articles</b>
      <br>
<?php if(count($articles)){

for ($i=0; $i < 6; $i++) { 

?>

<div style="background-color: #f7f7f7; border: 1px solid #999; margin-top: 10px;margin-right: 10px; padding-left:  15px; opacity: 0.8;border-radius: 5px;background: url(http://lotobitcoin.com/images/whitebg.png);">
<article>

  <?php echo get_excerpt_lastarticles($articles[$i]); ?>

  
</article></div>

<?php

}

} ?>
     </div>

</div>
    