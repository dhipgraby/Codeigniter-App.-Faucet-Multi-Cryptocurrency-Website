

<div class="col-sm-4">
<br>
<div class="group btn" align="left">


<?php echo new_button('Current round',intval($lottery->round),'dark submenu m-3','onclick="show_result(this.id,'.$lottery->type.')" name="c_round'.$lottery->type.'"') ?>
<?php echo new_button('Last round',intval($lottery->round)-1,'dark submenu','onclick="show_result(this.id,'.$lottery->type.')" name="last_round'.$lottery->type.'"') ?>


</div>

<br>
<div class="input-group mb-3">
  <input  type="number" class="form-control" placeholder="Check round" id="check<?php echo $lottery->type; ?>">
  <div class="input-group-append">
         <?php echo  new_button('check','check'.$lottery->type,'info','onclick="show_round('.$lottery->type.')"'); ?>
  </div>
</div>

<br>
<div align="left">
	
<?php echo new_button('<i class="fas fa-ticket-alt"></i> Your tickets',$lottery->type,'dark','onclick="show_stats(this.id)"') ?>

</div>


<br>
<div class="scene scene--cardto" style="perspective: 2000px;">
  


<?php

$this->data['lottery'] = $this->sit_lottery_m->_get_lottery($lottery->type,$lottery->coin);

 $this->load->view('buster/lottery/sit_lottery/card_view',$this->data); ?>

</div>
   

</div>