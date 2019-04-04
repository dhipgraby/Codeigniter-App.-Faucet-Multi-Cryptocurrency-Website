<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     $this->load->model('article_m');
      
   }

public function index(){	
	// fecht all faqs

                $this->db->group_by('topic');
		$faqs = $this->article_m->getof();
		
       $this->data['topics'] = $faqs;
		$this->data['subview'] = 'admin/faq/index';
		$this->load->view('admin/_layout_main', $this->data);
}

public function topic($topic){


if(empty($topic)){

redirect('admin/faqs');

}

$this->db->where('topic',$topic);
$this->db->order_by('id','ASC');
$this->data['articles'] = $this->db->get('faq')->result();



$this->data['topic'] = $topic;
$this->data['subview'] = 'admin/faq/topic';

  $this->load->view('admin/_layout_main', $this->data);
}


	
public function edit($id = NULL){

// Fecht a article or ad new
		if ($id) {
			$this->data['article']  =  $this->article_m->getof($id);

			count($this->data['article']) || $this->data['errors'][]= 'faq could not be found';
			}

		else {
			$this->data['article']  =  $this->article_m->get_new();
		}
	
		//Set up the form
		$rules = $this->article_m->_faq;
		$this->form_validation->set_rules($rules);

		//Process the from
		if ($this->form_validation->run() == TRUE) {
			
		$data = $this->article_m->array_from_post(array('title','body','topic','slug'));
		$this->article_m->saveof($data, $id);
		redirect('admin/faq');

		}
		//load view
		$this->data['subview'] = 'admin/faq/edit';
	   	$this->load->view('admin/_layout_main', $this->data);

}

public function delete($id){

$this->article_m->deleteof($id);
redirect('admin/faq');

}


}

