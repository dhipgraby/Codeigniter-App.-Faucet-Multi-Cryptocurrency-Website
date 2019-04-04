<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packs extends Frontend_Controller {
 
  function __construct() {
      parent::__construct(); 

      $this->load->model('credit_m');
        $this->load->model('buster_m');
           $this->load->model('lottery_m');
             $this->load->model('sit_lottery_m');

     
      
   }


public function index(){

$lotteries = $this->db->group_by('type')
                      ->where('status','current')
                      ->where('coin','btc')
                      ->get('sit_winners')->result();

$this->data['lotteries'] = $lotteries;



$this->data['pagetitle'] = '<i class="fas fa-gift"></i> Special Packs';
$this->data['mainview'] = 'buster/promo/loto_packs';
$this->load->view('buster/main_body', $this->data);


}


function process(){

      $id = $this->session->id;
     
     $this->db->where('id',$id);
    $user = $this->db->get('faucet')->row();    
 
 $pack = $this->input->post('pack');

 $data = $this->_check_pack($pack);

$amount = $data['amount'];
$price = $data['price'];
  $tickets = $data['tickets'];

$currency = 'btc';

if(empty($currency)){

  return FALSE;
}

if($this->credit_m->_check_funds($amount,$currency) == TRUE){


      if($this->credit_m->_ticket_payment($id,$amount,$currency) == TRUE){

        //PASS THIS TO CREDIT CONTROLLER
    $this->db->where('id',$id);
     $this->db->set('tickets',$user->tickets + $tickets);
     $this->db->update('faucet');

      $message = alert_msg("Succesfull bought ".$tickets." tickets for lottery round ".$this->lottery_m->current_game(),"success");

      $message_error = alert_msg("Server error, reload the page and try again or contact support","warning");

$c_round = $this->lottery_m->current_game();

$this->credit_m->_item_purchase($id,'ticket Round-'.$c_round ,$tickets,$price,'btc');

             echo ($this->db->affected_rows() < 1) ? $message_error : $message;

      }


 } else echo alert_msg('not enought balance','warning');

}

function _check_pack($pack){

switch ($pack) {
  case '10':
   
    return array(
       
       'amount' => 0.000495,
       'tickets' => 5500,
       'price' => 0.00000009,
     
     );

    break;

    case '20':
   
     return array(
       
       'amount' => 0.0009,
       'tickets' => 11250,
        'price' => 0.00000008,
     
     );

    break;
    case '30':
   
     return array(
       
       'amount' => 0.00179998,
       'tickets' => 25714,
       'price' => 0.00000007,
     );

    break;
    
}


}

}