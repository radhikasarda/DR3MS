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

			//log_message('info','##########Loading Login Controller INDEX FUNCTION');			
			//load login page
			//$data['users'] = $this->login_model->get_users();
			//$selected_district = $this->session->userdata('selected_district');
			//$data['selected_district'] = $selected_district;
			//$this->load->view('login_view',$data);
			
 
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
				$selected_district = $this->session->userdata('selected_district');
				$this->session->set_flashdata('validationFailed', 'Invalid Username OR Password');
				redirect('District/loadCommonDashboard');
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
		
		
		
   }  
?>  