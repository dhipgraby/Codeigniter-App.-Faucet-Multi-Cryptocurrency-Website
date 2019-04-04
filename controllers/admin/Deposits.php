<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposits extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     $this->load->model('deposit_m');
      $this->load->model('account_m');
      
      
   }

public function index(){	

$this->db->limit(20);
$this->data['deposits'] = $this->deposit_m->get();

		$this->data['subview'] = 'admin/user/deposits';
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

$this->data['deposits'] = $this->deposit_m->get();

echo $this->load->view('admin/tables/deposit',$this->data);

}



}
