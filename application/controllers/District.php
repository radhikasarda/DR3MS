<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class District extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			$this->load->model('district_model');
		}
		
		
		public function index() 
		{  
			log_message('info','##########Loading District Controller INDEX FUNCTION');
			$data['districts'] = $this->district_model->get_districts();
			$this->load->view('index_view',$data);			
		}
		
		public function getSelelctedDistrict()
		{
			log_message('info','##########Loading District Controller getSelelctedDistrict() FUNCTION');
			
			$selected_district = $this->input->post('districts');
			log_message('info','##########Loading District Controller getSelelctedDistrict() FUNCTION:: SELECTED DISTRICT:: '.$selected_district);
			
			$database_name = "database_".$selected_district;
			log_message('info','##########Loading District Controller getSelelctedDistrict() FUNCTION:: database_name:: '.$database_name);
			
			$this->session->set_userdata('database_name', $database_name);
			$this->session->set_userdata('selected_district', $selected_district);
			
			$this->loadCommonDashboard();
		}
		
		
		public function loadCommonDashboard()
		{
			log_message('info','##########loadCommonDashboard');
			$selected_district = $this->session->userdata('selected_district');
			$data['selected_district'] = $selected_district;
			$data_chart = $this->district_model->get_resources_data();	
			$data['total_incidents'] =  $this->district_model->get_total_incidents();	
			$data_total_assets =  $this->district_model->get_total_assets();
			$data_total_health_centres =  $this->district_model->get_total_health_centres();
			$data_total_institutions = $this->district_model->get_total_institutions();
			$data_login_view = $this->district_model->getLoginViewData($selected_district);
			$data = array_merge($data_chart,$data,$data_total_assets,$data_total_health_centres,$data_total_institutions,$data_login_view);
			$this->load->view('common_dashboard_view',$data);
		}
	}
?>