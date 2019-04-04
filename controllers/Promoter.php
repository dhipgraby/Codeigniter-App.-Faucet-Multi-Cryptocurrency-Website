<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promoter extends Buster_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
     $this->load->model('credit_m');
     $this->load->model('rules_m');
     $this->load->model('security_m');
     $this->load->model('email_m');


 
   }


public function index(){

$this->data['graphic'] = 'on';
  
$this->data['pagetitle'] = 'Promoter Dashboard';

$id = $this->session->id;

//AUTOMATIC ASCENSION
$this->_ascension($id);

//LOADING VIEW DATA
$this->_view_data($id);
//LOADING GRAPHIC DATA 
$this->_graphic_data();


$this->db->where('id',$id);
$promoter = $this->db->get('promoters')->row();

$this->data['promo_box'] = count($promoter) ? 'buster/promo/promoter_box' : 'buster/promo/become_promoter';
$this->data['promoter_lvl'] = count($promoter) ? $this->_promoter_lvl($id) : '';
//NEXT VIEWS FOR ASCENSION
$this->data['min_views'] = $this->_min_views($this->data['promoter_lvl']);

if($this->_promoter_lvl($id) == 'Beginner'){

		$this->data['next_ascent'] = 'Amateur';
}
	
if($this->_promoter_lvl($id) == 'Amateur'){

		$this->data['next_ascent'] = 'Expert';
}
	
if($this->_promoter_lvl($id) == 'Expert'){

		$this->data['next_ascent'] = 'Professinal';
}
	
        
 //setting transaction pagination
 $this->db->where('id', $id);
 $count = $this->db->count_all_results('advert_trans');
        //Set pagination
       $perpage = 5;
//data of all the total pages
    $this->data['total_pages'] = ceil($count / $perpage);

if($this->data['total_pages'] > 5){

	$this->data['total_pages'] = 5;
}
    //withdrawal history
    $this->db->order_by('datetime', 'DESC');
    $this->db->limit($perpage, 0);
    $this->db->where('id', $id);
    $this->data['withdraw'] = $this->db->get('advert_trans')->result();

$this->data['withdraw_tab'] = 'buster/promo/advert_trans_tab';

$this->_withdraw_data($id);

$this->data['mainview'] = 'buster/promo/index';
$this->load->view('buster/main_body', $this->data);

}

function _withdraw_data($id){


//Withdrawal Address book

 $user = $this->security_m->get($id);
   $only = $user->addronly;
   
if($only == 'on'){

$this->data['coin_list']['btc'] =  '<small class="mt-2">Select the address from your book</small><br>'.form_dropdown('addr_list',$this->array_explore('btc'), 'Please select a valid address', 'class="form-control w-50 mt-2" id="val_addr"');

$this->data['coin_list']['doge'] =  '<small class="mt-2">Select the address from your book</small><br>'.form_dropdown('addr_list',$this->array_explore('doge'), 'Please select a valid address', 'class="form-control w-50 mt-2" id="val_addr"');

$this->data['coin_list']['ltc'] =  '<small class="mt-2">Select the address from your book</small><br>'.form_dropdown('addr_list',$this->array_explore('ltc'), 'Please select a valid address', 'class="form-control w-50 mt-2" id="val_addr"');

$this->data['coin_list']['dgb'] =  '<small class="mt-2">Select the address from your book</small><br>'.form_dropdown('addr_list',$this->array_explore('dgb'), 'Please select a valid address', 'class="form-control w-50 mt-2" id="val_addr"');
}

if($only == 'off'){

$this->data['coin_list']['btc'] =  form_input('address', '', 'class="form-control w-50 mt-2" id="val_addr" placeholder="Enter a valid bitcoin address" readonly');
}


if(empty($this->session->tempdata('doge_convert'))){

$doge_price =  number_format(convert_to('doge','btc'),8);
$doge_calc = $doge_price * 0.1;
$doge_convert = $doge_price + $doge_calc;

 $this->session->set_tempdata('doge_convert',$doge_convert, 300);
 
}


if(empty($this->session->tempdata('ltc_convert'))){

$ltc_price =  number_format(convert_to('ltc','btc'),8);
$ltc_calc = $ltc_price * 0.1;
$ltc_convert = $ltc_price + $ltc_calc;

 $this->session->set_tempdata('ltc_convert',$ltc_convert, 300);
 
}


if(empty($this->session->tempdata('dgb_convert'))){

$dgb_price =  number_format(convert_to('dgb','btc'),8);
$dgb_calc = $dgb_price * 0.1;
$dgb_convert = $dgb_price + $dgb_calc;

 $this->session->set_tempdata('dgb_convert',$dgb_convert, 300);
 
}




$this->data['doge_convert'] = number_format($this->session->tempdata('doge_convert'),8);
$this->data['ltc_convert'] = number_format($this->session->tempdata('ltc_convert'),8);
$this->data['dgb_convert'] = number_format($this->session->tempdata('dgb_convert'),8);


}

