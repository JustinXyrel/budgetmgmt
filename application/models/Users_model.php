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
  		$this->db->select("tt.*,ts.name as sponsor_name,tp.name as project_name, u.name as leader_name , l.line_item as line_desc , tg.name as grant_name ,SUM(COALESCE(CASE WHEN tt.type = 'Debit' AND tt.status='1' THEN tt.cost END,0)) total_debits, SUM(COALESCE(CASE WHEN tt.type = 'Credit' AND tt.status='1' THEN tt.cost END,0)) total_credits ,  SUM(COALESCE(CASE WHEN type = 'Debit' THEN tt.cost END,0)) 
     - SUM(COALESCE(CASE WHEN type = 'Credit' THEN tt.cost END,0)) balance");
        $this->db->from('tbl_trans as tt');
        $this->db->join('tbl_sponsors as ts', 'tt.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tt.project_id = tp.id','LEFT');
        $this->db->join('tbl_users as u', 'tt.project_leader = u.id','LEFT');
        $this->db->join('tbl_line_items as l', 'tt.line_item = l.id','LEFT');
        $this->db->join('tbl_manage as tm', 'tt.project_id = tm.project_id','LEFT');
        $this->db->join('tbl_grants as tg', 'tt.grant_id = tg.id','LEFT');

        if($user_id != 0 ){
         $this->db->where('tm.user_id=',$user_id);

        }

        $this->db->where('tt.status=','1');
        $this->db->order_by('line_item asc');

        $this->db->group_by('tt.project_id,tt.sponsor_id,tt.grant_id, tt.line_item');
        $query = $this->db->get();
        $response = $query->result();

       	 // echo $this->db->last_query();die();
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
        		$line_item[$v->project_id][$v->sponsor_id][$v->line_item.':'.$v->line_desc] = $v->balance;  
                $line_item_l[$v->project_id][$v->sponsor_id][$v->grant_id][$v->line_item.':'.$v->line_desc] = $v->balance;  

                $avail_budget[] = $v;
                // $t_avail_budget[$v->project_id] += isset($t_avail_budget[$v->project_id]) ? $t_avail_budget[$v->project_id] + $v->balance : $v->balance ;



     
        }
