<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lottery_m extends MY_Model {

protected $_table_name = 'lottery';
protected $_table_col = 'faucet';
protected $_order_by = 'id';
protected $_timestamps = TRUE;



  function __construct() {
      parent::__construct(); 

   }

   


function generate_id(){

$playerID = randLetter().mt_rand(10000,99999);

$this->db->where('playerID', $playerID);
$player = $this->db->get('faucet')->result();


if(!count($player)) {

  return $playerID;

} else {

  $this->generate_id();
}


}

function new_playerID($id){

$playerID = $this->generate_id();

$this->db->where('id',$id)
         ->set('playerID',$playerID)
         ->update('faucet');

         return ($this->db->affected_rows() != 0) ? TRUE : FALSE;

}

function insert_ids(){

$users = $this->db->where('playerID','')
         ->get('faucet')->result();


$i = -1;
        foreach ($users as $key) {

$i++;
        
$player[$i] = $this->new_playerID($key->id);

        }
       
$data = array('query' => $this->db->last_query());

return $data;
 
}

//ADMIN FUNCTION TO CREATE LOTTERY BASE ON DATETIME GIVE IT BY SCRIPT
function new_lottery(){

//CAMBIAR EL TIEMPO A TODOS LOS VIERNES!!

//then create a new one 
$end = strtotime('today');
$next_lottery = strtotime('next Friday');
//Verify that the current lottery is end

if($this->check_timer() == 0){

  $next_date = date('y-m-d h:i', $next_lottery);
$all_rounds = $this->db->get('rounds')->result(); 
$new_round = count($all_rounds > 0) ? count($all_rounds) + 1 : 1;

$data = array(

'round' => $new_round,
'start' => date('y-m-d h:i'),
'end' => $next_date,
'players' => 0,
'tot_tickets' => 0,
'status' => 'current',
'script' => substr(md5(uniqid(rand(), true)), 0, 15),

  );

$this->db->set($data);
$this->db->insert('rounds');

return ($this->db->affected_rows() < 1) ? FALSE : TRUE;
}


}

//USER FUNCTION TO COUN ALL TICKETS IN CURRENT GAME
  public function all_tickets(){

$this->db->select_sum('tickets');
$query = $this->db->get('faucet');

$total = $query->row()->tickets;

return $total;  
}

function reset_tickets(){

//Reset of tickets
$this->db->set('tickets', 0);
$this->db->where('tickets > 0');
$this->db->update('faucet');

return ($this->db->affected_rows() < 1) ? FALSE : TRUE;

}

function lucky_num() {

$lucky_num = rand(1, $this->all_tickets());
return $lucky_num;

}

//GAMES WITH CURRENT STATUS
public function current_game(){

$this->db->where('status', 'current');

$query = $this->db->get('rounds');
$rounds = $query->row()->round;

if(count($rounds)){

return $rounds;

} else {

  $this->new_lottery();

return  0;

}

}

//RANDOM TIKECTS SHARE
function random_draw(){

$rand = rand(100, 10000);

$this->db->set('tickets', $rand);
$this->db->update($this->_table_col);

return ($this->db->affected_rows() < 1) ? FALSE : TRUE;


}

//SELECT RANDOM WINNERS 
public function all_players() {

//Selecting all the players order by id
  $winner_num = $this->lucky_num();
  $round = $this->current_game();

$this->db->select('id');
$this->db->where('round', $round);
$ids = $this->db->get('lottery')->result();

$position = 1 + (count($ids));

// Amount of tickets per ticket-price is the Amount to share in each position
$amount = $this->amount_to_share($position);

//Selecting winners in 10 positions

$ticket_avg = $this->all_tickets() * 0.001;

$winner = array(

'addr' =>  substr(md5(uniqid(rand(), true)), 0, 15),
'position' =>$position,
'id' => randLetter().mt_rand(10000,99999),
'tickets' =>rand(1, $ticket_avg),
'amount' => $amount,
'round' => $round,

  );

//Setting each winner in database.
$this->db->set($winner);
$this->db->insert('lottery');


return ($this->db->affected_rows() < 1) ? FALSE : TRUE;

}

//TIME TO END A LOTTERY
public function check_timer(){
//Check time time of the current lottery
 $this->db->where('status', 'current');
$query = $this->db->get('rounds');
$current_round = $query->row();

  if(count($current_round)){

      $start= strtotime($current_round->start);
      $end = strtotime($current_round->end); 
      $now = time();
      $time_left = $end-$now;
//If the time is end '0', so we proceed to Draw the current round
      if($time_left <= 0){   


  return 0;
      
      } else {

        return  $current_round->end;  
      
      }



  }

}


function select_winners(){

//Checking winners
$this->db->where('round', $this->current_game());
$winners = $this->get();

  if(count($winners) < 10) {

      for($y = count($winners); $y < 10; $y++) {

      $this->all_players();
      }

  } else return TRUE; 
}

public function draw_lottery() {

if($this->check_timer() == 0){

    if($this->select_winners() == TRUE){

        //Changing status to complete and creating next lottery
        $this->db->where('tickets > 0');    
        $user_info = $this->getof();
        $tot_players = count($user_info);

        //tickets from faucet
        $this->db->select_sum('tickets');
        $total = $this->db->get('faucet');
        $tot_tickets = $total->row()->tickets;

        //tickets from lottery
        $this->db->where('round', $this->current_game());
        $this->db->select_sum('tickets');
        $total = $this->db->get('lottery');
        $lote_tickets = $total->row()->tickets;

        //Total tikets in current round
        $full_tikets = $tot_tickets + $lote_tickets;

        //Completing lottery and adding info
        $this->db->where('status', 'current');
        $this->db->set('status', 'complete');
        $this->db->set('players', $tot_players + 10);
        $this->db->set('tot_tickets', $full_tikets);
        $this->db->update('rounds');

                    if ($this->db->affected_rows() > 0){

                        if($this->reset_tickets() == TRUE){

                    //Round info for the new Lottery
                    return ($this->new_lottery() == TRUE) ? TRUE : FALSE;
                         

                        }
                      
                    }
    
    } else return 2;

} else return 1;

}

function finish_lottery(){

$this->db->where('status','current');
$round = $this->db->get('rounds')->row();
$num = $round->round;
$end = strtotime($round->end) - (86400*8);

$this->db->where('round',$num);
$this->db->set('end', date('y-m-d h:i', $end));
$this->db->update('rounds');

return ($this->db->affected_rows() > 0) ? TRUE : FALSE;

}



//RETURN THE REWARD FOR EACH POSITION, DEPENDING ON TICKET PRIZE
public function amount_to_share($position){

// Amount of tickets per ticke-price is the Amount to share in each position
   $amount = ($this->all_tickets() * 10) / 100000000;

  switch ($amount) {
  case $position == 1 :
    return $amount = $amount / 2;

    break;
   case $position == 2 :
    return $amount = $amount / 4;

    break;
      case $position == 3 :
     return  $amount = $amount / 8;

    break;
      case $position == 4 :
     return  $amount = $amount / 16;

    break;
      case $position == 5 :
    return $amount = $amount / 32;

    break;
      case $position == 6 :
     return $amount = $amount / 64;

    break;
      case $position == 7 :
    return $amount = $amount / 128;

    break;

      case $position == 8 :
     return $amount = $amount / 256;

    break;
      case $position == 9 :
      return $amount = $amount / 512;

    break;
      case $position == 10 :
     return $amount = $amount / 1024;

    break;

    default: $amount = 0;
  
}

}

}