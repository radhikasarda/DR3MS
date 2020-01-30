<?php  
		class password_model extends CI_Model  
		{  
			function __construct()  
			{  
				parent::__construct();
				$database_name = $this->session->userdata('database_name');
				$db = $this->load->database($database_name, TRUE);
				$this->db=$db;						
			}


			public function get_users()
			{
				$userid = $this->session->userdata('userid');
				$result = $this->db->query("SELECT uid as user from user where uid NOT LIKE '$userid'")->result_array();;
				$users = array(); 
				foreach($result as $r) 
				{ 
					$users[$r['user']] = $r['user']; 
				} 
				
				return $users;
			}
			public function validateOldPassword($oldPasswordOk,$userid,$current_password)
			{
				$this->db->select('password');
				$this->db->from('user');
				$this->db->where('uid', $userid);
				$query = $this->db->get();
				
				$current_password_in_db = $query->row()->password;
				log_message('info','##########current_password_in_db '.$current_password_in_db);
				
				if(password_verify($current_password, $current_password_in_db))
				{
					$oldPasswordOk = 1;
				}
				
				return $oldPasswordOk;
			}
			
			public function validateRetypePassword($validateRetypePassword,$new_password,$retype_password)
			{
				if(strcmp(strval($new_password),strval($retype_password)) == 0)
				{
					$validateRetypePassword = 1;
				}
				
				return $validateRetypePassword;
			}
			
			public function insertNewPassword($newPasswordSet,$new_password,$userid)
			{
				$newHashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
				log_message('info','##########newHashedPassword '.$newHashedPassword);
				
				$data = array(
					'password' => $newHashedPassword
				);

				$this->db->where('uid', $userid);
				$this->db->update('user', $data);
			
				$affected_rows =  $this->db->affected_rows();
				
				if($affected_rows > 0)
				{
					$newPasswordSet = 1;
				}
				
				return $newPasswordSet;
			}
			
			public function resetPassword($passwordReset,$userid)
			{
				$default_p = $this->config->item('default_p');
				
				$newHashedPassword = password_hash($default_p, PASSWORD_DEFAULT);
				
				$data = array(
					'password' => $newHashedPassword
				);

				$this->db->where('uid', $userid);
				$this->db->update('user', $data);
			
				$affected_rows =  $this->db->affected_rows();
				
				if($affected_rows > 0)
				{
					$passwordReset = 1;
				}
				
				return $passwordReset;
				
			}
			
			public function update_audit_trail_change_password_attempt($userid)
			{
				$activity = "Password Change Attempt";
				if(!empty($_SERVER['HTTP_CLIENT_IP']))
				{
					//ip from share internet
					$ip = $_SERVER['HTTP_CLIENT_IP'];
				}
				elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				{
					//ip pass from proxy
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				else
				{
					$ip = $_SERVER['REMOTE_ADDR'];
				}
				
				$data = array(
						'userid' => $userid,
						'activity_ip' => $ip,
						'activity' => $activity
				);
				$this->db->set('userid', $userid);
				$this->db->set('activity_ip', $ip);
				$this->db->set('activity', $activity);
				
				$this->db->insert('audit_trail');	
			}
			
			public function update_audit_trail_change_password_successful($userid)
			{
				$activity = "Password Change Successful";
				if(!empty($_SERVER['HTTP_CLIENT_IP']))
				{
					//ip from share internet
					$ip = $_SERVER['HTTP_CLIENT_IP'];
				}
				elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				{
					//ip pass from proxy
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				else
				{
					$ip = $_SERVER['REMOTE_ADDR'];
				}
				
				$data = array(
						'userid' => $userid,
						'activity_ip' => $ip,
						'activity' => $activity
				);
				$this->db->set('userid', $userid);
				$this->db->set('activity_ip', $ip);
				$this->db->set('activity', $activity);
				
				$this->db->insert('audit_trail');	
			}
		}
?>