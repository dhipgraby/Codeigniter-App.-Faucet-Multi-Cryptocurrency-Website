<?php

$config['site_name'] = 'Lotobitcoin';

//FAUCET REWARD

$config['faucet_reward'] = 0.0000001;

$config['btc_reward'] = 0.0000001;
$config['doge_reward'] = 0.25;
$config['dgb_reward'] = 0.1;
$config['ltc_reward'] = 0.00005;

//MIN DEPOSIT

$config['btc_mindep'] = 0.0001;
$config['doge_mindep'] = 100;
$config['dgb_mindep'] = 100;
$config['ltc_mindep'] = 0.001;


//WITHDRAW

$config['max_withdraw_btc'] = 0.1;
$config['max_withdraw_doge'] = 250000;

$config['max_withdraw_dgb'] = 10000;
$config['max_withdraw_ltc'] = 3;

$config['min_withdraw_btc'] = 0.005;
$config['min_withdraw_doge'] = 2500;

$config['min_withdraw_dgb'] = 1000;
$config['min_withdraw_ltc'] = 0.4;



$config['max_withdraw_advert'] = 0.1;
$config['min_withdraw_advert'] = 0.0002;

$config['max_withdraw_advertbal'] = 0.1;
$config['min_withdraw_advertbal'] = 0.00002;


//EMAIL CODE

$config['code_expiration'] = 180;
$config['time_for_claim'] = 1800;

//LOTTERY

$config['lottery_ticket'] = 0.00000010;

//FEES

$config['btc_fee'] = 0.0001;
$config['doge_fee'] = 60;
$config['ltc_fee'] = 0.001;
$config['dgb_fee'] = 0.1;

//TRANSACTIONS

$config['transactions'] = array(
	 'ticket' => 'ticket ',
	 'faucet' => 'faucet',
	 'ticket-' =>'ticket-',
     'ref-reward' => 'ref-reward',
     'dicegame' => 'dicegame',
     'withdraw' =>'withdraw',
     'deposit' => 'deposit',
     'genesis' => 'genesis',
      );