function array_explore($coin){

$id = $this->session->id;

     $this->db->where('id', $id);
     $this->db->where('coin', $coin);  
     $fields =  $this->db->get('addressbook')->result();
    $data = array();
    foreach ($fields as $field) {
      $data[$field->address] = $field->label;

    }     

    return $data;
   }

function change_view(){

$view = $this->input->post('view');

$this->_graphic_data();

echo $this->load->view('buster/promo/'.$view,$this->data);

}

function _graphic_data(){

$id = $this->session->id;


$this->db->where('id',$id);
$this->db->order_by('datetime','Asc');
$this->data['today_track'] = $this->db->get('tracker')->result();


$this->db->where('id',$id);
$this->db->order_by('day','Desc');
$this->data['tracker'] = $this->db->get('views')->result();


}

function _view_data($id){

$this->db->where('id',$id);
$query = $this->db->get('tracker');

$total = $query->num_rows()/2;
$today_payouts = $total * 0.000000004;

//TODAY VIEWS
$this->data['today_views'] =  round($total);
$this->data['today_payout'] = number_format($today_payouts,8);

//LAST 7 DAYS 

$weekly_views = $this->_count_views(7);
$this->data['weekly_views'] = $weekly_views;
$this->data['weekly_payout'] = number_format($this->_count_payouts(7),8);

//LAST 30 DAYS

$monthly_views = $this->_count_views(30);
$this->data['monthly_views'] = $monthly_views;
$this->data['monthly_payout'] = number_format($this->_count_payouts(30),8);

//TOTAL VIEWS
$this->db->where('id',$id);
$this->db->select_sum('validviews');
//REMEMBER TO COUNT THE VALID VIEWS AND NOT THE VIEWS
$total_views = $this->db->get('views')->row()->validviews;

//TOTAL PAYOUT
$this->db->where('id',$id);
$this->db->select_sum('paid');
$total_payout = $this->db->get('views')->row()->paid;

$this->data['total_views'] = round($total_views);
$this->data['total_payout'] = number_format($total_payout,8);

//LEFT VIEWS TO BECOME PROMOTER 
$left_views = round($this->_min_views($this->_promoter_lvl($id)) - $total_views);

$left_views = ($left_views < 0) ? 0 : $left_views;

$this->data['left_views'] = $left_views;

//LAST 10 DAYS HISTORY
$this->data['history'] = $this->db->where('id',$id)
                                  ->limit(10)
                                  ->order_by('datetime','desc')
                                  ->get('views')
                                  ->result();

//FAQS INFO ABOUT PROMOTER
$this->db->where('topic','promoter');
$this->db->order_by('id','ASC');
$this->data['faqs'] = $this->db->get('faq')->result();

}

function _count_views($num){

$id = $this->session->id;

$this->db->select_max('day');
$day = $this->db->get('views')->row()->day;
$day_left = $day - $num;


for($i=$day_left;$i <= $day;$i++){

$this->db->where('id',$id);
$this->db->where('day',$i);
//REMEMBER TO COUNT JUST THE VALID VIEWS AND NOT THE VIEWS
$this->db->select_sum('validviews');
$total[$i] = $this->db->get('views')->row()->validviews;

$views = $views + $total[$i];

}

return $views;


}

function _count_payouts($num){

$id = $this->session->id;

$this->db->select_max('day');
$day = $this->db->get('views')->row()->day;
$day_left = $day - $num;

for($i=$day_left;$i <= $day;$i++){

$this->db->where('id',$id);
$this->db->where('day',$i);
//REMEMBER TO COUNT JUST THE VALID VIEWS AND NOT THE VIEWS
$this->db->select_sum('paid');
$total[$i] = $this->db->get('views')->row()->paid;

$views = $views + $total[$i];

}

return $views;


}

function _ascension($id){

$views = $this->_count_views(30);

if($views < 2000){

     $this->db->where('id', $id);
     $this->db->limit(1);
 	 $this->db->delete('promoters');
}

if($views >= 2000){

	$this->db->where('id',$id);
	$this->db->set('boost','1');
	$this->db->update('promoters');
}


if($views >= 20000){

	$this->db->where('id',$id);
	$this->db->set('boost','2');
	$this->db->update('promoters');
}

if($views >= 100000){

		$this->db->where('id',$id);
	$this->db->set('boost','3');
	$this->db->update('promoters');
}

}

