<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Buster_Controller {
 
 	function __construct() {
      parent::__construct();

          $this->load->model('account_m'); 
          $this->load->model('security_m');
          $this->load->model('rules_m'); 
          $this->load->model('email_m');


 
         }


public function index() {


 $this->session->set_userdata('access', FALSE);


$this->data['pagetitle'] = 'Account';

$account = 'buster/user';
$id = $this->session->id;
$user = $this->security_m->get($id); 

$security_method = !count($user) ? 'password' : $user->security2fa;

$this->data['u_data'] = $user;
$this->data['mainview'] = $account.'/account';
//MENU WITH ACCOUNT OPTIONS

$this->data['settings'] = $account. '/user_form';
$this->data['security'] = 'buster/security/'. $security_method;



$this->data['mail_button'] = $user->permission == 1 ? new_button('Verify email','verify','primary') : new_button('Verified','','success','onClick=" return false;"');


$this->load->view('buster/main_body', $this->data);


}


//VISTA ACCESO A OPCIONES DE SEGURIDAD  

function access_security(){

$id = $this->session->id;
$user = $this->security_m->get($id);

$rules = $this->_rules('security');

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

$this->data['sec_options'] = $this->_dropdown_2fa('security',$user->security2fa);

$this->data['log_options'] = $this->_dropdown_2fa('login',$user->login2fa);

$this->data['withdraw_options'] = $this->_dropdown_2fa('withdraw',$user->withdraw2fa);

$this->data['pin'] = empty($user->pin) ? '' : '123';
//current methods for echo 2fa 
$this->data['current_security'] = $user->security2fa;
$this->data['current_login'] = $user->login2fa;
$this->data['current_withdraw'] = $user->withdraw2fa;

$this->data['addr_only'] = $user->addronly;

$this->db->where('id',$id);
$this->db->where('coin', 'btc');
$this->data['addr_list'] = $this->db->get('addressbook')->result();


$this->session->set_userdata('access', TRUE);
$this->data['addr_gen'] = 'admin/addr/head';  
echo $this->load->view('buster/user/security', $this->data);

}

else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning'); }


}

//SAVE SETTINGS. CHOOSE TWO METHOD DEPENDING IF THE USER IS REGISTER IN THE SECURITY OR NOT

function save_settings(){

$id = $this->session->id;
$user = $this->security_m->get($id); 

 count($user) ? $this->_setting_update($id) : $this->_new_update($id);

}


//PRIMERA PASSWORD . WHEN IS NOT REGISTER IN SECURITY
function _new_update($id){

$rules = $this->account_m->_rules;


$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

  $data = $this->account_m->array_from_post(array('name', 'email', 'password'));

$data['password'] = hash('sha256', $data['password'] . config_item('encryption_key'));

if($this->account_m->save_info($data,$id) == true){

$this->security_m->get_new($id);

echo 1;
//  $this->data['message'] = 'Change successful';

}

else { 

  echo alert_msg('input error','warning');
  //$this->data['message'] = 'input error';
    }

}

else { echo alert_msg(validation_errors(),'warning'); }

}


//VALIDACION PARA CAMBIAR USUARIO O EMAIL SIN SEGURIDAD REQUERIDA.(usuarios ya registrados)
function _setting_update($id){


$user = $this->account_m->get($id);
$user_security = $this->security_m->get($id);

$rules = $this->account_m->_setting_rules;


$data = $this->account_m->array_from_post(array('name', 'email','email_code'));

if($data['email'] != $user->email && $user_security->permission == 2){

  $data['permission'] = 1;
  $data['old_email'] = $user->email;
  $this->form_validation->set_rules('email_code', 'email_code', 'trim|required|callback__emailcode_validation');   

} else { $data['permission'] = $user_security->permission; }  ;


$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

if($this->account_m->save_info($data,$id) == true){


echo 1;
//  $this->data['message'] = 'Change successful';

}

else { 

  echo 'input error';
  //$this->data['message'] = 'input error';
    }

}

