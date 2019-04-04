<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upgrade extends Buster_Controller {
 
 	function __construct() {
      parent::__construct(); 
 
    $this->load->model('upgrade_m');

    $this->load->model('store_m');  
      
   }

public function index() {


    $dashboard = 'upgrade';
    $id = $this->session->id;
      
    $ipp = $this->input->ip_address();
     
    $this->data['subview'] = 'buster/views/store/item_box';
    $this->data['items']  =  $this->store_m->get();

     $limits = array (

     'limit' => $this->data['user']->wlimit,
     'transid' => $this->data['user']->transid,

     );
     
   $this->data['pagetitle'] = "<i class='fa fa-tachometer' aria-hidden='true'>   Upgrade</i>";

      
     if(isset($_POST['submit']))
{

$this->data['message'] = $this->upgrade_m->check_buy($id,$limits);
   $this->data['balance'] = $this->buster_m->user_balance($id);
     $this->data['user'] = $this->buster_m->get($id);
     $this->data['energy'] = $this->buster_m->energy_slot($id);


   } 


$this->load->view('buster/views/main_layout', $this->data);


   


}

public function purchase() {

$get_item = $_GET["item"];
$item_inf = $this->store_m->get($get_item);

if(count($item_inf)) {


echo 'Name : <input type="text" name="ctitle" id="ctitle" value="'.$item_inf->title.'" readonly>';
if ($item_inf->title == "Lottery ticket") {

  echo  '<input style="width: 28px; margin-left: 5px;" type="number" name="quantity" id="quantity" min="1" value="1">';
}
echo '<input style="display:none;" type="text" name="slug" id="slug" value="'.$item_inf->slug.'" readonly>';
echo '<br>';

echo 'Price : <input type="number" name="cprice" id="cprice" value="'.number_format($item_inf->price/100000000,8).'" readonly>';



}

else {echo 'no item set';}


}

}