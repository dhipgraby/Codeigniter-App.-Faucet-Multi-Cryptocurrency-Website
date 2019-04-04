

<div class="modal fade hide" id="modalinfo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
   
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-info-circle"></i> Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body table-responsive">
<h5>About Promoters</h5>
<br><?php

if(count($faqs)){

$i = 1;

foreach ($faqs as $faq) {



$i++;

echo '  <div align="center">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse2" data-target="#collapse'.$i.'" aria-expanded="true" aria-controls="collapseOne">
        '.$faq->title.'
        </button>
      </h5>
 </div>

    <div align="center" id="collapse'.$i.'" class="collapse2 hide" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
     


       '.$faq->body.'

  </div>';



}


}

 ?>

      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal"  class="btn btn-secondary">Close</button>
     
      </div>

   
    </div>
  </div>
</div>
