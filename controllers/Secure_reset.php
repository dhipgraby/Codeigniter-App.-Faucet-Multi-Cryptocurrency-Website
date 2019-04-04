<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secure_reset extends Buster_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
      $this->load->model('security_m');
      $this->load->model('rules_m');

   }

public function index(){

$method = $this->uri->segment(2);

$array = array('password', 'pincode');

if(!in_array($method, $array)){

redirect('dashboard');

}

$this->data['method'] = $method;
$this->data['mainview'] = 'buster/security/reset';
$this->load->view('buster/main_body', $this->data);

}

//Caja para cambiar pin o password despues de introducir el codigo email
function change_box($method){

$id = $this->session->id;

$user_security = $this->security_m->get($id);


  $rules = $this->security_m->email_rules;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){ 

if(count($user_security)){

	
$this->data['method'] = $method;
$this->load->view('buster/security/reset_method', $this->data);    


	}

}	else { $errors = validation_errors();
      
      echo alert_msg($errors, 'warning');
  }

}


function reset_method($method){


$method_set = 'set_'.$method;

$method_change = '_change_'.$method;

  $rules = $this->security_m->$method_set;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

$id = $this->session->id;

if($this->security_m->$method_change($this->input->post('new_'.$method), $id) == true){

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
  
return $this->rules_m->_password_match($password);
}


function _set_pin_match($password){
  
return $this->rules_m->_set_pin_match($password);

}

function _emailcode_validation(){

return $this->security_m->expired(600);

}


}