<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lottery extends Admin_Controller {
 
  function __construct() {
      parent::__construct(); 
 
    $this->load->model('lottery_m'); 
      
   }

public function index() {
    
    $this->db->where('status','current');
$this->data['current_round'] = $this->db->get('rounds')->row();

$this->db->where('item','ticket Round-'.$this->lottery_m->current_game());
$this->db->select_sum('quantity');
$query = $this->db->get('purchase');
$total = $query->row()->quantity;

$this->data['t_purchases'] = $total;
$this->data['all_tickets'] = $this->lottery_m->all_tickets();

$this->db->order_by('datetime','Desc');
$this->db->limit(15);
$this->data['purchases'] = $this->db->get('purchase')->result();
$winners = $this->lottery_m->get();

$this->db->where('status','complete');
$this->data['last_rounds'] = $this->db->get('rounds')->result();


   $this->data['winners'] = $winners;

   $this->data['subview'] = 'admin/lottery/dashboard';
    $this->load->view('admin/_layout_main', $this->data);
 
  
}


}