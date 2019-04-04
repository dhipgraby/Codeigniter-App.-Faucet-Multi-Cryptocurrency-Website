<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Frontend_Controller {
 
 	function __construct() {
      parent::__construct(); 
           
   }

public function index() {


$this->data['mainview']= 'buster/about';

$this->load->view('buster/main_body',$this->data);

}

}