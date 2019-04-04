<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends Buster_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
      $this->load->model('security_m');
      $this->load->model('rules_m');
      $this->load->model('email_m');

   }


public function index(){


$this->login_m->loggedin() == FALSE || redirect($dashboard);

$method = $this->uri->segment(2);

$array = array('password', 'pincode');

if(!in_array($method, $array)){

redirect('main');

}

$this->data['method'] = $method;
$this->data['mainview'] = 'buster/login/reset';
$this->load->view('buster/main_body', $this->data);

}


function send_mailcode(){

  $user_mail = $this->input->post('email');
  
  $this->db->where('email',$user_mail);
  $user = $this->db->get('members')->row();

  if(count($user)) {

if ($this->security_m->_set_reset_code($user_mail) == TRUE){


$this->_preset_email_data($user_mail);

$template = $this->load->view('buster/2fa', $this->data,TRUE);

$provider = end(explode('@',$user_mail));

if($provider == 'hotmail.com'){

echo ($this->send_to($user_mail) == TRUE) ? 'true' : 'false';

} else {   


echo ($this->email_m->_sendgrid_email($user_mail,$template) == TRUE) ? 'true' : 'false';
}

 

}


}


}

function _preset_email_data($user_email){

$this->db->where('email',$user_email);
$member = $this->db->get('members')->row();
$this->db->where('email',$user_email);
$code = $this->db->get('security')->row()->code;
$user = $member->name;

$this->data['code']= $code;
$this->data['user']= $user;


}

function send_to($email){

$this->db->where('email',$email);
$member = $this->db->get('members')->row();
$code = $member->code;
$user = $member->name;

$this->load->library('email');

$config['mailtype'] = 'html';

$this->email->initialize($config);

$this->email->from('support@lotobitcoin.com', 'Lotobitcoin');
$this->email->to($email);

$this->email->subject('Lotocode 2fa verication code');

$this->data['code']= $code;
$this->data['user']= $user;
$template = $this->load->view('buster/2fa', $this->data,TRUE);
$this->email->message($template);
$send = $this->email->send();

if(!$send){

  $this->form_validation->set_message('send_mailcode', 'error, email can not be sent. try another');


return FALSE;

  } 

  return TRUE;



}


//Caja para cambiar pin o password despues de introducir el codigo email
function change_box($method){

  $this->login_m->loggedin() == FALSE || redirect($dashboard);

$email = $this->input->post('email');

$this->data['email'] = 'Changing password for email: <b><span id="email_log">'.$email.'</span></b><br>';

$this->data['method'] = $method;
  $rules = $this->security_m->email_rules;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){ 

$this->load->view('buster/login/reset_method', $this->data);
        
}	else { $errors = validation_errors();
      
      echo alert_msg($errors, 'warning');
  }


}


function reset_method($method){

$this->login_m->loggedin() == FALSE || redirect($dashboard);

$email = $this->input->post('email');


$method_set = 'set_reset_'.$method;

$method_change = '_reset_'.$method;

  $rules = $this->security_m->$method_set;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){


if($this->security_m->$method_change($this->input->post('new_'.$method), $email) == true){

$script = '<script>setInterval(function(){ window.location.href = "../dashboard"; }, 2000);</script>';

echo alert_msg('Reset '.$method.' successful ', 'success').$script;  

}

else { echo alert_msg('input error, try another '.$method, 'warning'); }



}

else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning'); }
}


function _password_match($password){
  
return $this->rules_m->_password_match($password,TRUE);
}


function _set_pin_match($password){
  
return $this->rules_m->_set_pin_match($password);

}

function _emailcode_validation(){

return $this->security_m->expired_reset(600);

}


}