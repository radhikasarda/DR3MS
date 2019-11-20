<?php  
   class Report_model extends CI_Model  
   {  
		function __construct()  
		{  
         parent::__construct();	 
		}  
      
		public function get_circles($userid)	 
		{
			$c_s_no = $this->get_c_s_no($userid);
		
			if($c_s_no == 0)
			{
			
				$query = $this->db->select('*')-> get('circle');
			}
			else
			{
				$query = $this->db->select('*')->where('c_s_no',$c_s_no)-> get('circle');
				
			}
			return $query;

		}
		
		public function get_c_s_no($userid)
		{
			$query = $this->db->query("SELECT c_s_no FROM user where uid LIKE '$userid'");
			$c_s_no = null;
			foreach ($query->result() as $row)
			{
				$c_s_no = $row->c_s_no;
			}
			return $c_s_no;
		}
	  
		public function get_blocks($selected_circle)	
		{
			$query = $this->db->query("SELECT b.block as block FROM block b join circle c ON b.c_s_no=c.c_s_no WHERE c.circle_name LIKE '$selected_circle';");
			$output = '<option value="All">All</option>';
			foreach($query->result() as $row)
			{
			  $output .= '<option value="'.$row->block.'">'.$row->block.'</option>';
			}
			return $output;	   
		}	 

		public function get_gp($selected_block)
		{
			$query = $this->db->query("SELECT g.gp_name as gp FROM gp g join block b ON g.b_s_no=b.b_s_no WHERE b.block LIKE '$selected_block';");
			$output = '<option value="All">All</option>';
			foreach($query->result() as $row)
			{
			  $output .= '<option value="'.$row->gp.'">'.$row->gp.'</option>';
			}
			return $output;	
		}
		
		public function get_resources_names()
		{
			$query = $this->db->query("SELECT sno,tname as resource FROM selection");
			return $query;
		}
		
		public function get_report_data()
		{		
			$i = 0;
			$data_list = array();
			$c_s_no = null;
			$b_s_no = null;
			$gp_no = null;
			
			log_message('info','##########INSIDE GET REPORT DATA:: ');
			
			$selected_circle = $this->input->post('circle_id');
			
			if(($selected_circle)!= 'All')
			{
			$c_s_no = $this->getc_s_no($selected_circle);
			}
			
			$selected_block = $this->input->post('block_id');
			
			if(($selected_block)!= 'All')
			{
			$b_s_no = $this->get_b_s_no($selected_block);
			}
			
			$selected_gp = $this->input->post('gp_id');
			if(($selected_gp)!= 'All')
			{
			$gp_no = $this->get_gp_no($selected_gp);
			}
			
			$selected_resource = $this->input->post('resource_id');
			
			log_message('info','##########selected_circle:: '.$selected_circle);
			log_message('info','##########selected_gp:: '.$selected_gp);
			log_message('info','##########selected_block:: '.$selected_block);
			log_message('info','##########NUMBERS:: '.$c_s_no .' '.$b_s_no .' '.$gp_no );
			
				$query = $this->get_gp_details($c_s_no,$b_s_no,$gp_no);
				$gp_details = $query->result();
				$data['gp_details'] = $gp_details;
				foreach($gp_details as $row){
					//log_message('info','##########GP LIST:: '.$row->gp_no .' '.$row->gp_name  );
					$gp_no = $row->gp_no;
					$query_selection = $this ->get_all_resource_types($selected_resource);
					$resources_details = $query_selection->result();
					foreach($resources_details as $row1){
						//log_message('info','##########Resource LIST:: '.$row1->sno .' '.$row1->tname  );
						$resource_type = $row1->tname ;
						$query_res_quantity = $this ->get_resource_quantity($gp_no, $resource_type);
						$res_quantity_details = $query_res_quantity->result();
						//$row2 = $query_res_quantity->row();
						foreach ($res_quantity_details as $row2)
						{
								//log_message('info','##########Resource LIST:: '.$row->circle_name.' '.$row->block.' '.$row->gp_no.' '.$row1->sno .' '.$row1->tname .' '.$row2->count_res  );
								$list =  array(
								'circle_name' => $row->circle_name,
								'block' => $row->block,
								'gp'  => $row->gp_name,
								'resource_type' =>$row1->tname,
								'resource_quantity' =>$row2->count_res
								);
								$data_list[$i]  = $list;
				
								$i++;
						}
						
						
					}
					
				}
				$data['data_report'] = $data_list;
				
				/*foreach($data_list as $result) 
				{
					
					log_message('info','##########REPORT LIST:: '.$result['circle_name']);
					log_message('info','##########REPORT LIST:: '.$result['block']);
					log_message('info','##########REPORT LIST:: '.$result['gp']);
					log_message('info','##########REPORT LIST:: '.$result['resource_type']);
					log_message('info','##########REPORT LIST:: '.$result['resource_quantity']);
				}*/

				
				
				return $data;
			
		}
		
		public function getc_s_no($selected_circle)
		{
			$this->db->select('c_s_no');
			$this->db->from('circle');
			$this->db->where('circle_name', $selected_circle);
			$query = $this->db->get();	
			return $query->row()->c_s_no;
		}
		
		public function get_b_s_no($selected_block)
		{
			$this->db->select('b_s_no');
			$this->db->from('block');
			$this->db->where('block', $selected_block);
			$query = $this->db->get();	
			return $query->row()->b_s_no;
		}
		
		public function get_gp_no($selected_gp)
		{
			$this->db->select('gp_no');
			$this->db->from('gp');
			$this->db->where('gp_name', $selected_gp);
			$query = $this->db->get();	
			return $query->row()->gp_no;
		}
		
		public function get_resource_quantity($gp_no, $resource_type)
		{
			$circle_name = null;
			
			if($resource_type == 'assets')
			{
				$query=$this->db->query("SELECT sum(nos_of_items) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'community_hall')
			{
				$query=$this->db->query("SELECT sum(if(community_hall NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'demographic_and_socio_eco')
			{
				$query=$this->db->query("SELECT total_pop as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'embankment')
			{
				$query=$this->db->query("SELECT sum(if(name_of_embankment NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'hand_pump_ring_well')
			{
				$query=$this->db->query("SELECT sum(if(village_name NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'health_centre')
			{
				$query=$this->db->query("SELECT sum(if(name_of_health_centre NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'inaccessible')
			{
				$query=$this->db->query("SELECT sum(if(inaccessible_area NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'institution')
			{
				$query=$this->db->query("SELECT count(*) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'raised_platform')
			{
				$query=$this->db->query("SELECT sum(if(raised_platform NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'relif_camp')
			{
				$query=$this->db->query("SELECT sum(if(name_of_school NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'task_force_committee')
			{
				$query=$this->db->query("SELECT sum(if(s_no NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'telecommunication')
			{
				$query=$this->db->query("SELECT sum(if(village_name_tele NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			}
			else if($resource_type == 'vulnerable_village')
			{
				$query=$this->db->query("SELECT sum(if(village_name NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			} 
			else if($resource_type == 'vul_roads_culvert_bridge')
			{
				$query=$this->db->query("SELECT sum(if(s_no NOT LIKE '0',1,0)) as count_res FROM ".$resource_type." where gp_no = ".$gp_no);
			} 
			else
			{
				$query=$this->db->query("select count(*) as count_res from ".$resource_type." where gp_no = ".$gp_no);
			}
			return $query;
		}
		
		public function get_gp_details($c_s_no,$b_s_no,$gp_no)
		{
			$cir = 1;

			if(!is_null($c_s_no))
			{
				$cir = "c.c_s_no = '$c_s_no'";
			}
			if(!is_null($b_s_no))
			{
				$cir = $cir ." AND b.b_s_no = '$b_s_no'";
			}
			if(!is_null($gp_no))
			{
				$cir = $cir ." AND g.gp_no = '$gp_no'";
			}
			$q= "SELECT * from gp g join block b on b.b_s_no = g.b_s_no JOIN circle c on c.c_s_no = b.c_s_no where ".$cir;
			$query = $this->db->query($q);
			log_message('info','##########INSIDE get_all_gp_details QUERY::::::: '.$q);	
			return $query;
		}
		
		
		
		public function get_all_circles()
		{
			$query=$this->db->query("select * from circle");
			return $query;
		}
		public function get_all_resource_types($selected_resource)
		{
			if($selected_resource == 'All')
			{
				$query=$this->db->query("select * from selection");
			}
			else
			{
				$query=$this->db->query("select * from selection where tname like '$selected_resource'");
			}
			
			log_message('info','##########INSIDE GET ALL RESOURCE TYPES:: ');
			return $query;
		}
	
   }
?>