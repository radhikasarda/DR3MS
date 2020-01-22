<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class Login extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			$this->load->model('login_model');
		}
		
		
		public function index($msg = null)  
		{  

			log_message('info','##########Loading Login Controller INDEX FUNCTION');
			
			//load login page
			$data['users'] = $this->login_model->get_users();
			$data['msg'] = $msg;
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
			
			// Validate the user 
			$userid = $this->login_model->validate($username,$password);
			
			// If user did not validate
			if(is_null($userid)){
			
				log_message('info','##########USER NOT VALIDATED');
			
				$msg = "Invalid Username Or Password";
				$selected_district = $this->session->userdata('selected_district');
				$this->load->model('district_model');
				
				$this->district_model->loadLoginView($msg,$selected_district);
			}
			// If user did validate 
			else
			{
				log_message('info','##########USER VALIDATED ID:: '.$userid);
				$this->load->library('session');
				$this->session->set_userdata('userid', $userid);
				$this->session->set_userdata('entrance', TRUE);
				
				$circle_name  = $this->login_model->get_jurisdiction($userid);
				
				$arraydata = array('circle_name'  => $circle_name);
				
				$this->session->set_userdata($arraydata);

				redirect('/Dashboard');
			 
				/*$data['userid'] = $userid; 
				//Get role of the user
				$role = $this->db->query("SELECT role FROM user WHERE uid = '$userid' ")->row()->role;
				
				if($role == 1){
				//Load the dashbord for role 1
				$this->load->view('dashboard_view_admin',$data);
				}
				else{
				//Load the dashboard for other roles
				$this->load->view('dashboard_view_general',$data);
				}
				*/
			}
		}
	
		public function validateGuestLogin()
		{
			$otp_generated = strval($this->input->post('otp-generated'));
			$otp_entered = strval($this->input->post('otp'));
			log_message('info','##########otp_generated '.$otp_generated);
			log_message('info','##########otp_entered '.$otp_entered);
			
			
			$otp_generated_trim = trim($otp_generated);
			$otp_entered_trim = trim($otp_entered);
			log_message('info','##########otp_generated_trim '.$otp_generated_trim);
			log_message('info','##########otp_entered_trim '.$otp_entered_trim);
			
			if($otp_entered_trim == $otp_entered_trim)
			{
				log_message('info','########## setGuestEntrance');
				$this->load->library('session');			
				$this->session->set_userdata('entrance', TRUE); 
				redirect('/Guest');
			}
			else
			{
				redirect('/District');
			}
			
		}
		public function logout()
		{
			log_message('info','########## INSIDE logout');
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
			log_message('info','##########INSIDE getOtp FUNC::contact_no:: '.$contact_no);
			$otp = rand(100000,999999);
			log_message('info','##########INSIDE getOtp FUNC::otp:: '.$otp);			
			echo $otp;
		}

		
   }  
?>  