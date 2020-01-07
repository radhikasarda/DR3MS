<?php  
   class master_data_update_delete_model extends CI_Model  
   {  
		function __construct()  
		{  
			parent::__construct();	 
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;		
		}  
		
		public function get_item_details()
		{
			$selected_item = $this->input->post('selected_item');		
			log_message('info','########## SELECTED ITEM:: '.$selected_item);
			
			$id = $this->input->post('id');		
			
			$i=0;
			$item_details_list = [];
			
			$data['circles'] = $this->get_circles()->result(); 
			
			if($selected_item == 'circle')
			{
				$this->db->select('*');
				$this->db->from($selected_item);
				$this->db->where('c_s_no', $id);
				$query = $this->db->get();	
				foreach ($query->result() as $row)
				{
					$list =  array(
						'c_s_no' => $row->c_s_no,
						'circle_name'  => $row->circle_name
						);
					$item_details_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($selected_item == 'block')
			{
				$this->db->select('*');
				$this->db->from($selected_item);
				$this->db->where('b_s_no', $id);
				$query = $this->db->get();
				
				$c_s_no = $query->row()->c_s_no;
				
				$circle_name = $this->get_circle_name($c_s_no);
				
				foreach ($query->result() as $row)
				{
					$list =  array(
						'b_s_no' => $row->b_s_no,
						'circle_name'  => $circle_name,
						'block' =>$row->block
						);
					
					$item_details_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($selected_item == 'gp')
			{
				$this->db->select('*');
				$this->db->from($selected_item);
				$this->db->where('gp_no', $id);
				$query = $this->db->get();	
				
				$b_s_no = $query->row()->b_s_no; 
				
				$c_s_no = $this->get_c_s_no($b_s_no);
				
				$block_name = $this->get_block_name($b_s_no);
				$circle_name = $this->get_circle_name($c_s_no);
				
				foreach ($query->result() as $row)
				{
					$list =  array(
						'gp_no' => $row->gp_no,
						'block_name'  => $block_name,
						'circle_name' =>$circle_name,
						'gp_name' =>$row->gp_name
						);
					
					$item_details_list[$i]  = $list;
				
					$i++;			
				}
			}
			$data['data_item_details'] = $item_details_list;

			return $data;
		}
		
		public function get_circles()
		{
			$query = $this->db->select('*')-> get('circle');
			return $query;
		}
		public function get_circle_name($c_s_no)
		{
			$this->db->select('circle_name');
			$this->db->from('circle');
			$this->db->where('c_s_no', $c_s_no);
			$query = $this->db->get();
				
			return $query->row()->circle_name;
		}
		
		public function get_block_name($b_s_no)
		{
			$this->db->select('block');
			$this->db->from('block');
			$this->db->where('b_s_no', $b_s_no);
			$query = $this->db->get();
				
			return $query->row()->block;
		}
		
		public function get_c_s_no($b_s_no)
		{
			$this->db->select('c_s_no');
			$this->db->from('block');
			$this->db->where('b_s_no', $b_s_no);
			$query = $this->db->get();
				
			return $query->row()->c_s_no;
		}
		
		public function update_circle_data()
		{
			$name_of_circle = $this->input->post('name_of_circle');
			$circle_no = $this->input->post('circle_no');
			
			$data = array(
					'circle_name' => $name_of_circle
			);

			$this->db->where('c_s_no', $circle_no);
			$this->db->update('circle', $data);
			
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_circle_data::affected_rows '.$affected_rows);
			
			return $affected_rows ;
		}
		
		public function update_block_data()
		{
			$name_of_circle = $this->input->post('selected_circle');
			log_message('info','########## update_circle_data::selected_circle '.$name_of_circle);
			$name_of_block = $this->input->post('name_of_block');
			$block_no = $this->input->post('block_no');
			
			$this->db->select('c_s_no');
			$this->db->from('circle');
			$this->db->where('circle_name', $name_of_circle);
			$query = $this->db->get();
				
			$c_s_no = $query->row()->c_s_no;
			log_message('info','########## update_circle_data::c_s_no '.$c_s_no);
			
			$data = array(
					'c_s_no' => $c_s_no,
					'block' => $name_of_block
			);

			$this->db->where('b_s_no', $block_no);
			$this->db->update('block', $data);
			
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_block_data::affected_rows '.$affected_rows);
		
			return $affected_rows ;
		}
		
		public function update_gp_data()
		{
			$name_of_circle = $this->input->post('selected_circle');
			$name_of_block = $this->input->post('selected_block');
			$name_of_gp = $this->input->post('name_of_gp');			
			$gp_no = $this->input->post('gp_no');
			
			$this->db->select('b_s_no');
			$this->db->from('block');
			$this->db->where('block', $name_of_block);
			$query = $this->db->get();
				
			$b_s_no = $query->row()->b_s_no;
			
			$data = array(
					'b_s_no' => $b_s_no,
					'gp_name' => $name_of_gp
			);

			$this->db->where('gp_no', $gp_no);
			$this->db->update('gp', $data);
			
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_gp_data::affected_rows '.$affected_rows);
		
			return $affected_rows ;
		}
		
		public function get_blocks($selected_circle)	
		{
			$query = $this->db->query("SELECT b.block as block FROM block b join circle c ON b.c_s_no=c.c_s_no WHERE c.circle_name LIKE '$selected_circle';");
			$output = '<option value="Select">Select Block</option>';
			foreach($query->result() as $row)
			{
			  $output .= '<option value="'.$row->block.'">'.$row->block.'</option>';
			 
			}
			log_message('info','########## get_blocks::output '.$output);
			return $output;	   
		}	 

		public function get_gp($selected_block)
		{
			$query = $this->db->query("SELECT g.gp_name as gp FROM gp g join block b ON g.b_s_no=b.b_s_no WHERE b.block LIKE '$selected_block';");
			$output = '<option value="Select">Select GP</option>';
			foreach($query->result() as $row)
			{
			  $output .= '<option value="'.$row->gp.'">'.$row->gp.'</option>';
			}
			log_message('info','########## get_gp::output '.$output);
			return $output;	
		}
		public function get_resource_details()
		{
			$this->load->model('resource_report_model');
			
			$selected_item = $this->input->post('selected_item');				
			log_message('info','########## SELECTED ITEM:: '.$selected_item);
			
			$resource_name = $this->resource_report_model->get_resource_name($selected_item);
			log_message('info','########## resource_name:: '.$resource_name);
			
			$selected_gp =  $this->input->post('selected_gp');	
			$s_no = $this->input->post('s_no');		
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->select('*');
			$this->db->from($resource_name);
			$this->db->where('s_no', $s_no);
			$resource_details = $this->db->get();	
			
			$detailed_info = $this->resource_report_model->get_detailed_info($gp_no,$resource_name,$resource_details);
			
			return $detailed_info;
		}
		
		public function update_assets_data()
		{
			$this->load->model('resource_report_model');
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_item = $this->input->post('name_of_item');		
			$no_of_item = $this->input->post('no_of_item');		
			$name_of_owner = $this->input->post('name_of_owner');		
			$address_of_owner = $this->input->post('address');		
			$contact_no = $this->input->post('contact_no');		
			$capacity = $this->input->post('capacity');		
			$s_no = $this->input->post('s_no');	

			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('name_of_item', $name_of_item);
			$this->db->set('no_of_item', $no_of_item);
			$this->db->set('name_of_owner', $name_of_owner);					
			$this->db->set('address_of_owner', $address_of_owner);
			$this->db->set('contact_no_of_owner', $contact_no);
			$this->db->set('capacity_to_hold_people', $capacity);
			
			$this->db->where('s_no', $s_no);
			
			$this->db->update('assets');
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_assets_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_community_hall_data()
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
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('community_hall', $community_hall);
			$this->db->set('capacity_to_hold_people1', $capacity_1);
			$this->db->set('address', $address);					
			$this->db->set('ph_no_of_owner', $contact_no);
			$this->db->set('capacity_to_hold_people2', $capacity_2);
			$this->db->set('gps_point', $gps_point);
			
			$this->db->where('s_no', $s_no);
			
			$this->db->update('community_hall');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_community_hall_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_demographic_data()
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
			$s_no = $this->input->post('s_no');	
			
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
			
			$this->db->where('s_no', $s_no);
			$this->db->update('demographic_and_socio_eco');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_demographic_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_embankment_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_embankment = $this->input->post('name_of_embankment');		
			$status = $this->input->post('status');		
			$village_coverage = $this->input->post('village_coverage');		
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('name_of_embankment', $name_of_embankment);
			$this->db->set('status', $status);
			$this->db->set('village_coverage', $village_coverage);					

			$this->db->where('s_no', $s_no);
			$this->db->update('embankment');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_embankment_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_hand_pump_ring_well_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$village = $this->input->post('village');		
			$location = $this->input->post('location');		
			$gps_point = $this->input->post('gps_point');		
			$provider = $this->input->post('provider');		
			$name_of_provider = $this->input->post('name_of_provider');			
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('village_name', $village);
			$this->db->set('location', $location);
			$this->db->set('gps_point', $gps_point);					
			$this->db->set('provider', $provider);
			$this->db->set('name_of_provider', $name_of_provider);
			
			$this->db->where('s_no', $s_no);
			$this->db->update('hand_pump_ring_well');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_hand_pump_ring_well_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_health_centre_data()
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
			$s_no = $this->input->post('s_no');	
			
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
			
			$this->db->where('s_no', $s_no);
			$this->db->update('health_centre');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_health_centre_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_inaccessible_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$inaccessible_area = $this->input->post('inaccessible_area');		
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('inaccessible_area', $inaccessible_area);
			$this->db->where('s_no', $s_no);
			$this->db->update('inaccessible');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_inaccessible_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_institution_data()
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
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('total_lp_School', $total_lp_school);
			$this->db->set('total_me_School', $total_me_school);
			$this->db->set('total_high_school', $total_high_school);					
			$this->db->set('total_hs_School', $total_hs_school);
			$this->db->set('total_nos_of_college', $total_college);
			$this->db->set('others', $other_institutions);
			$this->db->where('s_no', $s_no);
			$this->db->update('institution');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_institution_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_raised_platform_data()
		{
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$raised_platform = $this->input->post('raised_platform');		
			$address = $this->input->post('address');
			$contact_no = $this->input->post('contact_no');
			$capacity = $this->input->post('capacity');		
			$gps_point = $this->input->post('gps_point');		
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('raised_platform', $raised_platform);
			$this->db->set('address', $address);
			$this->db->set('ph_no_of_owner', $contact_no);					
			$this->db->set('capacity_to_hold_people', $capacity);
			$this->db->set('gps_point', $gps_point);
			$this->db->where('s_no', $s_no);
			$this->db->update('raised_platform');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_raised_platform_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_relif_camp_data()
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
			$s_no = $this->input->post('s_no');	

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
			$this->db->where('s_no', $s_no);
			$this->db->update('relif_camp');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_relif_camp_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_task_force_data()
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
			$s_no = $this->input->post('s_no');	

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

			$this->db->where('s_no', $s_no);
			$this->db->update('task_force_committee');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_task_force_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_telecommunication_data()
		{

			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		   
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_village = $this->input->post('name_of_village');		
			$location = $this->input->post('location');
			$name_of_service_provider = $this->input->post('name_of_service_provider');
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('village_name_tele', $name_of_village);
			$this->db->set('location_of_telecom', $location);
			$this->db->set('name_of_service_provider', $name_of_service_provider);					
			$this->db->where('s_no', $s_no);
			$this->db->update('telecommunication');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_telecommunication_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_vul_road_cul_bridge_data()
		{			
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_vul_road = $this->input->post('name_of_vul_road');		
			$name_of_vul_culvert = $this->input->post('name_of_vul_culvert');
			$name_of_vul_bridge = $this->input->post('name_of_vul_bridge');
			$status = $this->input->post('status');
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('vulnerable_roads', $name_of_vul_road);
			$this->db->set('vulnerable_culvert', $name_of_vul_culvert);
			$this->db->set('vulnerable_bridges', $name_of_vul_bridge);					
			$this->db->set('status', $status);
			$this->db->where('s_no', $s_no);	
			$this->db->update('vul_roads_culvert_bridge');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_vul_road_cul_bridge_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function update_vul_village_data()
		{
			
			$selected_circle = $this->input->post('selected_circle');
			$selected_block = $this->input->post('selected_block');		
			$selected_gp = $this->input->post('selected_gp');		
			$name_of_village = $this->input->post('name_of_village');		
			$nature_of_disaster = $this->input->post('nature_of_disaster');
			$s_no = $this->input->post('s_no');	
			
			$this->load->model('resource_report_model');
			$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
			
			$this->db->set('gp_no', $gp_no);
			$this->db->set('village_name', $name_of_village);
			$this->db->set('nature_of_disaster', $nature_of_disaster);
			$this->db->where('s_no', $s_no);	
			$this->db->update('vulnerable_village');	
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_vul_village_data::affected_rows '.$affected_rows);
			return $affected_rows ;
		}
		
		public function delete_resource()
		{
			$selected_resource =  $this->input->post('selected_resource');	
			$this->load->model('resource_report_model');
			$resource_name = $this->resource_report_model->get_resource_name($selected_resource);
			log_message('info','########## resource_name:: '.$resource_name);

			$s_no = $this->input->post('s_no');		
			
			$this->db->where('s_no', $s_no);
			$result = $this->db->delete($resource_name);
			return $result ;
			
		}
		
		public function delete_circle_block_gp()
		{
			$selected_resource =  $this->input->post('selected_resource');
			$id = $this->input->post('id');	
			log_message('info','########## id:: '.$id);
			if($selected_resource == "circle")
			{
				$this->db->where('c_s_no', $id);
				$result = $this->db->delete($selected_resource);
			}
			
			if($selected_resource == "block")
			{
				$this->db->where('b_s_no', $id);
				$result = $this->db->delete($selected_resource);
			}
			
			if($selected_resource == "gp")
			{
				$this->db->where('gp_no', $id);
				$result = $this->db->delete($selected_resource);
			}
			
			return $result ;
		}
		
   }
?>