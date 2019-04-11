<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

protected $_table_name = '';
protected $_table_col = '';
protected $_primary_key = 'id';
protected $_primary_filter = 'intval';
protected $_order_by = '';
public $_rules = array();
protected $_timestamps = FALSE;


	function __construct() {
      parent::__construct(); 

   }



//REMEMBER TO CREATE THIS FUNCTION FOR UNIQUE PLAYER ID
   public function unique_player(){}

   public function array_from_post($fields){

    $data = array();
    foreach ($fields as $field) {
      $data[$field] = $this->input->post($field);

    }     

    return $data;
   }

   public function get($id = NULL, $single = FALSE,$table = NULL){  

if($table != NULL){

$table = $table;

}

else { $table = $this->_table_name; }

    if ($id != NULL) {
    	
    	$this->db->where('id', $id);
    	$method = 'row';
    }
    elseif($single == TRUE) {
    	$method = 'row';
    }

    else {
    	$method = 'result';
    }

 
       	return $this->db->get($table)->$method();


}

   public function getof($id = NULL, $single = FALSE){  

    if ($id != NULL) {
   
      $this->db->where('id', $id);
      $method = 'row';
    }
    elseif($single == TRUE) {
      $method = 'row';
    }

    else {
      $method = 'result';
    }


        return $this->db->get($this->_table_col)->$method();


}

   public function get_by($where, $single = FALSE){
   $this->db->where($where);
   return $this->get(NULL, $single);
   }


   public function save($data, $id = NULL,$table = NULL){

if($table != NULL){

$table = $table;

}

else { $table = $this->_table_name; }

   	//Set timestamp
   	if ($this->_timestamps == TRUE) {
   		$now = date('Y-m-d H:i:s');
   		$id || $data['created'] = $now;
   		$data['modified'] = $now;
   	}
   	//insert
   	if ($id === NULL) {
   	
   	 $this->db->set($data);
   	 $this->db->insert($table);
   	 $id = $this->db->insert_id();
   	}
   	//update
   	else {
 
   	 $this->db->set($data);
   	  $this->db->where('id', $id);
   	    $this->db->update($table);

   	}

   	return $id;

   }


   public function saveof($data, $id = NULL){

    //insert
    if ($id === NULL) {
       $now = date('Y-m-d H:i:s');
        $data['created'] = $now;
   
     $this->db->set($data);
     $this->db->insert($this->_table_col);
     $id = $this->db->insert_id();
    }
    //update
    else {
     
     $this->db->set($data);
      $this->db->where('id', $id);
        $this->db->update($this->_table_col);

    }

    return $id;

   }

   
   
   public function delete($id, $table = NULL){


if($table != NULL){

$table = $table;

}

else { $table = $this->_table_name; }

   	$filter = $this->_primary_filter;
    $id = $filter($id);
    
    if (!$id) {
    	return FALSE;
    	    }

     $this->db->where($this->_primary_key, $id);
     $this->db->limit(1);
   	    $this->db->delete($table);

   }   

   public function deleteof($id){
    
    if (!$id) {
      return FALSE;
          }

     $this->db->where('id', $id);
     $this->db->limit(1);
        $this->db->delete($this->_table_col);

   }

   //CREATE TRANSACTION TO TRACK ALL MOVEMENTS OF THE USER
function _create_trans($id,$amount,$coin,$type){

$user_trans = $this->db->where('id',$id)->get('transactions')->row();

if(count($user_trans)){

 $txid = substr(md5(uniqid(rand(), true)), 0, 15);

$data = array(

'id' => $id,
'type' => $type,
$coin => $amount,
'txid' => $txid,
'datetime' => date('y-m-d h:i:sa'),  

);

$this->db->insert('transactions',$data);

return ($this->db->affected_rows() > 0) ? TRUE : FALSE;


} else {

$this->_new_user_trans($id);

}


}


function _new_user_trans($id){

$credit = $this->db->where('id',$id)->limit(1)->get('credit')->row();

if(count($credit)){

  $data = array(
'id' => $id,
'type' => 'genesis',
'txid' => 'genesis-'.$id,
'btc' => $credit->btc,
'ltc' => $credit->ltc,
'doge' => $credit->doge,
'dgb' => $credit->dgb,
'advert' => $credit->advert,
'datetime' => date('y-m-d h:i:sa'),

  );

$insert = $this->db->insert('transactions',$data);

return ($this->db->affected_rows() > 0) ? TRUE : FALSE;

}

return FALSE;

}
   

}

