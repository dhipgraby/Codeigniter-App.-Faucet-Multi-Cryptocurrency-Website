<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buster_controller extends MY_Controller {

	function __construct() {
      parent::__construct(); 

    $id = $this->session->id;


 $this->load->helper('form');
 $this->load->library('form_validation');
 $this->load->library('session');
$this->load->model('login_m');
$this->load->model('page_m');
$this->load->model('page_menu_m');
$this->load->model('article_m');

$this->db->where('id', $id);
$credit = $this->db->get('credit')->row();


$this->data['doge_bal'] = number_format($credit->doge,3);
$this->data['ltc_bal'] = number_format($credit->ltc,8);
$this->data['dgb_bal'] = number_format($credit->dgb,4);
$this->data['advert_bal'] =  number_format($credit->advert,8);

$this->data['btc_bal'] = number_format($credit->btc,8);


//REFER STUFF

if(isset($_GET['ref'])) {

            $ref = $_GET['ref'];


           $r = $this->login_m->get($ref);
           
           if (count($r)) {


$this->session->set_tempdata('refer', $r->id, 600);
    }

    else {
        
$this->session->set_tempdata('refer', '0', 600);
      }

   } 


$this->data['refer'] = !empty($this->session->tempdata('refer')) ? $this->session->tempdata('refer') : '0';


   $this->data['user'] = $this->login_m->get($id);
   $this->data['menu'] = $this->login_m->loggedin() == FALSE ? $this->page_menu_m->get_nested() : $this->page_m->get_nested();
  $this->data['menu']['log'] = $this->login_m->loggedin();


  if($this->login_m->loggedin() == FALSE){

   $this->data['register'] = 'buster/login/register';
   $this->data['loginview'] = 'buster/login/log_input'; 
   
  }

  	// Login Check

  $exeption_uris = array(
   'logout',
   'main',
   'main/register',
   'article/3/freebitco',
   'main/login',
   'main/just_box',
   'faq',
   'reset',
   'reset/password',
   'reset/pincode',
   'reset/send_mailcode',
   'reset/change_box/pincode',
  'reset/change_box/password', 
  'reset/reset_method/password',
   'reset/reset_method/pincode',
   'main/box_procced',
   'account/send_mailcode',
    'account/send_to',
   'login',
   );

if(in_array(uri_string(), $exeption_uris) == FALSE){

if($this->login_m->loggedin() == FALSE) {

redirect('main'); 
      }

        }
      }

   }
