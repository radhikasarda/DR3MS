<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class District extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			$this->load->library('session');
			$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			$this->output->set_header('Pragma: no-cache');
			$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
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
			log_message('info','##########Loading Login Controller getSelelctedDistrict() FUNCTION');
			
			$selected_district = $this->input->post('districts');
			log_message('info','##########Loading Login Controller getSelelctedDistrict() FUNCTION:: SELECTED DISTRICT:: '.$selected_district);
			
			$database_name = "database_".$selected_district;
			log_message('info','##########Loading Login Controller getSelelctedDistrict() FUNCTION:: database_name:: '.$database_name);
			
			//$this->login_model->set_dbValue($database_name);
			$this->session->set_userdata('database_name', $database_name);
			
			$this->load->model('login_model');
			$data['selected_district'] = $selected_district;
			$data['users'] = $this->login_model->get_users();
			$this->load->view('login_view',$data);

		}
	}
?>