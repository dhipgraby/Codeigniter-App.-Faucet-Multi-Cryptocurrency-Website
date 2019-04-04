<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Buster_Controller {
 
 	function __construct() {
      parent::__construct(); 
 
      
   }

public function index() {

  $this->login_m->logout();
  redirect('main');
}  

}