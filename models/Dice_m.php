<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dice_m extends MY_Model {

protected $_table_name = 'dicegames';
protected $_table_col = 'credit';
protected $_order_by = '';
protected $_timestamps = TRUE;



  function __construct() {
      parent::__construct(); 

   }

function generate_game($id,$coin){

$credit = $this->getof($id);


$balance = round($credit->$coin,0);

if($coin == 'btc'){

  $balance = $credit->$coin * 100000000;
}


$array = array('btc','doge');

if(in_array($coin,$array)){

if($this->current_game($id,$coin,$balance) == FALSE){



if(count($credit)){


 //generate roll id
   $gameid = uniqid();
   //generate salt
   $salt = bin2hex(openssl_random_pseudo_bytes(32));
      //generate roll 
 

$data = array(

'datetime' => date('y-m-d h:i:s'),
'gid' => $gameid,
'u_id' => $id,
'open' => '0',
'ltgt' => '0',
'roll' => '0',
'vgbal' => $balance, 
'salt' => $salt,
'type' => $coin,
);
    
    $spacer = "+";
  $proof = sha1($salt.$spacer.$pick2);

$this->db->set($data);
$this->db->insert('dicegames');

return ($this->db->affected_rows() < 1) ? FALSE : TRUE;

}

return FALSE;

}

return FALSE;

}
//NO COIN. NO RESPONSE.. REMEMBER THIS IN ERROR CASE

}

function current_game($id,$coin,$balance){

$this->db->where('u_id', $id);
$this->db->where('open', '0');
$this->db->where('ltgt', '0');
$this->db->where('type',$coin);
$this->db->where('vgbal',$balance);
$query = $this->db->get('dicegames');
$rounds = $query->row();

if(count($rounds)){

return $rounds;

} else {

return  FALSE;

}

}

function check_game($gid,$bet,$u_target,$ltgt,$luckyNum,$coin){

if(!empty($luckyNum)){


$array = array('1','2');

if(in_array($ltgt,$array)){


  $data = array(
    
'datetime' => date('y-m-d h:i:s'),
'open' => 1,
'ltgt' => $ltgt,
'bet' => $bet,
'utarget' => $u_target,
'roll' => $luckyNum,
'type' => $coin,
  );


  $this->db->where('gid', $gid);
  $this->db->set($data);
    $this->db->update('dicegames');

    return ($this->db->affected_rows() < 1) ? FALSE : TRUE;

} 

}


}

function verify_game($gid,$bet,$netProfit,$uid = NULL){

$check_id = $this->session->id;

 $this->db->where('gid', $gid);
$this->db->where('profit', '0');
$game = $this->db->get('dicegames')->row();

if(count($game)){

$id = $game->gid;
$vgbal = intval($game->vgbal);
$roll = $game->roll;
$vgbet = $game->bet;
$coin = $game->type;

$credit = $this->getof($check_id);


if(count($credit)){

$reward = $netProfit;

if($coin == 'btc'){

$reward = $netProfit / 100000000;

}

elseif(round($credit->$coin,0) < $vgbet){

  return FALSE;

}

  
  if($vgbet > $vgbal || $vgbet != $bet || $bet < 1){

            return FALSE;

        } else {

          
$this->db->where('gid', $id);
$this->db->set('profit', $netProfit);
$this->db->update('dicegames');

if($this->db->affected_rows() > 0){

$this->_create_trans($check_id,$reward,$coin,'dicegame');

$this->db->where('id', $check_id);

$this->db->set($coin, $credit->$coin + $reward);
$this->db->update($this->_table_col);

return ($this->db->affected_rows() < 1) ? FALSE : TRUE;


}

         }


}

}

}

function table_result($id){

$str = '';

  $perpage = 10;

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$start_from = ($page-1) * $perpage;
$this->db->order_by('count', 'DESC');
$this->db->where('ltgt > 0');
$this->db->where('open', '1');
$this->db->where('u_id', $id);
$this->db->limit(10);
$this->db->limit($perpage, $start_from);
$game = $this->db->get('dicegames')->result();

$str .= '<table class="table table-responsive-lg" align="center">
<tr>
  
  <td>Time</td>
  <td>Target</td>
  <td>Bet</td>
  <td>Roll</td>
  <td>Profit</td>
    <td>Coin</td>

</tr> 

';

if(count($game)){



foreach ($game as $games){

$ltgt = ($games->ltgt == 1) ? '<i class="fas fa-angle-double-up"></i>' : '<i class="fas fa-angle-double-down"></i>';

$str .= '<tr><td>'.date('h:i:s', strtotime($games->datetime)).'</td>
  <td>'.$ltgt.$games->utarget.'</td>
  <td>'.$games->bet.'</td>
  <td>'.$games->roll.'</td>
  <td>'.$games->profit.'</td>
  <td>'.$games->type.'</td></tr>';

}

}

else {

  $str .= '<tr>
        <td colspan="3">No Roll.</td>
      </tr>';
}


$str .='</table>';

  echo $str;

}

}