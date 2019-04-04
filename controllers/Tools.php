<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends Frontend_Controller {
 
  function __construct() {
      parent::__construct(); 
 
   }

function converter(){


  $this->data['mainview'] = 'buster/tools/price';
$this->data['pagetitle'] = 'Lotobitcoin Converter';
  $this->load->view('buster/main_body',$this->data);
}



}