<?php  
   class master_data_update_delete_model extends CI_Model  
   {  
		function __construct()  
		{  
			parent::__construct();	 
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;		
		}  
		
		public function get_item_details()
		{
			$selected_item = $this->input->post('selected_item');		
			log_message('info','########## SELECTED ITEM:: '.$selected_item);
			
			$id = $this->input->post('id');		
			
			$i=0;
			$item_details_list = [];
			
			$this->load->model('incident_model');
			$data['circles'] = $this->incident_model->get_circles()->result(); 
			
			if($selected_item == 'circle')
			{
				$this->db->select('*');
				$this->db->from($selected_item);
				$this->db->where('c_s_no', $id);
				$query = $this->db->get();	
				foreach ($query->result() as $row)
				{
					$list =  array(
						'c_s_no' => $row->c_s_no,
						'circle_name'  => $row->circle_name
						);
					$item_details_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($selected_item == 'block')
			{
				$this->db->select('*');
				$this->db->from($selected_item);
				$this->db->where('b_s_no', $id);
				$query = $this->db->get();
				
				$c_s_no = $query->row()->c_s_no;
				
				$circle_name = $this->get_circle_name($c_s_no);
				
				foreach ($query->result() as $row)
				{
					$list =  array(
						'b_s_no' => $row->b_s_no,
						'circle_name'  => $circle_name,
						'block' =>$row->block
						);
					
					$item_details_list[$i]  = $list;
				
					$i++;			
				}
			}
			else if($selected_item == 'gp')
			{
				$this->db->select('*');
				$this->db->from($selected_item);
				$this->db->where('gp_no', $id);
				$query = $this->db->get();	
				foreach ($query->result() as $row)
				{
					$list =  array(
						'gp_no' => $row->gp_no,
						'b_s_no'  => $row->b_s_no,
						'gp_name' =>$row->gp_name
						);
					
					$item_details_list[$i]  = $list;
				
					$i++;			
				}
			}
			$data['data_item_details'] = $item_details_list;

			return $data;
		}
		
		public function get_circle_name($c_s_no)
		{
			$this->db->select('circle_name');
			$this->db->from('circle');
			$this->db->where('c_s_no', $c_s_no);
			$query = $this->db->get();
				
			return $query->row()->circle_name;
		}
		
   }
?>