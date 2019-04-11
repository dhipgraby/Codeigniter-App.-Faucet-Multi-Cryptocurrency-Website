<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit_m extends MY_Model {

protected $_table_name = 'deposits';
protected $_table_col = 'credit';
protected $_order_by = '';
protected $_timestamps = TRUE;



	function __construct() {
      parent::__construct(); 

   }

function _user_exist($id){

  $user = $this->get($id);

  if(count($user)){

    return TRUE;
  }

  return FALSE;
}

function get_deposit($coin,$address){

$id = $this->session->id;

$this->db->where('coin',$coin);
 $user = $this->get($id);
 $credit_user = $this->getof($id);

 $u_time = strtotime($user->datetime);

$url ="https://chain.so/api/v2/address/".$coin."/".$address;

$json = json_decode(file_get_contents($url), true);

$status = $json['status'];
$received_value = $json['data']['received_value'];
$pending_value = $json['data']['pending_value'];
$total_txs = $json['data']['total_txs'];
$time = $json['data']['txs'][0]['time'];
$txid = $json['data']['txs'][0]['txid'];
$value = $json['data']['txs'][0]['incoming']['value'];


$minimum = config_item($coin.'_mindep');


$this->db->where('txid', $txid);
$txid_check = $this->db->get($this->_table_name)->row();
$this->db->where('id',$txid);
$col_txid = $this->db->get('collection')->row();
		if(!count($txid_check) && !count($col_txid)){

			if($status == 'success' && $pending_value == 0 && $total_txs > 0 && $value >= $minimum)

			{


if($time > $u_time){


						if($this->create_dep_transaction($coin,$value,$time,$txid,$address) == TRUE){

						$user_bal = $credit_user->$coin;

						$arr = array(

						$coin => ($user_bal + $value),
						'datetime' => date('Y-m-d h:i'),
						'txid' => $txid,


						);

						$this->db->where('id',$id);
						$this->db->set($arr);
						$this->db->update($this->_table_col);

						$this->_create_trans($id,$value,$coin,'deposit');

						 return ($this->db->affected_rows() < 1) ? FALSE : TRUE;

						}

	
}

					

			}
			
		}

}

function create_dep_transaction($coin,$value,$time,$txid,$address){


$value = $value;

$data = array(

'amount' => $value,
'deposit_date' => date('y-m-d h:i', $time),
'status' => '2',
'txid' => $txid,

);

if(!empty($address) && $address != NULL){

$collection = array(

'id' => $txid,
'datetime' => date('y-m-d h:i', $time),
'number' => 180,
'coin' => $coin,

);

$this->db->set($collection);
$this->db->insert('collection');

$this->db->where('coin', $coin);
$this->db->where('address', $address);		
$this->db->set($data);
$this->db->update($this->_table_name);

 return ($this->db->affected_rows() < 1) ? FALSE : TRUE;


}

}


function get_current_address($coin){

$id = $this->session->id;

$where = array(

'id' => $id,
'coin' => $coin,
'status' => 1,
'txid' => null,


);

$this->db->where($where);
$address = $this->db->get('deposits')->row()->address;

if(count($address)){	

return $address;

}


}


function verify_addr($addr,$id,$coin,$num){

if(!empty($addr) && !empty($coin))
{

	$this->db->where('address', $addr);
	$check_address = $this->db->get('deposits')->row();
    
    //if address exist
	if(count($check_address)){

     	return '1'; 
	}
    
    //if not exist
    if(!count($check_address)){

//and thre is not current address awaiting for deposits
    	$deps = $this->get_current_address($coin);

if(!count($deps)){ 

//then create a new one
$data = array(

'id' => $id,
'address' => $addr,
'datetime' => date('Y-m-d H:i:s'),
'coin' => $coin,
'amount' => 0,
'txid' => null,
'status' => 1,
'num' => $num,

);

$this->db->set($data);
$this->db->insert($this->_table_name);

 return ($this->db->affected_rows() < 1) ? '3' : '2';

} else { return '3'; }   
    
    }

}    
    return '3';	
}


function qr_img($img){


if(!empty($img)){

include('phpqr/qrlib.php');


echo $qr_code = Qrcode::png($img);



}




}


}