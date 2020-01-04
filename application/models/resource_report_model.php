<?php  
   class resource_report_model extends CI_Model  
   {  
		function __construct()  
		{  
			parent::__construct();	 
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;		
		}  
      
		public function get_circles($userid)	 
		{
			$c_s_no = $this->get_c_s_no($userid);
		
			if($c_s_no == 0)
			{
			
				$query = $this->db->select('*')-> get('circle');
			}
			else
			{
				$query = $this->db->select('*')->where('c_s_no',$c_s_no)-> get('circle');
				
			}
			return $query;

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
		
		public function get_resources_names()
		{
			$query = $this->db->query("SELECT sno,actual_name as resource FROM selection");
			return $query;
		}
		
		public function get_report_data()
		{		
			$i = 0;
			$data_list = array();
			$c_s_no = null;
			$b_s_no = null;
			$gp_no = null;
			
			log_message('info','##########INSIDE GET REPORT DATA:: ');
			
			$selected_circle = $this->input->post('circle_id');
			
			if(($selected_circle)!= 'All')
			{
			$c_s_no = $this->getc_s_no($selected_circle);
			}
			
			$selected_block = $this->input->post('block_id');
			
			if(($selected_block)!= 'All')
			{
			$b_s_no = $this->get_b_s_no($selected_block);
			}
			
			$selected_gp = $this->input->post('gp_id');
			if(($selected_gp)!= 'All')
			{
			$gp_no = $this->get_gp_no($selected_gp);
			}
			
			$selected_resource = $this->input->post('resource_id');

				$query = $this->get_gp_details($c_s_no,$b_s_no,$gp_no);
				$gp_details = $query->result();
				$data['gp_details'] = $gp_details;
				foreach($gp_details as $row){
					//log_message('info','##########GP LIST:: '.$row->gp_no .' '.$row->gp_name  );
					$gp_no = $row->gp_no;
					$query_selection = $this ->get_all_resource_types($selected_resource);
					$resources_details = $query_selection->result();
					foreach($resources_details as $row1){
						//log_message('info','##########Resource LIST:: '.$row1->sno .' '.$row1->tname  );
						$resource_type = $row1->tname ;
						$query_res_quantity = $this ->get_resource_quantity($gp_no, $resource_type);
						$res_quantity_details = $query_res_quantity->result();
						foreach ($res_quantity_details as $row2)
						{
								//log_message('info','##########Resource LIST:: '.$row->circle_name.' '.$row->block.' '.$row->gp_no.' '.$row1->sno .' '.$row1->tname .' '.$row2->count_res  );
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
		
		public function get_resource_quantity($gp_no, $resource_type)
		{
			
			if($resource_type == 'assets')
			{
				$query=$this->db->query("SELECT sum(no_of_item) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'community_hall')
			{
				$query=$this->db->query("SELECT sum(if(community_hall NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'demographic_and_socio_eco')
			{
				$query=$this->db->query("SELECT total_pop as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'embankment')
			{
				$query=$this->db->query("SELECT sum(if(name_of_embankment NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'hand_pump_ring_well')
			{
				$query=$this->db->query("SELECT sum(if(village_name NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'health_centre')
			{
				$query=$this->db->query("SELECT sum(if(name_of_health_centre NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'inaccessible')
			{
				$query=$this->db->query("SELECT sum(if(inaccessible_area NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'institution')
			{
				$query=$this->db->query("SELECT sum(total_lp_School)+sum(total_me_School)+sum(total_high_school)+sum(total_hs_School)+sum(total_nos_of_college)+sum(others) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'raised_platform')
			{
				$query=$this->db->query("SELECT sum(if(raised_platform NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'relif_camp')
			{
				$query=$this->db->query("SELECT sum(if(name_of_school NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'task_force_committee')
			{
				$query=$this->db->query("SELECT sum(if(s_no NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'telecommunication')
			{
				$query=$this->db->query("SELECT sum(if(village_name_tele NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'vulnerable_village')
			{
				$query=$this->db->query("SELECT sum(if(village_name NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			} 
			else if($resource_type == 'vul_roads_culvert_bridge')
			{
				$query=$this->db->query("SELECT sum((if(vulnerable_roads NOT LIKE '0',1,0)) + (if(vulnerable_culvert NOT LIKE '0',1,0)) + (if(vulnerable_bridges NOT LIKE '0',1,0))) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			} 
			else
			{
				$query=$this->db->query("select count(*) as count_res from ".$resource_type." where gp_no = ".$gp_no);
			}
			return $query;
		}
		
		public function get_gp_details($c_s_no,$b_s_no,$gp_no)
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
			$q= "SELECT * from gp g join block b on b.b_s_no = g.b_s_no JOIN circle c on c.c_s_no = b.c_s_no where ".$cir." ORDER BY circle_name, block , gp_name";
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
			else if($resource_name == 'community_hall')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'community_hall' => $row->community_hall,
						'capacity_to_hold_people1'  => $row->capacity_to_hold_people1,
						'address' =>$row->address,
						'ph_no_of_owner' =>$row->ph_no_of_owner,
						'capacity_to_hold_people2' => $row->capacity_to_hold_people2,
						'gps_point' => $row->gps_point
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($resource_name == 'demographic_and_socio_eco')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'total_pop' => $row->total_pop,
						'male_child'  => $row->male_child,
						'female_child' =>$row->female_child,
						'male_adult' =>$row->male_adult,
						'female_adult' => $row->female_adult,
						'male_old' => $row->male_old,
						'female_old' => $row->female_old,
						'nos_of_bpl_families' => $row->nos_of_bpl_families,
						'families_with_pucca_house' => $row->families_with_pucca_house,
						'families_with_Kutcha_house' => $row->families_with_Kutcha_house,
						'landless_family' => $row->landless_family,
						'homeless_family' => $row->homeless_family
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($resource_name == 'embankment')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'name_of_embankment' => $row->name_of_embankment,
						'status'  => $row->status,
						'village_coverage' =>$row->village_coverage
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($resource_name == 'hand_pump_ring_well')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'village_name' => $row->village_name,
						'location'  => $row->location,
						'gps_point' =>$row->gps_point,
						'provider' =>$row->provider,
						'name_of_provider' => $row->name_of_provider
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
			else if($resource_name == 'inaccessible')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'inaccessible_area' => $row->inaccessible_area
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
			else if($resource_name == 'raised_platform')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'raised_platform' => $row->raised_platform,
						'address'  => $row->address,
						'ph_no_of_owner' =>$row->ph_no_of_owner,
						'capacity_to_hold_people' =>$row->capacity_to_hold_people,
						'gps_point' => $row->gps_point					
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($resource_name == 'relif_camp')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'name_of_school' => $row->name_of_school,
						'address_of_camp'  => $row->address_of_camp,
						'ph_no_of_owner' =>$row->ph_no_of_owner,
						'nos_of_class_room' =>$row->nos_of_class_room,
						'type_of_building' => $row->type_of_building,
						'nos_of_toilets' => $row->nos_of_toilets,
						'sources_of_drinking_water'  => $row->sources_of_drinking_water,
						'open_space' =>$row->open_space,
						'availability_of_electricity' =>$row->availability_of_electricity					
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($resource_name == 'task_force_committee')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'total_rev_village' => $row->total_rev_village,
						'total_govt_land'  => $row->total_govt_land,
						'total_forest_land' =>$row->total_forest_land,
						'designation' =>$row->designation,
						'name_of_members' => $row->name_of_members,
						'contact_no_of_members' => $row->contact_no_of_members,
						'address_of_members'  => $row->address_of_members
								
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($resource_name == 'telecommunication')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'village_name_tele' => $row->village_name_tele,
						'location_of_telecom'  => $row->location_of_telecom,
						'name_of_service_provider' =>$row->name_of_service_provider
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($resource_name == 'vulnerable_village')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'village_name' => $row->village_name,
						'nature_of_disaster'  => $row->nature_of_disaster
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($resource_name == 'vul_roads_culvert_bridge')
			{
				foreach ($resource_details->result() as $row)
				{
					$list =  array(
						'gp_no' => $gp_no,
						'vulnerable_roads' => $row->vulnerable_roads,
						'vulnerable_culvert'  => $row->vulnerable_culvert,
						'vulnerable_bridges' =>$row->vulnerable_bridges,
						'status' =>$row->status
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