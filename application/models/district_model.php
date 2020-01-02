<?php  
	class District_model extends CI_Model  
	{  
		function __construct()  
		{  
			// Call the Model constructor  
			parent::__construct();  
		}  
		
		public function get_districts()
		{
			//$result = $this->db->select('s_no, district_name')-> get('district')-> result_array();
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