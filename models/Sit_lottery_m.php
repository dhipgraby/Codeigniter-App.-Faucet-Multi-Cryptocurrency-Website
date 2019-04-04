<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sit_lottery_m extends MY_Model {

protected $_table_name = 'sit_lottery';
protected $_table_col = 'sit_winners';

protected $_timestamps = TRUE;



  function __construct() {
      parent::__construct(); 

   }


   function _get_address($currency){

$id = $this->session->userdata('id');

$address = $this->db->where('id',$id)
     ->select($currency)
     ->limit(1)
     ->get('sit_address')->row();

return $address;

   }

   
//ADMIN FUNCTION TO CREATE LOTTERY BASE ON DATETIME GIVE IT BY SCRIPT
function new_lottery($coin){

$this->db->group_by('type');
$this->db->where('coin',$coin);
$lotteries = $this->db->get('sit_winners')->result();

$num = 0;
                    foreach($lotteries as $lottery) {                   

$num++;

    $round = $this->next_round($lottery->type,$coin) -1;
    $current_lottery = $this->db->where('status','current')
                            ->where('coin',$coin)
                            ->where('type',$lottery->type)
                            ->get('sit_winners')->row();

    $this->db->where('type',$lottery->type);
    $this->db->where('coin',$coin);
     $this->db->where('round',$round);
                  $this->db->where('status','stock');
                  $current_sit = $this->get();

                 $this->db->where('type',$lottery->type);
                 $this->db->where('coin',$coin);
                  $this->db->where('round',$round);
                  $sits = $this->db->get('sit_lottery')->result();


                          if(!count($current_sit) && count($sits) < 10){

                            for($i=0;$i<10;$i++){


                        $insert =  $this->_insert_ticket($lottery->type,$coin);

                          }

                          } elseif(!count($current_lottery)) {

$this->_get_new_lottery($lottery->type,$coin);

$this->new_lottery($coin);

}


                     } 


}

function _get_new_lottery($type,$coin){

    $round = $this->next_round($type,$coin);

$lottery = $this->db->where('type',$type)
          ->where('coin',$coin)
         ->limit(1)
         ->get('sit_winners')->row();

$data = array (

'players' => $lottery->players,
'perplayer' => $lottery->perplayer,
'jackpot' => $lottery->jackpot,
'coin' => $coin,
'type' => $type,
'round' => $round,
'method' => $lottery->method,
'datetime' => date('y-m-d h:i'),
'status' => 'current',

);

$this->db->insert('sit_winners',$data);

return ($this->db->affected_rows() < 1) ? FALSE : TRUE; 


}

function _mother_lottery($type,$coin){

if(!empty($coin)){

  $lottery = $this->db->where('type',$type)
         ->where('coin',$coin)
         ->limit(1)
         ->get('sit_winners')->row();

if(!count($lottery)){

$perplayer = $type / 100000;

if($coin == 'doge'){

$perplayer = $type * 10;

}

$jackpot = $perplayer * 9;
$method = 1;

if($type > 10){

  $method = ($type > 100) ? 3 : 2;
}

$data = array (

'players' => 10,
'perplayer' => $perplayer,
'jackpot' => $jackpot,
'coin' => $coin,
'type' => $type,
'round' => 1,
'method' => $method,
'datetime' => date('y-m-d h:i'),
'status' => 'current',
'end' => NULL,

);

$this->db->insert('sit_winners',$data);

return ($this->db->affected_rows() < 1) ? FALSE : TRUE; 

}

}

}

function _insert_ticket($type,$coin){
 

 $round = $this->next_round($type,$coin) -1;

$this->db->where('round',$round);
$current_sit = $this->db->get('sit_lottery');



$txid = randLetter().mt_rand(10000,99999).randLetter();

$data = array(

'coin' => $coin,
't_address' => $txid,
'type' => $type,
'round' => $round,
'datetime' => date('y-m-d h:i'),
'status' => 'stock',


  );

$this->db->set($data);
$this->db->insert('sit_lottery');

return ($this->db->affected_rows() < 1) ? FALSE : TRUE; 


}


//GAMES WITH CURRENT STATUS
public function next_round($type,$coin){

$this->db->where('type',$type);
$this->db->where('coin',$coin);
$this->db->select_max('round');
$sit_round = $this->db->get('sit_winners')->row();
$round = $sit_round->round + 1;

return $round;

}

function check_ticket($ticket,$type,$round,$coin){

$id = $this->session->userdata('id');

$ticket = $this->db->where('t_address',$ticket)
                   ->where('coin',$coin)
                   ->where('round',$round)
                   ->where('type',$type)
                   ->where('id',$id)
                   ->get('sit_lottery')->row();

                   if(count($ticket)){


                    return TRUE;
                   }

return FALSE;

}

function _user_tickets($type,$coin){

$id = $this->session->userdata('id');

if(!empty($id)){


$user_tickets = $this->db->where('id',$id)
         ->where('type',$type)
         ->where('coin',$coin)
         ->get('sit_lottery')->result();

return $user_tickets;

}

}

function _tickets_in_round($type,$round,$coin){

$id = $this->session->userdata('id');

if(!empty($id)){

$user_tickets = $this->db->where('id',$id)
         ->where('type',$type)
         ->where('coin',$coin)
         ->where('round',$round)
         ->get('sit_lottery')->result();

return $user_tickets;

}

}

function _user_rounds($type,$coin){

$id = $this->session->userdata('id');

if(!empty($id)){


$user_rounds = $this->db
         ->group_by('round')
          ->where('coin',$coin)
         ->where('id',$id)
         ->where('type',$type)
         ->get('sit_lottery')->result();

return $user_rounds;

}

}


function _winner_tickets($type,$coin){

$user_tickets = $this->_user_tickets($type,$coin);

$i = -1;

$data  = array();

foreach ($user_tickets as $ticket) {
  
$i++;

$data[$i] = $this->db->where('address',$ticket->t_address)
         ->where('type',$type)
         ->where('coin',$coin)
         ->where('round',$ticket->round)
         ->get('sit_winners')->row();

if(count($data[$i])){

  $winners[$i] = $data[$i];
}

}

return $winners;

}

function _get_lottery($type,$coin){

$round = $this->next_round($type,$coin) -1;

$current_lottery = $this->db->where('type',$type)
         ->where('round',$round)
         ->where('coin',$coin)
         ->where('status','current')
         ->limit(1)
         ->get('sit_winners')->row();

         return $current_lottery;


}

function _get_winner($type,$round,$coin){

  $lottery = $this->db->where('status','complete')
                    ->where('round',$round)
                    ->where('coin',$coin)                    
                    ->where('type',$type)
                    ->limit(1)
                    ->get('sit_winners')->row();
return $lottery;


}


function select_winner($type,$coin){

$round = $this->next_round($type,$coin) -1;


$this->db->where('round',$round);
$this->db->where('coin',$coin);
$this->db->where('type',$type);
$this->db->where('status','stock');
$current_sit = $this->get();

$this->db->where('status','sold');
$this->db->where('coin',$coin);
$this->db->where('type',$type); 
$this->db->where('round',$round);
$sits = $this->db->get('sit_lottery')->result();

if(!count($current_sit) && count($sits) == 10){

$lottery = $this->db->where('status','current')
                    ->where('round',$round)
                    ->where('coin',$coin)
                    ->where('type',$type)
                    ->limit(1)
                    ->get('sit_winners')->row();

$jackpot = $lottery->jackpot;


$winner = $this->db->where('round',$round)
          ->where('type',$type)
          ->where('coin',$coin)
          ->order_by('rand()')
          ->limit(1)
          ->get('sit_lottery')->row();

if(count($winner)){


$sit_address = $this->db->where('id',$winner->id)->limit(1)->get('sit_address')->row();

$paid = (count($sit_address)) ? $sit_address->payment : 'balance';



$data = array (

'address' => $winner->t_address,
'end' => date('y-m-d h:i'),
'status' => 'complete',
'paid' => $paid,

);

$this->db->where('type',$type)
         ->where('coin',$coin)
         ->where('round',$round)
         ->set($data)
         ->update('sit_winners');


if($this->db->affected_rows() > 0){

$credit = $this->db->where('id',$winner->id)
                   ->limit(1)
                   ->get('credit')->row();


$method = $sit_address->payment;

if($winner->type > 10){



}

if($method == 'address'){

   $data = array(

      'addy' => $sit_address->$coin,
      'amount' => $jackpot,
      'currency' => $coin,
      'status' => 'pending',
      'datetime' => date('y-m-d h:i'),
      'id' => $winner->id,

      );

    $this->db->insert('withdraw', $data);

}

else {


$this->db->where('id',$winner->id)
         ->set($coin,$credit->$coin + $jackpot)
         ->update('credit');

}

}


return $winner;

}

}


return FALSE;

}

function _ticket_array($type,$round,$coin){



$data = $this->db->where('type',$type)
                            ->where('coin',$coin) 
                            ->where('round',$round)
                            ->get('sit_lottery')->result();

return $data;

}

function _ticket_left($type,$round,$coin){



$data = $this->db->where('type',$type)
                            ->where('coin',$coin)
                            ->where('status','stock')
                            ->where('round',$round)
                            ->get('sit_lottery')->result();

return $data;

}



function _stock_tickets($coin){

$this->db->where('status','stock');
$this->db->where('coin',$coin);
$stock = $this->db->get('sit_lottery')->result();

if(count($stock)){

return $stock;
}


}

}