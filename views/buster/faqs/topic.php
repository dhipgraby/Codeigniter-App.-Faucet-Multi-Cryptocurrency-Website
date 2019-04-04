<?php echo new_button('< Back','gback','dark submenu'); ?>  <br><br>

<script>
  $('#gback').click(function(){

window.history.go(-1);


});

</script>


<style type="text/css">
  
</style>
<?php

if(count($faqs)){

$i = 1;

foreach ($faqs as $faq) {

if(!empty($faq->slug)){

$video = '<iframe style="box-sizing: border-box;" class=".embed-responsive-item" src="'.$faq->slug.'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

}
else {  $video = ''; }

$i++;

echo '  <div class="card">
    <div class="card-header" id="heading'.$i.'">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="true" aria-controls="collapseOne">
        '.$faq->title.'
        </button>
      </h5>
    </div>

    <div align="center" id="collapse'.$i.'" class="collapse hide" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
      <div class="card-body">
'.$video.'<br>  

       '.$faq->body.'
      </div>
    </div>
  </div>';



}


}

 ?>
