<?php  
	class Login_model extends CI_Model  
	{  
		function __construct()  
		{  
			// Call the Model constructor  
			parent::__construct();  
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;
		}  

		public function validate($username,$password)  
		{  
				
		log_message('info','##########USER_INFO_USER '.$username);
		log_message('info','##########USER_INFO_Pass '.$password);
		$userid = null;
		
		$query = $this->db->query("SELECT * FROM user WHERE uid='".$username."'");  
		$numrows = $query->num_rows(); 
		if($numrows!=0)  
		{  
			foreach($query->result_array() as $row)
			{
				$dbusername = $row['uid'];  
				$dbpassword = $row['password'];  
				log_message('info','##########dbusername '.$dbusername);
				log_message('info','##########dbpassword '.$dbpassword);
				if($username == $dbusername)
				{ 
					if(password_verify( $password, $dbpassword))
					{
						$userid = $username;
						$this->insert_last_login_time($username);
						$this->set_login_ip($username);
					}
				}
			}
			/*if($username == $dbusername && $password == $dbpassword)  
			{ 
				$userid = $username;
				$this->insert_last_login_time($username);
				$this->set_login_ip($username);
		
			}*/
			
			
		}
		return $userid;
		}  
		
		private function insert_last_login_time($userid)
		{			
			$this->db->set('last_login_time', 'NOW()', FALSE);
			$this->db->where("uid", $userid); 
			$this->db->update("user");
		
		}
	 
		private function set_login_ip($userid)
		{
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
			
			$this->db->set('last_login_ip', $ip);
			$this->db->where("uid", $userid); 
			$this->db->update("user");
			
				
		}
		
		
		public function get_users()
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
		
		public function get_jurisdiction($userid)
		{
			$this->db->select('jurisdiction');
			$this->db->from('user');
			$this->db->where('uid', $userid);
			$query = $this->db->get();	
			return $query->row()->jurisdiction;
		}
		
		public function update_audit_trail_login_attempt($username)
		{
			$activity = "Login Attempt";
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
					'userid' => $username,
					'activity_ip' => $ip,
					'activity' => $activity
			);
			$this->db->set('userid', $username);
			$this->db->set('activity_ip', $ip);
			$this->db->set('activity', $activity);
			
			$this->db->insert('audit_trail');	
		
		}
		
		public function update_audit_trail_login_successful($username)
		{
			$activity = "Login Successful";
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
					'userid' => $username,
					'activity_ip' => $ip,
					'activity' => $activity
			);
			$this->db->set('userid', $username);
			$this->db->set('activity_ip', $ip);
			$this->db->set('activity', $activity);
			
			$this->db->insert('audit_trail');
		}
		
		public function update_audit_trail_logout($username)
		{
			$activity = "Logout";
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
					'userid' => $username,
					'activity_ip' => $ip,
					'activity' => $activity
			);
			$this->db->set('userid', $username);
			$this->db->set('activity_ip', $ip);
			$this->db->set('activity', $activity);
			
			$this->db->insert('audit_trail');
		}
		
		public function check_user_exist($contact_no)
		{
			$this->db->select('*');
			$this->db->from('registered_citizens');
			$this->db->where('contact_no', $contact_no);
			$this->db->join('gp', 'gp.gp_no = registered_citizens.gp_no');
			$this->db->join('block', 'block.b_s_no = gp.b_s_no');
			$this->db->join('circle', 'circle.c_s_no = block.c_s_no');
			$query = $this->db->get();	
			if ($query->num_rows() > 0)
			{
					return $query->result();
			}
			else
			{
				$this->load->library('session');			
				$this->session->set_userdata('entrance', TRUE); 
				redirect('/Citizen');
				
			}
		}
	}  
?>  