<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends Buster_Controller {
 
  function __construct() {
      parent::__construct();

          $this->load->model('account_m'); 
           $this->load->model('deposit_m'); 
           $this->load->model('email_m');
 
         }


public function datos($coin){

$address = $this->deposit_m->get_current_address($coin);

if(!empty($address)){


  if($this->deposit_m->get_deposit($coin,$address) == TRUE){

$this->db->where('address',$address);
$value = $this->db->get('deposits')->row()->amount;

$this->data['address'] = $address;
$this->data['amount'] = $value;
$this->data['coin'] = $coin;

$template = $this->load->view('buster/new_deposit', $this->data,TRUE);
$user_email = '';

$this->email_m->_sendgrid_email($user_email,$template);

echo alert_msg('You got a new '.$coin.' deposit!', 'success');    
  }

}

}

public function index() {

   $id = $this->session->id;
//Loading page views

$this->data['pagetitle'] = 'Your deposit address';

    $this->data['mainview'] = 'buster/user/deposit';
    $this->data['deposit_tab'] = 'buster/user/deposit_tab';
    $this->data['dep_address'] = $this->deposit_m->get_current_address('btc');
   $this->data['coin'] = 'btc';

    if(empty($this->data['dep_address'])){

      $this->data['pubkey'] = config_item('xpubkey');
      $this->data['newaddr'] = 'admin/addr/newaddr';
      $this->db->select_max('count');
      $this->data['var_index'] = $this->db->get('deposits')->row()->count + 1;
      $this->data['create_btn'] = new_button('Create new address','get_addr','success');
   
    }

        //Set pagination
       $perpage = 5;
//page of deposits
$this->db->where('id', $id);
$deps = $this->db->get('deposits');
 $count_dep =  count($deps);

    $this->data['total_dep'] = ceil($count_dep / $perpage);
  
//Setting Deposit History
    $this->db->order_by('datetime', 'DESC');
    $this->db->limit($perpage, 0);
    $this->db->where('id', $id);
    $this->db->where('status', 2);
    $this->data['deposit'] = $this->db->get('deposits')->result();

     $this->load->view('buster/main_body', $this->data);
}

function currency_box($coin){

   $this->data['dep_address'] = $this->deposit_m->get_current_address($coin);

 $this->data['coin'] = $coin;

    if(empty($this->data['dep_address'])){


     $this->data['pubkey'] = config_item($coin.'xpubkey');
     
      $this->data['newaddr'] = 'admin/addr/newaddr';
      $this->db->select_max('count');
      $this->data['var_index'] = $this->db->get('deposits')->row()->count + 1;
      $this->data['create_btn'] = new_button('Create new address','get_addr','success');
    }

 $this->load->view('buster/user/currency_box', $this->data);



}

   function verify_addr($addr,$coin){
    
    $id = $this->session->id;

  $num = $this->input->post('num');

   echo $this->deposit_m->verify_addr($addr,$id,$coin,$num);  

   }


public function deposit_tab(){

$perpage = 5;
     $id = $this->session->id;

    if (isset($_GET["page_dep"])) { $page  = $_GET["page_dep"]; } else { $page=1; }; 

   $start_from = ($page-1) * $perpage;
    $this->db->order_by('datetime', 'DESC');
    $this->db->limit($perpage, $start_from);
   $this->db->where(array('id' => $id, 'status' => 2,));
   $deposit = $this->db->get('deposits')->result();

   echo '<table class="table table-responsive-lg">
<tr>
<td>Address</td>
<td>Coin</td>
<td>Txid</td>
<td>Date</td>
<td>Amount</td>

</tr>';

   if(count($deposit)){ foreach($deposit as $user){
   
$href = ($user->coin == "btc") ? 'href="https://blockchain.info/tx/'.$user->txid.'"' : 'href="https://chain.so/tx/DOGE/'.$user->txid.'"';
$href_address = ($user->coin == "btc") ? 'href="https://www.blockchain.com/btc/address/'.$user->address.'"' : 'href="https://chain.so/address/DOGE/'.$user->address.'"'; 

     echo'<tr>
     <td><a '.$href_address.' target="_blank">'.$user->address.'</a></td>
     <td>'.$user->coin.'</td>
        <td><a style="color:#198337;" '.$href.'>Tx-id Here</a></td>
         <td>' .$user->datetime.'</td>
          <td>' .$user->amount. ' <b style="color: #3CC2F6;">'.$user->coin.'</b></td>
      </tr>';
   }
   } 
    else {
      
      echo '<tr>
        <td colspan="3">No deposits yet.</td>
      </tr>';
    }

  echo '</table>';

}

 function qrcode($img){

$this->deposit_m->qr_img($img);

}


}