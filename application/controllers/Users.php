<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
        parent::__construct();
        $this->load->model('users_model','umodel');
       
    }

	public function index()
	{

		$this->login();
	}

	public function login()
	{

		if($this->check_token()){
		
			redirect('dashboard','refresh');

		}
		$data['logged_in'] = false;
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('sidenav', $data);
		$this->load->view('footer');
	}

	public function dashboard(){
		if(!$this->check_token()){
			redirect('login','refresh');
			//header('Location: login');die();
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$response = $this->umodel->get('tbl_announcements');
 		$data['page'] = 'Dashboard';
		$data['current_page'] = 'dashboard';
 		$data['content'] = createNewsFeed($response,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

		//print_r($nav);die();
	}

	public function manage_projects(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Projects';
 		$data['current_page'] = 'manage_projects';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$fields = array('name'=>array('type'=>'text','placeholder'=>'Name','label' => 'Project Name'),
 						'create_date'=>array('type'=>'text','placeholder'=>'Create Date','label' => 'Create Date'),
 						'id'=>array('type'=>'hidden','placeholder'=>'id','label' => ''));
 		$table_name= 'projects';
 		$response = $this->umodel->get('tbl_projects');

 		$data['content'] = createTable($fields,$table_name,$response,$data['current_page']);

		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

		//print_r($nav);die();
	}

	public function manage_users(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Users';
 		$data['current_page'] = 'manage_users';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$fields = array('name'=>array('type'=>'text','placeholder'=>'Name','label' => 'Name'),
 						'username'=>array('type'=>'text','placeholder'=>'Username','label' => 'Username'),
 						'password'=>array('type'=>'password','placeholder'=>'Password','label' => 'Password'),
 						'role'=>array('type'=>'select','placeholder'=>'Role','label' => 'User Role'),
 						'create_date'=>array('type'=>'text','placeholder'=>'Create Date','label' => 'Create Date'),
 						'id'=>array('type'=>'hidden','placeholder'=>'id','label' => ''));
 		$table_name= 'users';
 		$response = $this->umodel->get('tbl_users');

 		$data['content'] = createTable($fields,$table_name,$response,$data['current_page']);

		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');

	}

	public function manage_sponsors(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Sponsors';
 		$data['current_page'] = 'manage_sponsors';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$fields = array('name'=>array('type'=>'text','placeholder'=>'Name','label' => 'Sponsor Name'),
 						'create_date'=>array('type'=>'text','placeholder'=>'Create Date','label' => 'Create Date'),
 						'id'=>array('type'=>'hidden','placeholder'=>'id','label' => ''));
 		$table_name= 'sponsors';
 		$response = $this->umodel->get('tbl_sponsors');

 		$data['content'] = createTable($fields,$table_name,$response,$data['current_page']);

		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}

	public function manage_announcements(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Announcements';
 		$data['current_page'] = 'manage_announcements';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$fields = array('title'=>array('type'=>'text','placeholder'=>'Title','label' => 'Title'),
 						'description'=>array('type'=>'textarea','placeholder'=>'Description','label' => 'Description'),
 						'create_date'=>array('type'=>'text','placeholder'=>'Create Date','label' => 'Create Date'),
 						'update_date'=>array('type'=>'text','placeholder'=>'Update Date','label' => 'Update Date'),
 						'id'=>array('type'=>'hidden','placeholder'=>'id','label' => ''));
 		$table_name= 'announcements';
 		$response = $this->umodel->get('tbl_announcements');

 		$data['content'] = createTable($fields,$table_name,$response,$data['current_page']);

		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');

	}

	public function manage_projstruct(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Manage Projects';
 		$data['current_page'] = 'manage_projstruct';
 		$response = $this->umodel->get_project_structure();
 		$empty_projects = $this->umodel->get_empty_projects();
 		$get_users = json_encode($this->umodel->get('tbl_users'));
 		$table_name= 'manage';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$fields = array('project_name'=>array('type'=>'text','placeholder'=>'Project Name','label' => 'Project Name'),
 						'users'=>array('type'=>'hidden','placeholder'=>'Project Members','label' => 'Assigned Personnel'),
 						'project_id'=>array('type'=>'hidden','placeholder'=>'Project Name','label' => ''),
 						'create_date'=>array('type'=>'text','placeholder'=>'Create Date','label' => 'Create Date'),
 						'manage_id'=>array('type'=>'hidden','placeholder'=>'id','label' => ''));
// echo "<pre>",print_r($empty_projects),"</pre>";die();
 	 		// $table_name= 'manage';
 		// $response = $this->umodel->manage_projects('tbl_manage');

 		 $data['content'] = manageTable($fields,$table_name,$response,$get_users,$empty_projects,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}

	public function add_budget(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Line Budget';
 		$data['current_page'] = 'add_budget';
 		$response = $this->umodel->get_project_leader();
 		//echo "<pre>",print_r($response),"</pre>";die();
 		//$leaders = $this->umodel->get_where('tbl_users',array('role'=>'2'));
 		$sponsors = $this->umodel->get('tbl_sponsors');
 		$line_items = $this->umodel->get('tbl_line_items');


 		$grants = $this->umodel->get('tbl_grants');
 		$f_grants = array();
 		foreach($grants as $k=>$v){
 			$f_grants[$v->sponsor_id][$v->id] = $v->name ;
 		}
 		$table_name= 'manage';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		

 		$data['content'] = add_budget_form($response,$sponsors,$line_items,$f_grants,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}

	public function deduct_budget(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}
 		$user_id = ucwords($this->session->userdata('user_id'));

		$data['logged_in'] = true;

 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Deduct Budget Form';
 		$data['current_page'] = 'deduct_budget';
 		$response = $this->umodel->get_available_budget(0);
        $parse = json_decode($response,true);
 		$table_name= 'manage';
 		$grants = $this->umodel->get('tbl_grants');
 		$f_grants = array();
 		foreach($grants as $k=>$v){
 			$f_grants[$v->sponsor_id][$v->id] = $v->name ;
 		}
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$data['content'] = deduct_budget_form($parse['response'],$parse['projects'], $parse['sponsors'] , $parse['project_leader'],$parse['line_item_l'], $parse['line_item'],$f_grants,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');

	}

	public function proj_manage_add()
	{
		
		$tbl = $this->input->post('process');		
		$cur_page = $this->input->post('current_page');	
		$post = $this->input->post();	
		$batch = array();


		unset($post['process']);
		unset($post['current_page']);

		foreach($post['users'] as $k => $v){
			$batch[] = array('project_id' => $post['project_id'] , 'user_id' => $v , 'user_role' => $post['role'][$k]);
		}

		$id = $this->db->insert_batch('tbl_'.$tbl,$batch);

		// if($tbl == 'projects'){
		// 	$id = $this->db->insert_id();
		// 	$this->db->insert('tbl_manage',array('project_id'=>$id));
		// }
		redirect('users/'.$cur_page.'?s=1','refresh');

	}


	public function proj_manage_update()
	{
		
		$tbl = 'manage';		
		$cur_page = $this->input->post('current_page');	
		$post = $this->input->post();	
		$batch = array();

		unset($post['process']);
		unset($post['current_page']);
	
        if(!empty($post['users'])){

			foreach($post['users'] as $k => $v){
				$batch[] = array('project_id' => $post['project_id'] , 'user_id' => $v , 'user_role' => $post['role'][$k]);
			}

			$this->db->insert_batch('tbl_'.$tbl,$batch);
		}
			redirect('users/'.$cur_page.'?s=2','refresh');
		

	}





	public function check_user()
	{
		
		$response = $this->umodel->check_user();

		if($response){
			
			header('Location: dashboard');
		}else{
			redirect('login?e=1','refresh');
		}
	}

	public function add_record()
	{
		
		$tbl = $this->input->post('process');		
		$cur_page = $this->input->post('current_page');	
		$post = $this->input->post();	

		if(isset($post['password'])){
			$post['password'] = sha1($post['password']);
		}
		unset($post['process']);
		unset($post['current_page']);

		$id = $this->db->insert('tbl_'.$tbl,$post);

		// if($tbl == 'projects'){
		// 	$id = $this->db->insert_id();
		// 	$this->db->insert('tbl_manage',array('project_id'=>$id));
		// }
		redirect('users/'.$cur_page.'?s=1','refresh');

	}



	public function remove()
	{	
		$tbl = $this->input->post('process');		
		$cur_page = $this->input->post('current_page');	
		$id = $this->input->post('ref');	
		$this->db->delete('tbl_'.$tbl , array('id' => $id)); 
		redirect('users/'.$cur_page.'?s=3','refresh');

		echo true;

	}

	public function remove_personnel()
	{	
		$tbl = $this->input->post('process');		
		$cur_page = $this->input->post('current_page');	
		$id = $this->input->post('ref');	
		$user_id = $this->input->post('user_id');	

		$this->db->delete('tbl_'.$tbl , array('project_id' => $id,'user_id' => $user_id)); 

		echo true;

	}

	public function update_record()
	{
		$tbl = $this->input->post('process');		
		$cur_page = $this->input->post('current_page');	
		$id = $this->input->post('ref');	
		$post = $this->input->post();	
		
		unset($post['process']);
		unset($post['current_page']);
		unset($post['ref']);

        if($cur_page == 'manage_announcements'){
        	$post['update_date'] = date('Y-m-d');

        }
		$response = $this->umodel->update($post,$id,$tbl);

		if($response){
			redirect('users/'.$cur_page.'?s=2','refresh');
		}

	}

	public function add_budget_db(){
		$post = $this->input->post();	
		// $batch = array();
		$post['type'] = 'Debit';
		unset($post['submit']);

		$id = $this->db->insert('tbl_trans',$post);

		redirect('add_budget?s=1','refresh');
	}


	public function request_budget(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}
 		$user_id = ucwords($this->session->userdata('user_id'));
//print_r($this->session->userdata());die();
 	// /	echo $user_id;die();

		$data['logged_in'] = true;

 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Request Budget Form';
 		$data['current_page'] = 'request_budget';
 		$response = $this->umodel->get_available_budget($user_id);
        $parse = json_decode($response,true);
//echo "<pre>",print_r($parse),"</pre>";die();
 		$table_name= 'manage';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		
 		$data['content'] = request_budget_form2($parse['response'],$parse['projects'], $parse['sponsors'],$parse['line_item'],$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}

	// public function request_budget_db(){
	// 	$post = $this->input->post();	
	// 	extract($post);
	// 	$project_leader = $this->session->userdata('user_id');
	// 	// $batch = array();
	// 	$debit_check =  $this->umodel->get_debit($project_leader,$b_project_id, $b_project_sponsors, $b_line_item);
	// 	$credit_check =  $this->umodel->get_credit($project_leader,$b_project_id, $b_project_sponsors, $b_line_item);

	// 	$debit = $debit_check[0]->debit;
	// 	$credit = (empty($credit_check[0]->credit)) ? 0 : $credit_check[0]->credit;

	// 	if(($debit - $credit) >= $cost){

	// 		$arr_post = array("project_id" => $b_project_id , "project_leader" => $project_leader,
	// 						 "sponsor_id"=> $b_project_sponsors,"line_item"=> $b_line_item,
	// 						 "cost" => $cost,"remarks"=>$remarks);
	// 		$id = $this->db->insert('tbl_budget_request',$arr_post);
	// 	    redirect('users/request_budget?s=1','refresh');

	// 	}else{
	// 		echo "Requested budget exceeded available budget.";
	// 	}
	// }

	public function request_budget_db(){
		$post = $this->input->post();	
		extract($post);
		$project_leader = $this->session->userdata('user_id');
		$forms = array();
		// $batch = array();

		foreach($post['data'] as $kf=>$vf){
			foreach($vf as $k=>$v){
				// echo $k;

				$forms[$kf][$v['name']] = $v['value'];
			     // echo "<pre>",print_r($v),"</pre>";die();

			}
		}

			// echo "<pre>",print_r($forms),"</pre>";die();
		foreach($forms as $k => $v){
			$debit_check =  $this->umodel->get_debit($project_leader,$v['project_id'], $v['project_sponsor'], $v['line_item']);
			$credit_check =  $this->umodel->get_credit($project_leader,$v['project_id'], $v['project_sponsor'], $v['line_item']);

			$debit = $debit_check[0]->debit;


			$credit = (empty($credit_check[0]->credit)) ? 0 : $credit_check[0]->credit;

			if(($debit - $credit) >= $cost){

				$arr_post = array("project_id" => $v['project_id'] , "project_leader" => $project_leader,
								 "sponsor_id"=> $v['project_sponsor'],"line_item"=> $v['line_item'],
								 "cost" => $v['cost_r'],"remarks"=>$v['remarks']);
				// $id = $this->db->insert('tbl_budget_request',$arr_post);
			 //    redirect('users/request_budget?s=1','refresh');

			}else{
				$arr_post = array("project_id" => $v['project_id'] , "project_leader" => $project_leader,
								 "sponsor_id"=> $v['project_sponsor'],"line_item"=> $v['line_item'],
								 "cost" => $v['cost_r'],"remarks"=>$v['remarks'],"is_granted"=>'3');			
			}

			$id = $this->db->insert('tbl_budget_request',$arr_post);
		}

		echo true;
		
	}

	public function deduct_budget_db(){
		$post = $this->input->post();	
		extract($post);
		// $batch = array();
		$debit_check =  $this->umodel->get_debit($b_project_leader,$b_project_id, $b_project_sponsors, $b_line_item);
		$credit_check =  $this->umodel->get_credit($b_project_leader,$b_project_id, $b_project_sponsors, $b_line_item);

		$debit = $debit_check[0]->debit;
		$credit = (empty($credit_check[0]->credit)) ? 0 : $credit_check[0]->credit;

		if(($debit - $credit) >= $cost){

			$arr_post = array("project_id" => $b_project_id , "project_leader" => $b_project_leader,
							 "sponsor_id"=> $b_project_sponsors,"line_item"=> $b_line_item,
							 "cost" => $cost, "type" => "Credit","remarks"=>$remarks);
			$id = $this->db->insert('tbl_trans',$arr_post);
		    redirect('users/deduct_budget?s=1','refresh');

		}else{
			echo "Requested budget exceeded available budget.";
		}
	}



	public function check_token()
	{
		$user = $this->session->userdata('name');

		if(!empty($user)){
			return true;
		}else{
			return false;
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->login();
	}

	public function side_nav(){
		$role = $this->session->userdata('user_role');
		$nav = array();

		if($role == '1'){
			$nav = array('Dashboard' => array("icon"=> "fa fa-tachometer" , "url" => "dashboard") ,
						 'Maintenance' => array('Project' => array("icon"=> "fa fa-book" , "url" => "users/manage_projects") ,
						 'Users'  => array("icon"=> "fa fa-users" , "url" => "users/manage_users") ,
						 'Sponsors'  => array("icon"=> "fa fa-industry" , "url" => "users/manage_sponsors"),
						 'Announcements' => array("icon" => "fa fa-microphone","url"=>"users/manage_announcements"),
						 'Line Items' => array("icon" => "fa fa-tags","url"=>"manage/line_items") ),
						 'Grants'  => array("icon"=> "fa fa-user-plus" , "url" => "users/manage_grants"),
					  	 'Manage Projects'  => array("icon"=> "fa fa-book" , "url" => "users/manage_projstruct"),
						 'Budget Requests'  => array("icon"=> "fa fa-exchange" , "url" => "users/manage_requests") ,
						 'Line Budget'  => array( "Add Budget" => array("icon"=> "fa fa-plus" , "url" => "add_budget"),
						 						  "Reduce Budget" => array ("icon" => "fa fa-minus", "url"=> "deduct_budget"),),
						 'Transaction Logs'  => array("icon"=> "fa fa-money" , "url" => "users/all_trans_logs"),
						 'Account Settings'  => array("icon"=> "fa fa-gear" , "url" => "users/settings"));
		}else if($role == '2'){
			$nav = array('Dashboard' => array("icon"=> "fa fa-tachometer" , "url" => "dashboard") ,
						 'Projects'  => array("icon"=> "fa fa-th-list" , "url" => "users/view_projects") ,
						 'Request Funds'  => array("icon"=> "fa fa-mail-forward" , "url" => "users/request_budget"), 
						 'Requests'  => array( 'History' => array("icon"=> "fa fa-history" , "url" => "users/budget_history" ),
						 								 	'Available Budget' => array("icon"=> "fa fa-dollar" , "url" => "users/available_budget" )),
						 'Transaction Logs'  => array("icon"=> "fa fa-money" , "url" => "users/trans_logs"),
						  'Account Settings'  => array("icon"=> "fa fa-gear" , "url" => "users/settings")

						 	);
		}else if($role == '3'){
			$nav = array('Dashboard' => array("icon"=> "fa fa-tachometer" , "url" => "dashboard") ,
						 'Project'  => array("icon"=> "fa fa-book" , "url" => "users/view_projects") ,
					                  'Account Settings'  => array("icon"=> "fa fa-gear" , "url" => "users/settings"));
		}

		return $nav;
	}

	public function manage_requests(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Manage Requests';
 		$data['current_page'] = 'manage_requests';
 		$response = $this->umodel->get_budget_requests();
 		$table_name= 'manage_requests';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;

 		$data['content'] = manageRequestsTable($response,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}


 	public function budget_approved(){
 		$post = $this->input->post();	
 		extract($post);

 		$details = $this->umodel->get_where('tbl_budget_request',array('id'=>$id));
 		$success = true;

 		$debit_check =  $this->umodel->get_debit($details[0]->project_leader,$details[0]->project_id, $details[0]->sponsor_id, $details[0]->line_item);
		$credit_check =  $this->umodel->get_credit($details[0]->project_leader,$details[0]->project_id, $details[0]->sponsor_id, $details[0]->line_item);

		$debit = $debit_check[0]->debit;


		$credit = (empty($credit_check[0]->credit)) ? 0 : $credit_check[0]->credit;

		if(($debit - $credit) < $details[0]->cost){
			$is_granted = '3';
		}

 		$update_trans = $this->umodel->update(array('is_granted'=>$is_granted),$id,'budget_request');

		if($is_granted != '3'){
			$response = $this->umodel->add_credit_trans($id);
		}else{
			$success = false;
		}


 		echo $success;
 	}


 	public function budget_rejected(){
 		$post = $this->input->post();	
 		extract($post);

 		$update_trans = $this->umodel->update(array('is_granted'=>$is_granted),$id,'budget_request');

 		echo true;
 	}

 	public function view_projects(){
		if(!$this->check_token()){
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Manage Requests';
 		$data['current_page'] = 'manage_requests';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$projects = $this->umodel->get_projects();
 		$data['content'] = manageProjectsTable($projects,$data['current_page']);
 		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');

	//	echo "<pre>",print_r($projects),"</pre>";die();
 	//	echo true;
 	}


 	public function check_username()
	{
		$data = $this->input->post();
		extract($data);
		$id = (isset($id))  ? $id :null;
		
		$response = $this->umodel->check_username($username,$id);

		echo count($response);
	}

	public function budget_history(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$user_id = ucwords($this->session->userdata('user_id'));

 		$data['page'] = 'Budget Requests History';
 		$data['current_page'] = 'budget_history';
 		$response = $this->umodel->get_budget_history($user_id);
 		//echo "<pre>",print_r($response),"</pre>";die();
 		$table_name= 'manage_requests';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;

 		$data['content'] = budgetHistoryTable($response,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}


	public function trans_logs(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$user_id = ucwords($this->session->userdata('user_id'));

 		$data['page'] = 'Transaction Logs';
 		$data['current_page'] = 'trans_logs';
 		$response = $this->umodel->get_trans_logs($user_id);
 		//echo "<pre>",print_r($response),"</pre>";die();
 		$table_name= 'manage_requests';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;

 		$data['content'] = transactionLogsTable($response,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}

	public function available_budget(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$user_id = ucwords($this->session->userdata('user_id'));

 		$data['page'] = 'Available Budget';
 		$data['current_page'] = 'available_budget';
 		$response = $this->umodel->get_available_budget($user_id);
 		$arr = json_decode($response,1);

 		// echo "<pre>",print_r(($arr)),"</pre>";die();
 		// $table_name= 'manage_requests';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;

 		$data['content'] = availableBudgetTable($arr['avail_budget'],$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}

	public function settings(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}
 		$user_id = ucwords($this->session->userdata('user_id'));
//print_r($this->session->userdata());die();
 	// /	echo $user_id;die();

		$data['logged_in'] = true;

 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Settings';
 		$data['current_page'] = 'users/settings';
 		$response = $this->umodel->get_where('tbl_users', array('id'=>$user_id));
        // $parse = json_decode($response,true);
// echo "<pre>",print_r($response),"</pre>";die();
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		
 		$data['content'] = settings_form($response[0],$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}

	public function settings_db(){
		$post = $this->input->post();	
 		$user_id = ucwords($this->session->userdata('user_id'));
 		$tbl = 'users';
		$err = 0;
		$err_msg = '';
		$posts = array();
		foreach($post['form'] as $k=>$v){
			if($v['name'] != 'cur_page'){
				$posts[$v['name']] = $v['value'];
			}
			if(empty($v['value'])){
				$err++;
				$err_msg .= "Please fill in all fields. <br> ";
			}
		}
		extract($posts);
		if(sha1($current_pwd) != $pwd){
			$err++;
			$err_msg .= "Current password is incorrect. <br>";
		}

		if($new_pwd != $conf_pwd){
			$err++;
			$err_msg .= "	New password does not match.";
		}

				// echo"<pre>",print_r($posts),"</pre>";die();

		if($err == 0){
			$this->session->set_userdata('name',$name);
			$send = array("name"=>$name,"password"=> sha1($new_pwd)); 
			$this->umodel->update($send,$user_id,$tbl);
		}
		
		$arr = json_encode(array("err" => $err , "err_msg" => $err_msg));

		echo $arr;

		// $batch = array();
		// $post['type'] = 'Debit';
		// unset($post['submit']);

		// $id = $this->db->insert('tbl_trans',$post);

		// redirect('add_budget?s=1','refresh');
	}	

	public function upload_document(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

 		$user_id = ucwords($this->session->userdata('user_id'));
 		$id = $this->input->get('ref');

		$data['logged_in'] = true;

 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Upload Document Form';
 		$data['current_page'] = 'upload_document';
//echo "<pre>",print_r($parse),"</pre>";die();
 		$table_name= 'documents';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		
 		$data['content'] = upload_document_form($id,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}

	public function upload_document_db(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$budget_request_id = $this->input->post('budget_request_id');


		// echo base_url();

		// echo "<pre>",print_r($_FILES),"</pre>";die();
		if(!empty($budget_request_id)){
			foreach($_FILES['file']['name'] as $k => $v){

				if(!empty($v)){
					$post = array('budget_request_id'=> $budget_request_id , 'filename'=> $budget_request_id.'/'.$v);
	          	 	$id = $this->db->insert('tbl_documents',$post);
	          	 	// echo $_SERVER['DOCUMENT_ROOT'];die();
	          	 	$path = 'support_documents/'.$budget_request_id;
					if ( !is_dir($path)) {
					    mkdir($path);
					}

	          	   move_uploaded_file($_FILES['file']['tmp_name'][$k], $path.'/'.$v);

	            }

			}

	 		redirect('users/upload_document?s=1','refresh');
	 	}

	}

	public function manage_grants(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Grants';
 		$data['current_page'] = 'manage_grants';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$grants = $this->umodel->get('tbl_sponsors');
 		$f_grants = array();
 		foreach($grants as $k=>$v){
 			$f_grants[$v->id] = $v;
 		}

 		$fields = array('name'=>array('type'=>'text','placeholder'=>'Name','label' => 'Name'),
 						'sponsor_id'=>array('type'=>'select','placeholder'=>'Sponsor Name','label' => 'Sponsor Name','ref'=> json_encode($f_grants)),
 						'create_date'=>array('type'=>'text','placeholder'=>'Create Date','label' => 'Create Date'),
 						'id'=>array('type'=>'hidden','placeholder'=>'id','label' => ''));
 		$table_name= 'grants';
 		$response = $this->umodel->get('tbl_grants');



 		$data['content'] = createTable($fields,$table_name,$response,$data['current_page']);

		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');

	}

	public function all_trans_logs(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$user_id = ucwords($this->session->userdata('user_id'));

 		$data['page'] = 'Transaction Logs';
 		$data['current_page'] = 'all_trans_logs';
 		$response = $this->umodel->get_trans_logs();
 		//echo "<pre>",print_r($response),"</pre>";die();
 		$table_name= 'manage_requests';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;

 		$data['content'] = allTransactionLogsTable($response,$data['current_page']);
		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');
	

	}




	/**manage line items @jx 5/13**/

	public function manage_line_items(){
		if(!$this->check_token()){
			//header('Location: login');//die();
			redirect('login','refresh');
		}

		$data['logged_in'] = true;
 		$data['user'] = ucwords($this->session->userdata('name'));
 		$data['page'] = 'Line Items';
 		$data['current_page'] = 'manage_line_items';
 		$nav = $this->side_nav();
 		$data['nav'] = $nav;
 		$fields = array('line_item'=>array('type'=>'text','placeholder'=>'Name','label' => 'Line Item Name'),
 						'create_date'=>array('type'=>'text','placeholder'=>'Create Date','label' => 'Create Date'),
 						'id'=>array('type'=>'hidden','placeholder'=>'id','label' => ''));
 		$table_name= 'line_items';
 		$response = $this->umodel->get('tbl_line_items');

 		$data['content'] = createTable($fields,$table_name,$response,$data['current_page']);

		$this->load->view('header');
		$this->load->view('sidenav', $data);
		$this->load->view('body', $data);
		$this->load->view('footer');

	}

}
