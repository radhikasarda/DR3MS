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
		
		public function get_audit_trail_report_data()
		{
			$user = $this->input->post('user');
			$fromDateTime = $this->input->post('fromDatetime');
			$toDateTime = $this->input->post('toDateTime');
			
			log_message('info','##########INSIDE get_audit_trail_report_data FUNC::fromDateTime: '.$fromDateTime);
			log_message('info','##########INSIDE get_audit_trail_report_data FUNC::toDateTime: '.$toDateTime);
			
			$data_list = array();
			if($user == 'All')
			{
				$query = $this->db->query("SELECT * from audit_trail where activity_date_time >= '$fromDateTime' and activity_date_time <= '$toDateTime'");
				
				
			}			
			else
			{
				$query = $this->db->query("SELECT * from audit_trail where activity_date_time >= '$fromDateTime' and activity_date_time <= '$toDateTime' and userid LIKE '$user'");
			}
			
			$audit_trail_details = $query->result();
			$i=0;
			foreach($audit_trail_details as $row)
			{
					$list =  array(
						's_no' => $row->s_no,
						'userid' => $row->userid,
						'activity_date_time' => $row->activity_date_time,
						'activity_ip'  => $row->activity_ip,
						'activity' =>$row->activity
						);
					$data_list[$i]  = $list;
					
					$i++;
			}
			$data['data_audit_trail_report'] = $data_list;

			return $data;									
					
		}
   }
?>