function _min_views($lvl){

switch ($lvl) {
	case 'Beginner':
		
        return 20000;

		break;
			case 'Amateur':
		
        return 100000;

		break;
			case 'Expert':
		
        return 200000;

		break;

		 case 'no promoter':
 
         return 2000;
 
}

}

function _promoter_lvl($id){

	$this->db->where('id',$id);
	$promoter = $this->db->get('promoters')->row();

if(count($promoter)){

   $promoter_lvl = $promoter->boost;

switch ($promoter_lvl) {
	case $promoter_lvl == '1' :

	return 'Beginner';
	
		break;
	case $promoter_lvl == '2' :

	return  'Amateur';
	
		break;
			case $promoter_lvl == '3' :

	return  'Expert';
	
    case $promoter_lvl == '4' :

  return  'Professinal';

		break;
}


} else return 'no promoter';




}


function factor_box(){


$id = $this->session->id;

$user = $this->security_m->get($id);

$rules = $this->rules_m->advert_rules;

$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

   $this->session->set_userdata('access', TRUE);

$factor_name = 'Withdraw 2fa security'; 

$current_method =  $user->withdraw2fa;

$title = $factor_name.' '.$current_method; 
$button = 'Unlock';
$b_id = 'unlock';

$this->data['mod_title'] = $title;
$this->data['mod_content'] = '';
$this->data['mod_id'] = $b_id;
$this->data['mod_button'] = $button;
$this->data['input_id'] = 'sec_password';


    echo $this->load->view('buster/security/form_'.$current_method, $this->data);


}  else { 

    $errors = validation_errors();

      echo alert_msg($errors,'warning');

        }

}

function confirm_box(){

$id = $this->session->id;
$user = $this->security_m->get($id);

$method = $this->input->post('method');
$coin = strtoupper($this->input->post('coin'));
$convert = $this->input->post('convert');

$factor = $user->withdraw2fa.'_rules';

if($method == 'address'){


$method = ' Address ('.$this->input->post("addr").')';

} 

if($coin != 'btc'){

  $method .='<br>
Convertion: '.$convert.' '.$coin;

}

$rules = $this->security_m->$factor;
$this->form_validation->set_rules($rules);

if($this->form_validation->run() == TRUE){

   $this->session->set_userdata('access', TRUE);


//WITHDRAWAL Confirm
$content = 'You are about to withdraw <b>' .$this->input->post('amount').' '.$this->input->post('currency').' BTC</b></b>
<br>
<b>Method: '.$coin.' '.$method.'</b><br>
 <br>
 Click confirm to proceed';

$modal = modal_content('<span id="message"></span>Withdrawal details',$content,'Confirm withdrawal', 'w_confirm');

$data = array( 'access' => '1',
        'info' => $modal,
             );

echo json_encode($data);

 }

    else { 


    $errors = validation_errors();

      $modal = alert_msg($errors,'warning');

$data = array( 'access' => '2',
        'info' => $modal,
      
             );


echo json_encode($data);


        }

}


