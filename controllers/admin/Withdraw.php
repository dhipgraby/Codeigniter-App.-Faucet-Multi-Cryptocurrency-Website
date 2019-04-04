<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     $this->load->model('deposit_m');
      $this->load->model('account_m');
      
      
   }

public function index(){	

$this->db->limit(20);
$this->db->order_by('count','desc');
$this->data['withdraws'] = $this->db->get('withdraw')->result();
$this->db->select_max('count');
$this->data['total_withdrawals'] = $this->db->get('withdraw')->row()->count;
		$this->data['subview'] = 'admin/user/payouts';
		$this->load->view('admin/_layout_main', $this->data);
}

function table(){

$where = $this->input->post('option');

$filter_name = $this->input->post('content');

if(!empty($filter_name)){


if($where == 'name'){

	$this->db->where('name',$filter_name);
	$name_id = $this->db->get('members')->row(); 
	$filter_name = $name_id->id;
	$where = 'id';
}

if($where == 'email'){

	$this->db->where('email',$filter_name);
	$name_id = $this->db->get('members')->row(); 
	$filter_name = $name_id->id;
	$where = 'id';
}

$this->db->where($where,$filter_name);

} 

$this->db->limit(20);
$this->db->order_by('count','desc');
$this->data['withdraws'] = $this->db->get('withdraw')->result();

echo $this->load->view('admin/tables/withdraw',$this->data);

}

function approve(){

$count = $this->input->post('id');

$this->db->where('status', 'pending');
$this->db->where('count',$count);
$this->db->limit(1);
$address = $this->db->get('withdraw')->row();

if(count($address)){

	$this->db->where('count',$count);
	$this->db->set('status','TxId');
	$this->db->update('withdraw');

	echo ($this->db->affected_rows() > 0) ? 'true' : 'false';

} else echo 'false';



}



}
