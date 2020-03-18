<?php  
	class common_dashboard_model extends CI_Model  
	{  
		function __construct()  
		{  
			// Call the Model constructor  
			parent::__construct();  
			$database_name = $this->session->userdata('database_name');
			log_message('info','##########database_name '.$database_name);
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;
		}  
		
		
		public function check_user_exist($contact_no,$user_exist)
		{
			$this->db->select('*');
			$this->db->from('registered_citizens');
			$this->db->where('contact_no', $contact_no);
			///$this->db->join('gp', 'gp.gp_no = registered_citizens.gp_no');
			//$this->db->join('block', 'block.b_s_no = gp.b_s_no');
			//$this->db->join('circle', 'circle.c_s_no = block.c_s_no');
			$query = $this->db->get();	
			if ($query->num_rows() > 0)
			{
				$user_exist = 1;
				
			}else
			{
				$user_exist = 0;
			}
			
			return $user_exist;
		
		}
		
		public function get_reg_user_info($contact_no)
		{
			$this->db->select('*');
			$this->db->from('registered_citizens');
			$this->db->where('contact_no', $contact_no);
			$this->db->join('gp', 'gp.gp_no = registered_citizens.gp_no');
			$this->db->join('block', 'block.b_s_no = gp.b_s_no');
			$this->db->join('circle', 'circle.c_s_no = block.c_s_no');
			$query = $this->db->get();	
			
			return $query->result();
		}
		
		public function update_contact_no($contact_no)
		{
			$preveious_contact = $this->session->userdata('contact'); 
			$this->db->set('contact_no', $contact_no);			
			$this->db->where('contact_no', $preveious_contact);
			
			$this->db->update('registered_citizens');	
			$affected_rows = 0;
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_contact_no::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		
		public function validateCitizenPreviousDetails($contact_no,$citizen_name,$citizen_father_name,$user_exist)
		{
			$this->db->select('*');
			$this->db->from('registered_citizens');
			$this->db->where('contact_no', $contact_no);
			$this->db->where('name', $citizen_name);
			$this->db->where('father_name', $citizen_father_name);
			$query = $this->db->get();	
			if ($query->num_rows() > 0)
			{
				$user_exist = 1;
				
			}else
			{
				$user_exist = 0;
			}
			
			return $user_exist;
			
		}
		
			public function num_incidents()
			{
				$userid = $this->session->userdata('userid');
				$c_s_no = $this->get_c_s_no($userid);
				
				if($c_s_no == 0)
				{			
					return $this->db->count_all('incident_report');
				}
				
				else
				{
					$this->db->where('c_s_no',$c_s_no);
					$this->db->from('incident_report');
					$this->db->join('gp', 'incident_report.gp_no = gp.gp_no');
					$this->db->join('block', 'gp.b_s_no = block.b_s_no');
					$this->db->join('circle', 'block.c_s_no = circle.c_s_no');
					return $this->db->count_all_results();
											
				}
			}
			
			public function get_all_incidents($start,$records_per_page)
			{
				$userid = $this->session->userdata('userid');
				$c_s_no = $this->get_c_s_no($userid);
				
				$end = $start+$records_per_page;
			
				$limit_start = $start - 1 ;
				$offset = $records_per_page;
			
				if($c_s_no == 0)
				{	
					log_message('info','##########INSIDE get_all_incidents FUNC:: C S no = 0');					
					$query = $this->db->query("SELECT * FROM incident_report ORDER BY reporting_date_time DESC LIMIT $limit_start , $offset ");
				}
				
				else
				{
					$query = $this->db->query("SELECT * FROM `incident_report` join gp g on incident_report.gp_no = g.gp_no join block b on g.b_s_no = b.b_s_no JOIN circle c on b.c_s_no = c.c_s_no  where c.c_s_no = ".$c_s_no." ORDER BY `incident_report`.`reporting_date_time` DESC LIMIT $limit_start , $offset ");							
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
			
			public function get_incident_details()
			{
				$incident_id = $this->input->post('incident_id');
				$request_from_incident = $this->input->post('request_from_incident');
				$request_from_guest = $this->input->post('request_from_guest');
				$query = $this->db->query("SELECT * from incident_report where incident_id = '$incident_id'");
				
				$gp_no = $query->row()->gp_no;				
				$circle_name = $this->get_circle_name($gp_no);
				log_message('info','##########INSIDE get_circle_name FUNC:: circle_name:: '.$circle_name);	
				
				
				$image_1_path = null;
				$image_2_path = null;
				$image_3_path = null;
				
					$database_name = $this->session->userdata('database_name');
					log_message('info','##########INSIDE get_circle_name FUNC:: dir EXIST');
					if (file_exists('./upload/'.$database_name."/".$incident_id.'/'.$incident_id.'_photo_1.jpg'))
					{
						log_message('info','##########INSIDE get_circle_name FUNC:: PHOTO 1 EXIST');
						$image_1_path = base_url('upload/'.$database_name."/".$incident_id.'/'.$incident_id.'_photo_1.jpg');
					}
					if (file_exists('./upload/'.$database_name."/".$incident_id.'/'.$incident_id.'_photo_2.jpg'))
					{
						log_message('info','##########INSIDE get_circle_name FUNC:: PHOTO 2 EXIST');
						$image_2_path = base_url('upload/'.$database_name."/".$incident_id.'/'.$incident_id.'_photo_2.jpg');
					}
					if (file_exists('./upload/'.$database_name."/".$incident_id.'/'.$incident_id.'_photo_3.jpg'))
					{
						log_message('info','##########INSIDE get_circle_name FUNC:: PHOTO 3 EXIST');
						$image_3_path = base_url('upload/'.$database_name."/".$incident_id.'/'.$incident_id.'_photo_3.jpg');
					}
					
				
				
				log_message('info','##########INSIDE get_circle_name FUNC:: image_1_path:: '.$image_1_path);
				log_message('info','##########INSIDE get_circle_name FUNC:: image_2_path:: '.$image_2_path);
				log_message('info','##########INSIDE get_circle_name FUNC:: image_3_path:: '.$image_3_path);
				
				$i = 0;
				$data_incident_details_list = array();
				$incident_details = $query->result();
				$data['incident_details'] = $incident_details;
				foreach($incident_details as $row)
				{
					$list =  array(
								'incident_id' => $incident_id,
								'circle_name' => $circle_name,
								'block_name' => $row->block_name,
								'gp_name' => $row->gp_name,
								'subject' => $row->subject,
								'location' => $row->location_village_name,
								'longitude' => $row->longitude,
								'latitude' => $row->latitude,
								'landmark' => $row->landmark,
								'incident_date' => $row->incident_date,
								'incident_time' => $row->incident_time,
								'reporting_date_time' => $row->reporting_date_time,
								'contact_no' => $row->phone_no,
								'reported_by' => $row->reported_by,
								'detailed_report' => $row->detailed_report,
								'image_1_path' => $image_1_path,
								'image_2_path' => $image_2_path,
								'image_3_path' => $image_3_path,
								'request_from_incident' => $request_from_incident,
								'request_from_guest' => $request_from_guest
								
								);
								$data_incident_details_list[$i]  = $list;
				
								$i++;
				}
				$data['data_incident_details'] = $data_incident_details_list;
				
				return $data;
			}
			
			public function get_circle_name($gp_no)
			{
				$query=$this->db->query("SELECT circle_name from circle join block on block.c_s_no = circle.c_s_no join gp on gp.b_s_no = block.b_s_no where gp.gp_no = ".$gp_no);
				
				return $query->row()->circle_name;
			}
			
			public function get_circles()	 
			{
				
				$query = $this->db->select('*')-> get('circle');
				
				return $query;

			}
			
			public function get_blocks($selected_circle)	
			{
				$query = $this->db->query("SELECT b.block as block FROM block b join circle c ON b.c_s_no=c.c_s_no WHERE c.circle_name LIKE '$selected_circle';");
				$output = '<option value="All">All</option>';
				foreach($query->result() as $row)
				{
				  $output .= '<option value="'.$row->block.'">'.$row->block.'</option>';
				}
				return $output;	   
			}	 

			public function get_gp($selected_block)
			{
				$query = $this->db->query("SELECT g.gp_name as gp FROM gp g join block b ON g.b_s_no=b.b_s_no WHERE b.block LIKE '$selected_block';");
				$output = '<option value="All">All</option>';
				foreach($query->result() as $row)
				{
				  $output .= '<option value="'.$row->gp.'">'.$row->gp.'</option>';
				}
				return $output;	
			}
			
			public function count_gp()
			{
				$selected_circle = $this->input->post('circle_id');
				$selected_block = $this->input->post('block_id');
				$selected_gp = $this->input->post('gp_id');
				
				log_message('info','##########INSIDE count_gp:: selected_circle '.$selected_circle);
				log_message('info','##########INSIDE count_gp:: selected_block '.$selected_block);
				log_message('info','##########INSIDE count_gp:: selected_gp '.$selected_gp);
				
				if($selected_gp != 'All')//if gp is selected so there will be one gp
				{
					return 1;
				}
				if($selected_circle != 'All')//if gp is selected so there will be one gp
				{
					$this->db->where('circle_name',$selected_circle);
				}
				if($selected_block != 'All')//if gp is selected so there will be one gp
				{
					$this->db->where('block',$selected_block);
				}
				$this->db->from('gp');
				$this->db->join('block', 'block.b_s_no = gp.b_s_no');
				$this->db->join('circle', 'circle.c_s_no = block.c_s_no');
				$count = $this->db->count_all_results();
				log_message('info','##########INSIDE count_gp:: count '.$count);
				return $count ;
				
				//$query = $this->db->query("SELECT * from gp");	
				//return $query->num_rows();
			}
		
			public function count_resource_type()
			{
				$query = $this->db->query("SELECT * from selection");	
				return $query->num_rows();
			}
			
			public function get_report_data($start,$no_gp_per_page)
			{
				log_message('info','##########INSIDE GET REPORT DATA::');
				$i = 0;
				$data_list = array();
				$c_s_no = null;
				$b_s_no = null;
				$gp_no = null;
				
				$end = $start + $no_gp_per_page;			
				$limit_start = $start - 1 ;
				$offset = $no_gp_per_page;
				
				log_message('info','##########INSIDE GET REPORT DATA:: limit_start '.$limit_start);
				log_message('info','##########INSIDE GET REPORT DATA:: offset'.$offset);
				$selected_circle = $this->input->post('circle_id');
				log_message('info','##########INSIDE GET REPORT DATA:: selected_circle '.$selected_circle);
				if(($selected_circle)!= 'All')
				{
				$c_s_no = $this->getc_s_no($selected_circle);
				}
				
				$selected_block = $this->input->post('block_id');
				log_message('info','##########INSIDE GET REPORT DATA:: selected_block '.$selected_block);
				if(($selected_block)!= 'All')
				{
				$b_s_no = $this->get_b_s_no($selected_block);
				}
				
				$selected_gp = $this->input->post('gp_id');
				if(($selected_gp)!= 'All')
				{
				$gp_no = $this->get_gp_no($selected_gp);
				}
				log_message('info','##########INSIDE GET REPORT DATA:: selected_gp '.$selected_gp);
				$selected_resource = $this->input->post('resource_id');
				log_message('info','##########INSIDE GET REPORT DATA:: selected_resource '.$selected_resource);
					$query = $this->get_gp_details($c_s_no,$b_s_no,$gp_no,$limit_start,$offset);
					$gp_details = $query->result();
					$gp_num_rows = $query->num_rows();
					
					if($gp_num_rows == 0)
					{
						log_message('info','##########INSIDE If gp_no = 0');
						$start = $start-$offset;
						return $this->get_report_data($start,$no_gp_per_page);
					}
					else
					{
						log_message('info','##########INSIDE If gp_no not = 0');
						log_message('info','##########INSIDE GET REPORT DATA:: limit_start '.$limit_start);
						$data['gp_details'] = $gp_details;
						foreach($gp_details as $row){
							log_message('info','##########GP LIST:: '.$row->gp_no .' '.$row->gp_name  );
							$gp_no = $row->gp_no;
							$query_selection = $this ->get_all_resource_types($selected_resource);
							$resources_details = $query_selection->result();
							foreach($resources_details as $row1){
								log_message('info','##########Resource LIST:: '.$row1->sno .' '.$row1->tname  );
								$resource_type = $row1->tname ;
								$query_res_quantity = $this ->get_resource_quantity($gp_no, $resource_type);
								$res_quantity_details = $query_res_quantity->result();
								foreach ($res_quantity_details as $row2)
								{
										log_message('info','##########Resource LIST:: '.$row->circle_name.' '.$row->block.' '.$row->gp_no.' '.$row1->sno .' '.$row1->tname .' '.$row2->count_res  );
										$list =  array(
										'circle_name' => $row->circle_name,
										'block' => $row->block,
										'gp'  => $row->gp_name,
										'resource_type' =>$row1->actual_name,
										'resource_quantity' =>$row2->count_res
										);
										$data_list[$i]  = $list;
						
										$i++;
								}
								
								
							}					
						}
					
					$data['data_resource_report'] = $data_list;

					return $data;
					}	
			}
			
			public function get_gp_details($c_s_no,$b_s_no,$gp_no,$limit_start,$offset)
			{
				$cir = 1;

				if(!is_null($c_s_no))
				{
					$cir = "c.c_s_no = '$c_s_no'";
				}
				if(!is_null($b_s_no))
				{
					$cir = $cir ." AND b.b_s_no = '$b_s_no'";
				}
				if(!is_null($gp_no))
				{
					$cir = $cir ." AND g.gp_no = '$gp_no'";
				}
				$q = "SELECT * from gp g join block b on b.b_s_no = g.b_s_no JOIN circle c on c.c_s_no = b.c_s_no where ".$cir." ORDER BY circle_name, block , gp_name LIMIT $limit_start , $offset ";
				$query = $this->db->query($q);
				log_message('info','##########INSIDE get_all_gp_details QUERY::::::: '.$q);	
				return $query;
			}
			
			public function get_all_resource_types($selected_resource)
			{
				if($selected_resource == 'All')
				{
					$query=$this->db->query("select * from selection");
				}
				else
				{
					$query=$this->db->query("select * from selection where actual_name like '$selected_resource'");
				}
				
				log_message('info','##########INSIDE GET ALL RESOURCE TYPES:: ');
				return $query;
			}
			
			public function get_resource_quantity($gp_no, $resource_type)
			{
				
				if($resource_type == 'assets')
				{
					$query=$this->db->query("SELECT sum(no_of_item) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
				}				
				else if($resource_type == 'health_centre')
				{
					$query=$this->db->query("SELECT sum(if(name_of_health_centre NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
				}
				else if($resource_type == 'institution')
				{
					$query=$this->db->query("SELECT sum(total_lp_School)+sum(total_me_School)+sum(total_high_school)+sum(total_hs_School)+sum(total_nos_of_college)+sum(others) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
				}				
				return $query;
			}
			
			public function getc_s_no($selected_circle)
			{
				$this->db->select('c_s_no');
				$this->db->from('circle');
				$this->db->where('circle_name', $selected_circle);
				$query = $this->db->get();	
				return $query->row()->c_s_no;
			}
		
			public function get_b_s_no($selected_block)
			{
				$this->db->select('b_s_no');
				$this->db->from('block');
				$this->db->where('block', $selected_block);
				$query = $this->db->get();	
				return $query->row()->b_s_no;
			}
			
			public function get_gp_no($selected_gp)
			{
				$this->db->select('gp_no');
				$this->db->from('gp');
				$this->db->where('gp_name', $selected_gp);
				$query = $this->db->get();	
				return $query->row()->gp_no;
			}
		
			public function get_row_detailed_info()
			{
				
				$circle_name = $this->input->post('circle');
				$block_name = $this->input->post('block');
				$gp_name = $this->input->post('gp');
				$actual_resource_name = $this->input->post('resource');
				log_message('info','##########ACTUAL RESOURCE NAME:: '.$actual_resource_name);
				//get gp number from gp name
				$gp_no  = $this->get_gp_no($gp_name);
				log_message('info','##########INSIDE GET get_row_detailed_info:: '.$gp_no);
				
				//get resource_name from actual resource name			
				$resource_name = $this->get_resource_name($actual_resource_name);
				log_message('info','##########INSIDE GET get_row_detailed_info RESOURCE NAME:: '.$resource_name);
				
				//Get resource details from gp number
				$resource_details = $this->get_resource_details($gp_no,$resource_name);
				
				//Get Detailed info in an array
				$detailed_info = $this->get_detailed_info($gp_no,$resource_name,$resource_details);
				
				return $detailed_info;
				
			}
			
			public function get_resource_name($actual_resource_name)
			{
				$this->db->select('tname');
				$this->db->from('selection');
				$this->db->where('actual_name', $actual_resource_name);
				$query = $this->db->get();	
				return $query->row()->tname;
			}
		
			public function get_resource_details($gp_no,$resource_name)
			{
				$this->db->select('*');
				$this->db->from($resource_name);
				$this->db->where('gp_no', $gp_no);
				$query = $this->db->get();	
				return $query;
			}
			
			public function get_detailed_info($gp_no,$resource_name,$resource_details)
		{
			$i=0;
			$resource_detail_data_list = [];
			if($resource_name == 'assets')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						's_no' =>  $row->s_no,
						'name_of_item' => $row->name_of_item,
						'no_of_item'  => $row->no_of_item,
						'name_of_owner' =>$row->name_of_owner,
						'address_of_owner' =>$row->address_of_owner,
						'contact_no_of_owner' => $row->contact_no_of_owner,
						'capacity_to_hold_people' => $row->capacity_to_hold_people
						);
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
				
			else if($resource_name == 'health_centre')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						's_no' =>  $row->s_no,
						'name_of_health_centre' => $row->name_of_health_centre,
						'address'  => $row->address,
						'ph_no_of_health_centre' =>$row->ph_no_of_health_centre,
						'no_of_doctors' =>$row->no_of_doctors,
						'nos_of_anm' => $row->nos_of_anm,
						'building_type' => $row->building_type,
						'nos_of_bed' => $row->nos_of_bed
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			
			else if($resource_name == 'institution')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						's_no' =>  $row->s_no,
						'total_lp_School' => $row->total_lp_School,
						'total_me_School'  => $row->total_me_School,
						'total_high_school' =>$row->total_high_school,
						'total_hs_School' =>$row->total_hs_School,
						'total_nos_of_college' => $row->total_nos_of_college,
						'others' => $row->others
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}

			$data['data_report_detailed_info'] = $resource_detail_data_list;

			return $data;
		}
	}  
?>  