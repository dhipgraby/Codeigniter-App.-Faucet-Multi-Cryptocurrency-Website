<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promoters extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
      $this->load->model('tracker_m');
      
      
   }

public function index(){	

$this->db->limit(25);
$this->db->order_by('datetime','desc');
$this->data['trackers'] = $this->db->get('views')->result();

$this->db->limit(25);
$promoters = $this->db->get('promoters')->result();
//PROMOTERS INFO
$this->data['promoters'] = $promoters;


//TOTAL SITEVIEWS
$this->db->select_sum('views');
$siteviews = $this->db->get('siteviews')->row()->views;
$this->data['siteviews'] = $siteviews;

//TOTAL SHARE
$this->db->select_sum('advert');
$this->data['total_share'] = number_format($this->db->get('credit')->row()->advert,8);



//YESTERDAY VIEWS
$this->db->where('status','current');
$c_day  = $this->db->get('siteviews')->row()->day;

$yesterday = $c_day - 1;

$this->db->where('day',$yesterday);
$this->data['yesterday_views'] = $this->db->get('siteviews')->row()->views;


		$this->data['subview'] = 'admin/promo/index';
		$this->load->view('admin/_layout_main', $this->data);
}


function user_stats($id){


$this->data['graphic'] = 'on';
  

//AUTOMATIC ASCENSION
$this->_ascension($id);

//LOADING VIEW DATA
$this->_view_data($id);
//LOADING GRAPHIC DATA 
$this->_graphic_data($id);


$this->db->where('id',$id);
$promoter = $this->db->get('promoters')->row();

$this->data['promo_box'] = count($promoter) ? 'buster/promo/promoter_box' : 'buster/promo/become_promoter';
$this->data['promoter_lvl'] = count($promoter) ? $this->_promoter_lvl($id) : '';
//NEXT VIEWS FOR ASCENSION

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
$this->data['subview'] = 'admin/promo/user_stats';

$this->db->where('id',$id);
$advert_bal = $this->db->get('credit')->row()->advert;

$this->data['advert_bal'] = number_format($advert_bal,8);
$this->data['promo_id'] = $id;


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

$this->data['promoters'] = $this->db->get('promoters')->result();

echo $this->load->view('admin/tables/promoters',$this->data);

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
	
		break;
}


} else return 'no promoter';




}


function change_view($id){

$view = $this->input->post('view');

$this->_graphic_data($id);

echo $this->load->view('buster/promo/'.$view,$this->data);

}

function _graphic_data($id){



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


$this->db->where('id',$id);
$this->db->limit(1);
$promoter = $this->db->get('promoters')->row();

$share = 0.000000004;

if(count($promoter)){

if($promoter->boost == '1')
{
    $share = 0.000000004;
}

if($promoter->boost == '2'){

    $share = 0.000000006;
}
if($promoter->boost == '3'){

    $share = 0.000000008;
}
if($promoter->boost == '4'){

    $share = 0.00000001;
}

} 

$today_payouts = $total * $share;


//TODAY VIEWS
$this->data['today_views'] =  round($total);
$this->data['today_payout'] = number_format($today_payouts,8);

//LAST 7 DAYS 

$weekly_views = $this->_count_views(7,$id);
$this->data['weekly_views'] = $weekly_views;
$this->data['weekly_payout'] = number_format($this->_count_payouts(7,$id),8);

//LAST 30 DAYS

$monthly_views = $this->_count_views(30,$id);
$this->data['monthly_views'] = $monthly_views;
$this->data['monthly_payout'] = number_format($this->_count_payouts(30,$id),8);

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

//LAST 10 DAYS HISTORY
$this->data['history'] = $this->db->where('id',$id)
                                  ->limit(10)
                                  ->order_by('datetime','desc')
                                  ->get('views')
                                  ->result();



}

function _count_views($num,$id){


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

function _count_payouts($num,$id){



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

function _share($id){

$share = 0.000000004;

  $this->db->where('id',$id);
  $promoter = $this->db->get('promoters')->row();

if(count($promoter)){

   $promoter_lvl = $promoter->boost;

switch ($promoter_lvl) {
  case $promoter_lvl == '1' :

  return 0.000000004;
  
    break;
  case $promoter_lvl == '2' :

  return   0.000000006;
  
    break;
      case $promoter_lvl == '3' :

  return   0.000000008;
  
    break;

      case $promoter_lvl == '4' :

  return   0.00000001;
  
    break;
}

} else return $share;


}

function _ascension($id){

$views = $this->_count_views(30,$id);

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




}
