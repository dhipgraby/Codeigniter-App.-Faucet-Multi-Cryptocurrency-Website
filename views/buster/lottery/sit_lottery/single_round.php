

  <span class="cardto">
   <li class="list-group-item <?php if(isset($color)){ echo $color; } ?>">

      <small style="float:left;">Round: <b><?php echo $round->round; ?></b></small>

      <small style="float:right;">Bought tickets: <b>
        <?php echo count($this->sit_lottery_m->_tickets_in_round($round->type,$round->round,$round->coin)); ?></b></small>
      
      <br>
  <p>     

    <b style="font-size: 18px; float:left;"><i class="fas fa-crown"></i> <?php echo $winner->address; ?></b>

    </p>

    
<?php echo new_button('Check',$round->round,'info','onclick="show_result(this.id,'.$round->type.')"'); ?>




</li>
</span>

