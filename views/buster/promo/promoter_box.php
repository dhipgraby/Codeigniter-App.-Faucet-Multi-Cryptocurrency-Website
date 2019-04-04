  
<div class="card bg-light mb-3" style="max-width: 18rem;" align="center"> 
  <div class="card-header"> <h4><b style="color:#42B2F1;"><i class="fas fa-user-tie"></i> Promoter lvl:</b> <?php echo $promoter_lvl; ?></h4></div>
  <div class="card-body">

   <p class="card-title">You need at least <?php echo $min_views; ?> views in the last 30 days of your <a href="<?php echo base_url() ?>refer">"referral Link"</a> to ascent to <?php echo $next_ascent; ?>.</p>
 <br>

<table class="table">

<tr>
  <td><b>Views left for Promoter Ascent</b></td>
  <td><b>Promoter status</b></td>
</tr>

<tr>
  <td><?php echo $left_views ; ?></td>
   <td><?php echo new_button('Active','active','success'); ?></td>

</tr>


</table>
  </div>
</div>



