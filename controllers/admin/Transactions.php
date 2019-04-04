<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
     $this->load->model('credit_m');
      
   }

  public function index(){
   
  
  $this->db->limit(25)->order_by('datetime','desc');
  $this->data['transactions'] = $this->db->get('transactions')->result();

//PAGINATION  

$perpage = 25;

    $count = $this->db->count_all_results('transactions');
    
    $this->data['total_pages'] = ceil($count / $perpage);

$page = 1;
$total_pages = $this->data['total_pages'];

       $left_pages = $page + 4;

    if($left_pages >= $total_pages){

      $left_pages = $total_pages;
    }

    if($page >= $total_pages){

      $page = $total_pages;
    }

$next_pages = $page + 5;

if($left_pages < 0) $left_pages = 1;

$this->data['left_pages'] = $left_pages;
$this->data['page'] = $page;
$this->data['id'] = 0;
$this->data['category'] = null;
$this->data['next_pages'] = $next_pages;

$this->data['subview'] = 'admin/transactions/index';
  $this->load->view('admin/_layout_main', $this->data);

}  

function full_table(){


 $perpage = 25;

$page = 1;

$start_from = ($page-1) * $perpage;

$id = $_GET['id'];
$coin = $_GET['coin'];
$category = $_GET['category'];

$order_by ='datetime';

//FIRST QUERY TRANSACTIONS
 if($id != 0 && !empty($id) && $id!=null){

  $this->db->where('id',$id);
}

else { $id = 0; }
 
 if(!empty($coin) && $coin != 'null'){

$order_by = $coin;

}
 
if(isset($category) && !empty($category) && $category != null){

$category = config_item('transactions')[$category];

$this->db->like('type',$category);

} else { $category = null; }

  $this->db->limit($perpage, $start_from)->order_by($order_by,'desc');
  $this->data['transactions'] = $this->db->get('transactions')->result();

// SECOND QUERY PAGES-


 if($id != 0 && !empty($id) && $id!=null){

  $this->db->where('id',$id);
}


if(isset($category) && !empty($category) && $category != null){

$category = config_item('transactions')[$category];

$this->db->like('type',$category);

} 
    //TOTAL PAGES
     $count =  $this->db->count_all_results('transactions');
    
    $total_pages = ceil($count / $perpage);
   
    $this->data['total_pages'] = ceil($count / $perpage);


       $left_pages = $page + 4;

    if($left_pages >= $total_pages){

      $left_pages = $total_pages;
    }

    if($page >= $total_pages){

      $page = $total_pages;
    }

$next_pages = $page + 5;

if($left_pages < 0) $left_pages = 1;

$this->data['left_pages'] = $left_pages;
$this->data['page'] = $page;
$this->data['next_pages'] = $next_pages;
$this->data['id'] = $id;
$this->data['category'] = $category;

$this->load->view('admin/transactions/pagination',$this->data);

}


function table(){

 $perpage = 25;

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$start_from = ($page-1) * $perpage;

$id = $_GET['id'];

 if($id != 0 && !empty($id) && $id!=null){

  $this->db->where('id',$id);
}

else { $id = 0; }


$category = $_GET['category'];

 
if(isset($category) && !empty($category) && $category != null){

$category = config_item('transactions')[$category];

$this->db->like('type',$category);

}

  $this->db->limit($perpage, $start_from)->order_by('datetime','desc');
  $this->data['transactions'] = $this->db->get('transactions')->result();


echo $this->load->view('admin/tables/transactions',$this->data);

}

function pages(){

   $perpage = 25;

$category = $_GET['category'];
$id = $_GET['id'];

 if($id != 0 && !empty($id) && $id!=null){

  $this->db->where('id',$id);
}

else { $id = 0; }


if(isset($category) && !empty($category)){

$category = config_item('transactions')[$category];

$this->db->like('type',$category);

}

    //TOTAL PAGES
     $count = $this->db->count_all_results('transactions');
    
    $total_pages = ceil($count / $perpage);

$page = $_GET['page'];
 
if(isset($page)) { $page  = ($page > 0) ? $page : 1; } else { $page=1; };  

   $left_pages = $page + 4;

    if($left_pages >= $total_pages){

      $left_pages = $total_pages;
    }

    if($page >= $total_pages){

      $page = $total_pages;
    }

$next_pages = $page + 5;

if($left_pages < 0) $left_pages = 1;


echo new_button('<b>- 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.($next_pages - 10).'"');

echo '<div class="btn-group mr-2 ml-2" role="group" aria-label="First group">';

    for($x=$page; $x<= $left_pages; $x++) {
 

  echo new_button($x,'','light','type="button" name="'.$category.'" onclick="paginator(this.value,'.$id.',this.name)" value="'.$x.'"');

  }  

  echo '</div>';

echo new_button('<b>+ 5</b>','','light','type="button" onclick="next_page(this.value)" value="'.$next_pages.'"');

}


  
}