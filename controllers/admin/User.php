<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {
 
 	function __construct() {
      parent::__construct(); 
     
      
   }

public function index(){
	// fecht all users

//Set pagination
       $perpage = 50;

	$users = $this->user_m->get();
$this->data['total_users']  = count($users);
	$this->data['total_pages'] = ceil(count($users) / $perpage);


$today = strtotime('yesterday');
$yesterday = strtotime('-2 day');
$last_week = strtotime('-7 day');
$last_month = strtotime('-30 day');

$today_resgistered = $this->db->where('datetime >',$today)->get('members')->result();
$yesterday_resgistered = $this->db->where('datetime >',$yesterday)->where('datetime <',strtotime('today'))->get('members')->result();
$weekly_resgistered = $this->db->where('datetime >',$last_week)->get('members')->result();
$monthly_resgistered = $this->db->where('datetime >',$last_month)->get('members')->result();

$this->data['today_users'] = count($today_resgistered);
$this->data['yesterday_users'] = count($yesterday_resgistered);
$this->data['weekly_users'] = count($weekly_resgistered);
$this->data['monthly_users'] = count($monthly_resgistered);



    $this->db->limit($perpage, 0);
	$this->data['users'] = $this->user_m->get();
	// Load view
	$this->data['subview'] = 'admin/user/index';
	$this->load->view('admin/_layout_main', $this->data);
}

function paginator(){

$perpage = 50;
  
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

   $start_from = ($page-1) * $perpage;
    
    $this->db->limit($perpage, $start_from);
  	$users = $this->user_m->get();

  echo '<table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
     <tbody>';

     if(count($users)){

     	foreach($users as $user){

     		echo '<tr>
     		<td>'.anchor("admin/user/edit/" . $user->id, $user->name).'</td>
     		<td>'.btn_edit("admin/user/edit/" . $user->id).'</td>
     		<td>'.btn_delete("admin/user/delete/" . $user->id).'</td></tr>';
     	} 

     	
     
     } else { echo '<tr>
        <td colspan="3">We could not find any users.</td>
      </tr>'; }


       echo '</tbody>
  </table>
</section>';

}

public function edit($id = NULL){

// Fecht a user or add new
if ($id) {
	$this->data['user']  =  $this->user_m->get($id);
	count($this->data['user']) || $this->data['errors'][]= 'User could not be found';
	

$this->data['credit'] = $this->db->where('id',$id)->get('credit')->row();
  }

else {
	$this->data['user']  =  $this->user_m->get_new();
}
//Set up the form
$rules = $this->user_m->_rules_admin;
$id || $rules['password'] .= '|required';
$this->form_validation->set_rules($rules);

//Process the from
if ($this->form_validation->run() == TRUE) {
	
$data = $this->user_m->array_from_post(array('name', 'email', 'password'));
$data['password'] = hash('sha512', $data['password'] . config_item('encryption_key'));
$this->user_m->save($data, $id);
redirect('admin/user');

}
//load view
$this->data['subview'] = 'admin/user/edit';
$this->load->view('admin/_layout_main', $this->data);

}

public function delete($id){

$this->user_m->delete($id);
redirect('admin/user');

}

public function login() {


$dashboard = 'admin/dashboard';
//rediect user if already log in
	$this->user_m->loggedin() == FALSE || redirect($dashboard);
// Set up form
$rules = $this->user_m->_rules;
$this->form_validation->set_rules($rules);

//Process the from
if ($this->form_validation->run() == TRUE) {
	
if($this->user_m->login() == TRUE){
	redirect($dashboard);
}
else { 	

$this->session->set_flashdata('error', 'That user/password combination does not exist');
redirect('admin/user/login', 'refresh');

}

}
$this->data['subview'] = 'admin/user/login';
  $this->load->view('admin/_layout_modal', $this->data);

}

public function logout() {

	$this->user_m->logout();
	redirect('admin/user/login');
}

public function _unique_email($str) {
// Do NOT  validate if email exist
	//UNLESS its the email for the current users
	$id = $this->uri->segment(4);
	$this->db->where('email', $this->input->post('email'));
	!$id || $this->db->where('id !=', $id);
	$user = $this->user_m->get();

	if (count($user)) {
		$this->form_validation->set_message('_unique_email', '%s should be unique');
		return FALSE;
	}

	return TRUE;
}

public function _oldpassword_check($password){
  
   $password = $this->input->post('password');
    $old_password = $this->input->post('password_confirm');
   if($password != $old_password)
   {
      $this->form_validation->set_message('_oldpassword_check', 'Old password not match');
      return FALSE;
   } 
   return TRUE;
}

}
