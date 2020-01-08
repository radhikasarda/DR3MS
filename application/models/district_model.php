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
	}
?>