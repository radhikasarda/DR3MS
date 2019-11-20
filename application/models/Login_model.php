<?php  
	class Login_model extends CI_Model  
	{  
		function __construct()  
		{  
			// Call the Model constructor  
			parent::__construct();  
		}  

		public function validate($username,$password)  
		{  
		
		
		log_message('info','##########USER_INFO_USER '.$username);
		log_message('info','##########USER_INFO_Pass '.$password);
		$userid = null;
		
        // Prep the query
        $this->db->where('uid', $username);
        $this->db->where('password', $password);
        
        // Run the query
        $query = $this->db->get('user');
		foreach ($query->result() as $row)
		{
		$userid = $row->uid;

		}
		
		if(!is_null($userid)){
		
			$this->insert_last_login_time($userid);
			$this->set_login_ip($userid);
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
	 
	 
	}  
?>  