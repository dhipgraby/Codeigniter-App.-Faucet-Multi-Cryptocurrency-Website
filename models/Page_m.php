<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_m extends  MY_Model {

protected $_table_name = 'pages';
protected $_primary_filter = 'intval';
protected $_order_by = 'order';
public $_rules = array(

  		'parent_id' =>array(
			'field' => 'parent_id',
		    'label' => 'Parent',
		    'rules' =>'trim|intval'),      

		'title' =>array(
			'field' => 'title',
		    'label' => 'Title',
		    'rules' =>'trim|required|max_length[100]'),

	
		'slug' =>array(
			'field' => 'slug',
		    'label' => 'Slug',
		    'rules' =>'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'),



);

public function delete($id) {
	$this->delete_single($id);
	$this->db->set(array('parent_id' => 0));
	$this->db->where('parent_id', $id);
	$this->db->update($this->_table_name);
}

 public function delete_single($id){

   	$filter = $this->_primary_filter;
    $id = $filter($id);
    
    if (!$id) {
    	return FALSE;
    	    }

     $this->db->where($this->_primary_key, $id);
     $this->db->limit(1);
   	    $this->db->delete($this->_table_name);

   }

public function save_order($pages) {

if(count($pages)){

	foreach ($pages as $order => $page) {
	
		if ($page['item_id'] != '') {

			$data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $page['item_id']);
			$this->db->update($this->_table_name);
        
		}
	}
}

}

public function get_nested() {
   $this->db->order_by($this->_order_by, 'asc');
   $pages = $this->db->get('pages')->result_array();
   $array = array();

   foreach ($pages as $page) {
	   	if (!$page['parent_id']) {
	   		$array[$page['id']] = $page;
	   	}
	   	else {
	   		$array[$page['parent_id']]['children'][] = $page;
	   	}
   }
   return $array;
}

public function get_with_parents($id = NULL, $single = FALSE)  {
	//
	$this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
	$this->db->join('pages as p', 'pages.parent_id=p.id', 'left');
	return $this->get($id,$single);
}

public  function get_no_parents() {
	//Fetch pages without parents
	$this->db->select('id, title');
	$this->db->where('parent_id', 0);
	$pages = $this->get();

	//Return key => value pair array
	$array = array(0 => 'No parent');
if(count($pages)) {
      foreach($pages as $page){
            $array[$page->id] = $page->title;

     }
}
return $array;

}

public function get_archive_link() {

	$page = $this->get_by(array('template' => 'news'));
	return isset($page->slug) ? $page->slug : '';

}

public function get_new(){

	$page = new stdClass();
	$page->title = '';
	$page->slug = '';
	$page->parent_id = 0;

return $page;


}


}