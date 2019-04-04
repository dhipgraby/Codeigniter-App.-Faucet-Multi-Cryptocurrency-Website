<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class upgrade_m extends  MY_Model {

protected $_table_name = 'faucet';
protected $_table_col = 'members';
protected $_primary_filter = 'intval';
protected $_order_by = '';
protected $_timestamps = TRUE;


//Checking the item and values
public function check_buy($id,$limits) {

$price = ($_POST['cprice'] * 100000000);
$title = $_POST['ctitle'];
$method = $_POST['slug'];
if($_POST['quantity']){
$quantity = $_POST['quantity'];
$price = $price * $quantity;
}
else {
  $quantity = 1;
}
//user check from faucet
$user = $this->getof($id);
$faucet = $this->get($id);

if(count($user)) {

		 if(!empty($_POST['ctitle']) && !empty($_POST['cprice'])) {

//from faucet balance
$bbb = $user->bbb;

if($price > $bbb) {


	return 'Not eneugh Balance.';
}

else {



$new_balance = $bbb-$price;

//Setting array for the item method
    $data = array (
    
    'id' => $id,
    'item' => $title,
    'price' => $price,
    'new_balance' => $new_balance,
    'transid' => $limits['transid'],
    'limit' => $limits['limit'],
    'active' => $user->active,
    'boost' => $faucet->boost,
    'tickets' => $faucet->tickets,
    'quantity' => $quantity,
   
    	);

//Checking and loading method
return $this->$method($data);

}
	}

}
       



}

function enerplus($data){

if($data['transid'] >= $data['limit']){

return 'you got full energy. Go withdraw';

} else { 

 //Adding energy slot and updating balance
    $this->db->where('id', $data['id']);
    $this->db->set('transid', $data['transid'] + $data['quantity']);
   $this->db->set('bbb', $data['new_balance']);
   $this->db->update('members');

  //registering purchase

    $datos = array (
    
    'id' => $data['id'],
    'item' => $data['item'],
    'amount' => $data['quantity'],
    'price' => $data['price'],
    'datetime' => date('Y-m-d H:i:s'),
   
      );
  
    $this->db->set($datos);
    $this->db->insert('sells');
    return 'Purchase complete';

}

}

function ticketplus($data) {

  // Adding tickets to balance
    $this->db->where('id', $data['id']);
    $this->db->set('tickets', $data['tickets'] + $data['quantity']);
    $this->db->update('faucet');  


//updating balance
     $this->db->where('id', $data['id']);
    $this->db->set('bbb', $data['new_balance']);
    $this->db->update('members');  
    //registering purchase
     $datos = array (
    
    'id' => $data['id'],
    'item' => $data['item'],
    'amount' => $data['quantity'],
    'price' => $data['price'],
    'datetime' => date('Y-m-d H:i:s'),
   
      );
  
    $this->db->set($datos);
    $this->db->insert('sells');
    return 'Purchase complete';


}

function boost($data){


	if($data['boost'] > 0){

return 'Boost 2X already active';

} else { 

//updating balance and boosting

    $this->db->where('id', $data['id']);
    $this->db->set('boost', '1');
    $this->db->update('faucet');
    
//updating balance
      $this->where('id', $data['id']);
    $this->db->set('bbb', $data['new_balance']);
    $this->db->update('members');  

   //Registering purchase
    $datos = array (
    
    'id' => $data['id'],
    'item' => $data['item'],
    'amount' => $data['quantity'],
    'price' => $data['price'],
    'datetime' => date('Y-m-d H:i:s'),
   
      );
  
    $this->db->set($datos);
    $this->db->insert('sells');
    return 'Purchase complete';

}


}



}