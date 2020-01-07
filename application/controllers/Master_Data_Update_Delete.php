<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Master_Data_Update_Delete extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('master_data_update_delete_model');
			}
			
			
		}
	
		public function index()  
		{ 
			
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
				
			$this->load->model('resource_report_model');
			$data_resources['resources'] = $this->resource_report_model->get_resources_names()->result();
			
			$userid = $this->session->userdata('userid');		
			$data_resources['circles'] = $this->resource_report_model->get_circles($userid)->result(); 
			
			$data = array_merge($data_resources,$data_last_login);
			$this->load->view('master_data_update_delete_view',$data);
			
		}
		
		public function onClickSubmitArea()
		{
			$this->load->model('master_data_model');
			log_message('info','##########INSIDE onClickSubmitArea FUNC::');
			$data_item_details = $this->master_data_model->get_item_details(); 
			
			$selected_item = $this->input->post('resource_id');	
			log_message('info','##########INSIDE onClickSubmitArea FUNC::selected_item::'.$selected_item);
			$data_item_details_view = null;
			
			if($selected_item == "circle")
			{
				$data_item_details_view = $this->load->view('master_data_circle_detail_update_delete_view.php',$data_item_details,TRUE);
			}
			if($selected_item == "block")
			{
				$data_item_details_view = $this->load->view('master_data_block_detail_update_delete_view.php',$data_item_details,TRUE);
			}
			if($selected_item == "gp")
			{
				$data_item_details_view = $this->load->view('master_data_gp_detail_update_delete_view.php',$data_item_details,TRUE);
			}
			
			echo $data_item_details_view;
		}
		
		public function getItemDetails()
		{
			$data_item_details = $this->master_data_update_delete_model->get_item_details(); 
			
			$selected_item = $this->input->post('selected_item');	
			
			$data_item_details_view = null;
			
			if($selected_item == "circle")
			{
				$data_item_details_view = $this->load->view('master_data_circle_edit_view.php',$data_item_details,TRUE);
			}
			if($selected_item == "block")
			{
				$data_item_details_view = $this->load->view('master_data_block_edit_view.php',$data_item_details,TRUE);
			}
			if($selected_item == "gp")
			{
				$data_item_details_view = $this->load->view('master_data_gp_edit_view.php',$data_item_details,TRUE);
			}
			
			echo $data_item_details_view;
		}
		
		public function onClickUpdateCircleData()
		{
			log_message('info','##########INSIDE onClickUpdateCircleData FUNC::');
			$response = $this->master_data_update_delete_model->update_circle_data();
			echo $response;	
		}
		
		public function onClickUpdateBlockData()
		{
			log_message('info','##########INSIDE onClickUpdateBlockData FUNC::');
			$response = $this->master_data_update_delete_model->update_block_data();
			echo $response;	
		}
		
		public function onClickUpdateGpData()
		{
			log_message('info','##########INSIDE onClickUpdateGpData FUNC::');
			$response = $this->master_data_update_delete_model->update_gp_data();
			echo $response;
		}
		
		//For filling combobox
		public function get_blocks()
		{
			if($this->input->post('circle_id'))
			{
				log_message('info','##########INSIDE get_blocks FUNC::');
				$selected_circle = $this->input->post('circle_id');			
				echo $this->master_data_update_delete_model->get_blocks($selected_circle);
			}

		}
		//For filling combobox
		public function get_gp()
		{
			if($this->input->post('block_id'))
			{
				log_message('info','##########INSIDE get_gp FUNC::');
				$selected_block = $this->input->post('block_id');
				echo $this->master_data_update_delete_model->get_gp($selected_block);
			}
		}
		public function onClickSubmitCategory()
		{
			log_message('info','##########INSIDE onClickSubmitCategory FUNC::');
			$this->load->model('resource_report_model');
			$actual_resource_name = $this->input->post('resource');
			$row_detailed_info = $this->resource_report_model->get_row_detailed_info();
			
			if($actual_resource_name == 'Assets')
			{
			$detailed_info_view = $this->load->view('master_data_assets_detail_update_delete_view.php',$row_detailed_info,TRUE);
			}
			else if($actual_resource_name == 'Community hall')
			{
			$detailed_info_view = $this->load->view('master_data_community_hall_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Population')
			{
			$detailed_info_view = $this->load->view('master_data_demographic_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Embankment')
			{
			$detailed_info_view = $this->load->view('master_data_embankment_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'HandPump and Ring Wells')
			{
			$detailed_info_view = $this->load->view('master_data_handPump_ringwell_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Health Centre')
			{
			$detailed_info_view = $this->load->view('master_data_health_centre_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Inaccessible Area')
			{
			$detailed_info_view = $this->load->view('master_data_inaccessible_area_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Institutions')
			{
			$detailed_info_view = $this->load->view('master_data_institutions_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Raised Platform')
			{
			$detailed_info_view = $this->load->view('master_data_raised_platform_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Relif Camp')
			{
			$detailed_info_view = $this->load->view('master_data_relif_camp_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Task Force Commitee Members')
			{
			$detailed_info_view = $this->load->view('master_data_task_force_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Telecommunication')
			{
			$detailed_info_view = $this->load->view('master_data_telecommunication_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Vulnerable Village')
			{
			$detailed_info_view = $this->load->view('master_data_vul_village_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Vulnerable Roads, Culvert and Bridges')
			{
			$detailed_info_view = $this->load->view('master_data_vul_roads_culvert_bridge_detail_update_delete_view.php',$row_detailed_info,TRUE);	
			}
			echo $detailed_info_view;
				
		}
		
		public function OnClickResourceEdit()
		{
			log_message('info','##########INSIDE OnClickResourceEdit FUNC::');
			$this->load->model('resource_report_model');
			
			$data_resource_details = $this->master_data_update_delete_model->get_resource_details(); 
			
			$userid = $this->session->userdata('userid');		
			$data_resources['circles'] = $this->resource_report_model->get_circles($userid)->result(); 
			
			$selected_gp =  $this->input->post('selected_gp');	
			$selected_block =  $this->input->post('selected_block');	
			$selected_circle =  $this->input->post('selected_circle');	
			
			$data['selected_gp'] = $selected_gp;

			$data['selected_block'] = $selected_block;

			$data['selected_circle'] = $selected_circle;

			$data = array_merge($data_resource_details,$data_resources,$data);
			
			$selected_item = $this->input->post('selected_item');	
			
			$data_resource_details_view = null;
			
			if($selected_item == "Assets")
			{
				$data_resource_details_view = $this->load->view('master_data_assets_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Community hall")
			{
				$data_resource_details_view = $this->load->view('master_data_community_hall_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Population")
			{
				$data_resource_details_view = $this->load->view('master_data_population_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Embankment")
			{
				$data_resource_details_view = $this->load->view('master_data_embankment_edit_view.php',$data,TRUE);
			}
			if($selected_item == "HandPump and Ring Wells")
			{
				$data_resource_details_view = $this->load->view('master_data_handPump_ringwell_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Health Centre")
			{
				$data_resource_details_view = $this->load->view('master_data_health_centre_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Inaccessible Area")
			{
				$data_resource_details_view = $this->load->view('master_data_inaccessible_area_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Institutions")
			{
				$data_resource_details_view = $this->load->view('master_data_institutions_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Raised Platform")
			{
				$data_resource_details_view = $this->load->view('master_data_raised_platform_edit_view.php',$data,TRUE);
			}
			if($selected_item == 'Relif Camp')
			{
				$data_resource_details_view = $this->load->view('master_data_relif_camp_edit_view.php',$data,TRUE);	
			}
			if($selected_item == "Task Force Commitee Members")
			{
				$data_resource_details_view = $this->load->view('master_data_task_force_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Telecommunication")
			{
				$data_resource_details_view = $this->load->view('master_data_telecommunication_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Vulnerable Village")
			{
				$data_resource_details_view = $this->load->view('master_data_vul_village_edit_view.php',$data,TRUE);
			}
			if($selected_item == "Vulnerable Roads, Culvert and Bridges")
			{
				$data_resource_details_view = $this->load->view('master_data_vul_roads_culvert_bridge_edit_view.php',$data,TRUE);
			}
			
			echo $data_resource_details_view;
		}
		
		public function onClickUpdateAssetsData()
		{
			log_message('info','##########INSIDE onClickUpdateAssetsData FUNC::');
			$response = $this->master_data_update_delete_model->update_assets_data();
			echo $response;	
		}
		
		public function onClickUpdateCommunityHallData()
		{
			log_message('info','##########INSIDE onClickUpdateCommunityHallData FUNC::');
			$response = $this->master_data_update_delete_model->update_community_hall_data();
			echo $response;	
		}
		
		public function onClickUpdateDemographicData()
		{
			log_message('info','##########INSIDE onClickUpdatePopulationData FUNC::');
			$response = $this->master_data_update_delete_model->update_demographic_data();
			echo $response;	
		}
		
		public function onClickUpdateEmbankmentData()
		{
			log_message('info','##########INSIDE onClickUpdateEmbankmentData FUNC::');
			$response = $this->master_data_update_delete_model->update_embankment_data();
			echo $response;	
		}
		
		public function onClickUpdateHandPumpRingWellData()
		{
			log_message('info','##########INSIDE onClickUpdateHandPumpRingWellData FUNC::');
			$response = $this->master_data_update_delete_model->update_hand_pump_ring_well_data();
			echo $response;	
		}
		
		public function onClickUpdateHealthCentreData()
		{
			log_message('info','##########INSIDE onClickUpdateHealthCentreData FUNC::');
			$response = $this->master_data_update_delete_model->update_health_centre_data();
			echo $response;	
		}
		
		
		public function onClickUpdateInaccessibleData()
		{
			log_message('info','##########INSIDE onClickUpdateInaccessibleData FUNC::');
			$response = $this->master_data_update_delete_model->update_inaccessible_data();
			echo $response;	
		}
				
		public function onClickUpdateInstitutionData()
		{
			log_message('info','##########INSIDE onClickUpdateInstitutionData FUNC::');
			$response = $this->master_data_update_delete_model->update_institution_data();
			echo $response;	
		}
		
		
		public function onClickUpdateRaisedPlatformData()
		{
			log_message('info','##########INSIDE onClickUpdateRaisedPlatformData FUNC::');
			$response = $this->master_data_update_delete_model->update_raised_platform_data();
			echo $response;	
		}
		
		
		public function onClickUpdateRelifCampData()
		{
			log_message('info','##########INSIDE onClickUpdateRelifCampData FUNC::');
			$response = $this->master_data_update_delete_model->update_relif_camp_data();
			echo $response;	
		}
		
		
		public function onClickUpdateTaskForceData()
		{
			log_message('info','##########INSIDE onClickUpdateTaskForceData FUNC::');
			$response = $this->master_data_update_delete_model->update_task_force_data();
			echo $response;	
		}
		
		public function onClickUpdateTelecommunicationData()
		{
			log_message('info','##########INSIDE onClickUpdateTelecommunicationData FUNC::');
			$response = $this->master_data_update_delete_model->update_telecommunication_data();
			echo $response;	
		}
		
		public function onClickUpdateVulRoadCulvertBridgeData()
		{
			log_message('info','##########INSIDE onClickUpdateVulRoadCulvertBridgeData FUNC::');
			$response = $this->master_data_update_delete_model->update_vul_road_cul_bridge_data();
			echo $response;	
		}
		
		
		public function onClickUpdateVulVillageData()
		{
			log_message('info','##########INSIDE onClickUpdateVulVillageData FUNC::');
			$response = $this->master_data_update_delete_model->update_vul_village_data();
			echo $response;	
		}
   }
?>