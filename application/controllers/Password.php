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
		
		public function loadResetPasswordView()
		{
			$this->load->model('dashboard_model');
			$data_last_login = $this->dashboard_model->get_last_login_time();
			$data['users'] = $this->password_model->get_users();
			$data = array_merge($data_last_login,$data);
			$this->load->view('password_reset_view',$data);
		}
		
		public function resetPassword()
		{
			$userid = $this->input->post('users');
			$password = $this->input->post('password');
			
			log_message('info','##########user '.$userid);
			log_message('info','##########password '.$password);
			
			//validate User Password
			$oldPasswordOk = 0;
			$oldPasswordOk = $this->password_model->validateOldPassword($oldPasswordOk,$userid,$password);
			log_message('info','##########oldPasswordOk '.$oldPasswordOk);
			
			if($oldPasswordOk == 0)
			{
				$this->session->set_flashdata('PasswordError', 'Incorrect Password !! TRY AGAIN !!');
				redirect($_SERVER['HTTP_REFERER']);				
			}
			else
			{
				$passwordReset = 0;
				$passwordReset = $this->password_model->resetPassword($passwordReset,$userid);
				log_message('info','##########passwordReset '.$passwordReset);	
				if($passwordReset == 0)
				{
					$this->session->set_flashdata('setPasswordError', 'Internal server Error !! TRY AGAIN !!');
					redirect($_SERVER['HTTP_REFERER']);				
				}
				else
				{
					$this->session->set_flashdata('passwordResetSuccess', 'Password Reset Successfull');
					redirect($_SERVER['HTTP_REFERER']);		
				}
			}
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
			//Update audit trail Password Change attempt
			$this->password_model->update_audit_trail_change_password_attempt($userid);
			
			$oldPasswordOk = 0;
			$oldPasswordOk = $this->password_model->validateOldPassword($oldPasswordOk,$userid,$current_password);
			log_message('info','##########oldPasswordOk '.$oldPasswordOk);
			
			if($oldPasswordOk == 0)
			{
				$this->session->set_flashdata('oldPasswordError', 'Incorrect Current Password !! TRY AGAIN !!');
				redirect($_SERVER['HTTP_REFERER']);				
			}
			
			else
			{
				$validateRetypePassword = 0;
				$validateRetypePassword = $this->password_model->validateRetypePassword($validateRetypePassword,$new_password,$retype_password);
				log_message('info','##########validateRetypePassword '.$validateRetypePassword);
				if($validateRetypePassword == 0)
				{
					$this->session->set_flashdata('retypePasswordError', 'New Password and Retyped Password did not match !! TRY AGAIN !!');
					redirect($_SERVER['HTTP_REFERER']);				
				}
				
				else
				{
					$newPasswordSet = 0;
					$newPasswordSet = $this->password_model->insertNewPassword($newPasswordSet,$new_password,$userid);
					log_message('info','##########newPasswordSet '.$newPasswordSet);
					if($newPasswordSet == 0)
					{
						$this->session->set_flashdata('setPasswordError', 'Internal server Error !! TRY AGAIN !!');
						redirect($_SERVER['HTTP_REFERER']);				
					}
					else
					{
						//Update audit trail Password Change Successful
						$this->password_model->update_audit_trail_change_password_successful($userid);
						$this->session->set_flashdata('passwordSetSuccess', 'Password Changed Successfully');
						redirect($_SERVER['HTTP_REFERER']);		
					}
				}
				
			}
			
		}
   }
?>