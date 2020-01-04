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
			else if($actual_resource_name == 'Heath Centre')
			{
			$detailed_info_view = $this->load->view('master_data_heath_centre_detail_update_delete_view.php',$row_detailed_info,TRUE);	
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
   }
?>