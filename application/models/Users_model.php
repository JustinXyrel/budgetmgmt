<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

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
    public function __construct()
    {
                // Call the CI_Model constructor
        parent::__construct();
    }

	public function check_user()
	{
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		//echo $password;die();
 		$result = $this->get_where('tbl_users', array('username' => $username,'password'=>$password));
 		$response = false;

 		if(count($result) > 0){
 			$this->logged_user($result[0]);
 			$response = true;
 		}

 		return $response;
		
	}

	public function logged_user($data){
		$this->session->set_userdata('user_id',$data->id);
		$this->session->set_userdata('user_role',$data->role);
		$this->session->set_userdata('user_name',$data->username);
		$this->session->set_userdata('name',$data->name);

	}


/***UNIVERSAL***/
	public function get_where($tbl=null,$arr=null){
		$query = $this->db->get_where($tbl, $arr);

		return $query->result();

	}


	public function get($tbl=null){
		if($tbl != 'tbl_users'){
		 $query = $this->db->get($tbl);
	    }else{
	      $query = $this->db->get_where($tbl, array('id<>'=>'1'));
	    }
		return $query->result();

	}

	public function get_project_structure(){
  		$this->db->select("tm.*,tu.name as given_name,tp.name as project_name,tr.role as role_name");
        $this->db->from('tbl_manage as tm');
        $this->db->join('tbl_users as tu', 'tm.user_id = tu.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tm.project_id = tp.id','LEFT');
        $this->db->join('tbl_roles as tr', 'tm.user_role = tr.id','LEFT');
        $this->db->order_by('tm.id asc');
        $query = $this->db->get();
        $response = $query->result();
        $arr = array();
        $prev = '';

        foreach($response as $k => $v){
        	if($v->project_id != $prev){
        		$arr[$v->project_id] = array('manage_id'=>$v->id,'project_name'=>$v->project_name, 'project_id'=>$v->project_id, 'create_date' => $v->create_date);
        		$arr[$v->project_id]['users'][] = array('user_id'=>$v->user_id,'name'=>$v->given_name,'user_role'=> $v->role_name); 
        	}else{
				$arr[$v->project_id]['users'][] =  array('user_id'=>$v->user_id,'name'=>$v->given_name,'user_role'=> $v->role_name);
        	}

			$prev = $v->project_id ;
        }

		return $arr;

	}

	public function get_empty_projects(){
		$this->db->select("tp.id,tp.name");
        $this->db->from('tbl_projects as tp');
    	$this->db->where('tp.id NOT IN (select project_id from tbl_manage)');
        $query = $this->db->get();
        $response = $query->result();
        $arr = array();
        $prev = '';

		return $response;
	}

	public function get_project_leader(){
  		$this->db->select("tm.*,tu.name as given_name,tp.name as project_name,tr.role as role_name");
        $this->db->from('tbl_manage as tm');
        $this->db->join('tbl_users as tu', 'tm.user_id = tu.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tm.project_id = tp.id','LEFT');
        $this->db->join('tbl_roles as tr', 'tm.user_role = tr.id','LEFT');
        $this->db->where('tm.user_role=','2');
        $this->db->order_by('tm.id asc');
        $query = $this->db->get();
        $response = $query->result();
        $arr = array();
        $prev = '';

        foreach($response as $k => $v){
        	if($v->project_id != $prev){
        		$arr[$v->project_id] = array('manage_id'=>$v->id,'project_name'=>$v->project_name, 'project_id'=>$v->project_id, 'create_date' => $v->create_date);
        		$arr[$v->project_id]['users'][] = array('user_id'=>$v->user_id,'name'=>$v->given_name,'user_role'=> $v->role_name); 
        	}else{
				$arr[$v->project_id]['users'][] =  array('user_id'=>$v->user_id,'name'=>$v->given_name,'user_role'=> $v->role_name);
        	}

			$prev = $v->project_id ;
        }

		return $arr;

	}

	public function get_available_budget($user_id){
  		$this->db->select("tt.*,ts.name as sponsor_name,tp.name as project_name, u.name as leader_name ,SUM(COALESCE(CASE WHEN type = 'Debit' THEN tt.cost END,0)) total_debits, SUM(COALESCE(CASE WHEN type = 'Credit' THEN tt.cost END,0)) total_credits ,  SUM(COALESCE(CASE WHEN type = 'Debit' THEN tt.cost END,0)) 
     - SUM(COALESCE(CASE WHEN type = 'Credit' THEN tt.cost END,0)) balance");
        $this->db->from('tbl_trans as tt');
        $this->db->join('tbl_sponsors as ts', 'tt.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tt.project_id = tp.id','LEFT');
        $this->db->join('tbl_users as u', 'tt.project_leader = u.id','LEFT');

        if($user_id != 0 ){
         $this->db->where('tt.project_leader=',$user_id);
        }
        $this->db->order_by('line_item asc');

        $this->db->group_by('tt.project_id, tt.line_item');
        $query = $this->db->get();
        $response = $query->result();

       //	 echo $this->db->last_query();die();
        $arr = array();
        $projects = array();
        $sponsors = array();
        $line_item = array();
        $line_item_l = array();
        $avail_budget = array();
        $project_leader = array();
        $prev = '';
// echo "<pre>",print_r($response),"</pre>";die();
        foreach($response as $k => $v){
        		$arr[$v->project_id][]= $v;
        		$projects[$v->project_id] = $v->project_name;    
        		$sponsors[$v->project_id][$v->sponsor_id] = $v->sponsor_name;   
                $project_leader[$v->project_id][$v->sponsor_id][$v->project_leader] = $v->leader_name;   
        		$line_item[$v->project_id][$v->sponsor_id][$v->line_item] = $v->balance;  
                $line_item_l[$v->project_id][$v->sponsor_id][$v->grant_id][$v->project_leader][$v->line_item] = $v->balance;  

                $avail_budget[] = $v; 

     
        }
// echo "<pre>",print_r($line_item_l),"</pre>";die();
		return json_encode(array("response" => $arr,"projects"=>$projects,"sponsors"=> $sponsors, "project_leader" => $project_leader,"line_item_l" => $line_item_l,"line_item" =>$line_item , "avail_budget" => $avail_budget)) ;

	}

	public function get_budget_requests($id=null){
  		$this->db->select("tbr.*,ts.name as sponsor_name,tp.name as project_name ,tu.name");
        $this->db->from('tbl_budget_request as tbr');
        $this->db->join('tbl_sponsors as ts', 'tbr.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tbr.project_id = tp.id','LEFT');
		$this->db->join('tbl_users as tu', 'tbr.project_leader = tu.id','LEFT');
		if(!empty($id)){
			$this->db->where('tbr.id',$id);	
		}
        $query = $this->db->get();
        $response = $query->result();

      
		return $response ;

	}

    public function get_budget_history($id=null){
        $this->db->select("tbr.*,ts.name as sponsor_name,tp.name as project_name ,tu.name");
        $this->db->from('tbl_budget_request as tbr');
        $this->db->join('tbl_sponsors as ts', 'tbr.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tbr.project_id = tp.id','LEFT');
        $this->db->join('tbl_users as tu', 'tbr.project_leader = tu.id','LEFT');
        if(!empty($id)){
            $this->db->where('tbr.project_leader',$id); 
        }
        $query = $this->db->get();
        $response = $query->result();

      
        return $response ;

    }

    public function  get_trans_logs($id=null){
        $this->db->select("tbr.*,tu.name as project_leader_name , tg.name as grant_name,ts.name as sponsor_name,tp.name as project_name ,tu.name");
        $this->db->from('tbl_trans as tbr');
        $this->db->join('tbl_sponsors as ts', 'tbr.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tbr.project_id = tp.id','LEFT');
        $this->db->join('tbl_grants as tg', 'tbr.grant_id = tg.id','LEFT');
        $this->db->join('tbl_users as tu', 'tbr.project_leader = tu.id','LEFT');
        if(!empty($id)){
            $this->db->where('tbr.project_leader',$id); 
        }
        $this->db->order_by('tbr.trans_date');
        $query = $this->db->get();
        $response = $query->result();

      
        return $response ;

    }

	public function update($data, $id , $table){
		$tbl = 'tbl_'.$table;
		$this->db->where('id', $id);
		$query  = $this->db->update($tbl, $data); 
		return $query;
	}

	public function add_credit_trans($id){
		$response = $this->get_budget_requests($id);
		$data = $response[0];
		$arr_post = array("project_id" => $data->project_id , "project_leader" => $data->project_leader,
						 "sponsor_id"=> $data->sponsor_id,"line_item"=> $data->line_item,
						 "type"=> "Credit",
						 "cost" => $data->cost);
		$id = $this->db->insert('tbl_trans',$arr_post);
	}

	public function get_debit($project_leader,$project_id,$project_sponsor,$line_item){
		$this->db->select("SUM(cost) as debit");
        $this->db->from('tbl_trans');
        $this->db->where('project_id=',$project_id);
        $this->db->where('project_leader=',$project_leader);
        $this->db->where('sponsor_id=',$project_sponsor);
        $this->db->where('line_item=',$line_item);
        $this->db->where('type=','Debit');

        $query = $this->db->get();
        $debit = $query->result();
//echo $this->db->last_query();die();
     	return $debit;

    //     echo "<pre>",print_r($query->result()),"</pre>";die();

	}

	public function get_credit($project_leader,$project_id,$project_sponsor,$line_item){
		$this->db->select("SUM(cost) as credit");
        $this->db->from('tbl_trans');
        $this->db->where('project_id=',$project_id);
        $this->db->where('project_leader=',$project_leader);
        $this->db->where('sponsor_id=',$project_sponsor);
        $this->db->where('line_item=',$line_item);
        $this->db->where('type=','Credit');

        $query = $this->db->get();
        $credit = $query->result();

     	return $credit;

	}

	public function get_projects(){
		$id = $this->session->userdata('user_id');
		$this->db->select("tp.name as project_name, tr.role as role_name");
        $this->db->from('tbl_manage as tm');
        $this->db->join('tbl_projects as tp', 'tm.project_id = tp.id ','LEFT');
        $this->db->join('tbl_roles as tr', 'tm.user_role = tr.id ','LEFT');
        $this->db->where('tm.user_id=',$id);
        $query = $this->db->get();
        $response = $query->result();
       
		return $response;

	}

	public function check_username($username=null,$id=null){
		$this->db->select("id");
        $this->db->from('tbl_users');
      	$this->db->where('username',$username);

        if(!empty($id)){
      	  $this->db->where('id<>',$id);
      	}

        $query = $this->db->get();
        $response = $query->result();
       
		return $response;

	}

 

}
