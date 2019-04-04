<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit_m extends MY_Model {

protected $_table_name = 'credit';
protected $_table_col = 'security';
protected $_order_by = '';
protected $_timestamps = TRUE;



    function __construct() {
      parent::__construct(); 

   }

   function _check_balance(){

    $id = $this->session->id;
$amount = $this->input->post('amount');
$currency = $this->input->post('currency');

$user = $this->credit_m->get($id);

if (count($user)) {

$balance = $user->$currency;

if($balance > 0 && $balance >= $amount){

return TRUE;

}

else {   $this->form_validation->set_message('_check_balance', 'Not enought '.$currency.' balance to withdraw');

      return FALSE;  }


}

return FALSE;

   }

 function _check_funds($amount,$currency){

    $id = $this->session->id;
$user = $this->credit_m->get($id);

if (count($user)) {

$balance = $user->$currency;

if($balance > 0 && $balance >= $amount){

return TRUE;

}

else { 

      return FALSE;  }


}

return FALSE;

   }

function get_balance($coin = NULL){

$id = $this->session->id;

$credit = $this->get($id);

if(count($credit)){

//if you pass a coin, just return the balance for that coin
  if($coin != NULL){

  return $credit->$coin;
  
  }

//otherwise just the credit info;
else { return $credit;  }

}

}

function _ticket_payment($id,$amount,$coin){


    $user = $this->get($id);

    if (count($user) && !empty($id) && !empty($coin) && !empty($amount)) {

$txid = substr(md5(uniqid(rand(), true)), 0, 6);

if($user->$coin > $amount){ 


$data = array(

'txid' => $txid,
$coin => $user->$coin - $amount,
'datetime' => time(),

);

    $this->db->where('id', $id);
    $this->db->set($data);
    $this->db->update('credit');

      return ($this->db->affected_rows() < 1) ? FALSE : TRUE;
      
}




     }
}

function _item_purchase($id,$item,$quantity,$price,$coin){

$txid = substr(md5(uniqid(rand(), true)), 0, 6);

$data = array (

'id' => $id,
'item' =>$item,
'quantity' => $quantity,
'coin' => $coin,
'price' => $price,
'txid' => $txid,
'datetime' => date('y-m-d h:i'),

);

if($this->db->insert('purchase',$data)){

$amount = $price * $quantity;

$this->_create_trans($id,-$amount,$coin,$item);


return TRUE;

}
return FALSE;

}

function _withdraw_payment($id,$amount,$coin){


    $user = $this->get($id);

    if (count($user) && !empty($id) && !empty($coin) && !empty($amount)) {

if($this->_check_balance() == TRUE){

$txid = substr(md5(uniqid(rand(), true)), 0, 6);

$data = array(

'txid' => $txid,
$coin => $user->$coin - $amount,
'datetime' => time(),

);

    $this->db->where('id', $id);
    $this->db->set($data);
    $this->db->update('credit');


    $this->_create_trans($id,-$amount,$coin,'withdraw');

      return ($this->db->affected_rows() < 1) ? FALSE : TRUE;
}


     }
}

function _faucet_payment($id,$coin){

$user = $this->get($id);
$ipp = $this->get_client_ip_server();

    if (count($user) && !empty($id) && !empty($coin)) { 


$credit = $this->get($id);
$reward_time = $credit->reward;

    $timeBetweenClaims = config_item('time_for_claim'); //wait time between claims in seconds
    $time = time();
    $usertime = $user->reward;
    $timeDif = $time - $usertime;
    $rewardDif = $time - $reward_time;
     $time_left = $timeBetweenClaims - $timeDif;
     
  if($timeDif < $timeBetweenClaims || $rewardDif < $timeBetweenClaims){

            return FALSE;

        } 

     if($time_left <= 0) {

$data = array(

'reward' => time(),
$coin => ($user->$coin + faucet_reward($coin)),

);

    $this->db->where('id', $id);
    $this->db->set($data);
    $this->db->update($this->_table_name);

    if($this->db->affected_rows() > 0){


$this->db->where('ipp',$ipp);
$this->db->set('datetime', time());
if($this->db->update('faucet')){

        $this->db->where('id',$id);
      $this->db->limit(1);
      $faucet = $this->db->get('faucet')->row();
   
$update = array (
           'tickets' => $faucet->tickets + 1,
           'ipp' => $ipp,
           );
      
      $this->db
      ->where('id',$faucet->id)
      ->set($update)
      ->update('faucet');
      
$amount =  faucet_reward($coin);

$this->_create_trans($id,$amount,$coin,'faucet');

      return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
}




    } 
    
    }

    else { return $time_left; } 

    }

return 0;


}

function _refer_payment($id,$refid,$coin){

$this->db->where('id',$refid);
$member = $this->db->get('members')->row();

        if(count($member)){

        $this->db->where('id',$id);
        $this->db->where('refID',$member->id);
        $this->db->where('type',$coin);
        $refer_table = $this->db->get('refer')->row();
        $lastclaim = $refer_table->lastclaim;
        $time_check  = $lastclaim + config_item('time_for_claim');
        $now = time();
      
  $data =  array (
                  'reward' => $refer_table->reward + $this->comision($coin),
                  'lastclaim' => $now,
                  'id' => $id,
                  'refID' => $member->id,
                  'type' => $coin,
                  );

if(count($refer_table)){

                  if($now > $time_check){
        
        
       
        $this->db->where('id',$id);
        $this->db->where('refID',$member->id);
         $this->db->where('type',$coin);
        $this->db->set($data);
        $this->db->update('refer');               
    if ($this->db->affected_rows() != 0){

return ($this->_process_ref($member->id,$coin) == TRUE) ?  'update refer tab success' : 'db problem no updates';


    }

    else return 'just insert without payment';

} else { return ' no payment cuse time'; }

} else {

$this->db->set($data);

if($this->db->insert('refer')){


return ($this->_process_ref($member->id,$coin) == TRUE) ? 'insert refer tab success' : 'no insert done';

}


}
           } else {  return ' this user have no referrals'; }

        }

function _process_ref($mID,$coin){


$credit = $this->get($mID);
$balance = $credit->$coin;


if(count($credit)){

      $this->db->where('id',$mID);
    $this->db->set($coin,$balance + $this->comision($coin));
    $this->db->update($this->_table_name);
    
$this->_create_trans($mID,$this->comision($coin),$coin,'ref-reward');

    return ($this->db->affected_rows() < 1) ? FALSE : TRUE;
}

}


function comision($coin){

  $reward = faucet_reward($coin);

  $calc = $reward * 100000000;
  $reward = ($calc * 0.25) / 100000000;


return $reward;


}

// Function to get the client ip address
function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}


}