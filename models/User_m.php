<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends MY_Model {

protected $_table_name = 'members';
protected $_order_by = '';
public $_rules = array(

'email' =>array(
	'field' => 'email',
    'label' => 'Email',
    'rules' =>'trim|required|xss_clean'),

'password' =>array('field' => 'password', 'label' => 'Password', 'rules' =>'trim|required')
 	);

public $_rules_admin = array(

'name' =>array(
    'field' => 'name',
    'label' => 'Name',
    'rules' =>'trim|required|xss_clean'),


'email' =>array(
    'field' => 'email',
    'label' => 'Email',
    'rules' =>'trim|required|callback__unique_email|valid_email|xss_clean'),


'password' =>array(
    'field' => 'password',
     'label' => 'Password', 
     'rules' => 'trim|callback__oldpassword_check'),


'password_confirm' =>array(
    'field' => 'password_confirm',
     'label' => 'Confirm Password', 
     'rules' => 'trim'),




    );




	function __construct() {
      parent::__construct(); 

   }

public function login(){

$email = $this->input->post('email');

if (filter_var($email, FILTER_VALIDATE_EMAIL) == TRUE) {
  $name = 'email';
}

else { $name =  'name'; }

$user = $this->get_by(array(
$name => $this->input->post('email'),
'password' => hash('sha256', $this->input->post('password') . config_item('encryption_key')),), TRUE);

if (count($user)) {
	//Log in user
	$data = array(

    'name' => $user->name,
    'email' => $user->email,
    'id' => $user->id,
    'loggedin' => TRUE
		);

     $this->session->set_userdata($data);

} 
}

public function logout(){

     session_destroy();


}

public function loggedin(){

     return (bool) $this->session->userdata('loggedin');

}

public function get_new(){

$user = new stdClass();
$user->name = '';
$user->email = '';
$user->password = '';
return $user;

}

public function hash($string){

return hash('sha512', $string);

} 

}