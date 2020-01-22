<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Password extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('password_model');
			}
			
		}
		
		public function loadChangePasswordView()
		{
			$this->load->model('dashboard_model');
			$data_last_login = $this->dashboard_model->get_last_login_time();
			$this->load->view('password_change_view',$data_last_login);
		}
		
		public function changePassword()
		{
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');
			$retype_password = $this->input->post('retype_password');
			
			log_message('info','##########current_password '.$current_password);
			log_message('info','##########new_password '.$new_password);
			log_message('info','##########retype_password '.$retype_password);
			
			$userid = $this->session->userdata('userid');
			$oldPasswordOk = 0;
			$oldPasswordOk = $this->password_model->validateOldPassword($userid,$current_password);
			$password = $this->get_password();
			
		}
   }
?>