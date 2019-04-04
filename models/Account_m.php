<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_m extends MY_Model {

protected $_table_name = 'members';
protected $_table_col = 'deposits';
protected $_order_by = 'datetime desc';
protected $_timestamps = TRUE;
public $_rules = array(

'name' =>array(
    'field' => 'name',
    'label' => 'name',
    'rules' =>'trim|required|callback__unique_name|xss_clean'),

'email' =>array(
    'field' => 'email',
    'label' => 'email',
    'rules' =>'trim|required|callback__unique_email|valid_email|xss_clean'),

'password' =>array(
    'field' => 'password',
     'label' => 'Password', 
     'rules' => 'trim|required|callback__password_confirming|callback__oldpassword_check'),


'password_confirm' =>array(
    'field' => 'password_confirm',
     'label' => 'Confirm Password', 
     'rules' => 'required|callback__password_confirming|trim'),
 	);

public $_setting_rules = array(


'name' =>array(
    'field' => 'name',
    'label' => 'name',
    'rules' =>'trim|required|callback__unique_name|xss_clean'),

'email' =>array(
    'field' => 'email',
    'label' => 'email',
    'rules' =>'trim|required|callback__unique_email|valid_email|xss_clean'),

'password' =>array(
    'field' => 'password',
     'label' => 'password', 
     'rules' => 'trim|callback__password_validation|required'),



);

public $guest_rules = array (

'refer' =>array(
    'field' => 'refer',
    'label' => 'refer',
    'rules' =>'trim|required|xss_clean'),


);

	function __construct() {
      parent::__construct(); 


   }


function save_info($data, $id){

$datos = array (

'email' => $data['email'],
'name' => $data['name'],

);

$arr = array (

'permission' => $data['permission'],
'access' => time(),
'email' => $data['old_email'],

);

   	 $this->db->set($datos) ;
   	  $this->db->where('id =', $id);
   	    $this->db->update($this->_table_name);

if ($this->db->affected_rows() != 0){

   $this->db->set($arr);
      $this->db->where('id =', $id);
        $this->db->update('security');

   return ($this->db->affected_rows() != 0) ? true : false;

}

   	  
}


public function get_deposits($id){

$this->db->where('id', $id);
$user = $this->db->get('members')->row();

	if(count($user)){

	$addy = $user->depaddy;

$url = "https://blockchain.info/address/".$addy."?format=json";
$json = json_decode(file_get_contents($url), true);

$outs = $json['txs'];

foreach ($outs as $txs) {
	
	$transactions=  $txs['out'];

	 

	foreach ($transactions as $key) {
		
		if ($key['addr'] == $addy){ 

		
            $data = array( 
               
              'id' => $id, 
              'amount' => $key['value'],
              'txid' =>  $txs['hash'],
              'addy' => $key['addr'],   
			  'datetime' => date('Y-m-d-h-i-s', $txs['time']),
		
			 );
          
           $this->db->where('txid', $txs['hash']);
           $deposit = $this->getof();

           if(count($deposit) == '0') {

                 $this->db->set($data);
           $this->db->insert('deposits');

if ($this->db->affected_rows() >= '1') {
   
$this->db->set('bbb', $user->bbb + $key['value']);
$this->db->where('id', $id);
$this->db->update('members');


} 

           }

 

		}
	}
}

	}

}



}