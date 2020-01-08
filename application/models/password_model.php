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
		}
?>