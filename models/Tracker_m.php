<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracker_m extends MY_Model {

protected $_table_name = 'credit';
protected $_table_col = 'tracker';
protected $_order_by = '';
protected $_timestamps = TRUE;



    function __construct() {
      parent::__construct(); 

   }

   function _track_view($id){

//IP FROM THE REFER LINK
    //REMEMBER TO CHANGE THE IP OF USER IN EACH LOGIN
$this->db->where('id',$id);
$id_ipp = $this->db->get('faucet')->row()->ipp;

//CREDIT IF THE REFER LINK
$credit = $this->get($id);
$advert = $credit->advert;

//IP FROM THE VISITOR
$ipp = $this->get_client_ip_server();

if($id_ipp != $ipp){

 //CHECKING IFIS A UNIQUE VISITOR
$this->db->where('ipp',$ipp);
$tracker = $this->getof();

if(!count($tracker)){

$data = array(

'id' => $id,
'ipp' => $ipp,
'datetime' => date('y-m-d h:i'),

);

if($this->db->insert('tracker',$data)){

$this->db->where('id',$id);
$this->db->limit(1);
$promoter = $this->db->get('promoters')->row();

if(count($promoter)){

if($promoter->boost == '1')
{
    $share = 0.000000002;
}

if($promoter->boost == '2'){

    $share = 0.000000003;
}
if($promoter->boost == '3'){

    $share = 0.000000004;
}
if($promoter->boost == '4'){

    $share = 0.000000005;
}


$this->db->where('id',$id);
$this->db->set('advert', $advert + $share);
$this->db->update('credit');

return ($this->db->affected_rows() < 1) ? FALSE : TRUE;


}


}

return FALSE;

} 

return FALSE;

}


  }

function daily_views(){


    $this->db->where('status','current');
$siteviews = $this->db->get('siteviews')->row();

if(count($siteviews)){

    $end = strtotime($siteviews->datetime);

$now = time();

if($now >= $end){

$promo = $this->db->get('promoters');
$promoters = $promo->num_rows();

$query = $this->db->get('tracker');

$views = $query->num_rows();

$array = array(

'views' => $views,
'promoters' => $promoters,
'status' => 'complete',

);

$this->db->where('status','current');
$this->db->set($array);
$this->db->update('siteviews');


if ($this->db->affected_rows() > 0){

foreach($query->result() as $user){

$this->db->where('id',$user->id);
$fullviews = $this->db->get('tracker');
$userviews = $fullviews->num_rows();

$this->db->where('day',$siteviews->day);
$this->db->where('id',$user->id);
$user_in_view = $this->db->get('views')->result();


                if(!count($user_in_view)){

$this->db->where('id',$user->id);
$this->db->limit(1);
$is_promoter = $this->db->get('promoters')->row();

$paid = 0;

if(count($is_promoter)){


$share = 0.000000004;

if($is_promoter->boost == 2){

    $share = 0.000000006;
}
if($is_promoter->boost == 3){

    $share = 0.000000008;
}
if($is_promoter->boost == 4){

    $share = 0.00000001;
}

$payment = $userviews/2;
$paid = $payment * $share;



}

                $data = array(

                'id' => $user->id,
                'views' => $userviews,
                'validviews' => round($userviews / 2),
                'datetime' => date('y-m-d'),
                'paid' => $paid,
                'day' => $siteviews->day,


                );


                $this->db->insert('views',$data);
     
                
                }

}

      $this->db->empty_table('tracker');
  
} 

}



} else {


    $this->new_views();
    $this->db->empty_table('tracker');
}

}


//CHOOSE THE NEW PROMOTERS WITH MORE THAN 2000 VIEWS
function new_promoters(){

$tracker = $this->db->get('views')->result();

    foreach ($tracker as $user) {

    $this->db->where('id',$user->id);
    $this->db->select_sum('validviews');
    $user_views = $this->db->get('views');

    $valid_views = $user_views->row()->validviews;

            if($valid_views >= 2000){

            $this->db->where('id',$user->id);
            $promoter = $this->db->get('promoters')->result();

                    if(!count($promoter)){               

                    $data = array(

                    'id' => $user->id,
                    'datetime' => date('y-m-d'),
                    'boost' => 1,

                    );
                     
                     $this->db->insert('promoters',$data);


                    }


            } 


    } 

}



function new_views(){

$this->db->order_by('day','Desc');
$site = $this->db->get('siteviews')->row();
$day = $site->day;

if(!count($site)){

    $day = 0;
}

    $data = array(

'promoters' => 0,
'datetime' => date('y-m-d',strtotime('+1 day')),
'views' => 0,
'status' => 'current',
'day' => $day +1,


);

$this->db->insert('siteviews',$data);

}


function _promoter_info($id){

if(isset($id)){

$this->db->where('id',$id);
$this->db->select_sum('validviews');
 $this->db->select_sum('paid');
 $info = $this->db->get('views');

 $data = array(

'views' => $info->row()->validviews,
'paid' => $info->row()->paid,

 );

 return $data;

}

}



function get_client_ip_server() {
    $ipaddress = '';
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}



}