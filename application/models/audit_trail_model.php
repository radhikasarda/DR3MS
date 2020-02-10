<?php  
   class audit_trail_model extends CI_Model  
   {  
		function __construct()  
		{  
			parent::__construct();	
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;			
		}  
		
		public function get_users()
		{
			$userid = $this->session->userdata('userid');
			$result = $this->db->query("SELECT uid as user from user")->result_array();
			$users = array(); 
			foreach($result as $r) 
			{ 
				$users[$r['user']] = $r['user']; 
			} 
				
			return $users;
		}
		public function num_rows()
		{
			$user = $this->input->post('user');
			$fromDateTime = $this->input->post('fromDateTime');
			$toDateTime = $this->input->post('toDateTime');
			
			if($user == 'All')
			{
				$query = $this->db->query("SELECT * from audit_trail where activity_date_time >= '$fromDateTime' and activity_date_time <= '$toDateTime'");
				
				
			}			
			else
			{
				$query = $this->db->query("SELECT * from audit_trail where activity_date_time >= '$fromDateTime' and activity_date_time <= '$toDateTime' and userid LIKE '$user'");
			}
			
			return $query->num_rows();
		}
		public function get_audit_trail_report_data($start,$records_per_page)
		{
			$user = $this->input->post('user');
			$fromDateTime = $this->input->post('fromDateTime');
			$toDateTime = $this->input->post('toDateTime');
			
			//$end = $start+$records_per_page;
			
			$limit_start = $start - 1 ;
			$offset = $records_per_page;
			
			if($user == 'All')
			{			
				$query = $this->db->query("SELECT * from audit_trail where activity_date_time >= '$fromDateTime' and activity_date_time <= '$toDateTime' order by s_no asc LIMIT $limit_start , $offset ");			
			}			
			else
			{				
				$query = $this->db->query("SELECT * from audit_trail where activity_date_time >= '$fromDateTime' and activity_date_time <= '$toDateTime' and userid LIKE '$user' order by s_no asc LIMIT $limit_start , $offset ");
			}
										
			return $query->result();
		}
   }
?>