<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class security_m extends MY_Model {

protected $_table_name = 'security';
protected $_table_col = 'members';
protected $_order_by = 'datetime desc';
protected $_timestamps = TRUE;

public $password_rules = array (

'password' => array (

'field' => 'password',
'label' => 'Password',
'rules' => 'trim|required|callback__password_validation'

),

);

public $pincode_rules = array (

'pincode' => array (

'field' => 'pincode',
'label' => 'Pin code',
'rules' => 'trim|required|callback__pin_validation'

),

);

public $email_rules = array (

'email_code' => array (

'field' => 'email_code',
'label' => 'Email code',
'rules' => 'trim|required|callback__emailcode_validation'

),

);

public $change_pincode = array(


'pincode' =>array(
    'field' => 'pincode',
     'label' => 'Pin code', 
     'rules' => 'trim|required|callback__pin_validation'),

'new_pincode' => array (

'field' => 'new_pincode',
'label' => 'New pin',
'rules' => 'trim|required|callback__pin_match|min_length[4]|max_length[6]',

),

'pincode_confirm' =>array(
    'field' => 'pincode_confirm',
     'label' => 'Confirm Pin', 
     'rules' => 'required|trim|min_length[4]|max_length[6]'),
  );

public $set_pincode = array (

'new_pincode' =>array(
    'field' => 'new_pincode',
     'label' => 'Pin code', 
     'rules' => 'trim|required|callback__set_pin_match|min_length[4]|max_length[6]'),


'pin_confirm' =>array(
    'field' => 'pincode_confirm',
     'label' => 'Confirm Pin', 
     'rules' => 'required|trim|min_length[4]|max_length[6]'),



);

public $set_reset_pincode = array (

'new_pincode' =>array(
    'field' => 'new_pincode',
     'label' => 'Pin code', 
     'rules' => 'trim|required|callback__set_pin_match|min_length[4]|max_length[6]'),


'pin_confirm' =>array(
    'field' => 'pincode_confirm',
     'label' => 'Confirm Pin', 
     'rules' => 'required|trim|min_length[4]|max_length[6]'),



);


public $set_reset_password = array(

'new_password' => array (

'field' => 'new_password',
'label' => 'New password',
'rules' => 'trim|required|callback__password_match|min_length[6]',

),

'password_confirm' =>array(
    'field' => 'password_confirm',
     'label' => 'Confirm Password', 
     'rules' => 'required|trim'),
  );



public $change_password = array(


'password' =>array(
    'field' => 'password',
     'label' => 'Password', 
     'rules' => 'trim|required|callback__password_validation'),

'new_password' => array (

'field' => 'new_password',
'label' => 'New password',
'rules' => 'trim|required|callback__password_match|min_length[6]',

),

'password_confirm' =>array(
    'field' => 'password_confirm',
     'label' => 'Confirm Password', 
     'rules' => 'required|trim'),
  );

public $set_password = array(

'new_password' => array (

'field' => 'new_password',
'label' => 'New password',
'rules' => 'trim|required|callback__password_match|min_length[4]',

),

'password_confirm' =>array(
    'field' => 'password_confirm',
     'label' => 'Confirm Password', 
     'rules' => 'required|trim'),
  );




	function __construct() {
      parent::__construct(); 


   }

function _addr_list($set){

$id = $this->session->id;

if($set == 'on' || $set == 'off'){

$this->db->where('id', $id);
$this->db->set('addronly', $set);
$this->db->update($this->_table_name);

 return ($this->db->affected_rows() < 1) ? FALSE : TRUE;

}

}

//FOR LOGGEDING USERS
function _change_password($password, $id){

$new_password = hash('sha256', $password . config_item('encryption_key'));

$user = $this->get($id);

if(count($user)){


$user_password = $user->password;

if ($new_password == $user_password) {
  
 return false;

}

else {

  $this->db->where('id', $id);
  $this->db->set('password', $new_password);
  $this->db->update($this->_table_name);

    $this->db->where('id', $id);
  $this->db->set('password', $new_password);
  $this->db->update('members');

 return ($this->db->affected_rows() < 1) ? false : true;

}


}

}
//FOR LOGGEDING USERS
function _change_pincode($pin, $id){

$new_pin = hash('sha256', $pin . config_item('encryption_pin'));

$user = $this->get($id);

if(count($user)){


$user_pin = $user->pin;

if ($new_pin == $user_pin) {
  
 return false;

}

else {

  $this->db->where('id', $id);
  $this->db->set('pin', $new_pin);
  $this->db->update($this->_table_name);

 return ($this->db->affected_rows() < 1) ? false : true;

}


}

}

//FOR NOT! LOGGEDING USERS
function _reset_password($password, $email){

$new_password = hash('sha256', $password . config_item('encryption_key'));

$this->db->where('email',$email);
$user = $this->db->get('members')->row();

if(count($user)){

$id = $user->id;
$user_password = $user->password;

if ($new_password == $user_password) {
  
 return false;

}

else {

    $this->db->where('email', $email);
  $this->db->set('password', $new_password);
  $this->db->update('members');

 if($this->db->affected_rows() > 0){

$this->db->where('id',$id);
$this->db->set('password', $new_password);
$this->db->update('security');

 return ($this->db->affected_rows() < 0) ? false : true;

 }

}


}

}
//FOR NOT! LOGGEDING USERS
function _reset_pincode($pin,$email){

$new_pin = hash('sha256', $pin . config_item('encryption_pin'));


$this->db->where('email',$email);
$member = $this->db->get('members')->row();

$id = $member->id;

$user = $this->get($id);

if(count($user)){


$user_pin = $user->pin;

if ($new_pin == $user_pin) {
  
 return false;

}

else {

  $this->db->where('id', $id);
  $this->db->set('pin', $new_pin);
  $this->db->update($this->_table_name);

 return ($this->db->affected_rows() < 1) ? false : true;

}


}

}

function _password_factor(){
  
   $password = hash('sha256', $this->input->post('password'). config_item('encryption_key'));

$id = $this->session->id;
   $user = $this->get($id);
   
   $user_password =  strtolower($user->password);

   if($password != $user_password)
   {
      $this->form_validation->set_message('_password_validation', 'incorrect password dude');

      return FALSE;
   } 

   return TRUE;
}

function _password_confirming(){
  
   $password = hash('sha256', $this->input->post('password'). config_item('encryption_key'));

$id = $this->session->id;
   $user = $this->getof($id);
   
   $user_password =  strtolower($user->password);

   if($password != $user_password)
   {
      $this->form_validation->set_message('_password_confirming', 'incorrect password dude');

      return FALSE;
   } 

   return TRUE;
}

//PIN VALIDATION 
function _pin_factor(){
  
  $id = $this->session->id;
$pin = hash('sha256', $this->input->post('pincode') . config_item('encryption_pin'));
     $user = $this->get($id);
   
   if(count($user)){

 $user_pin = strtolower($user->pin);

   if($pin != $user_pin)
   {
      $this->form_validation->set_message('_pin_validation', 'incorrect pin or empty');

      return FALSE;
   } 

   return TRUE;

   }
  

}
 

function _set_2fa($method, $name){


 $array = array('email','pincode','password');

 if(in_array($method, $array)){


$id = $this->session->id;

  $user = $this->get($id);
   
     if(count($user)){

      $method_name = $user->$name.'2fa';

      if($method_name == $method){

      return FALSE;

      }

      else {

      $this->db->where('id', $id);
      $this->db->set($name.'2fa', $method);
      $this->db->update($this->_table_name);

       return ($this->db->affected_rows() != 1) ? false : true;


      }


   }

}

}


function _factor_remove($name){

$name = $name.'2fa';

 $array = array('login2fa' ,'security2fa','withdraw2fa');


 if(in_array($name, $array)){

$id = $this->session->id;
$user = $this->get($id);

    if(count($user)){

      $current = $user->$name;

        if($current != 'password'){
            
           $this->db->where('id', $user->id); 
           $this->db->set($name,'password');
           $this->db->update($this->_table_name);

           return ($this->db->affected_rows() != 1) ? false : true; 

        }

      }

}

}


//RAMDON EMAIL CODE FOR EMAIL CODE VALIDATION FOR NOT!! LOGGEDIN USERS
function _set_reset_code($email){


$rand = substr(md5(uniqid(rand(), true)), 0, 6);

$this->db->where('email',$email);
$user = $this->db->get('members')->row();

      if(count($user)){


$array = array(

'code' => $rand,
'access' => time(),

);

                $this->db->where('email', $email);
                $this->db->set($array);
                $this->db->update('members');

                return ($this->db->affected_rows() < 1) ? false : true;   
          
      }

}

//VALIDATE EMAIL CODE AND IF IS RIGHT, 
//FOR NOT LOGGEDIN USERS
function _email_reset($email){

$code = $this->input->post('email_code');

$this->db->where('email',$email);
$user = $this->db->get('members')->row();

      if(count($user)){

                return ($this->expired_reset(120) == TRUE) ? TRUE : FALSE;           

      }

}

//CHECK IF EMAIL CODE IS EXPIRED FOR NOT LOGGEDIN USERS
function expired_reset($time){

$email = $this->input->post('email');
$code = $this->input->post('email_code');

if(empty($time)){ 

$time = 120;

}

$this->db->where('email', $email);
$user = $this->db->get('members')->row();
$user_code = $user->code;

//CHECKING CODE EXPIRATION
$now = time();
$user_time = $user->access;
$diferencial_time = $now - $user_time;

if ($time < $diferencial_time){

$this->form_validation->set_message('_emailcode_validation', 'code is expired, get another by clicking on send.');

return FALSE;
}

if($user_code != $code){

   $this->form_validation->set_message('_emailcode_validation', 'incorrect code');
   return FALSE;
}


return TRUE;


}



//RAMDON EMAIL CODE FOR EMAIL CODE VALIDATION FOR LOGGEDIN USERS
function _set_code(){

$id = $this->session->id;
$rand = substr(md5(uniqid(rand(), true)), 0, 6);
$user = $this->get($id);

      if(count($user)){

$array = array('code' => $rand, 'access' => time());

                $this->db->where('id', $id);
                $this->db->set($array);
                $this->db->update($this->_table_name);

                return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
     

          
      }

}


//VALIDATE EMAIL CODE AND IF IS RIGHT, CHANGE PERMISSION TO VERIFYED USER
function _email_code($unlock = NULL){

$id = $this->session->id;

$code = $this->input->post('email_code');

$user = $this->get($id);

      if(count($user)){

$user_email = $this->getof($id)->email;

            if($this->expired(config_item('code_expiration')) == TRUE){

$data = array(

'permission' => 2,
'access' => time(),
'email' => $user_email,

);

                $this->db->where('id', $id);
                $this->db->set($data);
                $this->db->update($this->_table_name);

                return ($this->db->affected_rows() != 0) ? true : false; 


            }

      }

}

//CHECK IF EMAIL CODE IS EXPIRED
function expired($time){

$code = $this->input->post('email_code');

if(empty($time)){ 

$time = 120;

}

$id = $this->session->id;
$user = $this->get($id);
$user_code = $user->code;

//CHECKING CODE EXPIRATION
$now = time();
$user_time =$user->access;
$diferencial_time = $now - $user_time;

if ($time < $diferencial_time){

$this->form_validation->set_message('_emailcode_validation', 'code is expired, get another by clicking on send.');

return FALSE;
}

if($user_code != $code){

   $this->form_validation->set_message('_emailcode_validation', 'incorrect code');
   return FALSE;
}





return TRUE;


}


function _access_method(){


 return (bool) $this->session->userdata('access'); 
}


function get_new($id){

$user = $this->get($id);

$this->db->where('id', $id);
$member = $this->db->get('members')->row();

  if(!count($user)){

$data = array(

  'id' => $id,
  'password' => $member->password,
  'code' => '',
  'permission' => 1,
  'status' =>'unlocked',
  'datetime' => date('Y-m-d h:i:s'),

);

$this->db->set($data);
$this->db->insert($this->_table_name);
  return ($this->db->affected_rows() != 1) ? false : true;

  }


}



}