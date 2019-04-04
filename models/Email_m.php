<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_m extends MY_Model {

protected $_table_name = 'credit';
protected $_table_col = 'security';
protected $_order_by = '';
protected $_timestamps = TRUE;



    function __construct() {
      parent::__construct(); 

   }


function _framework_email($email){

$this->db->where('email',$email);
$member = $this->db->get('members')->row();
$this->db->where('email',$email);
$code = $this->db->get('security')->row()->code;
$user = $member->name;

$this->load->library('email');

$config['mailtype'] = 'html';

$this->email->initialize($config);

$this->email->from('support@lotobitcoin.com', 'Lotobitcoin');
$this->email->to($email);

$this->email->subject('Lotocode 2fa verication code');

$this->data['code']= $code;
$this->data['user']= $user;
$template = $this->load->view('buster/2fa', $this->data,TRUE);
$this->email->message($template);
$send = $this->email->send();

if(!$send){

  $this->form_validation->set_message('send_mailcode', 'error, email can not be sent. try another or contact support');


return FALSE;

  } 

  return TRUE;


}



function _sendgrid_email($user_email,$template){


require('sendgrid/vendor/autoload.php');

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("support@lotobitcoin.com", "Lotobitcoin team");
$email->setSubject("Authentication Code");
$email->addTo($user_email, "kennow");

$email->addContent(
    "text/html", $template
);
$sendgrid = new \SendGrid('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');

    $response = $sendgrid->send($email);
    
    return ($response->statusCode() == 202) ? TRUE : FALSE;

}


}