else { echo validation_errors(); }

}


function change_password(){

$rules = $this->security_m->change_password;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

$id = $this->session->id;

if($this->security_m->_change_password($this->input->post('new_password'), $id) == true){

$script = timescript(3,'account');

echo alert_msg('successful changed', 'success').$script;  

}

else { echo alert_msg('input error, try another password', 'warning'); }



}


else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning'); }

}

function change_pincode(){

  $rules = $this->security_m->change_pincode;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

$id = $this->session->id;


if($this->security_m->_change_pincode($this->input->post('new_pincode'), $id) == true){

$script = timescript(4,'account','change_pin');



echo alert_msg('successful new Pin code set. Page reload...', 'success').$script;  

}

else { echo alert_msg('input error, try another pin', 'warning'); }



}

else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning'); }
}

function set_new_pin(){

$rules = $this->security_m->set_pincode;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

$id = $this->session->id;

if($this->security_m->_change_pincode($this->input->post('new_pincode'), $id) == true){

$script = timescript(3,'account','set_pin');

echo alert_msg('successful pin set, now you can use it!. Page reload...', 'success').$script;  

}

else { echo alert_msg('input error, try another pin', 'warning'); }



}

else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning'); }

}


//CAJA PREVIA PARA CAMBIAR LOS 2FA

function set_method($method, $name){

if($this->security_m->_access_method() == TRUE){ 

$id = $this->session->id;

$user = $this->security_m->get($id);


$factor_name = $name.'2fa'; 

$current_method =  $user->$factor_name;

$content = $method;

$text = "Once you set this method, in order to access ". $name." or change this 2fa method";

switch ($content) {
    case "email":
        $content = $text .", you will receive a email code";
        break;
    case "password":
        $content = $text . ", you will use your current password";
        break;
    case "pincode":
        $content = $text . ", you will use your current pin code";
        break;
    }

$title = $name . ' second factor'; 
$button = 'Set '. $method;
$b_id = '2fa'. $method;

$this->data['mod_title'] = $title;
$this->data['mod_content'] = $content;
$this->data['mod_id'] = $b_id;
$this->data['mod_button'] = $button;
$this->data['input_id'] = 'sec_password';


  echo $this->load->view('buster/security/form_'.$current_method, $this->data);



} else {  echo alert_msg('you are not allowed, access first','danger'); }     

}

//RESULTADO DE LA CAJA PREVIA 2FA SET METHOD

function factor_message($method, $name){


if($this->security_m->_access_method() == TRUE){ 


$rules = $this->_rules($name);

  $this->form_validation->set_rules($rules);

      if($this->form_validation->run() == TRUE){

      if($this->security_m->_set_2fa($method,$name) == true){

        $script = timescript(3,'account','2fa'.$method);

        echo alert_msg('success '.$method.' set for ' .$name. '. Page will reload in <span id="timer"></span>', 'success').$script;
      }

      else {

        echo alert_msg('this method is already active','warning');

      } 

       } else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning'); }
       


 }
 
 else {  echo alert_msg('you are not allowed, access first','danger'); }
  

}


//PREVIEWS BOX FOR REMOVE ANY 2FA method

function modal_remove($name){

 if($this->security_m->_access_method() == true){


$id = $this->session->id;

$user = $this->security_m->get($id);

$factor_name = $name.'2fa'; 

$current_method =  $user->$factor_name;

$content = 'Are you sure to remove this '.$name. ' factor?';

$title = 'Remove '.$name . ' second factor'; 
$button = 'Confirm';
$b_id = 'remove_'.$name;

$this->data['mod_title'] = $title;
$this->data['mod_content'] = $content;
$this->data['mod_id'] = $b_id;
$this->data['mod_button'] = $button;
$this->data['input_id'] = 'sec_password';


    echo $this->load->view('buster/security/form_'.$current_method, $this->data);

 }



}

//REMOVE 2FA VALIDATOR USING THE CURRENT METHOD

