<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lottery extends Frontend_Controller {
 
  function __construct() {
      parent::__construct(); 
 
    $this->load->model('lottery_m'); 
    $this->load->model('credit_m'); 
    $this->load->model('email_m');
  
      
   }



public function index() {
    
     $this->session->set_userdata('access', FALSE);

$this->data['pagetitle'] = '<i class="fas fa-ticket-alt"></i>  Lotobitcoin Weekly Lottery';

    $id = $this->session->id;
 $perpage = 10;



$lottery = $this->lottery_m->draw_lottery();
$round = $this->lottery_m->current_game();


if($lottery == 2){

$this->lottery_m->draw_lottery();
$script = timescript(5,'lottery');
$this->data['finish_message'] =  alert_msg('Lottery round '.$round.' is finish! Selecting winners', 'success').$script;
  
} 


   //TOTAL PAGES
    $this->db->select('round');
    $count = $this->db->count_all_results('lottery');
    
    $total_pages = ceil($count / $perpage);

$page = $total_pages;
$this->data['page'] = $page;
   $start_from = ($page-1) * $perpage;
   $this->db->where('round', $page);
   $this->db->order_by('position');
     $this->db->order_by('round','ASC');
      $winners = $this->lottery_m->get();
   $this->data['winners'] = $winners;

   //Subviews
    $this->data['mainview'] = 'buster/lottery/loto_box';
    $this->data['paginator'] = 'buster/lottery/paginator';

$this->_preset_loto_data();
    
    $this->db->select('round');
    $count = $this->db->count_all_results('lottery');
    
    $this->data['total_pages'] = ceil($count / $perpage);

$this->load->view('buster/main_body', $this->data);

  
}

function _preset_loto_data(){

$id = $this->session->id;

    $this->data['tickets'] = $this->lottery_m->all_tickets();
    $this->data['amount'] = $this->lottery_m->all_tickets();
    $this->data['rounder'] = $this->lottery_m->current_game();
    $this->data['playerID'] = $this->lottery_m->getof($id)->playerID;
    $this->data['time_left'] = $this->lottery_m->check_timer();
    $this->data['user_tickets'] = $this->lottery_m->getof($id)->tickets;
    $this->data['user_prob'] =  number_format(($this->data['user_tickets'] * 100)/$this->data['tickets'],8);

}


public function paginator() {

  $perpage = 5;

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$this->data['page'] = $page;

   $start_from = ($page-1) * $perpage;
   $this->db->order_by('position');
    $this->db->order_by('round','ASC');
   $this->db->where('round', $page);
        $winners = $this->lottery_m->get();

echo '
  <h3 class="modal-title">Round:'. $page.'</h3>
<table class="table table-responsive-lg" align="center">
  <tr>

  <td>Place</td>
  <td>user Id</td>
  <td>Amount Won</td>
  <td>User tickets</td>

  </tr>';

    if(count($winners)) { 
  
foreach ($winners as $winner) {

echo
'<tr>
<td>' .$winner->position .'</td>
<td>'.  $winner->id .'</td>
<td>'.  $winner->amount . '</td>
<td>'.  $winner->tickets . '</td></tr>';

}
     
    }
    else {

         echo '<tr>
        <td colspan="3">No Winners.</td>
      </tr>';
    }

  echo '</table>';
  
}

function pages(){

   $perpage = 10;

    //TOTAL PAGES
    $this->db->select('round');
    $count = $this->db->count_all_results('lottery');
    
    $total_pages = ceil($count / $perpage);

 

if(isset($_GET["page"])) { $page  = ($_GET["page"] > 0) ? $_GET["page"] : $total_pages; } else { $page=$total_pages; };  

   $left_pages = $page - 4;

    if($left_pages >= $total_pages){

      $left_pages = $total_pages;
    }

    if($page >= $total_pages){

      $page = $total_pages;
    }

$next_pages = $page + 5;

if($left_pages < 0) $left_pages = 1;

echo new_button('<b>+ 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.$next_pages.'"');


echo '<div class="btn-group mr-2 ml-2" role="group" aria-label="First group">';

  for($x=$page; $x >= $left_pages; $x--) {
 

  echo new_button($x,'','light','type="button" onclick="paginator(this.value)" value="'.$x.'"');

  }  

  echo '</div>';


echo new_button('<b>- 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.($next_pages - 10).'"');
}



function update_stats(){

$this->_preset_loto_data();

  echo $this->load->view('buster/lottery/stats',$this->data);
}

function update_prizes(){

$this->_preset_loto_data();

  echo $this->load->view('buster/lottery/prizes',$this->data);
}

//IF THRE IS NOT CURRENT LOTTERY RUNNING, YOU CAN GET A NEW ONE
function new_lottery(){

echo ($this->lottery_m->new_lottery() == TRUE) ? 'SUCCESS' : 'error';
}


//DRAW THE CURRENT LOTTERY: CHOOSE WINNERS, RESET TICKETS, START A NEW LOTTERY
function draw(){

$lottery = $this->lottery_m->draw_lottery();
$round = $this->lottery_m->current_game();

if($lottery == 1){

echo alert_msg('Lottery round '.$round.' not finish jet, buy some tickets to win', 'info');

} 

if($lottery == 2){

$this->lottery_m->draw_lottery();
$script = timescript(2,'lottery');
echo alert_msg('Lottery round '.$round.' is finish! Selecting winners', 'success').$script;
  
} 

}



function process(){

      $id = $this->session->id;
     
     $this->db->where('id',$id);
    $user = $this->db->get('faucet')->row();    

  $amount = $this->input->post('amount');

$ticket_price = config_item('lottery_ticket');

$amount_calc = $amount * 100000000;

$currency = $this->input->post('currency');

if($currency != 'btc'){

$ticket_price = ticket_price($currency);

}

$tickets_calc =  $ticket_price  * 100000000;

  $tickets = $amount_calc / $tickets_calc;


if(empty($currency)){

  return FALSE;
}

if($this->credit_m->_check_funds($amount,$currency) == TRUE){


      if($this->credit_m->_ticket_payment($id,$amount,$currency) == TRUE){

        //PASS THIS TO CREDIT CONTROLLER
    $this->db->where('id',$id);
     $this->db->set('tickets',$user->tickets + $tickets);
     $this->db->update('faucet');

      $message = alert_msg("Succesfull bought ".round($tickets)." tickets for lottery round ".$this->lottery_m->current_game(),"success");

      $message_error = alert_msg("Server error, reload the page and try again or contact support","warning");

$c_round = $this->lottery_m->current_game();

$this->credit_m->_item_purchase($id,'ticket Round-'.$c_round ,$tickets,$ticket_price,$currency);

             echo ($this->db->affected_rows() < 1) ? $message_error : $message;

      }


 } else echo alert_msg('not enought balance','warning');

}


}