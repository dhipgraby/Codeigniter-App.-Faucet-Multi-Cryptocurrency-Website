<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Work extends Frontend_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
      
   }

public function index(){

$this->data['mainview'] = 'buster/jobs/promoter';
$this->data['pagetitle'] = 'Be part of Lotobitcoin Team';
$this->load->view('buster/main_body', $this->data);

}



}