<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faucet extends Buster_Controller {
 
  function __construct() {
      parent::__construct(); 
 
      $this->load->model('buster_m');
       $this->load->model('credit_m');
   }

public function index() {

    $id = $this->session->id;
  
  $credit = $this->credit_m->get($id);
//IF NOT COUNT USER BALANCE TABLE, THEN CREATE NEW ONE
  if(!count($credit)) { $this->db->insert('credit',$this->login_m->new_credit($id)); }

$f_user = $this->buster_m->getof($id);

 $this->data['user'] = $f_user;
 $this->data['hash'] = $f_user->script;
 $this->data['c_addr'] = $f_user->address;
$this->data['reward_time'] = $f_user->datetime + config_item('time_for_claim');
$this->data['pagetitle'] = config_item('site_name').' Faucet<br><small>Claim every 30 minutes</small>';
 $this->data['mainview'] = 'buster/user/faucet';
 

 $this->data['claim_btn'] = ($this->buster_m->faucet($id) == TRUE) ? new_button('claim','claim','success') : new_button('claim','claim','secondary');

 $this->data['faucet_timecheck'] = 'admin/addr/faucet_timecheck';


 $this->load->view('buster/main_body', $this->data);


   
}

function claim($hash){

  if(!empty($hash)){

$id = $this->session->id;

  $this->db->where('script', $hash);
  $user = $this->buster_m->getof($id);

    if(count($user)){

        if($this->buster_m->faucet($id) == TRUE){
            //CAN CLAIM
            echo 1;          

        }
         //NOT CAN CLAIM
        else { echo 2; }

       //USER NOT FOUND
    } else { echo 3;  }


  } 

}

function new_hash(){

$address = $_POST['address'];
$coin = $_POST['coin'];
$currency = $coin;
$id = $this->session->id;  

$user = $this->buster_m->getof($id)->id;

if(count($user)){

if($this->buster_m->create_hash($address,$id) == TRUE){

if($this->credit_m->_faucet_payment($id,$coin) == TRUE){

$refid = $this->buster_m->get($id)->refer;
$refer = $this->credit_m->_refer_payment($id,$refid,$coin);

$coin = faucet_reward($coin);

$msg = alert_msg('Claim success, you receive free '.number_format($coin,8).' '.$currency.' and + 1 <i class="fas fa-ticket-alt"></i> Lottery ticket' , 'success');

$data = array(

'msg' => $msg,
'ref' => $refer,
'number' => 1,
'coin' => $coin,
'timeleft' => (time() + config_item('time_for_claim')) * 1000,

);

echo json_encode($data);

}

 else {

$msg = alert_msg("hash not created, try again later or contact support","warning");

  $data = array(

'number' => 2,
'coin' => $coin,
'msg' => $msg,

);

echo json_encode($data);


 }

}
 else { 

$msg = alert_msg("hash not created, try again later or contact support","warning");

  $data = array(

'number' => 2,
'coin' => $coin,
'msg' => $msg,
);

echo json_encode($data);


 }

}

else {

$msg = alert_msg("user not found","warning");

 $data = array(

'number' => 3,
'coin' => $coin,
'msg' => $msg,
);

echo json_encode($data);


 }


}


}