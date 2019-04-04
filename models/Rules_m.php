<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_m extends MY_Model {

protected $_table_name = 'members';
protected $_table_col = 'deposits';
protected $_order_by = 'datetime desc';
protected $_timestamps = TRUE;

public $address_book_rules = array (

'address' => array (

'field' => 'address',
'label' => 'address',
'rules' => 'trim|required'

),

'label' => array (

'field' => 'label',
'label' => 'label',
'rules' => 'trim|required|callback__unique_label',

),

);

public $withdraw_rules = array (

'currency' => array (

'field' => 'currency',
'label' => 'currency',
'rules' => 'trim|required|callback__check_balance'

),


'address' => array (

'field' => 'address',
'label' => 'Address',
'rules' => 'trim|required'

),

'amount' => array (

'field' => 'amount',
'label' => 'Amount',
'rules' => 'trim|required|numeric|callback__amount_validation'

),

);

public $advert_rules = array (

'currency' => array (

'field' => 'currency',
'label' => 'currency',
'rules' => 'trim|required|callback__check_balance'

),

'amount' => array (

'field' => 'amount',
'label' => 'Amount',
'rules' => 'trim|required|numeric|callback__amount_validation'

),

);


	function __construct() {
      parent::__construct(); 


   }

function _unique_label() {
// Do NOT  validate if name exist
  //UNLESS its the name for the current users
    $id = $this->session->id;

    $this->db->where('label', $this->input->post('label'));
  $this->db->where('id', $id);

  $user = $this->db->get('addressbook')->result();

  if (count($user)) {

    $this->form_validation->set_message('_unique_label', 'Label already in use');
    
    return FALSE;
  }

  return TRUE;
}

function _unique_name() {
// Do NOT  validate if name exist
  //UNLESS its the name for the current users
    $id = $this->session->id;

    $this->db->where('name', $this->input->post('name'));
  $this->db->where('id !=', $id);

  $user = $this->get();

  if (count($user)) {

    $this->form_validation->set_message('_unique_name', 'Name already in use');
    
    return FALSE;
  }

  return TRUE;
}

function _unique_email() {
// Do NOT  validate if email exist
  //UNLESS its the email for the current users
  $id = $this->session->id;

    $this->db->where('email', $this->input->post('email'));
  $this->db->where('id !=', $id);

  $user = $this->get();

  if (count($user)) {

    $this->form_validation->set_message('_unique_email', 'Email already in use');
    
    return FALSE;
  }

  return TRUE;
}

function _email_check(){
  
   $email = $this->input->post('email');
    $email_check = $this->input->post('email_confirm');
   if($email  !=  $email_check)
   {
      $this->form_validation->set_message('_email_check', 'Email not match');

     return FALSE;
   
   } 
   
   return TRUE;
}

function _password_match($password,$res = NULL){
  
   $password = $this->input->post('new_password');
    $old_password = $this->input->post('password_confirm');

if($res != NULL){

   $password = $this->input->post('new_reset_password');
    $old_password = $this->input->post('password_reset_confirm');


}

   if($password != $old_password)
   {
      $this->form_validation->set_message('_password_match', 'Password not match');
        
      return FALSE;
   } 
   return TRUE;
}

function _pin_match($password){
  
   $pin = $this->input->post('new_pincode');
    $match_pin = $this->input->post('pincode_confirm');
   if($pin != $match_pin)
   {
      $this->form_validation->set_message('_pin_match', 'Pin not match');
        
      return FALSE;
   } 
   return TRUE;
}

function _set_pin_match($password){
  
   $pin = $this->input->post('new_pincode');
    $match_pin = $this->input->post('pincode_confirm');
   if($pin != $match_pin)
   {
      $this->form_validation->set_message('_set_pin_match', 'Pin not match');
        
      return FALSE;
   } 
   return TRUE;
}

function _oldpassword_check($password){
  
   $password = $this->input->post('password');
    $old_password = $this->input->post('password_confirm');
   if($password != $old_password)
   {
      $this->form_validation->set_message('_oldpassword_check', 'Password not match');
        
      return FALSE;
   } 
   return TRUE;
}



}