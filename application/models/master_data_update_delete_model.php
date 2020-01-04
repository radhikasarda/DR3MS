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
			$data['circles'] = $this->get_circles()->result(); 
			
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
				
				$b_s_no = $query->row()->b_s_no; 
				
				$c_s_no = $this->get_c_s_no($b_s_no);
				
				$block_name = $this->get_block_name($b_s_no);
				$circle_name = $this->get_circle_name($c_s_no);
				
				foreach ($query->result() as $row)
				{
					$list =  array(
						'gp_no' => $row->gp_no,
						'block_name'  => $block_name,
						'circle_name' =>$circle_name,
						'gp_name' =>$row->gp_name
						);
					
					$item_details_list[$i]  = $list;
				
					$i++;			
				}
			}
			$data['data_item_details'] = $item_details_list;

			return $data;
		}
		
		public function get_circles()
		{
			$query = $this->db->select('*')-> get('circle');
			return $query;
		}
		public function get_circle_name($c_s_no)
		{
			$this->db->select('circle_name');
			$this->db->from('circle');
			$this->db->where('c_s_no', $c_s_no);
			$query = $this->db->get();
				
			return $query->row()->circle_name;
		}
		
		public function get_block_name($b_s_no)
		{
			$this->db->select('block');
			$this->db->from('block');
			$this->db->where('b_s_no', $b_s_no);
			$query = $this->db->get();
				
			return $query->row()->block;
		}
		
		public function get_c_s_no($b_s_no)
		{
			$this->db->select('c_s_no');
			$this->db->from('block');
			$this->db->where('b_s_no', $b_s_no);
			$query = $this->db->get();
				
			return $query->row()->c_s_no;
		}
		
		public function update_circle_data()
		{
			$name_of_circle = $this->input->post('name_of_circle');
			$circle_no = $this->input->post('circle_no');
			
			$data = array(
					'circle_name' => $name_of_circle
			);

			$this->db->where('c_s_no', $circle_no);
			$this->db->update('circle', $data);
			
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_circle_data::affected_rows '.$affected_rows);
			
			return $affected_rows ;
		}
		
		public function update_block_data()
		{
			$name_of_circle = $this->input->post('selected_circle');
			log_message('info','########## update_circle_data::selected_circle '.$name_of_circle);
			$name_of_block = $this->input->post('name_of_block');
			$block_no = $this->input->post('block_no');
			
			$this->db->select('c_s_no');
			$this->db->from('circle');
			$this->db->where('circle_name', $name_of_circle);
			$query = $this->db->get();
				
			$c_s_no = $query->row()->c_s_no;
			log_message('info','########## update_circle_data::c_s_no '.$c_s_no);
			
			$data = array(
					'c_s_no' => $c_s_no,
					'block' => $name_of_block
			);

			$this->db->where('b_s_no', $block_no);
			$this->db->update('block', $data);
			
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_block_data::affected_rows '.$affected_rows);
		
			return $affected_rows ;
		}
		
		public function update_gp_data()
		{
			$name_of_circle = $this->input->post('selected_circle');
			$name_of_block = $this->input->post('selected_block');
			$name_of_gp = $this->input->post('name_of_gp');			
			$gp_no = $this->input->post('gp_no');
			
			$this->db->select('b_s_no');
			$this->db->from('block');
			$this->db->where('block', $name_of_block);
			$query = $this->db->get();
				
			$b_s_no = $query->row()->b_s_no;
			
			$data = array(
					'b_s_no' => $b_s_no,
					'gp_name' => $name_of_gp
			);

			$this->db->where('gp_no', $gp_no);
			$this->db->update('gp', $data);
			
			$affected_rows =  $this->db->affected_rows();
			log_message('info','########## update_gp_data::affected_rows '.$affected_rows);
		
			return $affected_rows ;
		}
		
		public function get_blocks($selected_circle)	
		{
			$query = $this->db->query("SELECT b.block as block FROM block b join circle c ON b.c_s_no=c.c_s_no WHERE c.circle_name LIKE '$selected_circle';");
			$output = '<option value="Select">Select Block</option>';
			foreach($query->result() as $row)
			{
			  $output .= '<option value="'.$row->block.'">'.$row->block.'</option>';
			}
			return $output;	   
		}	 

		public function get_gp($selected_block)
		{
			$query = $this->db->query("SELECT g.gp_name as gp FROM gp g join block b ON g.b_s_no=b.b_s_no WHERE b.block LIKE '$selected_block';");
			$output = '<option value="Select">Select GP</option>';
			foreach($query->result() as $row)
			{
			  $output .= '<option value="'.$row->gp.'">'.$row->gp.'</option>';
			}
			return $output;	
		}
		
   }
?>