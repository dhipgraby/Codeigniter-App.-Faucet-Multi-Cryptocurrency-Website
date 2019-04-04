<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends Admin_Controller {


 	function __construct() {
      parent::__construct(); 

}

  public function index(){
  	$this->load->library('migration');
  	    if ($this->migration->version(13) === FALSE)
                {
                        show_error($this->migration->error_string());
                }
        else {
        	echo 'Migration Works!';
        }
  }
}
