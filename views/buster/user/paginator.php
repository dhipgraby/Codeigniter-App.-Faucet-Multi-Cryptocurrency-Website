<table class="table table-responsive-lg">
  <tr>
  <td>Ref id</td>
  <td>Coin</td>
  <td>Total Comision</td>
  <td>Last Claim</td>

  </tr>

    <?php if(count($referral)): foreach($referral as $refer): ?>
  <tr>
<td><?php echo substr((sha1($refer->id)),0,6); ?></td>
<td><?php echo $refer->type; ?></td>
<td><?php echo ($refer->type == "doge") ? number_format($refer->reward,0) : $refer->reward; ?></td>
<td><?php echo date("Y-m-d",$refer->lastclaim); ?></td>
  </tr>
        <?php endforeach; ?> 

        <?php else: ?>
      <tr>
        <td colspan="3">No referrals yet.</td>
      </tr>
    <?php endif; ?>

  </table>