<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Master_Data extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('master_data_model');
			}
			
			
		}
	
		public function index()  
		{  
			$this->load->model('resource_report_model');

			$data_circles['resources'] = $this->resource_report_model->get_resources_names()->result();
			
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			
			$data = array_merge($data_circles,$data_last_login);
		
			$this->load->view('master_data_entry_view',$data);
 
		}
		public function getItemDetails()
		{
			log_message('info','##########INSIDE getItemDetails FUNC::');
			$data_item_details = $this->master_data_model->get_item_details(); 
			
			$selected_resource = $this->input->post('resource_id');	
			
			$data_item_details_view = null;
			
			if($selected_resource == "circle")
			{
				$data_item_details_view = $this->load->view('master_data_entry_circle_detail_view.php',$data_item_details,TRUE);
			}
			if($selected_resource == "block")
			{
				$data_item_details_view = $this->load->view('master_data_entry_block_detail_view.php',$data_item_details,TRUE);
			}
			if($selected_resource == "gp")
			{
				$data_item_details_view = $this->load->view('master_data_entry_gp_detail_view.php',$data_item_details,TRUE);
			}
			
			echo $data_item_details_view;
		}
		
		public function onClickAddMoreData()
		{
			$selected_resource = $this->input->post('resource_id');	
			$data_master_data_entry_form_view = null;
			
			if($selected_resource == "circle")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_circle_view.php',$selected_resource,TRUE);
				
			}
			if($selected_resource == "block")
			{
				$this->load->model('incident_model');
				$data_circles['circles'] = $this->incident_model->get_circles()->result(); 
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_block_view.php',$data_circles,TRUE);
				
			}
			if($selected_resource == "gp")
			{
				$this->load->model('incident_model');
				$data_circles['circles'] = $this->incident_model->get_circles()->result(); 
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_gp_view.php',$data_circles,TRUE);				
			}
			echo $data_master_data_entry_form_view;
		}
		
		public function onClickSubmit()
		{
			log_message('info','##########INSIDE SUBMIT FUNC::');
			$this->load->model('incident_model');
			$data_circles['circles'] = $this->incident_model->get_circles()->result(); 
			
			$resource_table_name = $this->master_data_model->get_master_data_entry_form_data(); 
			
			$data_master_data_entry_form_view = null; 
						
			if($resource_table_name == "assets")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_assets_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "community_hall")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_community_hall_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "demographic_and_socio_eco")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_demographic_and_socio_eco_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "embankment")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_embankment_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "hand_pump_ring_well")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_hand_pump_ring_well_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "health_centre")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_health_centre_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "inaccessible")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_inaccessible_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "institution")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_institution_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "raised_platform")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_raised_platform_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "relif_camp")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_relif_camp_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "task_force_committee")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_task_force_committee_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "telecommunication")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_telecommunication_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "vulnerable_village")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_vulnerable_village_view.php',$data_circles,TRUE);
				
			}
			if($resource_table_name == "vul_roads_culvert_bridge")
			{
				$data_master_data_entry_form_view = $this->load->view('master_data_entry_vul_roads_culvert_bridge_view.php',$data_circles,TRUE);
				
			}
			echo $data_master_data_entry_form_view;
		}
		
		public function onClickAddCircleData()
		{
			log_message('info','##########INSIDE onClickAddCircleData FUNC::');
			$response = $this->master_data_model->add_circle_data();
			echo $response;	
		}
		
		public function onClickAddBlockData()
		{
			log_message('info','##########INSIDE onClickAddBlockData FUNC::');
			$response = $this->master_data_model->add_block_data();
			echo $response;	
		}
		
		public function onClickAddGpData()
		{
			log_message('info','##########INSIDE onClickAddGpData FUNC::');
			$response = $this->master_data_model->add_gp_data();
			echo $response;	
		}
		
		public function onClickAddAssetsData()
		{
			log_message('info','##########INSIDE onClickAddAssetsData FUNC::');
			$response = $this->master_data_model->add_assets_data();
			echo $response;			
		}
		
		public function onClickAddCommunityHallData()
		{
			log_message('info','##########INSIDE onClickAddCommunityHallData FUNC::');
			$response = $this->master_data_model->add_community_hall_data();
			echo $response;			
		}
		
		public function onClickAddDemographicData()
		{
			log_message('info','##########INSIDE onClickAddDemographicData FUNC::');
			$response = $this->master_data_model->add_demographic_data();
			echo $response;	
		}
		
		public function onClickAddEmbankmentData()
		{
			log_message('info','##########INSIDE onClickAddEmbankmentData FUNC::');
			$response = $this->master_data_model->add_embankment_data();
			echo $response;	
		}
		
		public function onClickAddHandPumpRingWellData()
		{
			log_message('info','##########INSIDE onClickAddHandPumpRingWellData FUNC::');
			$response = $this->master_data_model->add_hand_pump_ring_well_data();
			echo $response;	
		}
		
		public function onClickAddHealthCentreData()
		{
			log_message('info','##########INSIDE onClickAddHealthCentreData FUNC::');
			$response = $this->master_data_model->add_health_centre_data();
			echo $response;	
		}
		
		public function onClickAddInaccessibleData()
		{
			log_message('info','##########INSIDE onClickAddInaccessibleData FUNC::');
			$response = $this->master_data_model->add_inaccessible_data();
			echo $response;	
		}
		
		public function onClickAddInstitutionData()
		{
			log_message('info','##########INSIDE onClickAddInstitutionData FUNC::');
			$response = $this->master_data_model->add_institution_data();
			echo $response;	
		}
		
		public function onClickAddRaisedPlatformData()
		{
			log_message('info','##########INSIDE onClickAddRaisedPlatformData FUNC::');
			$response = $this->master_data_model->add_raised_platform_data();
			echo $response;	
		}
		
		public function onClickAddRelifCampData()
		{
			log_message('info','##########INSIDE onClickAddRelifCampData FUNC::');
			$response = $this->master_data_model->add_relif_camp_data();
			echo $response;
		}	

		public function onClickAddTaskForceData()
		{
			log_message('info','##########INSIDE onClickAddTaskForceData FUNC::');
			$response = $this->master_data_model->add_task_force_data();
			echo $response;
		}

		public function onClickAddTelecommunicationData()
		{
			log_message('info','##########INSIDE onClickAddTelecommunicationData FUNC::');
			$response = $this->master_data_model->add_telecommunication_data();
			echo $response;
		}
		
		public function onClickAddVulRoadCulvertBridgeData()
		{
			log_message('info','##########INSIDE onClickAddVulRoadCulvertBridgeData FUNC::');
			$response = $this->master_data_model->add_vul_road_cul_bridge_data();
			echo $response;
		}
		
		public function onClickAddVulVillageData()
		{
			log_message('info','##########INSIDE onClickAddVulVillageData FUNC::');
			$response = $this->master_data_model->add_vul_village_data();
			echo $response;
		}
   }
?>