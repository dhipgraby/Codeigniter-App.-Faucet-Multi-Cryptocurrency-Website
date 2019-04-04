<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addresses extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
     $this->load->model('deposit_m');
      
   }

  public function index(){
   
  $this->data['subview'] = 'admin/addr/create';
  $this->data['addr_gen'] = 'admin/addr/head';  
  $this->data['xpubkey'] = config_item('xpubkey');
  $this->db->select_max('count');
  $this->data['var_index'] = $this->db->get('deposits')->row()->count + 1;

  $this->load->view('admin/_layout_main', $this->data);

}  

   function verify_addr($addr,$coin){
    
    $id = $this->session->id;

   echo $this->deposit_m->verify_addr($addr,$id,$coin);  

   }

  
}