<?php

function convert_to($currency,$to){
 $coin =  strtoupper($currency);
 $fiat = strtoupper($to);

$api = "https://min-api.cryptocompare.com/data/price?fsym=".$coin."&tsyms=".$fiat;


$json = json_decode(file_get_contents($api), true);

$price = $json[$fiat];

return $price;


}

function amount_to_fiat2($id,$amount,$to){

 $amount  = str_replace(',', '',$amount);

 $fiat = strtoupper($to);

$api = 'https://api.coinmarketcap.com/v2/ticker/'.$id.'/?convert='.$fiat;


$json = json_decode(file_get_contents($api), true);

$pricejson = $json['data']['quotes'][$fiat]['price'];	

$price = number_format($pricejson * $amount,3);


return $price;


}

function amount_to_fiat($currency,$amount,$to){

 $amount  = str_replace(',', '',$amount);

 $coin =  strtoupper($currency);
 $fiat = strtoupper($to);

$api = "https://min-api.cryptocompare.com/data/price?fsym=".$coin."&tsyms=".$fiat;


$json = json_decode(file_get_contents($api), true);

$pricejson = $json[$fiat];

$price = number_format($pricejson * $amount,3);


return $price;


}

function ticket_price($currency){

$ticket = config_item('lottery_ticket');

  $coin_btc = number_format(convert_to($currency,'btc'),8);

$ticket_price = $ticket / $coin_btc;

return $ticket_price;
}


function faucet_reward($currency){

$reward = config_item('faucet_reward');

  $coin_btc = number_format(convert_to($currency,'btc'),8);
  

$reward_price = $reward / $coin_btc;

return $reward_price;
}