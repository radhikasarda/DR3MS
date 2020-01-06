<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Resource_Report extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('resource_report_model');
			}
			
			
		}
	
		public function index()  
		{  
			$this->load->model('resource_report_model');
			$this->load->library('table');
			
			$userid = $this->session->userdata('userid');
			
			$data_circles['circles'] = $this->resource_report_model->get_circles($userid)->result(); 
			$data_circles['resources'] = $this->resource_report_model->get_resources_names()->result();
			
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			
			$data = array_merge($data_circles,$data_last_login);
		
			$this->load->view('resource_report_view',$data);
 
		}
	
		//For filling combobox
		public function get_blocks()
		{
			if($this->input->post('circle_id'))
			{
				log_message('info','##########INSIDE get_blocks FUNC::');
				$selected_circle = $this->input->post('circle_id');			
				echo $this->resource_report_model->get_blocks($selected_circle);
			}

		}
		
		//For filling combobox
		public function get_gp()
		{
			if($this->input->post('block_id'))
			{
				log_message('info','##########INSIDE get_gp FUNC::');
				$selected_block = $this->input->post('block_id');
				echo $this->resource_report_model->get_gp($selected_block);
			}
		}
		
		public function onClickSubmit()
		{
			log_message('info','##########INSIDE SUBMIT FUNC::');
			$data_report_circlewise = $this->resource_report_model->get_report_data(); 
			$data_report_view = $this->load->view('data_resource_report_view.php',$data_report_circlewise,TRUE);
			echo $data_report_view;
				
		}
		
		public function onRowClick()
		{
			$actual_resource_name = $this->input->post('resource');
			$row_detailed_info = $this->resource_report_model->get_row_detailed_info();
			
			if($actual_resource_name == 'Assets')
			{
			$detailed_info_view = $this->load->view('assets_detailed_info_view.php',$row_detailed_info,TRUE);
			}
			else if($actual_resource_name == 'Community hall')
			{
			$detailed_info_view = $this->load->view('community_hall_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Population')
			{
			$detailed_info_view = $this->load->view('demographic_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Embankment')
			{
			$detailed_info_view = $this->load->view('embankment_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'HandPump and Ring Wells')
			{
			$detailed_info_view = $this->load->view('handPump_ringwell_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Health Centre')
			{
			$detailed_info_view = $this->load->view('health_centre_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Inaccessible Area')
			{
			$detailed_info_view = $this->load->view('inaccessible_area_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Institutions')
			{
			$detailed_info_view = $this->load->view('institutions_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Raised Platform')
			{
			$detailed_info_view = $this->load->view('raised_platform_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Relif Camp')
			{
			$detailed_info_view = $this->load->view('relif_camp_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Task Force Commitee Members')
			{
			$detailed_info_view = $this->load->view('task_force_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Telecommunication')
			{
			$detailed_info_view = $this->load->view('telecommunication_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Vulnerable Village')
			{
			$detailed_info_view = $this->load->view('vul_village_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Vulnerable Roads, Culvert and Bridges')
			{
			$detailed_info_view = $this->load->view('vul_roads_culvert_bridge_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			echo $detailed_info_view;
		}
	}  
?> 