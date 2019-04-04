  
<div class="card bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header"><i class="fas fa-user-tie"></i> <h4>Become a Promoter</h4></div>
  <div class="card-body">

   <p class="card-title">You need at least 2000 views of your <a href="<?php echo base_url() ?>refer">"referral Link"</a> to become a promoter<br>
 once you have the minimum views, your status will change from inactive to Active, so you can start earn for each visit/view your referral link receive</p>
 <br>
    <a href="<?php echo base_url() ?>article/13/become" class="btn btn-dark submenu"><i class="fas fa-book"></i> Read promoter guide</a>
<br>
<br>
<table class="table">

<tr>
  <td><b>Views left for become a Promoter</b></td>
  <td><b>Promoter status</b></td>
</tr>

<tr>
  <td><?php echo $left_views ; ?></td>
   <td><?php echo ($left_views < 0) ? new_button('Active','active','success') : new_button('Inactive','active','secondary') ; ?></td>

</tr>


</table>
  </div>
</div>



