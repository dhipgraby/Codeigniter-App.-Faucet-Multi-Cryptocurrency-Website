<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends MY_Model {

protected $_table_name = 'members';
protected $_table_col = 'security';
protected $_order_by = '';
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
     'rules' => 'trim|required|callback__oldpassword_check|min_length[6]'),


'password_confirm' =>array(
    'field' => 'password_confirm',
     'label' => 'Confirm Password', 
     'rules' => 'required|trim'),



    );


public $login_rules = array(


'name' =>array(
    'field' => 'name',
    'label' => 'name',
    'rules' =>'trim|required|xss_clean'),

'password' =>array(
    'field' => 'password',
     'label' => 'password', 
     'rules' => 'trim|required'),



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

//REMEMBER TO PASS THE IP TO LOGIN
public function login($cookie_name=NULL,$cookie_password=NULL){   

$email = $this->input->post('name');
$password = $this->input->post('password');

if($cookie_name != NULL && $cookie_password != NULL){

    $email = $cookie_name;
    $password = $cookie_password;
}

if(filter_var($email, FILTER_VALIDATE_EMAIL)){

$this->db->where('email', $email);

} else { $this->db->where('name', $email); }


$this->db->where('password', hash('sha256', $password . config_item('encryption_key')));
$user = $this->db->get('members')->row();


if (count($user)) {

$security = $this->getof($user->id);
$method = $security->login2fa;

if($method == 'pincode' || $method == 'email'){

    $data['loggedin'] = FALSE;

}
    //Log in user
    $data = array(

    'name' => $user->name,
    'email' => $user->email,
    'id' => $user->id,
        );

if($method == 'password' || empty($method)){

    $data['loggedin'] = TRUE;
}   

if($cookie_name != NULL && $cookie_password != NULL){

   $data['loggedin'] = TRUE;

}  


     $this->session->set_userdata($data);

     return TRUE; 
} 

return FALSE;

}

public function register_guest(){

$refer = 0;

if($this->input->post('refer') > 0){

$ref = $this->get($this->input->post('refer'));

if(count($ref)){ 

$refer = $this->input->post('refer');

}

else { $refer = 0; }

}

//user id allways increassing and higher
$this->db->select_max('id');
$max_id = $this->db->get('members')->row();
$id =  $max_id->id +1;

   $data = array(
     
    'id' => $id,
    'email' => $this->input->post('email'),
    'name' => $this->input->post('name'),
    'password' => hash('sha256', $this->input->post('password') . config_item('encryption_key')),
    'refer' => $refer,
    'datetime' =>  time(),
    
        );

     $this->db->set($data);
     $this->db->insert($this->_table_name);

     if ($this->db->affected_rows() > 0 ) {

        
$credit = $this->new_credit($id);

$this->db->set($credit);
$this->db->insert('credit');


        $ses_data = array(

    'name' => $name,
    'email' => '',
    'id' => $id,
    'refer' => $refer,
    'loggedin' => TRUE
        );

     $this->session->set_userdata($ses_data);

     return TRUE;
}

else { return FALSE; }

}


public function logout(){
    
       setcookie('name','', time() - 3600, "/");
       setcookie('password','', time() - 3600, "/");
     session_destroy();

}

public function loggedin(){

     return (bool) $this->session->userdata('loggedin');

}

public function deposit_address(){

    //CoinBase Apicall
require('coinbase/apicall.php');
$newaddy = $client->createAccountAddress($account, $address);
$newaddy = $client->decodeLastResponse();
return $newaddy['data']['address'];

}

//Check if a created name is in the database. And if it is, then create another and check again
public function new_name($name){

//using faker for ramdom user names
 require('Faker-master/src/autoload.php');

  $faker = Faker\Factory::create();

$this->db->where('name', $name);

$uniq_name = $this->db->get('members')->row();

if(!count($uniq_name)){ 

 
return $name;
    
  }

  return $this->new_name($faker->firstName());

}

function new_credit($id){


$r_time = time();
$ipp = $this->get_client_ip_server();

$this->db->where('ipp', $ipp);
$faucet = $this->db->get('faucet')->row();

if(count($faucet)){  $r_time = $faucet->datetime;  }

$array = array(

'id' => $id,
'btc' => 0,
'ltc' => 0,
'doge' => 0,
'dgb' => 0,
'reward' => $r_time,
'datetime' => time(),
'txid' => 0,

);

return $array;

}

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

