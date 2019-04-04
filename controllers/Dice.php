<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dice extends Buster_Controller {
 
  function __construct() {
      parent::__construct(); 
 
      $this->load->model('buster_m');
     $this->load->model('dice_m');
   }

public function index() {

$id = $this->session->id;
$this->dice_m->generate_game($id,'btc');
$this->dice_m->generate_game($id,'doge');

$this->data['pagetitle'] = 'Doble your Earnings';

$this->db->order_by('count', 'DESC');
$this->db->where('ltgt > 0');
$this->db->where('open', '1');
$this->db->where('u_id', $id);
$this->db->limit(10);
$this->data['games'] = $this->db->get('dicegames')->result();
$this->data['mainview'] = 'buster/dice/dicebeta';
$this->data['subview'] = 'buster/dice/table_bet';
$this->data['auto_bet'] = 'buster/dice/auto_bet';
$this->data['dice_script'] = 'buster/dice/dice_script';
 

$this->load->view('buster/main_body', $this->data);


}

function check_bet($betAmt,$probability,$ltgt,$coin){

$id = $this->session->id;

$script = '<script> $("#stopint").click(); </script>';

  if(!is_numeric($betAmt) || !is_numeric($probability)){
  
  $message = array('message' => alert_msg('Invalid Input','warning').$script);

  echo json_encode($message);
  
  } else {


//CALCULATING DATA TO PROCCESS, INCLUDING BALANCE
    $betAmt = filter_var($betAmt, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $probability = filter_var($probability, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $multi = 100 / $probability;
  $multi2 = $multi - 0.15; //house Edge
  $grossProfit = $betAmt * $multi2;
  $netProfit = $grossProfit - $betAmt;
  $bet = $betAmt;
  $target = 100 / $multi;
  $usertarget = $target;
 
$credit = $this->dice_m->getof($id);
$balance = round($credit->$coin,0);

if($coin == 'btc'){

  $balance = $credit->$coin * 100000000;
}


//DICE RULES

  if($bet > $balance){

   $message = array('message' => alert_msg('Insufficient Funds','warning').$script);

     echo json_encode($message);

    
    } else if ($target > 97 || $target < 2){
    
    $message = array('message' =>  alert_msg('Win Chance must be between 2 - 97','warning').$script);
    
      echo json_encode($message);

    } else if ($bet < 2 || $bet > 10000000){
    
$bet_alert = ($coin == 'btc') ? 'Bets must be between 2  - 10.000.000 Satoshi' : 'Bets must be between 2  - 100.000 doge';

    $message = array('message' =>  alert_msg($bet_alert,'warning').$script);

     echo json_encode($message);
   
    }

     else {

  
//PLAYING HI
  if($ltgt == 1){

    $usertarget = 100 - $target;
  }
          $game = $this->dice_m->current_game($id,$coin,$balance);
            $gid = $game->gid;  

            $pick = mt_rand(0, 10000);
            $pick2 = $pick / 100;
            $luckyNum = $pick2;


      if($this->dice_m->check_game($gid,$bet,$usertarget,$ltgt,$luckyNum,$coin) == TRUE){

         $uid = $id;
        
        if($ltgt == 1){
//ON WINNING
      if($luckyNum > $usertarget && $bet <= $balance){ 

 $type = 'win';
 $message = alert_msg("Roll  <span id='lastbet'>Hi!</span> you win + ". ceil($netProfit),"success");

        }
        //ON LOSESSES
else if($luckyNum < $usertarget && $bet <= $balance){

$type = 'lose';
 $message = alert_msg("Roll  <span id='lastbet'>Hi!</span> you lose - ". $bet,"secondary");
 $netProfit = -$bet;

}
        }

     if($ltgt == 2){
          //ON WINNING
      if($luckyNum < $target && $bet <= $balance){ 

$type = 'win';
         $message = alert_msg("Roll <span id='lastbet'>Low!</span> you win + ". ceil($netProfit),"success");

        }
        //ON LOSSES
else if($luckyNum > $target && $bet <= $balance){


$type = 'lose';
$netProfit = -$bet;

   $message = alert_msg("Roll <span id='lastbet'>Low!</span> you lose - ". $bet,"secondary");  


}
        }


// DATA ARRAY FOR JS TO JUST READ 
$color = ($netProfit < 0) ? '#F33535' : '#1AC55C';

     $data = array(
     
'luckyNum' => $luckyNum,
'message' => $message,
'type' => $type,
'target' => $target,
'netProfit' => '<b style="color:'.$color.'">'.ceil($netProfit).'</b>',

     );   

     $crash = array('message' => alert_msg('dice overloaded, please reload the page','danger').$script);

        if($this->dice_m->verify_game($gid,$bet,ceil($netProfit),$uid) == TRUE){

          echo ($this->dice_m->generate_game($id,$coin) == TRUE) ? json_encode($data) : json_encode($crash);
        
        } else { $not_accept =  array('message' => alert_msg('error verifying game, reload or contact support','danger').$script);
  
       echo json_encode($not_accept); } 

      }

      else { 

$not_accept =  array('message' => alert_msg('Bet not accepted','danger').$script);
  
       echo json_encode($not_accept);

        }
           
           }

}//end if is numeric

}

function autobet_result(){

  $str = '';


$str .= '
    <div class="col-sm">
      
 <div class="form-row">
    <div class="col-6">
 <p>Rolls Played : '. form_input('played_rolls', '0', 'class="form-control" id="played_rolls" onchange="noteLimit(this, 6)"').'</p>
          </div>
           <div class="col-6">
<p>Rolls left : '. form_input('rolls_left', '0', 'class="form-control" id="rolls_left" onchange="noteLimit(this, 6)"').'</p>
          </div>
        </div>
     </div>
   <br>';

$str .=  '<p>Total Profit this Round : '. form_input('game_profit', '0', 'class="form-control" style="aling-content:center;" id="game_profit" onchange="noteLimit(this, 6)"').'</p>';

echo $str;

}

function result_table(){

$id = $this->session->id;

echo $this->dice_m->table_result($id);

}

/*

function rollHi(){}

function rolLow(){}


*/
}