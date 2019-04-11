<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends MY_Controller {

	function __construct() {
      parent::__construct(); 


$this->data['meta_title'] = 'Lotobitcoin Market Place';
 $this->load->helper('form');
 $this->load->library('encryption');
  $this->load->library('form_validation');
  $this->load->library('session');
  $this->load->model('user_m');
  $this->load->model('login_m');

    	// Admin Login Check
$array = array(

'Admin',
'Admin1',


);

        if(!in_array($this->session->name ,$array) || $this->login_m->loggedin() != TRUE){

        redirect('main');

        }

      }

   }
