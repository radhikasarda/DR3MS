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
			$query = $this->db->query("SELECT a.*,b.* FROM message_comm a JOIN message_recipient b on a.message_id=b.message_id WHERE b.recipient_id LIKE '$user' ORDER BY a.`msg_saved_date` DESC LIMIT 10 ");
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

		public function get_registered_citizens_data($start,$records_per_page)
		{
			$end = $start+$records_per_page;
			
			$limit_start = $start - 1 ;
			$offset = $records_per_page;
			
			$query = $this->db->query("SELECT registered_citizens.citizen_id,registered_citizens.name,registered_citizens.father_name,registered_citizens.contact_no,registered_citizens.village_name,registered_citizens.area_locality_street,registered_citizens.email_id,g.gp_name,b.block,c.circle_name FROM `registered_citizens` join gp g on g.gp_no = registered_citizens.gp_no join block b on b.b_s_no = g.b_s_no join circle c on c.c_s_no = b.c_s_no order by registered_citizens.citizen_id asc LIMIT $limit_start , $offset");
			return $query->result();
			/*$gp_no =  $query_reg_citizen->row()->gp_no;
			
			$this->db->select('*');
			$this->db->from('gp');
			$this->db->where('gp_no', $gp_no);
			$query_gp = $this->db->get();
				
			$gp_name = $query_gp->row()->gp_name;
			$block_no = $query_gp->row()->b_s_no;
			
			$this->db->select('*');
			$this->db->from('block');
			$this->db->where('b_s_no', $block_no);
			$query_block = $this->db->get();
			
			$block_name = $query_block->row()->block;
			$circle_no = $query_block->row()->c_s_no;
			
			$this->db->select('*');
			$this->db->from('circle');
			$this->db->where('c_s_no', $circle_no);
			$query_circle = $this->db->get();
			
			$circle_name = $query_circle->row()->circle_name;
			
			$i=0;
			$registered_citizens_detail_data_list = [];
			foreach ($query_reg_citizen->result() as $row)
			{					
					$list =  array(
						'circle' => $circle_name,
						'block'  => $block_name,
						'gp' => $gp_name,
						'citizen_id' =>$row->citizen_id,
						'name' =>$row->name,
						'father_name' =>$row->father_name,
						'contact_no' =>$row->contact_no,
						'village_name' =>$row->village_name,
						'area_locality_street' =>$row->area_locality_street,
						'email_id' =>$row->email_id
						
						);
					
					$registered_citizens_detail_data_list[$i]  = $list;
				
					$i++;			
			}
			
			$data['data_reg_citizen_details'] = $registered_citizens_detail_data_list;

			return $data;*/
		}
		
		public function num_reg_citizens()
		{		
			$query = $this->db->query("SELECT * from registered_citizens");	
			return $query->num_rows();
		}
		
		public function get_all_incidents()
		{
			$userid = $this->session->userdata('userid');
			$c_s_no = $this->get_c_s_no($userid);
				
			
			if($c_s_no == 0)
			{	
				log_message('info','##########INSIDE get_all_incidents FUNC:: C S no = 0');	
				$query = $this->db->query("SELECT * FROM incident_report ORDER BY reporting_date_time DESC LIMIT 10 ");
			}
				
			else
			{
				$query = $this->db->query("SELECT * FROM `incident_report` join gp g on incident_report.gp_no = g.gp_no join block b on g.b_s_no = b.b_s_no JOIN circle c on b.c_s_no = c.c_s_no  where c.c_s_no = ".$c_s_no." ORDER BY `incident_report`.`reporting_date_time` DESC LIMIT 10 ");							
			}
								
			return $query->result();
		}
		
		public function get_c_s_no($userid)
		{
			$query = $this->db->query("SELECT c_s_no FROM user where uid LIKE '$userid'");
			$c_s_no = null;
			foreach ($query->result() as $row)
			{
				$c_s_no = $row->c_s_no;
			}
			return $c_s_no;
		}		
		
		public function insert_instant_incident_report()
		{
			//For Testing purpose Only
			//Can be changed in future
			//To be used for  inserting an incident to the instant incident report table on click of panic button.
			$query = $this->db->query("SELECT * FROM registered_citizens");
			$registered_citizens = $query->result();
				foreach($registered_citizens as $reg_citizen)
				{
					$citizen_id = $reg_citizen->citizen_id;			
					$affected_rows = $this->insert_to_instant_incident_report($citizen_id);
				}
			return $affected_rows;
		}
		
		public function insert_to_instant_incident_report($citizen_id)
		{
			$data = array(
					'citizen_id' => $citizen_id,
					'gps_location' => 'gps location',
					'remarks' => 'remarks'
			);

			$this->db->insert('instant_incident_report', $data);
			$affected_rows = 0;
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## insert_to_instant_incident_report::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
   }
?>