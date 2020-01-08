<?php  
   class master_data_model extends CI_Model  
   {  
		function __construct()  
		{  
			parent::__construct();	 
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;		
		}  
		
		public function get_master_data_entry_form_data()
		{
			log_message('info','########## INSIDE FUNCTION get_master_data_entry_form_data():: ');
			
			$selected_resource = $this->input->post('resource_id');		
			log_message('info','########## SELECTED RESOURCE:: '.$selected_resource);
			
			$resource_table_name = $this->get_actual_resource_name($selected_resource);
			log_message('info','########## RESOURCE TABLE NAME:: '.$resource_table_name);
			
			return $resource_table_name;
		}
		
		public function get_actual_resource_name($selected_resource)
		{
			$this->db->select('tname');
			$this->db->from('selection');
			$this->db->where('actual_name', $selected_resource);
			$query = $this->db->get();	
			return $query->row()->tname;
		}
		
		public function get_item_details()
		{
			$this->load->model('master_data_update_delete_model');
			$selected_resource = $this->input->post('resource_id');		
			log_message('info','########## SELECTED RESOURCE:: '.$selected_resource);
			
			$this->db->select('*');
			$this->db->from($selected_resource);
			$query = $this->db->get();	
			
			$i=0;
			$resource_detail_data_list = [];
			
			if($selected_resource == 'circle')
			{
				foreach ($query->result() as $row)
				{
					$list =  array(
						'c_s_no' => $row->c_s_no,
						'circle_name'  => $row->circle_name
						);
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($selected_resource == 'block')
			{
			
				foreach ($query->result() as $row)
				{
					$c_s_no =  $row->c_s_no;		
					$circle_name = $this->master_data_update_delete_model->get_circle_name($c_s_no);
					$list =  array(
						'b_s_no' => $row->b_s_no,
						'c_s_no'  => $row->c_s_no,
						'circle_name' => $circle_name,
						'block' =>$row->block
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($selected_resource == 'gp')
			{
			
				foreach ($query->result() as $row)
				{
					$b_s_no =  $row->b_s_no;
					$block_name = $this->master_data_update_delete_model->get_block_name($b_s_no);
					$list =  array(
						'gp_no' => $row->gp_no,
						'b_s_no'  => $row->b_s_no,
						'block_name' =>$block_name,
						'gp_name' =>$row->gp_name
						);
					
					$resource_detail_data_list[$i]  = $list;
				
					$i++;			
				}
			}
			
			$data['data_item_details'] = $resource_detail_data_list;

			return $data;
		}
		
		public function add_circle_data()
		{
			$name_of_circle = $this->input->post('name_of_circle');
			$this->db->set('circle_name', $name_of_circle);
			$this->db->insert('circle');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_circle_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_block_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$name_of_block = $this->input->post('name_of_block');
			
			$this->load->model('resource_report_model');
			$c_s_no = $this->resource_report_model->getc_s_no($selected_circle);
			
			$this->db->set('c_s_no', $c_s_no);
			$this->db->set('block', $name_of_block);
			
			$this->db->insert('block');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_block_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_gp_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$name_of_gp = $this->input->post('name_of_gp');
			
			$this->load->model('resource_report_model');
			$b_s_no = $this->resource_report_model->get_b_s_no($selected_block);
			
			$this->db->set('b_s_no', $b_s_no);
			$this->db->set('gp_name', $name_of_gp);
			
			$this->db->insert('gp');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_gp_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_assets_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_item = $this->input->post('name_of_item');		
			$no_of_item = $this->input->post('no_of_item');		
			$name_of_owner = $this->input->post('name_of_owner');		
			$address_of_owner = $this->input->post('address');		
			$contact_no = $this->input->post('contact_no');		
			$capacity = $this->input->post('capacity');		
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('name_of_item', $name_of_item);
			$this->db->set('no_of_item', $no_of_item);
			$this->db->set('name_of_owner', $name_of_owner);					
			$this->db->set('address_of_owner', $address_of_owner);
			$this->db->set('contact_no_of_owner', $contact_no);
			$this->db->set('capacity_to_hold_people', $capacity);
			
			$this->db->insert('assets');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_assets_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_community_hall_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$community_hall = $this->input->post('community_hall');		
			$capacity_1 = $this->input->post('capacity_1');		
			$address = $this->input->post('address');		
			$contact_no = $this->input->post('contact_no');		
			$capacity_2 = $this->input->post('capacity_2');		
			$gps_point = $this->input->post('gps_point');		
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('community_hall', $community_hall);
			$this->db->set('capacity_to_hold_people1', $capacity_1);
			$this->db->set('address', $address);					
			$this->db->set('ph_no_of_owner', $contact_no);
			$this->db->set('capacity_to_hold_people2', $capacity_2);
			$this->db->set('gps_point', $gps_point);
			
			$this->db->insert('community_hall');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_community_hall_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_demographic_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$total_population = $this->input->post('total_population');		
			$male_child = $this->input->post('male_child');		
			$female_child = $this->input->post('female_child');		
			$male_adult = $this->input->post('male_adult');		
			$female_adult = $this->input->post('female_adult');		
			$male_old = $this->input->post('male_old');	
			$female_old = $this->input->post('female_old');		
			$no_of_bpl_families = $this->input->post('no_of_bpl_families');		
			$families_with_pucca_house = $this->input->post('families_with_pucca_house');		
			$families_with_kutcha_house = $this->input->post('families_with_kutcha_house');		
			$landless_families = $this->input->post('landless_families');		
			$homeless_families = $this->input->post('homeless_families');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('total_pop', $total_population);
			$this->db->set('male_child', $male_child);
			$this->db->set('female_child', $female_child);					
			$this->db->set('male_adult', $male_adult);
			$this->db->set('female_adult', $female_adult);
			$this->db->set('male_old', $male_old);
			$this->db->set('female_old', $female_old);
			$this->db->set('nos_of_bpl_families', $no_of_bpl_families);
			$this->db->set('families_with_pucca_house', $families_with_pucca_house);					
			$this->db->set('families_with_Kutcha_house', $families_with_kutcha_house);
			$this->db->set('landless_family', $landless_families);
			$this->db->set('homeless_family', $homeless_families);
			
			$this->db->insert('demographic_and_socio_eco');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_demographic_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_embankment_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_embankment = $this->input->post('name_of_embankment');		
			$status = $this->input->post('status');		
			$village_coverage = $this->input->post('village_coverage');		

			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('name_of_embankment', $name_of_embankment);
			$this->db->set('status', $status);
			$this->db->set('village_coverage', $village_coverage);					

			$this->db->insert('embankment');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_embankment_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_hand_pump_ring_well_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$village = $this->input->post('village');		
			$location = $this->input->post('location');		
			$gps_point = $this->input->post('gps_point');		
			$provider = $this->input->post('provider');		
			$name_of_provider = $this->input->post('name_of_provider');			
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('village_name', $village);
			$this->db->set('location', $location);
			$this->db->set('gps_point', $gps_point);					
			$this->db->set('provider', $provider);
			$this->db->set('name_of_provider', $name_of_provider);
			
			$this->db->insert('hand_pump_ring_well');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_hand_pump_ring_well_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_health_centre_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_health_centre = $this->input->post('name_of_health_centre');		
			$address = $this->input->post('address');
			$contact_no = $this->input->post('contact_no');
			$no_of_doctors = $this->input->post('no_of_doctors');		
			$no_of_anm = $this->input->post('no_of_anm');		
			$building_type = $this->input->post('building_type');		
			$no_of_beds = $this->input->post('no_of_beds');		
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('name_of_health_centre', $name_of_health_centre);
			$this->db->set('address', $address);
			$this->db->set('ph_no_of_health_centre', $contact_no);					
			$this->db->set('no_of_doctors', $no_of_doctors);
			$this->db->set('nos_of_anm', $no_of_anm);
			$this->db->set('building_type', $building_type);
			$this->db->set('nos_of_bed', $no_of_beds);
			
			$this->db->insert('health_centre');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_health_centre_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_inaccessible_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$inaccessible_area = $this->input->post('inaccessible_area');		
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('inaccessible_area', $inaccessible_area);
			
			$this->db->insert('inaccessible');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_inaccessible_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_institution_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$total_lp_school = $this->input->post('total_lp_school');		
			$total_me_school = $this->input->post('total_me_school');
			$total_high_school = $this->input->post('total_high_school');
			$total_hs_school = $this->input->post('total_hs_school');		
			$total_college = $this->input->post('total_college');		
			$other_institutions = $this->input->post('other_institutions');		

			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('total_lp_School', $total_lp_school);
			$this->db->set('total_me_School', $total_me_school);
			$this->db->set('total_high_school', $total_high_school);					
			$this->db->set('total_hs_School', $total_hs_school);
			$this->db->set('total_nos_of_college', $total_college);
			$this->db->set('others', $other_institutions);
			
			$this->db->insert('institution');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_institution_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_raised_platform_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$raised_platform = $this->input->post('raised_platform');		
			$address = $this->input->post('address');
			$contact_no = $this->input->post('contact_no');
			$capacity = $this->input->post('capacity');		
			$gps_point = $this->input->post('gps_point');		

			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('raised_platform', $raised_platform);
			$this->db->set('address', $address);
			$this->db->set('ph_no_of_owner', $contact_no);					
			$this->db->set('capacity_to_hold_people', $capacity);
			$this->db->set('gps_point', $gps_point);
			
			$this->db->insert('raised_platform');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_institution_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_relif_camp_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_school = $this->input->post('name_of_school');		
			$address = $this->input->post('address');
			$contact_no = $this->input->post('contact_no');
			$no_of_classroom = $this->input->post('no_of_classroom');		
			$type_of_building = $this->input->post('type_of_building');
			$no_of_toilets = $this->input->post('no_of_toilets');		
			$source_of_drinking_water = $this->input->post('source_of_drinking_water');		
			$open_space = $this->input->post('open_space');		
			$electricity_available = $this->input->post('electricity_available');		

			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('name_of_school', $name_of_school);
			$this->db->set('address_of_camp', $address);
			$this->db->set('ph_no_of_owner', $contact_no);					
			$this->db->set('nos_of_class_room', $no_of_classroom);
			$this->db->set('type_of_building', $type_of_building);
			$this->db->set('nos_of_toilets', $no_of_toilets);
			$this->db->set('sources_of_drinking_water', $source_of_drinking_water);
			$this->db->set('open_space', $open_space);
			$this->db->set('availability_of_electricity', $electricity_available);
			
			$this->db->insert('relif_camp');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_relif_camp_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_task_force_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$total_rev_village = $this->input->post('total_rev_village');		
			$total_govt_land = $this->input->post('total_govt_land');
			$total_forest_land = $this->input->post('total_forest_land');
			$designation = $this->input->post('designation');		
			$name_of_members = $this->input->post('name_of_members');
			$contact_no = $this->input->post('contact_no');		
			$address = $this->input->post('address');		


			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('total_rev_village', $total_rev_village);
			$this->db->set('total_govt_land', $total_govt_land);
			$this->db->set('total_forest_land', $total_forest_land);					
			$this->db->set('designation', $designation);
			$this->db->set('name_of_members', $name_of_members);
			$this->db->set('contact_no_of_members', $contact_no);
			$this->db->set('address_of_members', $address);

			
			$this->db->insert('task_force_committee');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_task_force_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_telecommunication_data()
		{

			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		   
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_village = $this->input->post('name_of_village');		
			$location = $this->input->post('location');
			$name_of_service_provider = $this->input->post('name_of_service_provider');
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('village_name_tele', $name_of_village);
			$this->db->set('location_of_telecom', $location);
			$this->db->set('name_of_service_provider', $name_of_service_provider);					
			
			$this->db->insert('telecommunication');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_telecommunication_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_vul_road_cul_bridge_data()
		{			
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_vul_road = $this->input->post('name_of_vul_road');		
			$name_of_vul_culvert = $this->input->post('name_of_vul_culvert');
			$name_of_vul_bridge = $this->input->post('name_of_vul_bridge');
			$status = $this->input->post('status');
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('vulnerable_roads', $name_of_vul_road);
			$this->db->set('vulnerable_culvert', $name_of_vul_culvert);
			$this->db->set('vulnerable_bridges', $name_of_vul_bridge);					
			$this->db->set('status', $status);
				
			$this->db->insert('vul_roads_culvert_bridge');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_vul_road_cul_bridge_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		
		public function add_vul_village_data()
		{
			
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_village = $this->input->post('name_of_village');		
			$nature_of_disaster = $this->input->post('nature_of_disaster');
	
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('village_name', $name_of_village);
			$this->db->set('nature_of_disaster', $nature_of_disaster);
			
			$this->db->insert('vulnerable_village');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## add_vul_village_data::affected_rows '.$affected_rows);
			if($affected_rows ==1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
   }
?>