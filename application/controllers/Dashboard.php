<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Dashboard extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('dashboard_model');
			}
			
		}
	
		public function index()  
		{  
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
					
			$this->load->library('table');
						
			$data_chart = $this->dashboard_model->get_resources_data();			
								
			//Load numeric resources data
			$data_resources = $this->dashboard_model->get_resources_data_numeric();
			
			//Load inbox messages data
			$data_inbox = $this->dashboard_model->get_inbox_messages();
			
			//Get last Login time of current user
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			$this->load->model('incident_model');
			$data_all_incidents = $this->incident_model->get_all_incidents();  
			
			$data = array_merge($data_chart,$data_resources,$data_inbox,$data_last_login,$data_all_incidents);
					
			//Load DashBoard view
			$this->load->view('dashboard_view_admin',$data);
 
			}
		}
	
		public function viewUserInfo()
		{
			//Get users info
			$this->load->library('table');
			$data_user = $this->dashboard_model->get_user_data();
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			$data = array_merge($data_last_login,$data_user);
			$this->load->view('user_info_view',$data);
			
		}
		
		
		public function viewRegisteredCitizens()
		{
			//Get users info
			$this->load->library('table');
			$data_registered_citizens = $this->dashboard_model->get_registered_citizens_data();
			
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			$data = array_merge($data_last_login,$data_registered_citizens);
			$this->load->view('registered_citizens_view',$data);
		}
		
	}  
?> 