<?php  
	class District_model extends CI_Model  
	{  
		function __construct()  
		{  
			parent::__construct();  
		}  
		
		public function get_districts()
		{
			log_message('info','##########Loading District Model get_districts FUNCTION');
			$this->db->select('s_no, district_name');
			$this->db->from('district');
			$this->db->where('is_enabled', true);
			$this->db->order_by("district_name", "asc");
			$result = $this->db->get()->result_array();;

			$districts = array(); 
			foreach($result as $r) 
			{ 
				$districts[$r['district_name']] = $r['district_name']; 
			} 
			
			return $districts;
				
		}
		public function loadLoginView($selected_district)
		{
			//For password Encryption
			
			$key_val = $this->encryption->create_key(32);
			$data['key']=bin2hex($key_val);
			
			log_message('info','##########KEY IN loadLoginView FUNCTION '.$key_val);
			
			$this->session->set_userdata('key_val', $key_val);

			$data['selected_district'] = $selected_district;
			$data['users'] = $this->get_users();
			$this->load->view('login_view',$data);
		}
		
		public function get_users()
		{
			log_message('info','##########Loading Login Controller get_users() FUNCTION');
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;						
			$result = $this->db->select('s_no, uid')-> get('user')-> result_array();
			$users = array(); 
			foreach($result as $r) 
			{ 
				$users[$r['uid']] = $r['uid']; 
			} 
			
			return $users;
				
		}
	}
?>