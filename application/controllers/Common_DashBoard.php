<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class Common_DashBoard extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			$this->load->model('common_dashboard_model');
		}
		
		
		public function index() 
		{  
				
		}
		public function loadCitizenRegistration()
		{
						
			$contact_no = $this->session->userdata('contact');	
			log_message('info','##########contact_no '.$contact_no);
			$this->load->library('session');			
			$this->session->set_userdata('entrance', TRUE);
			$user_exist = 0;
			$user_exist = $this->check_user_exist($contact_no,$user_exist);
			log_message('info','##########user_exist '.$user_exist);	
			if($user_exist == 1)
			{
				$this->session->set_userdata('user_exist', TRUE);
			}else
			{
				$this->session->set_userdata('user_exist', FALSE);
			}
				
			$user_exist_session = $this->session->userdata('user_exist');
			log_message('info','########## user_exist_session'.$user_exist_session);				
				
			$this->load_citizen_registration_view();					
			
		}
		
		public function check_user_exist($contact_no,$user_exist)
		{
			$user_exist = $this->common_dashboard_model->check_user_exist($contact_no,$user_exist);
			return $user_exist;
		}
		
		public function load_citizen_registration_view()
		{
			log_message('info','########## inside load_citizen_registration_view');
			$this->load->model('citizen_model');	
			$user_exist = $this->session->userdata('user_exist');
			$contact_no = $this->session->userdata('contact');	
			if($user_exist == 1)
			{
				$data['reg_user_info'] = $this->common_dashboard_model->get_reg_user_info($contact_no);		
			}
			$data['circles'] = $this->citizen_model->get_circles(); 		
					
			$data['user_exist'] = $user_exist;
					
			$this->load->view('citizen_registration_view',$data);
					
		}
		
		public function loadGuestReportView()
		{
						
			$contact_no = $this->session->userdata('contact');	
			log_message('info','##########contact_no '.$contact_no);
			$this->load->library('session');			
			$this->session->set_userdata('entrance', TRUE);
			$user_exist = 0;
			$user_exist = $this->check_user_exist($contact_no,$user_exist);
			log_message('info','##########user_exist '.$user_exist);	
			if($user_exist == 1)
			{
				$this->session->set_userdata('user_exist', TRUE);
			}else
			{
				$this->session->set_userdata('user_exist', FALSE);
			}
				
			$user_exist_session = $this->session->userdata('user_exist');
			log_message('info','########## user_exist_session'.$user_exist_session);				
				
			$this->load_guest_report_view();					
			
		}
		
		public function load_guest_report_view()
		{
			$user_exist = $this->session->userdata('user_exist');
			$contact_no = $this->session->userdata('contact');				
			if($user_exist == 1)
			{
				$data['reg_user_info'] = $this->common_dashboard_model->get_reg_user_info($contact_no);		
			}
			$this->load->model('guest_model');	
			$data['circles'] = $this->guest_model->get_circles(); 
			$data['user_exist'] = $user_exist;			
			$this->load->view('guest_report_view',$data);
		}
		
		public function updateContactNo()
		{
			$contact_no = $this->input->post('contact_no');	
			log_message('info','##########contact_no '.$contact_no);
			$result = $this->common_dashboard_model->update_contact_no($contact_no);
			echo $result;
		}
		
		public function generateOtp()
		{
			$contact_no = $this->input->post('contact_no');
			$this->session->set_userdata('contact', $contact_no); 
			
			log_message('info','##########INSIDE getOtp FUNC::contact_no:: '.$contact_no);
			$otp = rand(100000,999999);
			log_message('info','##########INSIDE getOtp FUNC::otp:: '.$otp);			
			echo $otp;
		}
		
		public function validateCitizenPreviousDetails()
		{
			$contact_no = $this->input->post('contact_no');	
			$citizen_name = $this->input->post('name');	
			$citizen_father_name = $this->input->post('father_name');	
			
			log_message('info','##########contact_no '.$contact_no);			
			$user_exist = 0;
			$user_exist = $this->common_dashboard_model->validateCitizenPreviousDetails($contact_no,$citizen_name,$citizen_father_name,$user_exist);
			log_message('info','##########user_exist '.$user_exist);	
			if($user_exist == 1)
			{
				$this->session->set_userdata('contact', $contact_no); 
			}
			echo $user_exist;
		}
		
			
		
		/*For citiozens who have summited the report and then registering them*/
		public function loadCitizenRegistrationViewGuest()
		{
			$this->load->model('citizen_model');	
			$contact_no = $this->session->userdata('contact');
			$data['circles'] = $this->citizen_model->get_circles(); 		
					
			$data['user_exist'] = 0;
					
			echo $this->load->view('citizen_registration_view',$data,TRUE);
		}
		
		public function viewIncidents()
		{
			$start = 1;
			$records_per_page = 10;
			$total_rows = $this->common_dashboard_model->num_incidents();
			log_message('info','##########INSIDE viewIncidents FUNC::total_rows :: '.$total_rows);
			if($total_rows == 0)
			{
				log_message('info','##########INSIDE if total rows = 0 :: ');
				$data['noData'] = 1;
			}
			
			else
			{
				log_message('info','##########INSIDE if total rows not = 0 :: ');
				if (isset($_POST["submitForm"]))
				{
					log_message('info','##########INSIDE isset submitform :: ');
					
					$formSubmit = $this->input->post('submitForm');
					$last_end = $this->input->post('last_end');
					$last_start = $this->input->post('last_start');
					log_message('info','##########INSIDE viewIncidents FUNC::last_end:: '.$last_end);
					log_message('info','##########INSIDE viewIncidents FUNC::last_start:: '.$last_start);
					
					if( $formSubmit == 'next' )
					{
						if($last_end != null)
						{				
							$start = $last_end + 1 ;				
						}
						log_message('info','##########INSIDE viewIncidents FUNC::start:: '.$start);
				
						if($total_rows < $start && $last_start != null)
						{
							$start = $last_start;
							log_message('info','##########INSIDE viewIncidents FUNC::last_start:: '.$start);					
						}
					}
					
					if($formSubmit == 'prev' )
					{
						log_message('info','##########INSIDE viewIncidents FUNC::Prev button clicked :: ');
						if($last_start != null && $last_start > $records_per_page)
						{				
							$start = $last_start - $records_per_page ;				
						}
						log_message('info','##########INSIDE viewIncidents FUNC::start:: '.$start);
						
						if($last_end != null)
						{
							$end = $last_start - 1;
							log_message('info','##########INSIDE viewIncidents FUNC::last_start:: '.$start);					
						}
					}
				}
				$data['incident'] = $this->common_dashboard_model->get_all_incidents($start,$records_per_page);
				$data["start"] = $start;
				$data["end"] = $start+$records_per_page - 1;
				$data["total_records"] = $total_rows;
				$data['noData'] = 0;
			}	
			
			$this->load->view('citizen_all_incidents_view',$data);
				
			
		}
		
		public function OnClickViewIncidentDetails()
		{
			log_message('info','##########INSIDE OnClickViewIncidentDetails FUNC::');
			$data_incident_details = $this->common_dashboard_model->get_incident_details(); 	
			$data_incident_details_view = $this->load->view('data_incident_details_view',$data_incident_details,TRUE);
			echo $data_incident_details_view;
		}
		
		
		
		public function viewAssetsReport()
		{
			$this->load->library('table');
			
			$data_circles['circles'] = $this->common_dashboard_model->get_circles()->result(); 
		
			$data = array_merge($data_circles);
		
			$this->load->view('citizen_assets_report_view',$data);
		}
		
		//For filling combobox
		public function get_blocks()
		{
			if($this->input->post('circle_id'))
			{
				log_message('info','##########INSIDE get_blocks FUNC::');
				$selected_circle = $this->input->post('circle_id');			
				echo $this->common_dashboard_model->get_blocks($selected_circle);
			}

		}
		
		//For filling combobox
		public function get_gp()
		{
			if($this->input->post('block_id'))
			{
				log_message('info','##########INSIDE get_gp FUNC::');
				$selected_block = $this->input->post('block_id');
				echo $this->common_dashboard_model->get_gp($selected_block);
			}
		}
		
		public function onClickSubmitResource()
		{
			log_message('info','##########INSIDE onClickSubmitResource FUNC::');
			
			$start = 1;
			$no_gp_per_page = 10;
			$last_end = $this->input->post('last_end');
			$last_start = $this->input->post('last_start');
			log_message('info','##########INSIDE onClickSubmitResource FUNC::last_start :: '.$last_start);
			log_message('info','##########INSIDE onClickSubmitResource FUNC::last_end :: '.$last_end);
			
			$target = $this->input->post('target');
			log_message('info','##########INSIDE onClickSubmitResource FUNC::target :: '.$target);
			$total_gp = $this->common_dashboard_model->count_gp(); 
			$total_resource = $this->common_dashboard_model->count_resource_type(); 
			$total_rows = $total_gp * $total_resource;			
			log_message('info','##########INSIDE onClickSubmitResource FUNC::total_rows :: '.$total_rows);
			
			//$no_gp_current_page = $no_gp_per_page;
			if($total_rows == 0)
			{
				$data['noData'] = 1;
				$this->load->view('no_data_view.php',$data,TRUE);
				$data_resource_report_view = $this->load->view('no_data_view.php',$data,TRUE);
				echo $data_resource_report_view;	
			}
			
			else
			{	
				if($target != '')
				{
					if($target > 0)
					{
						log_message('info','##########INSIDE onClickSubmitResource FUNC::Next button clicked :: ');
						if($last_end != null)
						{				
							$start = $last_end + 1 ;				
						}
						log_message('info','##########INSIDE onClickSubmitResource FUNC::start:: '.$start);
				
						if($total_gp <= $last_end && $last_start != null)
						{
							$start = $last_start;
							log_message('info','##########INSIDE onClickSubmitResource FUNC::last_start:: '.$start);
							//$no_gp_current_page = $total_gp-$last_start;						
						}
					}
					else
					{
						log_message('info','##########INSIDE onClickSubmitResource FUNC::Prev button clicked :: ');
						if($last_start != null && $last_start > $no_gp_per_page)
						{				
							$start = $last_start - $no_gp_per_page ;				
						}
						log_message('info','##########INSIDE onClickSubmitResource FUNC::start:: '.$start);
						
						if($last_end != null)
						{
							$end = $last_start - 1;
							log_message('info','##########INSIDE onClickSubmitResource FUNC::last_start:: '.$start);					
						}
					}
				}
				log_message('info','##########INSIDE onClickSubmitResource FUNC::total_rows:: '.$total_rows);
				$data = $this->common_dashboard_model->get_report_data($start,$no_gp_per_page); 
				$data["start"] = $start;
				$data["end"] = $start+$no_gp_per_page - 1;
				$data["total_records"] = $total_rows;
				$data["no_gp_per_page"] = $no_gp_per_page;
				$data["total_gp"] = $total_gp;
				$data_report_view = $this->load->view('data_resource_report_view.php',$data,TRUE);
				echo $data_report_view;	
			}	
		}
		
		public function onRowClick()
		{
			$actual_resource_name = $this->input->post('resource');
			$row_detailed_info = $this->common_dashboard_model->get_row_detailed_info();
			
			if($actual_resource_name == 'Assets')
			{
			$detailed_info_view = $this->load->view('assets_detailed_info_view.php',$row_detailed_info,TRUE);
			}		
			else if($actual_resource_name == 'Health Centre')
			{
			$detailed_info_view = $this->load->view('health_centre_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			else if($actual_resource_name == 'Institutions')
			{
			$detailed_info_view = $this->load->view('institutions_detailed_info_view.php',$row_detailed_info,TRUE);	
			}
			echo $detailed_info_view;
		}
		
		public function viewHealthCentresReport()
		{
			$this->load->library('table');
			
			$data_circles['circles'] = $this->common_dashboard_model->get_circles()->result(); 
			
			$data = array_merge($data_circles);
		
			$this->load->view('citizen_health_centres_report_view',$data);
		}
		
		public function viewInstitutionsReport()
		{
			$this->load->library('table');
			
			$data_circles['circles'] = $this->common_dashboard_model->get_circles()->result(); 
			
			$data = array_merge($data_circles);
		
			$this->load->view('citizen_institutions_report_view',$data);
		}
	}
?>