// echo "<pre>",print_r($line_item_l),"</pre>";die();
		return json_encode(array("response" => $arr,"projects"=>$projects,"sponsors"=> $sponsors, "project_leader" => $project_leader,"line_item_l" => $line_item_l,"line_item" =>$line_item , "avail_budget" => $avail_budget)) ;

	}

	public function get_budget_requests($id=null){
  		$this->db->select("tbr.*,ts.name as sponsor_name,tp.name as project_name ,tu.name,l.line_item as line_desc, g.name as grant_name");
        $this->db->from('tbl_budget_request as tbr');
        $this->db->join('tbl_sponsors as ts', 'tbr.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tbr.project_id = tp.id','LEFT');
		$this->db->join('tbl_users as tu', 'tbr.project_leader = tu.id','LEFT');
        $this->db->join('tbl_line_items as l', 'tbr.line_item = l.id','LEFT');
        $this->db->join('tbl_grants as g', 'tbr.grant_id = g.id','LEFT');

		if(!empty($id)){
			$this->db->where('tbr.id',$id);	
		}
        $query = $this->db->get();
        $response = $query->result();

      
		return $response ;

	}

    public function get_budget_history($id=null){
        $this->db->select("tbr.*,ts.name as sponsor_name,tp.name as project_name ,tu.name,l.line_item as line_desc, g.name as grant_name");
        $this->db->from('tbl_budget_request as tbr');
        $this->db->join('tbl_sponsors as ts', 'tbr.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tbr.project_id = tp.id','LEFT');
        $this->db->join('tbl_users as tu', 'tbr.project_leader = tu.id','LEFT');
        $this->db->join('tbl_line_items as l', 'tbr.line_item = l.id','LEFT');
        $this->db->join('tbl_grants as g', 'tbr.grant_id = g.id','LEFT');

        if(!empty($id)){
            $this->db->where('tbr.project_leader',$id); 
        }
        $query = $this->db->get();
        $response = $query->result();

      
        return $response ;

    }

    public function  get_trans_logs($id=null){
        $this->db->select("tbr.*,tu.name as project_leader_name , tg.name as grant_name,ts.name as sponsor_name,tp.name as project_name ,tu.name, l.line_item as line_desc");
        $this->db->from('tbl_trans as tbr');
        $this->db->join('tbl_sponsors as ts', 'tbr.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tbr.project_id = tp.id','LEFT');
        $this->db->join('tbl_grants as tg', 'tbr.grant_id = tg.id','LEFT');
        $this->db->join('tbl_line_items as l', 'tbr.line_item = l.id','LEFT');
        $this->db->join('tbl_manage as tm', 'tbr.project_id = tm.project_id','LEFT');
        $this->db->join('tbl_users as tu', 'tm.user_id = tu.id','LEFT');

        if(!empty($id)){
           // $this->db->where('tbr.project_leader',$id); 
            $this->db->where('tm.user_id',$id); 
        }
        $this->db->order_by('tbr.trans_date');
        $query = $this->db->get();
        $response = $query->result();

      
        return $response ;

    }

	public function update($data, $id , $table){
   //     print_r($data);die();
        if(isset($data['password'])){
            $data['password'] = sha1($data['password']);
        }

		$tbl = 'tbl_'.$table;
		$this->db->where('id', $id);
		$query  = $this->db->update($tbl, $data); 
		return $query;
	}

	public function add_credit_trans($id){
		$response = $this->get_budget_requests($id);
		$data = $response[0];
		$arr_post = array("project_id" => $data->project_id , "project_leader" => $data->project_leader,
						 "sponsor_id"=> $data->sponsor_id,"line_item"=> $data->line_item, "grant_id"=>$data->grant_id,
						 "type"=> "Credit",
						 "cost" => $data->cost);
		$id = $this->db->insert('tbl_trans',$arr_post);
	}

	public function get_debit($grant_id,$project_id,$project_sponsor,$line_item){
		$this->db->select("SUM(cost) as debit");
        $this->db->from('tbl_trans');
        $this->db->where('project_id=',$project_id);
        $this->db->where('grant_id=',$grant_id);
        $this->db->where('sponsor_id=',$project_sponsor);
        $this->db->where('line_item=',$line_item);
        $this->db->where('type=','Debit');
        $this->db->where('status=','1');

        $query = $this->db->get();
        $debit = $query->result();
// echo $this->db->last_query();die();
     	return $debit;

    //     echo "<pre>",print_r($query->result()),"</pre>";die();

	}

	public function get_credit($grant_id,$project_id,$project_sponsor,$line_item){
		$this->db->select("SUM(cost) as credit");
        $this->db->from('tbl_trans');
        $this->db->where('project_id=',$project_id);
        $this->db->where('grant_id=',$grant_id);
        $this->db->where('sponsor_id=',$project_sponsor);
        $this->db->where('line_item=',$line_item);
        $this->db->where('type=','Credit');
        $this->db->where('status=','1');


        $query = $this->db->get();
        $credit = $query->result();
// echo $this->db->last_query();die();

     	return $credit;

	}

	public function get_projects($user_id = NULL){
        $optional = "";
        if(!empty($user_id) && $user_id != 1){
            $optional = " tr.role as role_name,";
        }
		$this->db->select("tp.name as project_name, $optional SUM(COALESCE(CASE WHEN type = 'Debit' THEN tt.cost END,0)) 
     - SUM(COALESCE(CASE WHEN type = 'Credit' THEN tt.cost END,0)) balance");
        $this->db->from('tbl_projects as tp');
        $this->db->join('tbl_trans as tt','tt.project_id = tp.id','LEFT');

        if(!empty($user_id) && $user_id != 1){

            $this->db->join('tbl_manage as tm', ' tp.id  = tm.project_id','LEFT');
            $this->db->join('tbl_roles as tr', 'tm.user_role = tr.id ','LEFT');

            $this->db->where('tm.user_id=',$user_id);
        }


        $this->db->where('tt.status=',1);
        $this->db->group_by('tt.project_id');

        $query = $this->db->get();
        $response = $query->result();
      //     echo $this->db->last_query();die();
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

     public function get_documents($id=null){
        $this->db->select("*");
        $this->db->from('tbl_documents');

        if(!empty($id)){
            $this->db->where('tbr.id',$id); 
        }

        $query = $this->db->get();
        $response = $query->result();
        $documents = array();

        foreach($response as $k => $v){
            $documents[$v->budget_request_id][] = $v;
        }

        return $documents ;

    }

     public function get_sponsors(){
        $this->db->select("d.* , d.name as sponsor_name , g.name");
        $this->db->from('tbl_sponsors as d');
        $this->db->join('tbl_grants as g', 'd.id = g.sponsor_id','LEFT');
        $this->db->order_by('g.sponsor_id');

        $query = $this->db->get();
        $response = $query->result();
        $grants = $sponsors = array();
// echo "<pre>",print_r($response),"</pre>";die();
        foreach($response as $k => $v){
            $grants[$v->id][] = $v->name;
            $sponsors[$v->id] = $v->sponsor_name;

        }

        return array('grants'=> $grants, 'sponsors'=>$sponsors) ;

    }


    public function  report_trans_logs($user=null,$date_from=null,$date_to=null,$project_id = null){
        $this->db->select("tbr.*,tu.name as project_leader_name , tg.name as grant_name,ts.name as sponsor_name,tp.name as project_name ,tu.name, l.line_item as line_desc");
        $this->db->from('tbl_trans as tbr');
        $this->db->join('tbl_sponsors as ts', 'tbr.sponsor_id = ts.id ','LEFT');
        $this->db->join('tbl_projects as tp', 'tbr.project_id = tp.id','LEFT');
        $this->db->join('tbl_grants as tg', 'tbr.grant_id = tg.id','LEFT');
        $this->db->join('tbl_users as tu', 'tbr.project_leader = tu.id','LEFT');
        $this->db->join('tbl_line_items as l', 'tbr.line_item = l.id','LEFT');

        if(!empty($user)){
            $this->db->like('tu.name',$user); 
            $this->db->or_where('tu.name is null',null,false); 

        }

        if(!empty($project_id)){
            $this->db->or_where('tbr.project_id',$project_id); 

        }

        // if(!empty($date_from)){
        //     $date_from = date('Y-m-d',strtotime($date_from));
        if(!empty($date_from) || !empty($date_to)){
            $now = date('Y-m-d');
            $date_from = (!empty($date_from)) ? $date_from : $now;
            $date_to = (!empty($date_to)) ? $date_to : $now;

            $this->db->where('tbr.trans_date BETWEEN "'. date('Y-m-d 00:00:00', strtotime($date_from)). '" and "'. date('Y-m-d 23:59:59', strtotime($date_to)).'"');
        }

         $this->db->where('tbr.status','1'); 

        $this->db->order_by('tbr.trans_date');
        $query = $this->db->get();
        $response = $query->result();

      // echo $this->db->last_query();die();    
        return $response ;

    }

 

}
