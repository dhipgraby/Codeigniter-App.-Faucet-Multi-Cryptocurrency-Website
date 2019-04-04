<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Buster_Controller {
 
 	function __construct() {
      parent::__construct(); 

      $this->load->model('security_m');
        $this->load->model('buster_m');
             $this->load->model('sit_lottery_m');
      
   }

public function index(){

 $this->db->limit(6);
 $this->data['articles'] = $this->article_m->get();

$this->data['pagetitle'] = 'Dashboard';	

$id = $this->session->id;

$this->buster_m->faucet($id);

$user = $this->security_m->get($id);

if(!count($user)){

$this->security_m->get_new($id);

}



$lotteries = $this->db->group_by('type')
                      ->where('status','current')
                      ->where('coin','btc')
                      ->get('sit_winners')->result();

$this->data['lotteries'] = $lotteries;

$this->data['mainview'] = 'buster/index';
$this->load->view('buster/main_body', $this->data);

}


function convert_balance(){

$id = $this->session->id;


$this->db->where('id', $id);
$credit = $this->db->get('credit')->row();

$doge_bal = number_format($credit->doge,8);
$btc_bal = number_format($credit->btc,8);

if(empty($this->session->tempdata('btc'))){

 $this->session->set_tempdata('btc', amount_to_fiat('btc',$btc_bal,'usd'), 300);

}

if(empty($this->session->tempdata('doge'))){

 $this->session->set_tempdata('doge', amount_to_fiat('doge',$doge_bal,'usd'), 300);
 
}
if(empty($this->session->tempdata('btc_eur'))){

 $this->session->set_tempdata('btc_eur', amount_to_fiat('btc',$btc_bal,'eur'), 300);
 
}
if(empty($this->session->tempdata('doge_eur'))){

 $this->session->set_tempdata('doge_eur', amount_to_fiat('doge',$doge_bal,'eur'), 300);
 
}
if(empty($this->session->tempdata('btc_cny'))){

 $this->session->set_tempdata('btc_cny', amount_to_fiat2(1,$btc_bal,'cny'), 300);
 
}
if(empty($this->session->tempdata('doge_cny'))){

 $this->session->set_tempdata('doge_cny', amount_to_fiat2(74,$doge_bal,'cny'), 300);
 
}



$btc = $this->session->tempdata('btc');
$doge = $this->session->tempdata('doge');
$btc_eur = $this->session->tempdata('btc_eur');
$doge_eur = $this->session->tempdata('doge_eur');
$btc_cny = $this->session->tempdata('btc_cny');
$doge_cny = $this->session->tempdata('doge_cny');



echo '<div class="row" aling="left"><div class="col-sm-6 ml-3" ><b>(BTC) <i class="fas fa-dollar-sign"></i> </b>'.$btc.' <b><i class="fas fa-euro-sign"></i> </b>'.$btc_eur.' <b><i class="fas fa-yen-sign"></i> </b>'.$btc_cny.'</div>

<div class="col-sm" ><b>(DOGE) <i class="fas fa-dollar-sign"></i> </b>'.$doge.' <b><i class="fas fa-euro-sign"></i> </b>'.$doge_eur.' <b><i class="fas fa-yen-sign"></i> </b> '.$doge_cny.'</div></div>';

}

function balances(){

$script = "<script>
  
$('#fiat').click(function(){

    $.ajax({

      url: '".base_url()."dashboard/convert_balance',
      type: 'POST',
      data: { },

      success: function(data) {

            $('#to_fiat').html(data);
         
            }       
        
      });

});

</script>";

 $this->load->view('admin/addr/head');


echo ' Balances : 
<b>BTC</b><span style="margin-right: 8px;" id="btc_bal">  '.
$this->data['btc_bal']. ' </span>

<b>Doge</b><span id="doge_bal">  '.$this->data['doge_bal']. '</span>

<b>Ltc</b><span id="doge_bal">  '.$this->data['ltc_bal']. '</span>

<b>Dgb</b><span id="doge_bal">  '.$this->data['dgb_bal']. '</span>


<span id="to_fiat"></span>'.$script.'<br>
<small><b> <a  style="margin-right:2%;"  href="'. base_url() .'deposit"> Deposit </a> <a style="margin-left:2%;" href="'. base_url() .'withdraw"> Withdraw</a></b></small>

';
}

}