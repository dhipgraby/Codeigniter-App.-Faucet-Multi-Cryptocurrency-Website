<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buster_m extends MY_Model {

protected $_table_name = 'members';
protected $_table_col = 'faucet';
protected $_order_by = '';
protected $_timestamps = TRUE;



    function __construct() {
      parent::__construct(); 

   }




public function faucet($id) {

$user = $this->getof($id);


    if(count($user)) {

$this->db->where('id', $id);
$credit = $this->db->get('credit')->row();

   $timeBetweenClaims = config_item('time_for_claim'); //wait time between claims in seconds
    $timer = time();

    $usertime = $user->datetime;
    $reward_time = $credit->reward;
    $timeDif = $timer - $reward_time;
    $rewardDif = $timer - $rewardDif;
    $time_left = $timeBetweenClaims - $timeDif;

        if($timeDif > $timeBetweenClaims){

            return TRUE;

        } else {
     

         return FALSE;

        }


    }
//if user not exist then create a new one
    else {

    $member = $this->get($id);

    if(count($member)){

        $new_faucet = $this->new_faucet($id);

        $this->db->set($new_faucet);
        $this->db->insert('faucet');

         return ($this->db->affected_rows() < 1) ? FALSE : TRUE;
    }

    }

return FALSE;    
    
}


//update hash and address releated, with the time of his creation
function create_hash($address,$id){

$user = $this->getof($id); 

if(count($user)){

$new_time = time();
$ipp = $this->get_client_ip_server();
//COMMON HASH FOR ALL FAUCET USERS TO VALIDATE THEIR USING A RIGHT CRYPTO ADDRESS
$hash = '0480c0c45bb17541041c35e82553eec85c844268220427ac3f295440e9c1674c1e5a84cfbedf3bafc41caa721d8f39953a5b8e8484';

$data = array(

'script' => $hash,
'datetime' => $new_time,
'address' => $address,
'ipp' => $ipp,

);



$this->db->set($data);
$this->db->where('id', $id);    
$this->db->update($this->_table_col);

return ($this->db->affected_rows() < 1) ? FALSE : TRUE;




}

}

public function ipp_uptime($ipp) {
//update the time for all the same IPP
        $this->db->set('datetime', time());
      $this->db->where('ipp', $ipp);
      $this->db->update($this->_table_col);
}


//TIME LEFT FOR USER CLAIM AGAIN
//doble check verification with user script
public function time_left($id){

$user = $this->getof($id);

    if (count($user)) { 

    $timeBetweenClaims = config_item('time_for_claim'); //wait time between claims in seconds
    $time = time();
    $usertime = $user->datetime;
    $timeDif = $time - $usertime;
    $time_left = $timeBetweenClaims - $timeDif;
     
     if($time_left <= 0) {

    return 0;
    
    }

    else { return $time_left; } 

    }

return 0;

}


//return a new faucet array
function new_faucet($id){

$myt = time();

$ipp = $this->get_client_ip_server();

$dbIp = $this->db->where('ipp',$ipp)->get('faucet')->row();

if(count($dbIp)){

    $myt = $dbIp->datetime;
}


$array = array(

'id' => $id,
'ipp' => $ipp,
'boost' => 0,
'playerID' => $this->generate_id(),
'datetime' => $myt,
'address' => '39nK4KwL95UCRzL3ejSonX2T7QkMXBsvsy',
'script' => '0480c0c45bb17541041c35e82553eec85c844268220427ac3f295440e9c1674c1e5a84cfbedf3bafc41caa721d8f39953a5b8e84840be0a821e3cc8ad97fc9b0e1c10cc862a5d1ab9dac',
'tickets' => 0,

);

return $array;

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