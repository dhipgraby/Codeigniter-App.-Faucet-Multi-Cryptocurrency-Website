<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     $this->load->model('article_m');
      
   }

public function index(){	
	// fecht all articles
		$this->data['articles'] = $this->article_m->get(NULL,FALSE,'news');
		// Load view
		$this->data['subview'] = 'admin/news/index';
		$this->load->view('admin/_layout_main', $this->data);
}

	
public function edit($id = NULL){

// Fecht a article or ad new
		if ($id) {
			$this->data['article']  =  $this->article_m->get($id,FALSE,'news');

			count($this->data['article']) || $this->data['errors'][]= 'article could not be found';
			}

		else {
			$this->data['article']  =  $this->article_m->get_new();
		}
	
		//Set up the form
		$rules = $this->article_m->_rules;
		$this->form_validation->set_rules($rules);

		//Process the from
		if ($this->form_validation->run() == TRUE) {
			
		$data = $this->article_m->array_from_post(array('title', 'slug','image','video', 'body', 'pubdate'));
		$this->article_m->save($data, $id,'news');
		redirect('admin/news');

		}
		//load view
		$this->data['subview'] = 'admin/news/edit';
	   	$this->load->view('admin/_layout_main', $this->data);

}

public function delete($id){

$this->article_m->delete($id,"news");
redirect('admin/news');

}


}

