<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Frontend_Controller {
 
 	function __construct() {
      parent::__construct(); 
           
   }

public function index($id=NULL, $slug=NULL) {

  $this->data['recent_news'] = $this->article_m->get_recent();
	//Fetch the article

if(isset($id)){
		//$this->article_m->set_published();
	$this->db->where('id',$id);
	$this->data['article'] = $this->db->get('articles')->row();
	$this->db->limit(6);
	$this->db->order_by('pubdate','desc');
	$this->data['articles'] = $this->article_m->get();
	

	//return 404 error if is not found
	count($this->data['article']) || show_404(uri_string());

	//redirect if slug was incorrect
	$requested_slug = $this->uri->segment(3);
	$set_slug = $this->data['article']->slug;

	if ($requested_slug != $set_slug) {
		
		redirect('article/' . $this->data['article']->id . '/' . $this->data['article']->slug, 'location', '301');
	}
	//load view
	    $this->data['mainview'] = 'templates/article';
	 add_meta_title($this->data['article']->title);
	
	} else {

	$this->db->order_by('pubdate','desc');	
	$this->data['articles'] = $this->article_m->get();
	    
    $this->data['mainview'] = 'templates/last_articles';
	}
       
      $this->data['pagetitle'] = 'Articles'; 
      $this->load->view('buster/main_body', $this->data);
}

}