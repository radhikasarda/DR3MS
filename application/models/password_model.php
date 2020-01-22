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
		}
?>