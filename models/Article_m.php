<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article_m extends  MY_Model {

protected $_table_name = 'articles';
protected $_table_col = 'faq';
protected $_order_by = 'pubdate desc, id desc';
protected $_timestamps = TRUE;
public $_rules = array(

  		'pubdate' =>array(
			'field' => 'pubdate',
		    'label' => 'Publication date',
		    'rules' =>'trim|required|exact_length[10]|xss_clean'),      

		'title' =>array(
			'field' => 'title',
		    'label' => 'Title',
		    'rules' =>'trim|required|max_length[100]|xss_clean'),
		
		'slug' =>array(
			'field' => 'slug',
		    'label' => 'Slug',
		    'rules' =>'trim|required|max_length[100]|url_title|xss_clean'),

		'body' =>array(
			'field' => 'body',
		    'label' => 'Body',
		    'rules' =>'trim|required'),

);

public $_faq = array(

  	

		'title' =>array(
			'field' => 'title',
		    'label' => 'Title',
		    'rules' =>'trim|required|max_length[100]|xss_clean'),


		'body' =>array(
			'field' => 'body',
		    'label' => 'Body',
		    'rules' =>'trim|required'),

);




public function set_published(){

	$this->db->where('pubdate <=', date('Y-m-d'));
}

public function get_recent($limit = 3) {

	$limit = (int) $limit;
	$this->set_published();
	$this->db->limit($limit);
	return $this->get();
}

public function get_new(){

	$article = new stdClass();
	$article->title = '';
	$article->slug = '';
	$article->body = '';
	$article->pubdate = date('Y-m-d');
return $article;


}


}