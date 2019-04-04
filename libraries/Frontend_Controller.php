<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_controller extends MY_Controller {

	function __construct() {
      parent::__construct(); 

    $id = $this->session->id;

     //load stuff
      $this->load->model('page_m');
      $this->load->model('article_m');
      $this->load->model('login_m');
      $this->load->model('page_menu_m');

      //Fetch navigation
      $this->data['menu'] = $this->page_m->get_nested();

      $this->data['meta_title'] = config_item('site_name');

    $this->db->where('id', $id);
$credit = $this->db->get('credit')->row();


$this->data['doge_bal'] = number_format($credit->doge,8);


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


 
      }

   }
