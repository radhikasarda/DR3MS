<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class Login extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			
		}
		
		
		public function index($msg = null)  
		{  
			
			log_message('info','##########Loading Login Controller INDEX FUNCTION');
			
			//$key_val = $this->encryption->create_key(32);
			//$data['key']=bin2hex($key_val);
			
			//log_message('info','##########KEY IN INDEX FUNCTIOON '.$key_val);
			
			//$this->session->set_userdata('key_val', $key_val);
			
	
			//load login page
			$data['users'] = $this->get_users();
			$data['msg'] = $msg;
			
			$this->load->view('index_view',$data);
			
 
		}
		
		private function get_users()
		{
			log_message('info','##########Loading Login Controller get_users() FUNCTION');
			$result = $this->db->select('s_no, uid')-> get('user')-> result_array();
			$users = array(); 
			foreach($result as $r) 
			{ 
				$users[$r['uid']] = $r['uid']; 
			} 

			return $users;
				
		}
				
		public function onLogin()
		{
		 
			log_message('info','##########Loading Login Controller  onLogin() FUNCTION');
			
			// Load the model
			$this->load->model('login_model');
			$userid = null;
			
			
			$username = $this->input->post('users');
			$password = $this->input->post('password');
			
			/*log_message('info','##########login_encrypt_INFO_USER '.$username);
			log_message('info','##########login_eNCRYPT_INFO_PASS '.$password);
			
			$key = $this->session->userdata('key_val');
			
			log_message('info','##########KEY '.$key);
			
			
			$username = $this->encryption->decrypt(base64_decode($user), array(
			'cipher' => 'aes-256',
			'mode' => 'cbc',
			'hmac' => FALSE,
			'key' => $key
			));
		
			
			
			$password = $this->encryption->decrypt(base64_decode($password), array(
			'cipher' => 'aes-256',
			'mode' => 'cbc',
			'hmac' => FALSE,
			'key' => $key
			));
			
			$this->session->unset_userdata('key_val');
			log_message('info','##########login_Decrypt_INFO_USER '.$username);
			log_message('info','##########login_Decrypt_INFO_PASS '.$password);*/
			
			// Validate the user 
			$userid = $this->login_model->validate($username,$password);
			
			// If user did not validate
			if(is_null($userid)){
			
				log_message('info','##########USER NOT VALIDATED');
			
				$msg = "Invalid Username Or Password";
				
				$this->index($msg);
			}
			// If user did validate 
			else
			{
				log_message('info','##########USER VALIDATED ID:: '.$userid);
				
				$this->session->set_userdata('userid', $userid);
				
				$circle_name  = $this->get_jurisdiction($userid);
				
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
	
		public function get_jurisdiction($userid)
		{
			$this->db->select('jurisdiction');
			$this->db->from('user');
			$this->db->where('uid', $userid);
			$query = $this->db->get();	
			return $query->row()->jurisdiction;
		}
		public function insert()
		{
			
			$this->load->model('insert_model');
			$result = $this->insert_model->insert();
			if(! $result)
			{
				// If not inserted
				$message = "User not created. Please Try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$this->load->view('signup_view');
			}else
			{
				// If inserted successfully
				$message = "User created.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				$this->load->view('login_view');
			}    
		
		}
	
		public function logout()
		{
			
			$this->session->sess_destroy();   
			redirect(base_url());
			
		}
	
		public function signup()
		{
			
			$this->load->view('signup_view');
		
		}
		

	
   }  
?>  