function process(){


$amount = $this->input->post('amount');
$method = $this->input->post('method');
$coin = $this->input->post('coin');
$currency = $this->input->post('currency');
$address = $this->input->post('addr');
$convert = $this->input->post('convert');

if($coin =='btc'){

  $convert = 0;
}


if($address == null || empty($address)){

$address = 'balance';

}

if($method == 'balance'){

$address = 'balance';


}


if(empty($currency)){

  return FALSE;
}

if($this->_check_balance() == TRUE){


      $id = $this->session->id;

      $data = array(

      'amount' => $amount,
      'convertion' => $convert,
      'method' => $method,
      'coin' => $coin,
      'address' => $address,
      'status' => 'Checking',
      'datetime' => date('y-m-d h:i'),
      'id' => $id,

      );


      if($this->security_m->_access_method() == TRUE){ 

      if($this->credit_m->_withdraw_payment($id,$amount,$currency) == TRUE){

        //PASS THIS TO CREDIT CONTROLLER
      $this->db->insert('advert_trans', $data);

      $message = alert_msg("withdrawal success! Process will take 24 to 48 hours to validate.<br>
      	Once transction is check, status will change to 'complete' and you will receive the BTC amount to your ".strtoupper($coin)." ".$method." ","success");

      $message_error = alert_msg("Server error or incorrect details, try again or contact support by <a href='https://www.facebook.com/lotobitcoin'>facebook</a>","warning");


$this->data['address'] = $this->session->id;
$this->data['title'] = 'Promoter transaction request.';
$template = $this->load->view('templates/withdraw_request', $this->data,TRUE);
$user_email = 'kenneth.zambrano4@gmail.com';

$this->email_m->_sendgrid_email($user_email,$template);

             echo ($this->db->affected_rows() < 1) ? $message_error : $message;

      }


        
      }



 }

 else { echo alert_msg("not allowed to process, please reload page or contact support","warning"); }


}
public function withdraw_tab(){

$perpage = 5;
     $id = $this->session->id;

    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

   $start_from = ($page-1) * $perpage;
    $this->db->order_by('datetime', 'DESC');
    $this->db->limit($perpage, $start_from);
    $this->db->where('id', $id);

    $this->data['withdraw'] = $this->db->get('advert_trans')->result();
    
$this->load->view('buster/promo/advert_trans_tab', $this->data);

}



function page_buttons(){

   $perpage = 5;

$page = $_GET["page"];
$id = $this->session->id;

    //TOTAL PAGES
  
    $this->db->where('id', $id);
    $count = $this->db->count_all_results('advert_trans');
    
    $total_pages = ceil($count / $perpage);


if(isset($page)) { $page  = ($page > 0) ? $page : 1; } else { $page=1; };  

   $left_pages = $page + 4;

    if($left_pages >= $total_pages){

      $left_pages = $total_pages;
    }

    if($page >= $total_pages){

      $page = $total_pages;
    }

$next_pages = $page + 5;


echo new_button('<b>- 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.($next_pages - 10).'"');

echo '<div class="btn-group mr-2 ml-2" role="group" aria-label="First group">';

  for($x=$page; $x<= $left_pages; $x++) {

  echo new_button($x,'','light','type="button" onclick="paginator(this.value);" value="'.$x.'"');

  }  

  echo '</div>';

echo new_button('<b>+ 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.$next_pages.'"');

}

//EMAIL REPORTS

function promoter_report(){

$id = $this->session->id;

$this->data['type'] = 'Weekly';

// PRELOAD DATA START--------------------------------->

$this->data['total_views'] = $this->_count_views(7,$id);

$earnings = $this->_count_payouts(7,$id);

$this->data['earnings'] = $earnings;
$this->data['promoter_lvl'] = $this->_promoter_lvl($id);

//LEFT VIEWS TO BECOME PROMOTER 
$left_views = round($this->_min_views($this->_promoter_lvl($id)) - $total_views);

$this->data['views_left'] = $left_views;

$this->db->where('id',$id);
$this->db->limit(1);
$member =  $this->db->get('members')->row();
$this->data['member'] = $member;

$this->data['history'] = $this->db->where('id',$id)
                                  ->limit(10)
                                  ->order_by('datetime','desc')
                                  ->get('views')
                                  ->result();

//PRELOAD DATA END------------------------------------------>

$user_email = $member->email;

$subject = "Promoter weekly report. Earnings: ".$earnings." BTC, receive this week.";

if(count($member)) {

$this->load->view('buster/promo/report_email', $this->data);

/*
echo ($this->email_m->_sendgrid_email($user_mail,$template,"Lotobitcoin Promoters Team",$subject) == TRUE) ? 'true' : 'false';
 **/

}

}


//VALIDATIONS FORMS

function _password_validation(){
  
  
   return $this->security_m->_password_factor();
}

function _amount_validation(){
  
$amount = $this->input->post('amount');
$currency = $this->input->post('currency');
$method = $this->input->post('method');


$min = config_item('min_withdraw_advert');
$max = config_item('max_withdraw_advert');

if($method == 'balance'){

$min = config_item('min_withdraw_advertbal');
$max = config_item('max_withdraw_advertbal');

}


if($amount < $min){

   $this->form_validation->set_message('_amount_validation', 'Minimum amount is '.number_format($min,8).' '.$currency);

      return FALSE;
}

elseif ($amount > $max){

   $this->form_validation->set_message('_amount_validation', 'Maximum amount to withdraw is '.number_format($max,8).' '.$currency);

      return FALSE;
}

return TRUE;

}


function _emailcode_validation(){

return $this->security_m->expired(600);

}


function _pin_validation(){
  
  
   return $this->security_m->_pin_factor();
}



function _check_balance(){

return $this->credit_m->_check_balance();

}



}