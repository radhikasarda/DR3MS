<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Incident_Report extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			$this->load->model('incident_report_model');
			
		}
	
		public function index()  
		{  
			$this->load->model('incident_report_model');
			
			$this->load->library('table');
			
			$userid = $this->session->userdata('userid');
			
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			$this->load->model('resource_report_model');
			$data_circles['circles'] = $this->resource_report_model->get_circles($userid)->result();
			
			$data = array_merge($data_circles,$data_last_login);
			
			$this->load->view('incident_report_view',$data);
		}
		
		public function onClickSubmit()
		{
			$data_incident_report_circlewise = $this->incident_report_model->get_incident_report_data(); 
			$data_incident_report_view = $this->load->view('data_incident_report_view.php',$data_incident_report_circlewise,TRUE);
			echo $data_incident_report_view;
		}
		public function onRowClick()
		{
			$row_detailed_info = $this->incident_report_model->get_row_detailed_info();
			$detailed_info_view = $this->load->view('incident_report_detailed_view.php',$row_detailed_info,TRUE);
			echo $detailed_info_view;
		}
   }
   
?>