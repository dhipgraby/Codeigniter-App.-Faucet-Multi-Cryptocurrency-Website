<?php

$tickets = $this->sit_lottery_m->_ticket_array($lottery->type,$lottery->round,$lottery->coin);

 if(count($tickets)){

 foreach ($tickets as $ticket) { 
  
$this->data['ticket'] = $ticket;
$this->data['winner_address'] = $winner_address;
$this->data['lottery'] = $lottery;

  $this->load->view('buster/lottery/sit_lottery/single_ticket',$this->data);

}

} ?>