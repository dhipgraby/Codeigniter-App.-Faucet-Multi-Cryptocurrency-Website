<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
      
   }

  public function index(){
   

   $this->load->model('article_m');

   //Fetch recently modified articles
   $this->db->order_by('modified desc');
   $this->db->limit(5);
   $this->data['recent_articles'] = $this->article_m->get();

   $this->data['subview'] = 'admin/dashboard/index';
   $this->load->view('admin/_layout_main', $this->data);
   }

   public function modal(){
   
   $this->load->view('admin/_layout_modal', $this->data);
   }
  
}