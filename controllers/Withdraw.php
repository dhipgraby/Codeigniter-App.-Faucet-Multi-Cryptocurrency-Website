<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends Buster_Controller {
 
 	function __construct() {
      parent::__construct();

          $this->load->model('account_m'); 
            $this->load->model('rules_m'); 
        $this->load->model('security_m');
        $this->load->model('credit_m');
        $this->load->model('email_m');

         }


public function index() {

 $this->session->set_userdata('access', FALSE);

   $id = $this->session->id;
   //Checking for deposits
//USE THIS FUNCTION TO GET DEPOSITS ==> $this->account_m->get_deposits($id);
//Loading page views
    
    $this->data['pagetitle'] = 'Withdrawals';
    $this->data['mainview'] = 'buster/user/withdraw';
    $this->data['withdraw_tab'] = 'buster/user/withdraw_tab';
         
 //setting transaction pagination
 $this->db->where('id', $id);
 $count = $this->db->count_all_results('withdraw');
        //Set pagination
       $perpage = 5;
//data of all the total pages
    $this->data['total_pages'] = ceil($count / $perpage);

    //withdrawal history
    $this->db->order_by('datetime', 'DESC');
    $this->db->limit($perpage, 0);
    $this->db->where('id', $id);
    $this->data['withdraw'] = $this->db->get('withdraw')->result();

    //only withdraw from address list

   $user = $this->security_m->get($id);
   $only = $user->addronly;
   
if($only == 'on'){

$this->data['coin_list'] =  form_dropdown('addr_list',$this->array_explore('btc'), 'Please select a valid address', 'class="form-control" id="address"');
}

if($only == 'off'){

$this->data['coin_list'] =  form_input('address', '', 'placeholder="Write address" class="form-control" id="address"');
}


$this->data['addr_gen'] = 'admin/addr/head'; 
     $this->load->view('buster/main_body', $this->data);
}

function receiving_addr($coin = NULL){

$id = $this->session->id;
   $user = $this->security_m->get($id);
   $only  = $user->addronly;

if($only == 'on'){

  echo form_dropdown('addr_list',$this->array_explore($coin), 'Please select a valid address', 'class="form-control" id="address"');
}

if($only == 'off'){

echo form_input('address', '', 'placeholder="Write address" class="form-control" id="address"');
}


}

function array_explore($coin){

$id = $this->session->id;

  $this->db->select('label');
     $this->db->select('address');
     $this->db->where('id', $id);
     $this->db->where('coin', $coin);  
     $fields =  $this->db->get('addressbook')->result();
    $data = array();
    foreach ($fields as $field) {
      $data[$field->address] = $field->label;

    }     

    return $data;
   }

function factor_box(){


$id = $this->session->id;

$user = $this->security_m->get($id);

$rules = $this->rules_m->withdraw_rules;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

   $this->session->set_userdata('access', TRUE);

$factor_name = 'Withdraw 2fa security'; 

$current_method =  $user->withdraw2fa;

$title = $factor_name.' '.$current_method; 
$button = 'Unlock';
$b_id = 'unlock';

$this->data['mod_title'] = $title;
$this->data['mod_content'] = '';
$this->data['mod_id'] = $b_id;
$this->data['mod_button'] = $button;
$this->data['input_id'] = 'sec_password';


    echo $this->load->view('buster/security/form_'.$current_method, $this->data);


}  else { 

    $errors = validation_errors();

      echo alert_msg($errors,'warning');

        }

}

function confirm_box(){

$id = $this->session->id;
$user = $this->security_m->get($id);
$currency = $this->input->post('currency');
$fees =  config_item($currency.'_fee');

$amount = $this->input->post('amount');

$withdraw_amount = $amount - $fees;

$factor = $user->withdraw2fa.'_rules';

$rules = $this->security_m->$factor;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

   $this->session->set_userdata('access', TRUE);



//WITHDRAWAL Confirm
$content = 'This transacion have a fee of '.$fees. ''.$currency.'. This fee will be taken from the amount.

You are about to send <b>' . $withdraw_amount .' '.$currency.' </b> to this address :<br><b><p class="img-thumbnail" >'.$this->input->post('address').'</p></b>Are you sure about details? Click confirm';


$modal = modal_content('<span id="message"></span>Withdrawal details',$content,'Confirm withdrawal', 'w_confirm');

$data = array( 'access' => '1',
        'info' => $modal,
             );

echo json_encode($data);

 }

    else { 


    $errors = validation_errors();

      $modal = alert_msg($errors,'warning');

$data = array( 'access' => '2',
        'info' => $modal,
      
             );


echo json_encode($data);


        }

}


function process(){


  $amount = $this->input->post('amount');

$currency = $this->input->post('currency');

if(empty($currency)){

  return FALSE;
}

if($this->_check_balance() == TRUE){


      $id = $this->session->id;

      $data = array(

      'addy' => $this->input->post('address'),
      'amount' => $amount,
      'currency' => $currency,
      'status' => 'pending',
      'datetime' => date('y-m-d h:i'),
      'id' => $id,

      );


      if($this->security_m->_access_method() == TRUE){ 

      if($this->credit_m->_withdraw_payment($id,$amount,$currency) == TRUE){


$fees =  config_item($currency.'_fee');
  $data['amount'] = $amount - $fees;
        //PASS THIS TO CREDIT CONTROLLER
      $this->db->insert('withdraw', $data);

      $message = alert_msg("withdrawal success! Wait the status change to TxId Here, to check in blockchain","success");

      $message_error = alert_msg("Server error or incorrect details, try again or contact support","warning");

             echo ($this->db->affected_rows() < 1) ? $message_error : $message;

      }


        
      }



 }

 else { echo alert_msg("not allowed to process, please reload page or contact support","warning"); }


}

public function withdraw_tab(){

$perpage = 5;
     $id = $this->session->id;

    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

   $start_from = ($page-1) * $perpage;
    $this->db->order_by('datetime', 'DESC');
    $this->db->limit($perpage, $start_from);
    $this->db->where('id', $id);

    $this->data['withdraw'] = $this->db->get('withdraw')->result();
    
$this->load->view('buster/user/withdraw_tab', $this->data);

}


function page_buttons(){

   $perpage = 5;

$page = $_GET["page"];
$id = $this->session->id;

    //TOTAL PAGES
  
    $this->db->where('id', $id);
    $count = $this->db->count_all_results('withdraw');
    
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

  echo new_button($x,'','light','type="button" onclick="paginator(this.value);" value="'.$x.'"');

  }  

  echo '</div>';

echo new_button('<b>+ 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.$next_pages.'"');

}


//VALIDATIONS FORMS

function _password_validation(){
  
  
   return $this->security_m->_password_factor();
}

function _amount_validation(){
  
$amount = $this->input->post('amount');
$currency = $this->input->post('currency');

$min = config_item('min_withdraw_'.$currency);
$max = config_item('max_withdraw_'.$currency);

if($amount < $min){

   $this->form_validation->set_message('_amount_validation', 'Minimum amount is '.$min.' '.$currency);

      return FALSE;
}

elseif ($amount > $max){

   $this->form_validation->set_message('_amount_validation', 'Maximum amount to withdraw is '.$max.' '.$currency);

      return FALSE;
}

return TRUE;

}

function _emailcode_validation(){

return $this->security_m->expired(600);

}


function _pin_validation(){
  
  
   return $this->security_m->_pin_factor();
}

function _check_balance(){

return $this->credit_m->_check_balance();

}



function _maximum($currency){

switch ($currency) {
  case 'doge':
    
return 2500000;

    break;
  
  case 'btc':
   
return 1;

    break;
}


}

}