<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends Frontend_Controller {
 
 	function __construct() {
      parent::__construct(); 

  
      
   }

public function index(){

$this->db->order_by('id','ASC');
$this->data['faqs'] = $this->db->get('faq')->result();
$this->data['pagetitle'] = '<i class="fas fa-graduation-cap"></i> Frequently asked questions';

$this->data['mainview'] = 'buster/faqs/index';

  $this->load->view('buster/main_body', $this->data);
}

public function topic($topic){


if(empty($topic)){

redirect('faqs');

}

$this->db->where('topic',$topic);
$this->db->order_by('id','ASC');
$this->data['faqs'] = $this->db->get('faq')->result();
$this->data['pagetitle'] = '<i class="fas fa-graduation-cap"></i> About '.$topic;

$this->data['mainview'] = 'buster/faqs/topic';

  $this->load->view('buster/main_body', $this->data);
}

}