function remove_factor($name){

      if($this->security_m->_access_method() == true){

      $rules = $this->_rules($name);

      $this->form_validation->set_rules($rules);


          if($this->form_validation->run() == TRUE){ 

        if($this->security_m->_factor_remove($name) == true){

          $script = timescript(3,'account','remove_'.$name);

          echo alert_msg($name.' sencond factor has been remove. Password is set by default. Page reload...', 'success').$script;
        }

         else  { echo alert_msg('error. method already set','warning'); }

          } else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning'); }

}


  }



//PREVIEWS BOX WITH INPUT MAIL code. SEND EMAIL

function activate_box(){

$id = $this->session->id;
$user = $this->security_m->get($id); 

$this->data['mod_title'] = '';
$this->data['mod_content'] = 'email code is valid for 15 minutes. if it is expired, get another by clicking on "SEND"';
$this->data['mod_button'] = 'confirm';
$this->data['mod_id'] = 'v_confirm';
$this->data['input_id'] = 'email_val';

  echo $this->load->view('buster/security/form_email', $this->data); 

 
}

function send_mailcode(){

  $id = $this->session->id;
  $this->db->where('id',$id);
  $this->db->limit(1);
  $user = $this->db->get('members')->row();

  if(count($user)) {

    $user_mail = $user->email;


if ($this->security_m->_set_code($user_mail) == TRUE){

$this->_preset_email_data($user_mail);

$template = $this->load->view('buster/2fa', $this->data,TRUE);

echo ($this->email_m->_sendgrid_email($user_mail,$template) == TRUE) ? 'true' : 'false';
 

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
$this->db->where('email',$email);
$code = $this->db->get('security')->row()->code;
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


// ACTIVATION EMAIL FORM VALIDATION

function activation(){


    $rules = $this->security_m->email_rules;

      $this->form_validation->set_rules($rules);

      if($this->form_validation->run() == TRUE){

      
      if($this->security_m->_email_code() == true){

$script = timescript(3,'account');

        echo alert_msg('email verification complete! Enjoy Full experience', 'success').$script;
      }
      else
        { echo alert_msg('Email code error. Get another code', 'warning'); }

      }

      else { $errors = validation_errors();
      
      echo alert_msg($errors, 'warning');
  }




}

// CHANGE THE ON | OFF WITHDRAWAL FROM ADDRESS ONLY
function addr_list($set){


 if($this->security_m->_access_method() == true){

if($set == 'on' || $set == 'off'){

if($this->security_m->_addr_list($set) == TRUE){  

$script = timescript(3,'account',NULL);

$message = $set == 'on' ? 'Success, address book only withdrawals'.$script : 'Address book Disable.'.$script;

echo alert_msg( $message, 'success');


}

else {

echo alert_msg('error or method alredy set', 'warning');

}


}


  }

}

function address_book(){

$perpage = 5;
$id = $this->session->id;

    //TOTAL PAGES
    $this->db->where('id', $id);
    $this->db->where('coin', 'btc');
    $this->db->limit($perpage);
    $count = $this->db->count_all_results('addressbook');
    $total_pages =  ceil($count / $perpage);
$this->data['total_pages'] = $total_pages;

 if($this->security_m->_access_method() == true){ 

$user  = $this->security_m->get($id);

if (count($user)) {
  
  $this->db->where('coin', 'btc');
  $this->db->where('id',$id);
  $this->db->limit($perpage);
   $this->data['addr_list'] = $this->db->get('addressbook')->result();


   $left_pages = 5;

    if($left_pages >= $total_pages){

      $left_pages = $total_pages;
    }

    $this->data['left_pages'] = $left_pages;


$this->load->view('buster/security/address_book', $this->data);

}
 else { echo 'Empty addres book'; }

 }

}

function add_new_coin(){

$id = $this->session->id;

$coin = $this->input->post('coin');
$address = $this->input->post('address');
$label = $this->input->post('label');



 if($this->security_m->_access_method() == true){ 

    $rules = $this->rules_m->address_book_rules;

      $this->form_validation->set_rules($rules);

      if($this->form_validation->run() == TRUE){

$data = array(

'address' => $address,
'coin' => $coin,
'id' => $id,
'datetime' => date('Y-m-d h:i:s'),
'label' => $label,


);

$this->db->insert('addressbook', $data);

$e_message = alert_msg('Error address not valid','warning');

$message = alert_msg('Address addred to '. $coin . ' list.','success');

  echo ($this->db->affected_rows() < 1) ? $e_message : $message;

      } else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning');  }


 }

}

public function addressbook_tab(){

$perpage = 5;
$id = $this->session->id;
$coin = $_GET['coin'];
$page = $_GET['page'];


    if (isset($page)) { $page  = $page; } else { $page=1; }; 

   $start_from = ($page-1) * $perpage;
    
   $this->db->where('coin', $coin);
  $this->db->where('id',$id);
  $this->db->limit($perpage, $start_from);
   $this->data['addr_list'] = $this->db->get('addressbook')->result();
    
$this->load->view('buster/security/address_tab', $this->data);

}


function page_buttons(){

   $perpage = 5;

$coin = $_GET["coin"];
$page = $_GET["page"];
$id = $this->session->id;

    //TOTAL PAGES
    $this->db->where('coin', $coin);
    $this->db->where('id', $id);
    $count = $this->db->count_all_results('addressbook');
    
    $total_pages = ceil($count / $perpage);


if(isset($page)) { $page  = ($page > 0) ? $page : 1; } else { $page=1; };  

   $left_pages = $page + 4;

    if($left_pages >= $total_pages){

      $left_pages = $total_pages;
    }

    if($page >= $total_pages){

      $page = $total_pages;
    }

$next_pages = $page + 5;


echo new_button('<b>- 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.($next_pages - 10).'"');

echo '<div class="btn-group mr-2 ml-2" role="group" aria-label="First group">';

  for($x=$page; $x<= $left_pages; $x++) {

  echo new_button($x,'','light','type="button" onclick="paginator(this.value)" value="'.$x.'"');

  }  

  echo '</div>';

echo new_button('<b>+ 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.$next_pages.'"');

}


//FROM HERE IS THE CALLBACK and VALIDATION FUNCTIONS


function _dropdown_2fa($name, $current){


$options = array (

'email' => 'email',
'pincode' => 'pincode',
'password' => 'password',

);

return form_dropdown('2fa', $options, $current, 'class="form-control" id="'. $name .'"');

}

function _rules($name){

  $id = $this->session->id;
$user = $this->security_m->get($id);

    if(count($user)){

$name = $name.'2fa';

    $rules = $user->$name;

            switch ($rules) {

              case 'password':
                
            return  $this->security_m->password_rules;
                break;
              
                case 'email':

            return $this->security_m->email_rules;

                break;

                  case 'pincode':

            return $this->security_m->pincode_rules;
                
                break;

            }  

    }


}

function _unique_label(){

  return $this->rules_m->_unique_label();

}

function _unique_name(){

return $this->rules_m->_unique_name();

}


function _unique_email($str) {

return $this->rules_m->_unique_email();

}

function _email_check($str){
  
return $this->rules_m->_email_check();
}

function _emailcode_validation(){

return $this->security_m->expired(config_item('code_expiration'));

}

function _password_validation(){
  
  
   return $this->security_m->_password_factor();
}

function _password_confirming(){
  
  
   return $this->security_m->_password_confirming();
}


function _password_match($password){
  
return $this->rules_m->_password_match($password,NULL);
}


function _pin_validation(){
  
  
   return $this->security_m->_pin_factor();
}

function _pin_match($password){
  
return $this->rules_m->_pin_match($password);

}

function _set_pin_match($password){
  
return $this->rules_m->_set_pin_match($password);

}

function _oldpassword_check($password){
  
return $this->rules_m->_oldpassword_check($password);

}

}