<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Frontend_Controller {
 
 	function __construct() {
      parent::__construct(); 

  
      
   }

public function index(){

$this->db->order_by('pubdate','desc');

$this->data['news'] = $this->db->get('news')->result();
$this->data['pagetitle'] = '<i class="far fa-newspaper"></i> Loto News';

$this->data['mainview'] = 'buster/news/index';

  $this->load->view('buster/main_body', $this->data);
}

public function page(){


$this->db->where('topic',$topic);
$this->db->order_by('id','ASC');
$this->data['news'] = $this->db->get('faq')->result();


$this->data['mainview'] = 'buster/news/page';

  $this->load->view('buster/main_body', $this->data);
}

}
