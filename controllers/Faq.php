<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Buster_Controller {
 
 	function __construct() {
      parent::__construct(); 

  
      
   }

public function index(){

$this->db->order_by('id','ASC');
$this->data['faqs'] = $this->db->get('faq')->result();
$this->data['pagetitle'] = 'Frequently asked questions';

$this->data['mainview'] = 'buster/faqs';

  $this->load->view('buster/main_body', $this->data);
}

}
