<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refer_m extends MY_Model {

protected $_table_name = 'refer';
protected $_table_col = 'members';
protected $_order_by = '';
protected $_timestamps = TRUE;



	function __construct() {
      parent::__construct(); 

   }

function get_referrals($id){


$this->db->where('id >',$id);
$this->db->where('refer',$id);

$refers = $this->db->get('members')->result();

if(count($refers))
{

   return $refers;
 
}

}


function get_ref_details($id){


$this->db->where('refID',$id);
$this->db->order_by('lastclaim','desc');
$refers = $this->db->get('refer')->result();

if(count($refers))
{

   return $refers;
 
}

}

function total_comision($id,$coin){

$this->db->where('refID',$id);
$this->db->where('type',$coin);
$this->db->select_sum('reward');
$sum = $this->db->get('refer');

return $sum->row()->reward;


}


}