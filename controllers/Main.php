<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Buster_Controller {
 
 	function __construct() {
      parent::__construct(); 

       $this->load->model('rules_m');
          $this->load->model('security_m');  
           $this->load->model('sit_lottery_m');
      
   }


public function index(){

if(isset($_COOKIE['name']) && isset($_COOKIE['password'])){

$name = $_COOKIE['name'];
$password = $_COOKIE['password'];
 
if ($this->login_m->login($name,$password) == TRUE){

  redirect('dashboard');
} 

}


$dashboard = 'dashboard';

//redirect user if already log in
$this->login_m->loggedin() == FALSE || redirect($dashboard);

 $this->db->limit(6);
 $this->data['articles'] = $this->article_m->get();



$lotteries = $this->db->group_by('type')
                      ->where('status','current')
                      ->where('coin','btc')
                      ->get('sit_winners')->result();

$this->data['lotteries'] = $lotteries;

  $this->data['mainview'] = 'buster/index'; 
  $this->load->view('buster/main_body', $this->data);

}


function register(){

$rules = $this->login_m->_rules;
$this->form_validation->set_rules($rules);

//Process the from
if ($this->form_validation->run() == TRUE) {

if($this->login_m->register_guest() == TRUE){

$message = 'Sucessfully register ' .$this->input->post('name'). '!<br>Now you can Login with your credentials!';



$script  = '<script>var timeleft = 3;
    var downloadTimer = setTimeout(function(){
    timeleft--;

$("#seconds").html(timeleft);
    if(timeleft <= 0){
      
        location.reload("dashboard");
      

    }

    },1000);

$("#btn_log").remove("");

    </script>';

    echo alert_msg($message.' Redirecting to dashboard in <span id ="seconds"></span> seconds...','success').$script;

} else {  



echo alert_msg('incorrect input fields. Please try again with a different combination', 'warning');


}


 }

else { 

$errors = validation_errors();

  echo alert_msg($errors,'warning'); }


}

public function login() {


$rules = $this->login_m->login_rules;
$this->form_validation->set_rules($rules);

//Process the from
if ($this->form_validation->run() == TRUE) {
  
$this->_login_proof();

}


else { 

$errors = validation_errors();

$data = array (

'log' => 'success',
'view' => alert_msg($errors,'warning'),


);

  echo json_encode($data); }



}

function just_box(){


$id = $this->session->id;

$user = $this->security_m->get($id);
$current_method = $user->login2fa;

$var_pass = $current_method;

 $forgot = '<br>
<small>forgot pin? Click on Reset Pincode. You can reset it using your email by receiving a code</small><br>'.anchor(base_url().'reset/pincode','Reset Pincode');

if($current_method == 'email'){

  $var_pass = 'email_code';
 $forgot = '';
}

$factor_name = 'Login 2fa security'; 

$title = $factor_name; 
$button = 'Unlock';
$b_id = 'unlock';

$script = '<script>

    $("#unlock").click(function(){

var '.$var_pass.' = $("input#sec_password").val();

var name = $("input#name").val();
var password = $("input#password").val();
 var box = $("#remember");  

  if (box.is(":checked")) {
                              
                 var remember = box.val();
                               } 
                    
                      $.ajax({

                       url: "'.base_url().'main/box_procced",
                  type: "POST",
                  data: { '.$var_pass.' : '.$var_pass.', name : name, password : password, remember : remember, },

                  success: function(data) { 
                                    

    var array = JSON.parse(data);

$("#message").slideUp(100).html(array.view).slideDown(1000,function(){

$("#message").delay(3000).slideUp();

});
      
                  }

                    });
                  });


</script>'.$forgot;

$this->data['mod_title'] = $title;
$this->data['mod_content'] = $script;
$this->data['mod_id'] = $b_id;
$this->data['mod_button'] = $button;
$this->data['input_id'] = 'sec_password';


echo $this->load->view('buster/security/form_'.$current_method, $this->data);


}

function box_procced(){

$id = $this->session->id;

$user = $this->security_m->get($id);

$current_method =  $user->login2fa;


$method = $current_method.'_rules';

$rules = $this->security_m->$method;
$this->form_validation->set_rules($rules);

//Process the from
if ($this->form_validation->run() == TRUE) {


$remember = $this->input->post('remember');

if(isset($remember)){

$name = $this->input->post('name');
$password = $this->input->post('password');
  setcookie('name',$name, time() + (86400 * 30), "/");
  setcookie('password',$password, time() + (86400 * 30), "/");

}

$this->session->set_userdata('loggedin', TRUE);

$this->_login_proof();

}

else { 

$errors = validation_errors();

$data = array (

'log' => 'success',
'view' => alert_msg($errors,'warning'),

);

  echo json_encode($data);

   }

}


function _login_proof(){

if($this->login_m->login() == TRUE){

if($this->login_m->loggedin() == TRUE){

$remember = $this->input->post('remember');

if(isset($remember)){

$name = $this->input->post('name');
$password = $this->input->post('password');
  setcookie('name',$name, time() + (86400 * 30), "/");
  setcookie('password',$password, time() + (86400 * 30), "/");

}



$script  = '<script>

 location.reload("dashboard");

$("#btn_log").remove("");

    </script>';

$data = array (

'log' => 'success',
'view' =>  alert_msg('Login success! Redirecting to dashboard in <span id="seconds"></span> seconds...','success').$script,

);

    echo json_encode($data);



} else { 

$script = '<script>
                    $.ajax({

                       url: "'.base_url().'main/just_box",
                  type: "POST",
                  data: {  },

                  success: function(data) { 
                                    

$("#myModal").modal("hide");
$("#2fa_mod").html(data);
$("#2fa_mod div#modal").modal("show");


                  }

                    });


</script>';


$data = array (

'log' => 'secure',
'view' => $script,

);

    echo json_encode($data);



  }


}

else {  

 $data = array ( 

   'log' => 'success',
   'view' => alert_msg('That user/password combination does not exist', 'warning'), 

);

echo json_encode($data);

}

}

function _pin_validation(){
  
  
   return $this->security_m->_pin_factor();
}

function _emailcode_validation(){

return $this->security_m->expired(600);

}

function _oldpassword_check($password){
  
return $this->rules_m->_oldpassword_check($password);

}

function _unique_name(){

return $this->rules_m->_unique_name();

}


function _unique_email($str) {

return $this->rules_m->_unique_email();

}

 function validate_captcha() {
        $captcha = $this->input->post('g-recaptcha-response');
         $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcGGyATAAAAAM3Dm2HfUL5-bTClXJlIdakuFnG_
&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
