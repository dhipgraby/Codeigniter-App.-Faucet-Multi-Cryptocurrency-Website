<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sit_lottery extends Buster_Controller {
 
  function __construct() {
      parent::__construct(); 
 
    $this->load->model('sit_lottery_m'); 
    $this->load->model('credit_m'); 
  
      
   }

public function index() {
    
     $this->session->set_userdata('access', FALSE);

$coin_array = array('btc','doge');
$coin = 'btc';

if(isset($_GET['coin']))
{

$coin = $_GET['coin'];

if(empty($coin) || $coin == NULL || !in_array($coin,$coin_array)){

  $coin = 'btc';
}

}


$this->data['btc_opt'] = ($coin == 'btc') ? TRUE : FALSE;
$this->data['doge_opt'] = ($coin == 'doge') ? TRUE : FALSE;
$this->data['symbol'] = ($coin == 'doge') ?  'DOGE': 'BTC'; 
    $id = $this->session->id;

$this->sit_lottery_m->new_lottery($coin);

//CREATE NEW LOTTERY FOR THE TYPE/AMOUNT YOU WISH
$this->sit_lottery_m->_mother_lottery(10,$coin);
$this->sit_lottery_m->_mother_lottery(100,$coin);
$this->sit_lottery_m->_mother_lottery(1000,$coin);

$lotteries = $this->db->group_by('type')
         ->where('coin',$coin)
         ->get('sit_winners')->result();

$i = -1;
foreach($lotteries as $lottery) {

$i ++;

$round = $this->sit_lottery_m->next_round($lottery->type,$coin) -1; 


$this->sit_lottery_m->select_winner($lottery->type,$coin);

$this->data['lotteries'][$i] = $this->db->where('round',$round)
                                    ->where('coin',$coin)
                                    ->where('type',$lottery->type)
                                    ->where('status','current')
                                    ->get('sit_winners')->result();



}


$this->data['pagetitle'] = '<i class="fas fa-rocket"></i> Sit and Go - Lottery ';

    $id = $this->session->id;

//data and views
   $this->_data_pagination();


$this->load->view('buster/main_body', $this->data);

  
}

function _data_pagination(){

     //Subviews
    $this->data['mainview'] = 'buster/lottery/sit_lottery/loto_box';
    $this->data['paginator'] = 'buster/lottery/sit_lottery/paginator';

}

function update_stats(){

$this->_preset_loto_data();

  $this->load->view('buster/lottery/sit_lottery/stats',$this->data);
}

function set_address(){

$id = $this->session->id;

$address = $this->input->post('new_address');
$currency = $this->input->post('currency');

if(!empty($address)){


$check = $this->db->where('id',$id)

                  ->get('sit_address')->row();

$script = timescript(3,'sit_lottery');


if(count($check)){

$this->db->where('id',$id)
        ->set($currency,$address)
        ->update('sit_address');

$message =  ($this->db->affected_rows() != 0) ? alert_msg('New address added','success') : alert_msg('error reload page or contact support','warning'); 

echo $message.$script;


}

else {

$data = array(

'id' => $id,
$currency => $address,
'datetime' => date('y-m-d h:i'),


);

$this->db->insert('sit_address',$data);

$message =  ($this->db->affected_rows() != 0) ? alert_msg('New address added','success') : alert_msg('error reload page or contact support','warning'); 

echo $message.$script;

}

} else { 


  echo alert_msg('address is required!','warning');


}

}

function set_method(){

$method = $this->input->post('method');

$id = $this->session->id;
$currency = 'btc';

$check = $this->db->where('id',$id)
                  ->get('sit_address')->row();

$script = timescript(3,'sit_lottery');


if(count($check)){

if($method == 'address'){

if(!empty($check->$currency))
{

$this->db->where('id',$id)
        ->set('payment',$method)
        ->update('sit_address');

$message =  ($this->db->affected_rows() != 0) ? alert_msg('Payment method to '.$method,'success') : alert_msg('error reload page or contact support','warning'); 

 
} else {

$message = alert_msg('In order to set this method, first add a '.$currency.' address','warning');

}


}

else {

$this->db->where('id',$id)
        ->set('payment',$method)
        ->update('sit_address');

$message =  ($this->db->affected_rows() != 0) ? alert_msg('Payment method to '.$method,'success') : alert_msg('error reload page or contact support','warning'); 

 

}


echo $message.$script;



} else {


$data = array(

'id' => $id,
'datetime' => date('y-m-d h:i'),
'payment' => $method,
 
);

$this->db->insert('sit_address',$data);

$message =  ($this->db->affected_rows() != 0) ? alert_msg('Payment method to '.$method,'success') : alert_msg('error reload page or contact support','warning'); 

echo $message.$script;


}



}

function process(){

  $id = $this->session->id;
  $type = $this->input->post('type');
  $currency = $this->input->post('currency');
  $ticket = $this->input->post('ticket');    
  $round = $this->input->post('round');
  $amount = $type / 100000;

$ticket_check = $this->db->where('type',$type)
                         ->where('coin',$currency)
                         ->where('status','stock')
                         ->where('t_address',$ticket)
                         ->get('sit_lottery')->row();


$tickets_left = count($this->sit_lottery_m->_ticket_left($type,$round,$currency));


if($tickets_left == 0)
{

  $get_new = $this->sit_lottery_m->_get_new_lottery($type,$currency);
  $new_lottery = $this->sit_lottery_m->new_lottery($currency);


}

$script = '<script>

var num = '.($tickets_left -1).';

$("#status'.$ticket.'").html("Sold");
$("#'.$type.'num").html(num);
$("#'.$ticket.'").html("Sold");
$("#'.$ticket.'").removeClass("btn btn-success").addClass("btn btn-secondary");

 var card'.$type.' = document.querySelector(".id'.$ticket.'");
  card'.$type.'.classList.toggle("is-rotated");

if(num <= 0){

  
 var c_name =   document.getElementsByName("c_round'.$type.'"); 
 var last_name = document.getElementsByName("last_round'.$type.'"); 


  show_result('.$round.','.$type.');

c_name[0].id = '.$this->sit_lottery_m->next_round($type,$currency).';

last_name[0].id = '.$round.';


var Dtime = setTimeout(function(){

  location.reload("sit_lottery?coin='.$currency.'");

    },10000);

}

  //  $("html, body").animate({ scrollTop: $("#buy_result").offset().top}, 300, "linear");


</script>';


  $new_lottery = $this->sit_lottery_m->new_lottery($currency);

  if($currency == 'doge'){

    $amount = $type * 10;
  }


if(empty($currency)){

  return FALSE;
}


if(count($ticket_check)){

if($this->credit_m->_check_funds($amount,$currency) == TRUE){

      if($this->credit_m->_ticket_payment($id,$amount,$currency) == TRUE){

$c_round = $ticket_check->round;
$this->credit_m->_item_purchase($id,'ticket-'.$ticket.' Round-'.$c_round ,1,$amount,$currency);

$data = array(

'id' => $id,
'datetime' => date('y-m-d h:i'),
'status' => 'sold',

);
        //UPDATE TICKET TO USER
        $this->db->where('t_address',$ticket_check->t_address)
                 ->where('type',$type)
                 ->where('coin',$currency)
                 ->where('status','stock')
                 ->set($data)
                 ->update('sit_lottery');

      $message = alert_msg("Succesfull bought ticket <b><i class='fas fa-ticket-alt'></i> ".$ticket."</b> for lottery type ".$type.".<br>
        <b>Good Luck!</b>","success").$this->sit_lottery_m->select_winner($type,$currency).$script.'<script>$("#ownership'.$ticket.'").html("owned")</script>';

      $message_error = alert_msg("Server error, reload the page and try again or contact support","warning");

             echo ($this->db->affected_rows() < 1) ? $message_error : $message;

      }


 } else echo alert_msg('not enought balance','warning');


} else echo alert_msg('Some one else bought this ticket: '.$ticket.'.<br>
             Choose another one to join this lottery','warning').$script;





}

function last_winner(){

$type = $this->input->post('type');
$round = $this->input->post('round');
$currency = $this->input->post('currency');

$tickets_left = count($this->sit_lottery_m->_ticket_left($type,$round,$currency));


if($tickets_left == 0)
{


  $new_lottery = $this->sit_lottery_m->new_lottery($currency);


}


$blue = '<i style="color:#17a2b8" class="fas fa-circle"></i>';

$green = '<i style="color:#28a745;" class="fas fa-circle"></i>';

$purple = ' <i style="color:#A13494;" class="fas fa-circle"></i>';


$Payment =  ($type == 10) ? $blue : $green; 

if($type == 1000) {

$Payment = $purple;

}

$this->data['blue'] = $blue;
$this->data['purple'] = $purple;
$this->data['Payment'] = $Payment;

$coin = $currency;
$this->data['btc_opt'] = ($coin == 'btc') ? TRUE : FALSE;
$this->data['doge_opt'] = ($coin == 'doge') ? TRUE : FALSE;
$this->data['symbol'] = ($coin == 'doge') ?  'DOGE': 'BTC'; 

$this->data['lottery'] = $this->sit_lottery_m->_get_winner($type,$round,$currency);

if(!count($this->data['lottery'])){


$this->data['lottery'] = $this->sit_lottery_m->_get_lottery($type,$currency);

}

$this->load->view('buster/lottery/sit_lottery/card_view',$this->data); 

}

function user_round(){

$id = $this->session->id;

$type = $this->input->post('type');
$currency = $this->input->post('currency');

$blue = '<i style="color:#17a2b8" class="fas fa-circle"></i>';

$green = '<i style="color:#28a745;" class="fas fa-circle"></i>';

$purple = ' <i style="color:#A13494;" class="fas fa-circle"></i>';


$Payment =  ($type == 10) ? $blue : $green; 

if($type == 1000) {

$Payment = $purple;

}

$method = $this->db->where('id',$id)->limit(1)->get('sit_address')->row();

$this->data['method'] = $method->payment;

$this->data['blue'] = $blue;
$this->data['purple'] = $purple;

$coin = $currency;
$this->data['btc_opt'] = ($coin == 'btc') ? TRUE : FALSE;
$this->data['doge_opt'] = ($coin == 'doge') ? TRUE : FALSE;
$this->data['symbol'] = ($coin == 'doge') ?  'DOGE': 'BTC'; 

$this->data['Payment'] = $Payment;
$this->data ['address'] = $this->sit_lottery_m->_get_address($currency);
$this->data['lottery'] = $this->sit_lottery_m->_get_lottery($type,$currency);

$this->load->view('buster/lottery/sit_lottery/user_round',$this->data); 

}

function next_page(){

$type = $this->input->post('type');
$start = $this->input->post('start');
$currency = $this->input->post('currency');


$this->db->order_by('round','desc')->limit(10,$start);
$rounds = $this->sit_lottery_m->_user_rounds($type,$currency);

 if(count($rounds)){

 foreach ($rounds as $round) { 
  
$this->data['round'] = $round;

 $winner =  $this->sit_lottery_m->_get_winner($round->type,$round->round,$currency); 

if($this->sit_lottery_m->check_ticket($winner->address,$round->type,$round->round,$currency)  == TRUE){

  $this->data['color'] = 'submenu';
}


  $this->data['winner'] = $winner;

  $this->load->view('buster/lottery/sit_lottery/single_round',$this->data);

}

}

}


function lottery_card(){

$type = $this->input->post('type');
$currency = $this->input->post('currency');

$this->data['current_lottery'] = $this->sit_lottery_m->_get_lottery($type);

  $this->load->view('buster/lottery/sit_lottery/lottery_card',$this->data);
}

function ticket_status(){

$type = $this->input->post('type');
$ticket = $this->input->post('ticket_address');
$round = $this->input->post('round');
$currency = $this->input->post('currency');

$lottery = $this->db->where('type',$type)
                    ->where('coin',$currency)
                    ->where('round',$round)
                    ->where('t_address',$ticket)
                    ->get('sit_lottery')->row();


 $t_left = count($this->sit_lottery_m->_ticket_left($lottery->type,$lottery->round,$currency));

if($t_left < 1){

    $new_lottery = $this->sit_lottery_m->new_lottery($currency);
}

if($lottery->status == 'sold'){

  $script = '<script>


 var card'.$type.' = document.querySelector(".id'.$ticket.'");
  card'.$type.'.classList.toggle("is-rotated");


var t_left = '.$t_left.';

if(t_left == "0"){

  
 var c_name =   document.getElementsByName("c_round'.$type.'"); 
 var last_name = document.getElementsByName("last_round'.$type.'"); 


  show_result('.$round.','.$type.');

c_name[0].id = '.$this->sit_lottery_m->next_round($type,$currency).';

last_name[0].id = '.$round.';


var Dtime = setTimeout(function(){

 show_result('.$this->sit_lottery_m->next_round($type,$currency).','.$type.');


    },1000);

}
   


</script>';

$this->data['script'] = $script;
}


$this->data['ticket'] = $lottery;
$this->data['lottery'] = $lottery;
 $this->load->view('buster/lottery/sit_lottery/single_ticket',$this->data);

     
}

}  