<?php  
   class Dashboard_model extends CI_Model  
   {  
		function __construct()  
		{  
			parent::__construct();	
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;			
		}  
		
		public function get_resources_data()
		{
			$userid = $this->session->userdata('userid');
			
			//get Jurisdiction 
			$circle_name  = $this->session->userdata('circle_name');
			
			//Getting assets
			$query=$this->get_assets($circle_name);
			$record = $query->result();
			$data = [];
 
			foreach($record as $row) 
			{
				$data['circle'][] = $row->circle_name;
				$data['assets'][] = (int) $row->no_of_assets;
			}
			
			
			//Getting community halls
			
			$query=$this->get_community_hall($circle_name);
			$ch_record = $query->result();
			
 
			foreach($ch_record as $row) 
			{
				$data['community_hall'][] = (int) $row->no_of_community_hall;
			}
			
			//Getting health centres
			$query=$this->get_health_centre($circle_name);
			$hc_record = $query->result();
			
 
			foreach($hc_record as $row) 
			{
				$data['health_centre'][] = (int) $row->no_of_health_centre;
			}
			
			
			//Getting institutions
			$query=$this->get_institution($circle_name);
			$i_record = $query->result();
			
 
			foreach($i_record as $row) 
			{
				$data['institution'][] = (int) $row->no_of_institution;
			}
			
			
			$data['resources_chart_data'] = json_encode($data);
			
			return $data;
			
		}
		
		
		public function get_user_data()
		{
		
			$userid = $this->session->userdata('userid');
			$role = $this->db->query("SELECT role FROM user WHERE uid = '$userid' ")->row()->role;
			$query = $this->db->query("SELECT uid as user, last_login_time , last_login_ip from user where role > '$role' order by last_login_time DESC");
			$data_user['user_info'] = null;	
			$data_user['user_info'] =  $query->result();
			return $data_user;
		}
	  
		public function get_resources_data_numeric()		
		{
			$userid = $this->session->userdata('userid');
			
			//get Jurisdiction
			$circle_name  = $this->session->userdata('circle_name');
			
			//Circle Details
			$query=$this->get_circles();
			$data_resource['circle_info'] = null;	
			$data_resource['circle_info'] =  $query->result();
				
			//Assets Details
			$query=$this->get_assets($circle_name);
			$data_resource['assets_info'] = null;	
			$data_resource['assets_info'] =  $query->result();
				
			//Community hall Details
			$query=$this->get_community_hall($circle_name);
			$data_resource['community_hall_info'] = null;	
			$data_resource['community_hall_info'] =  $query->result();
				
			//Health Centre Details	
			$query=$this->get_health_centre($circle_name);
			$data_resource['health_centre_info'] = null;	
			$data_resource['health_centre_info'] =  $query->result();
		
			//Institution Details
			$query=$this->get_institution($circle_name);
			$data_resource['institution_info'] = null;	
			$data_resource['institution_info'] = $query->result();
				
			//Embankment Details
			$query=$this->get_embankment($circle_name);
			$data_resource['embankment_info'] = null;	
			$data_resource['embankment_info'] = $query->result();
				
			//Hand Pump Ring Well Details
			$query=$this->get_handpump($circle_name);
			$data_resource['handpump_info'] = null;	
			$data_resource['handpump_info'] =  $query->result();
				
			//Inaccessible Area Details
			$query=$this->get_inaccessible($circle_name);
			$data_resource['inaccessible_info'] = null;	
			$data_resource['inaccessible_info'] =  $query->result();
					
			return $data_resource;
		}
		
		
		
		public function get_inbox_messages()
		{
				
			$user = $this->session->userdata('userid');
			$query = $this->db->query("SELECT a.*,b.* FROM message_comm a JOIN message_recipient b on a.message_id=b.message_id WHERE b.recipient_id LIKE '$user' ORDER BY a.`msg_saved_date` DESC");
			$data_inbox['user_msg'] = null;	
			$data_inbox['user_msg'] =  $query->result();
			return $data_inbox;				
		}
		
		public function get_last_login_time()
		{
			$user = $this->session->userdata('userid');
			$query = $this->db->query("SELECT last_login_time FROM `user` where uid like '$user'");
			$data_last_login['last_login'] = null;	
			$data_last_login['last_login'] =  $query->result();
			return $data_last_login;	
		}
		
		
		public function get_circles()
		{
			log_message('info','##########INSIDE dashboard getcircles()');	
			$query = $this->db->query("SELECT circle_name from circle order by circle_name");
			return $query;		
		}
		
		public function get_assets($circle_name)
		{	
			log_message('info','##########INSIDE dashboard get_assets()');	
			if($circle_name == 'All')
			{
			$query = $this->db->query("SELECT sum(no_of_item) as no_of_assets,c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN assets a ON a.gp_no=g.gp_no GROUP by c.circle_name");
			}
			else
			{
			$q = "SELECT sum(no_of_item) as no_of_assets,c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN assets a ON a.gp_no=g.gp_no WHERE c.circle_name LIKE ".$circle_name;
			log_message('info','##########INSIDE dashboard get_assets() QUERY:::'.$q);	
			$query = $this->db->query("SELECT sum(no_of_item) as no_of_assets,c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN assets a ON a.gp_no=g.gp_no WHERE c.circle_name LIKE '$circle_name'");	
			}
			return $query;			
		}
		
		public function get_community_hall($circle_name)
		{
			if($circle_name == 'All')
			{
			$query = $this->db->query("SELECT sum(if(ch.community_hall NOT LIKE '0',1,0)) as no_of_community_hall, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN community_hall ch ON ch.gp_no=g.gp_no  GROUP BY c.circle_name");
			}
			else
			{
			$query = $this->db->query("SELECT sum(if(ch.community_hall NOT LIKE '0',1,0)) as no_of_community_hall, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN community_hall ch ON ch.gp_no=g.gp_no WHERE c.circle_name LIKE '$circle_name'");	
			}	
			return $query;
		}
		
		public function get_health_centre($circle_name)
		{
			if($circle_name == 'All')
			{
			$query = $this->db->query("SELECT sum(if(hc.name_of_health_centre NOT LIKE '0',1,0)) as no_of_health_centre, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN health_centre hc ON hc.gp_no=g.gp_no  GROUP BY c.circle_name");
			}
			else
			{
			$query = $this->db->query("SELECT sum(if(hc.name_of_health_centre NOT LIKE '0',1,0)) as no_of_health_centre, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN health_centre hc ON hc.gp_no=g.gp_no  WHERE c.circle_name LIKE '$circle_name'");
			}
			return $query;
		}
		
		public function get_institution($circle_name)
		{
			if($circle_name == 'All')
			{
			$query = $this->db->query("SELECT Sum(total_lp_School)+sum(total_me_School)+sum(total_high_school)+sum(total_hs_School)+sum(total_nos_of_college)+sum(others) as no_of_institution, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN institution i ON i.gp_no=g.gp_no GROUP BY c.circle_name");
			}
			else
			{
			$query = $this->db->query("SELECT Sum(total_lp_School)+sum(total_me_School)+sum(total_high_school)+sum(total_hs_School)+sum(total_nos_of_college)+sum(others) as no_of_institution, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN institution i ON i.gp_no=g.gp_no WHERE c.circle_name LIKE '$circle_name'");	
			}
			return $query;
		}
		
		public function get_embankment($circle_name)
		{	
			if($circle_name == 'All')
			{
			$query=$this->db->query("SELECT sum(if(e.name_of_embankment NOT LIKE '0',1,0)) as no_of_embankment, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN embankment e ON e.gp_no=g.gp_no  GROUP BY c.circle_name");
			}
			else
			{
			$query=$this->db->query("SELECT sum(if(e.name_of_embankment NOT LIKE '0',1,0)) as no_of_embankment, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN embankment e ON e.gp_no=g.gp_no  WHERE c.circle_name LIKE '$circle_name'");
			}
			return $query;		
		}
		
		public function get_handpump($circle_name)
		{
			if($circle_name == 'All')
			{
			$query = $this->db->query("SELECT sum(if(h.village_name NOT LIKE '0',1,0)) as no_of_hand_pump_ring_well, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN hand_pump_ring_well h ON h.gp_no=g.gp_no  GROUP BY c.circle_name");
			}
			else 
			{
			$query = $this->db->query("SELECT sum(if(h.village_name NOT LIKE '0',1,0)) as no_of_hand_pump_ring_well, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN hand_pump_ring_well h ON h.gp_no=g.gp_no  WHERE c.circle_name LIKE '$circle_name'");
			}
			return $query;
		}
		
		public function get_inaccessible($circle_name)
		{
			if($circle_name == 'All')
			{
			$query = $this->db->query("SELECT sum(if(i.inaccessible_area NOT LIKE '0',1,0)) as no_of_inaccessible_area, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN inaccessible i ON i.gp_no=g.gp_no  GROUP BY c.circle_name");
			}
			else
			{
			$query = $this->db->query("SELECT sum(if(i.inaccessible_area NOT LIKE '0',1,0)) as no_of_inaccessible_area, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN inaccessible i ON i.gp_no=g.gp_no  WHERE c.circle_name LIKE '$circle_name'");	
			}
			return $query;	
		}

   }
?>