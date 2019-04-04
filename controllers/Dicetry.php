<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dicetry extends Frontend_Controller {
 
 	function __construct() {
      parent::__construct(); 
 
      $this->load->model('buster_m');
     $this->load->model('dice_m');
   }

public function index() {

$this->data['pagetitle'] = 'Doble your Earnings';

$this->data['mainview'] = 'buster/dice/dice_test';
$this->data['subview'] = 'buster/dice/table_bet';
$this->data['auto_bet'] = 'buster/dice/auto_bet';
$this->data['dice_script'] = 'buster/dice/dicetry_script';
 

$this->load->view('buster/main_body', $this->data);


}

function check_bet($betAmt,$probability,$ltgt,$coin){

$balance = $this->input->post('balance');


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
       
            $pick = mt_rand(0, 10000);
            $pick2 = $pick / 100;
            $luckyNum = $pick2;
        
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

     echo json_encode($data);
           
           }

}//end if is numeric

}

function autobet_result(){

  $str = '';


$str .= '
    <div class="col-sm">
      
 <div class="form-row">
    <div class="col-6">
 <b>Rolls Played</b> : '. form_input('played_rolls', '0', 'class="form-control" id="played_rolls" onchange="noteLimit(this, 6)"').'
          </div>
           <div class="col-6">
<b>Rolls left : </b>'. form_input('rolls_left', '0', 'class="form-control" id="rolls_left" onchange="noteLimit(this, 6)"').'
          </div>
        </div>
     </div>
   <br>';

$str .=  '<b>Total Profit this Round : </b>'. form_input('game_profit', '0', 'class="form-control" style="aling-content:center;" id="game_profit" onchange="noteLimit(this, 6)"');

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