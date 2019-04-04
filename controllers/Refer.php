<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refer extends Buster_Controller {
 
 	function __construct() {
      parent::__construct();

          $this->load->model('account_m'); 

          $this->load->model('refer_m'); 
 
         }

public function index() {

   $id = $this->session->id;
   //Checking for deposits
//USE THIS FUNCTION TO GET DEPOSITS ==> $this->account_m->get_deposits($id);
//Loading page views
	$this->data['pagetitle'] = "Referrals";
    $this->data['mainview'] = 'buster/user/referrals';
    $this->data['paginator'] = 'buster/user/paginator';

       
//page of referrals
  $this->data['total_doge'] = $this->refer_m->total_comision($id,'doge');
    $this->data['total_btc'] = $this->refer_m->total_comision($id,'btc');
  $this->data['referral'] = $this->refer_m->get_ref_details($id);
  $this->data['total_ref'] = $this->refer_m->get_referrals($id);
    
 $count_ref = count($this->data['referral']);  

$perpage = 5;

//data of all the total pages

    $this->data['total_ref_pages'] = ceil($count_ref / $perpage);
    
        $this->load->view('buster/main_body', $this->data);


}

public function paginator() {

  $perpage = 5;
     $id = $this->session->id;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

   $start_from = ($page-1) * $perpage;
    $this->db->limit($perpage, $start_from);
      $referral = $this->refer_m->get_ref_details($id);

echo '
<table class="table table-responsive-lg">
  <tr>
  <td>Ref id</td>
  <td>Coin</td>
  <td>Comision</td>
  <td>Last Claim</td>

  </tr>';

    if(count($referral)) { 
  
foreach ($referral as $refer) {

$reward  = ($refer->type == "doge") ? number_format($refer->reward,0) : $refer->reward;

echo
'<tr><td>' .substr((sha1($refer->id)),0,6).'</td>
<td>'.$refer->type.'</td>
<td>'.$reward.'</td>
<td>'.  date("Y-m-d",$refer->lastclaim) . '</td></tr>';

}
     
    }
    else {

         echo '<tr>
        <td colspan="3">No data refer.</td>
      </tr>';
    }

  echo '</table>';
  
}

}