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
			
			$data_circles['circles'] = $this->incident_model->get_circles()->result(); 
			
			$data = array_merge($data_last_login,$data_circles);
			$this->load->view('incident_view',$data);
		}
		
		//For filling combobox
		public function get_blocks()
		{
			if($this->input->post('circle_id'))
			{
				log_message('info','##########INSIDE get_blocks FUNC::');
				$selected_circle = $this->input->post('circle_id');			
				echo $this->incident_model->get_blocks($selected_circle);
			}

		}
		
		//For filling combobox
		public function get_gp()
		{
			if($this->input->post('block_id'))
			{
				log_message('info','##########INSIDE get_gp FUNC::');
				$selected_block = $this->input->post('block_id');
				echo $this->incident_model->get_gp($selected_block);
			}
		}
		
		public function sendIncidentReport()
		{
			$result = $this->incident_model->send_incident_report();
			echo $result;
		}
		
		public function uploadImage()
		{
			log_message('info','##########INSIDE uploadImage FUNC::');
			$result = $this->incident_model->upload_image_to_server();
		}
		
		public function viewIncidents()
		{
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			$data_all_incidents = $this->incident_model->get_all_incidents(); 
			
			$data = array_merge($data_last_login,$data_all_incidents);
			$this->load->view('all_incidents_view',$data);
		}
		
		public function OnClickViewIncidentDetailsClick()
		{
			log_message('info','##########INSIDE OnClickViewIncidentDetailsClick FUNC::');
			$data_incident_details = $this->incident_model->get_incident_details(); 	
			$data_incident_details_view = $this->load->view('data_incident_details_view',$data_incident_details,TRUE);
			echo $data_incident_details_view;
		}
   }
?>