<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Incident extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			$this->load->model('incident_model');
			
		}
	
		public function index()  
		{  
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			$this->load->model('resource_report_model');
			$userid = $this->session->userdata('userid');
			$data_circles['circles'] = $this->resource_report_model->get_circles($userid)->result(); 
			
			$data = array_merge($data_last_login,$data_circles);
			$this->load->view('incident_view',$data);
		}
   }
?>