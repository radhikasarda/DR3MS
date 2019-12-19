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
			
		}
	
		public function index()  
		{  
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}else{
			
			$this->load->model('dashboard_model');
			$this->load->library('table');
			
						
			
			$data_chart = $this->dashboard_model->get_resources_data();
			
			
			//Get users info
			$data_user = $this->dashboard_model->get_user_data();
						
			//Load numeric resources data
			$data_resources = $this->dashboard_model->get_resources_data_numeric();
			
			//Load inbox messages data
			$data_inbox = $this->dashboard_model->get_inbox_messages();
			
			//Get last Login time of current user
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			$data = array_merge($data_chart, $data_user,$data_resources,$data_inbox,$data_last_login);
					
			//Load DashBoard view
			$this->load->view('dashboard_view_admin',$data);
 
			}
		}
	
		
	}  
?> 