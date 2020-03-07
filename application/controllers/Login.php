<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class Login extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			$this->load->model('login_model');
		}
		
		
		public function index()  
		{  

			log_message('info','##########Loading Login Controller INDEX FUNCTION');			
			//load login page
			$data['users'] = $this->login_model->get_users();
			$selected_district = $this->session->userdata('selected_district');
			$data['selected_district'] = $selected_district;
			$this->load->view('login_view',$data);
			
 
		}
		
		public function onLogin()
		{

			log_message('info','##########Loading Login Controller  onLogin() FUNCTION');


			$userid = null;
			
			
			$enc_username = $this->input->post('users');
			$enc_password = $this->input->post('password');
			
			log_message('info','##########login_encrypt_INFO_USER '.$enc_username);
			log_message('info','##########login_eNCRYPT_INFO_PASS '.$enc_password);
				
			$key = $this->session->userdata('key_val');
			
			log_message('info','##########KEY '.$key);
			
			
			$username = $this->encryption->decrypt(base64_decode($enc_username), array(
			'cipher' => 'aes-256',
			'mode' => 'cbc',
			'hmac' => FALSE,
			'key' => $key
			));
		
			
			
			$password = $this->encryption->decrypt(base64_decode($enc_password), array(
			'cipher' => 'aes-256',
			'mode' => 'cbc',
			'hmac' => FALSE,
			'key' => $key
			));
			
			$this->session->unset_userdata('key_val');
			log_message('info','##########login_Decrypt_INFO_USER '.$username);
			log_message('info','##########login_Decrypt_INFO_PASS '.$password);
			
			//Update audit trail login attempt
			$this->login_model->update_audit_trail_login_attempt($username);
			
			// Validate the user 
			$userid = $this->login_model->validate($username,$password);
			
			// If user did not validate
			if(is_null($userid)){
			
				log_message('info','##########USER NOT VALIDATED');
			
				$msg = "Invalid Username Or Password";
				$selected_district = $this->session->userdata('selected_district');
				$this->load->model('district_model');			
				$this->district_model->loadLoginView($selected_district);
			}
			// If user did validate 
			else
			{
				log_message('info','##########USER VALIDATED ID:: '.$userid);
				$this->load->library('session');
				$this->session->set_userdata('userid', $userid);
				$this->session->set_userdata('entrance', TRUE);
				
				//Update audit trail login successful
				$this->login_model->update_audit_trail_login_successful($username);
				
				$circle_name  = $this->login_model->get_jurisdiction($userid);
				
				$arraydata = array('circle_name'  => $circle_name);
				
				$this->session->set_userdata($arraydata);

				redirect('/Dashboard');
			}
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
	
		/*public function validateGuestLogin()
		{
			$otp_generated = strval($this->input->post('otp-generated'));
			$otp_entered = strval($this->input->post('otp'));
			log_message('info','##########otp_generated '.$otp_generated);
			log_message('info','##########otp_entered '.$otp_entered);
			
			
			$otp_generated_trim = trim($otp_generated);
			$otp_entered_trim = trim($otp_entered);
			log_message('info','##########otp_generated_trim '.$otp_generated_trim);
			log_message('info','##########otp_entered_trim '.$otp_entered_trim);
			
			if($otp_entered_trim == $otp_generated_trim)
			{
							
				$contact_no = $this->session->userdata('contact');	
				$this->load->library('session');			
				$this->session->set_userdata('entrance', TRUE);
				$user_exist = 0;
				$user_exist = $this->check_user_exist($contact_no,$user_exist);
				
				if($user_exist == 1)
				{
					$this->session->set_userdata('user_exist', TRUE);
				}else
				{
					$this->session->set_userdata('user_exist', FALSE);
				}
				
				$user_exist_session = $this->session->userdata('user_exist');
				log_message('info','########## user_exist_session'.$user_exist_session);				
				

				if($this->session->userdata('citizen_reg_btn_clicked'))
				{
					log_message('info','########## citizen_reg_btn_clicked');
					$this->load_citizen_registration_view();				
					
					
				}else if($this->session->userdata('guest_report_btn_clicked'))
				{
					log_message('info','########## report_as_guest_clicked');
					$this->load_guest_report_view();				
				}
			
			}
			else
			{
				$this->session->set_flashdata('otpError', 'Invalid OTP Entered !!');
				redirect($_SERVER['HTTP_REFERER']);		
			}
			
		}*/
		public function validateCitizenPreviousDetails()
		{
			$contact_no = $this->input->post('contact_no');	
			$citizen_name = $this->input->post('name');	
			$citizen_father_name = $this->input->post('father_name');	
			
			log_message('info','##########contact_no '.$contact_no);			
			$user_exist = 0;
			$user_exist = $this->login_model->validateCitizenPreviousDetails($contact_no,$citizen_name,$citizen_father_name,$user_exist);
			log_message('info','##########user_exist '.$user_exist);	
			if($user_exist == 1)
			{
				$this->session->set_userdata('contact', $contact_no); 
			}
			echo $user_exist;
		}
		
		public function check_user_exist($contact_no,$user_exist)
		{
			$user_exist = $this->login_model->check_user_exist($contact_no,$user_exist);
			return $user_exist;
		}
		
		public function load_guest_report_view()
		{
			$user_exist = $this->session->userdata('user_exist');
			$contact_no = $this->session->userdata('contact');				
			if($user_exist == 1)
			{
				$data['reg_user_info'] = $this->login_model->get_reg_user_info($contact_no);		
			}
			//$data['circles'] = $this->citizen_model->get_circles(); 
			$this->load->model('guest_model');	
			$data['circles'] = $this->guest_model->get_circles(); 
			$data['user_exist'] = $user_exist;			
			$this->load->view('guest_report_view',$data);
		}
		
		public function load_citizen_registration_view()
		{
			log_message('info','########## inside load_citizen_registration_view');
			$this->load->model('citizen_model');	
			$user_exist = $this->session->userdata('user_exist');
			$contact_no = $this->session->userdata('contact');	
			if($user_exist == 1)
			{
				$data['reg_user_info'] = $this->login_model->get_reg_user_info($contact_no);		
			}
			$data['circles'] = $this->citizen_model->get_circles(); 		
					
			$data['user_exist'] = $user_exist;
					
			$this->load->view('citizen_registration_view',$data);
					
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
		
		public function updateContactNo()
		{
			$contact_no = $this->input->post('contact_no');	
			log_message('info','##########contact_no '.$contact_no);
			$result = $this->login_model->update_contact_no($contact_no);
			echo $result;
		}
		public function logout()
		{
			log_message('info','########## INSIDE logout');
			$username = $this->session->userdata('userid');
			//Update audit trail logout
			$this->login_model->update_audit_trail_logout($username);
			session_destroy();
			redirect(base_url());
			
		}
	
		public function signup()
		{
			
			$this->load->view('signup_view');
		
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

		
   }  
?>  