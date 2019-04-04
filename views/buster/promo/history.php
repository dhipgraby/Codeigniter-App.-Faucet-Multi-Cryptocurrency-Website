

<div class="modal fade hide" id="modalhist" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
   
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-clipboard-list"></i> History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body table-responsive">
<h5>Last 10 days</h5>
<br>
<table class="table">

<tr>
  <td>Date</td>
  <td>Valid views</td>
  <td>Paid (BTC)</td>
</tr>
<?php if(count($history)){

foreach ($history as $key) {

 ?>
<tr>
  <td><?php echo substr($key->datetime, 0, -8); ?></td>
    <td><?php echo $key->validviews; ?></td>
      <td><?php echo number_format($key->paid,8); ?></td>
</tr>
  
<?php } } else { echo 'No History to show.'; } ?>

</table>
      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal"  class="btn btn-secondary">Close</button>
     
      </div>

   
    </div>
  </div>
</div>
