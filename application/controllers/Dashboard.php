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
			
			$this->load->library('table');
			$start = 1;
			$records_per_page = 10;
			$total_rows = $this->dashboard_model->num_rows();
			log_message('info','##########INSIDE viewRegisteredCitizens FUNC::total_rows :: '.$total_rows);
			if($total_rows == 0)
			{
				$data['noData'] = 1;
				$this->load->view('no_data_view.php',$data,TRUE);	
			}
			
			else
			{
				if (isset($_POST["submitForm"]))
				{
					$formSubmit = $this->input->post('submitForm');
					$last_end = $this->input->post('last_end');
					$last_start = $this->input->post('last_start');
					if( $formSubmit == 'next' )
					{
						if($last_end != null)
						{				
							$start = $last_end + 1 ;				
						}
						log_message('info','##########INSIDE viewRegisteredCitizens FUNC::start:: '.$start);
				
						if($total_rows < $start && $last_start != null)
						{
							$start = $last_start;
							log_message('info','##########INSIDE viewRegisteredCitizens FUNC::last_start:: '.$start);					
						}
					}
					
					if($formSubmit == 'prev' )
					{
						log_message('info','##########INSIDE viewRegisteredCitizens FUNC::Prev button clicked :: ');
						if($last_start != null && $last_start > $records_per_page)
						{				
							$start = $last_start - $records_per_page ;				
						}
						log_message('info','##########INSIDE viewRegisteredCitizens FUNC::start:: '.$start);
						
						if($last_end != null)
						{
							$end = $last_start - 1;
							log_message('info','##########INSIDE viewRegisteredCitizens FUNC::last_start:: '.$start);					
						}
					}
				}
			
			
			
				$data['citizen'] = $this->dashboard_model->get_registered_citizens_data($start,$records_per_page);
				$data["start"] = $start;
				$data["end"] = $start+$records_per_page - 1;
				$data["total_records"] = $total_rows;
				
				$data_last_login = $this->dashboard_model->get_last_login_time();
			
				$data = array_merge($data_last_login,$data);
				$this->load->view('registered_citizens_view',$data);
			}
			
			
		}

	}  
?> 