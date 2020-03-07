<?php  
	class District_model extends CI_Model  
	{  
		function __construct()  
		{  
			parent::__construct();  
		}  
		
		public function get_districts()
		{
			log_message('info','##########Loading District Model get_districts FUNCTION');
			$this->db->select('s_no, district_name');
			$this->db->from('district');
			$this->db->where('is_enabled', true);
			$this->db->order_by("district_name", "asc");
			$result = $this->db->get()->result_array();;

			$districts = array(); 
			foreach($result as $r) 
			{ 
				$districts[$r['district_name']] = $r['district_name']; 
			} 
			
			return $districts;
				
		}
		
		public function get_resources_data()
		{
			//Getting assets
			$query=$this->get_assets();
			$record = $query->result();
			$data = [];
 
			foreach($record as $row) 
			{
				$data['circle'][] = $row->circle_name;
				$data['assets'][] = (int) $row->no_of_assets;
			}
			
			
			//Getting community halls
			
			$query=$this->get_community_hall();
			$ch_record = $query->result();
			
 
			foreach($ch_record as $row) 
			{
				$data['community_hall'][] = (int) $row->no_of_community_hall;
			}
			
			//Getting health centres
			$query=$this->get_health_centre();
			$hc_record = $query->result();
			
 
			foreach($hc_record as $row) 
			{
				$data['health_centre'][] = (int) $row->no_of_health_centre;
			}
			
			
			//Getting institutions
			$query=$this->get_institution();
			$i_record = $query->result();
			
 
			foreach($i_record as $row) 
			{
				$data['institution'][] = (int) $row->no_of_institution;
			}
			
			
			$data['resources_chart_data'] = json_encode($data);
			
			return $data;
			
		}
		
		public function get_assets()
		{	
			log_message('info','##########INSIDE get_assets()');	
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;						
			$query = $this->db->query("SELECT sum(no_of_item) as no_of_assets,c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN assets a ON a.gp_no=g.gp_no GROUP by c.circle_name");					
			return $query;			
		}
		
		public function get_community_hall()
		{
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;						
			$query = $this->db->query("SELECT sum(if(ch.community_hall NOT LIKE '0',1,0)) as no_of_community_hall, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN community_hall ch ON ch.gp_no=g.gp_no  GROUP BY c.circle_name");
				
			return $query;
		}
		
		public function get_health_centre()
		{
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;						
			$query = $this->db->query("SELECT sum(if(hc.name_of_health_centre NOT LIKE '0',1,0)) as no_of_health_centre, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN health_centre hc ON hc.gp_no=g.gp_no  GROUP BY c.circle_name");
			
			return $query;
		}
		
		public function get_institution()
		{
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;						
			$query = $this->db->query("SELECT Sum(total_lp_School)+sum(total_me_School)+sum(total_high_school)+sum(total_hs_School)+sum(total_nos_of_college)+sum(others) as no_of_institution, c.circle_name as circle_name FROM circle c LEFT JOIN block b ON b.c_s_no= c.c_s_no LEFT JOIN gp g ON g.b_s_no=b.b_s_no LEFT JOIN institution i ON i.gp_no=g.gp_no GROUP BY c.circle_name");
			
			return $query;
		}
		
		public function getLoginViewData($selected_district)
		{
			$key_val = $this->encryption->create_key(32);
			$data['key']=bin2hex($key_val);
			
			log_message('info','##########KEY IN getLoginViewData FUNCTION '.$key_val);
			
			$this->session->set_userdata('key_val', $key_val);

			$data['selected_district'] = $selected_district;
			$data['users'] = $this->get_users();
			
			return $data;
		}
		/*public function loadLoginView($selected_district)
		{
			//For password Encryption
			
			$key_val = $this->encryption->create_key(32);
			$data['key']=bin2hex($key_val);
			
			log_message('info','##########KEY IN loadLoginView FUNCTION '.$key_val);
			
			$this->session->set_userdata('key_val', $key_val);

			$data['selected_district'] = $selected_district;
			$data['users'] = $this->get_users();
			$this->load->view('login_view',$data);
		}*/
		
		public function get_total_incidents()
		{
			log_message('info','##########get_total_incidents FUNCTION');
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);			
			$this->db=$db;
			$total_incidents = $this->db->count_all_results('incident_report'); 
			return $total_incidents;
			
		}
		
		public function get_total_assets()
		{
			log_message('info','##########get_total_assets FUNCTION');
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);			
			$this->db=$db;
			$query = $this->db->query("SELECT sum(no_of_item) as no_of_assets from assets");
			$data['total_assets'] =  $query->result();
			return $data;
		}
		
		public function get_total_health_centres()
		{
			log_message('info','##########get_total_health_centres FUNCTION');
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);			
			$this->db=$db;
			$query = $this->db->query("SELECT sum(if(name_of_health_centre NOT LIKE '0',1,0)) as no_of_health_centre from health_centre");
			$data['total_health_centres'] =  $query->result();
			return $data;
		}
		
		public function get_total_institutions()
		{
			log_message('info','##########get_total_institutions FUNCTION');
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);			
			$this->db=$db;
			$query = $this->db->query("SELECT Sum(total_lp_School)+sum(total_me_School)+sum(total_high_school)+sum(total_hs_School)+sum(total_nos_of_college)+sum(others) as no_of_institution from institution");
			$data['total_institutions'] =  $query->result();
			return $data;
		}
		
		public function get_users()
		{
			log_message('info','##########Loading Login Controller get_users() FUNCTION');
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;						
			$result = $this->db->select('s_no, uid')-> get('user')-> result_array();
			$users = array(); 
			foreach($result as $r) 
			{ 
				$users[$r['uid']] = $r['uid']; 
			} 
			
			return $users;
				
		}
	}
?>