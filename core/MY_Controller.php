<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct() {
      parent::__construct(); 


//TRACKER

$this->load->model('login_m');

      $this->data['errors'] = array();
       $this->data['site_name'] = config_item('site_name');  

       



      }

   }

