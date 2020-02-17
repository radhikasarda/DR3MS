<?php  
		class citizen_model extends CI_Model  
		{  
			function __construct()  
			{  
				parent::__construct();

				$database_name = $this->session->userdata('database_name');
				log_message('info','##########INSIDE citizen_model database_name FUNC::'.$database_name);
				$db = $this->load->database($database_name, TRUE);
				$this->db=$db;	
								
			}  
			
			public function get_circles()	 
			{
				log_message('info','##########INSIDE citizen_model get_circles FUNC::');
				//$query = $this->db->select('*')-> get('circle');
				//return $query;
				$this->db->select('circle_name');
				$this->db->from('circle');
				$query = $this->db->get();
				return $query->result_array();
				
			}
			
			public function get_blocks($selected_circle)	
			{
				log_message('info','##########INSIDE get_blocks FUNC::selected_circle '.$selected_circle);
				/*$query = $this->db->query("SELECT b.block as block FROM block b join circle c ON b.c_s_no=c.c_s_no WHERE c.circle_name LIKE '$selected_circle';");
				$output = '<option value="Select">Select Block</option>';
				foreach($query->result() as $row)
				{
				  $output .= '<option value="'.$row->block.'">'.$row->block.'</option>';
				}
				return $output;	 */ 	
				$query = $this->db->query("SELECT b.block as block FROM block b join circle c ON b.c_s_no=c.c_s_no WHERE c.circle_name LIKE '$selected_circle';");
				return $query->result_array();
			}	
			
			
			public function get_gp($selected_block)
			{
				/*$query = $this->db->query("SELECT g.gp_name as gp FROM gp g join block b ON g.b_s_no=b.b_s_no WHERE b.block LIKE '$selected_block';");
				$output = '<option value="Select">Select GP</option>';
				foreach($query->result() as $row)
				{
				  $output .= '<option value="'.$row->gp.'">'.$row->gp.'</option>';
				}
				return $output;	*/

				$query = $this->db->query("SELECT g.gp_name as gp FROM gp g join block b ON g.b_s_no=b.b_s_no WHERE b.block LIKE '$selected_block';");
				return $query->result_array();
				
			}
			
			public function register_citizen()
			{
				//add citizen details to database
				$insert_id = $this->insert_citizen_details();
				log_message('info','##########INSIDE insert_citizen_details FUNC::insert_id:: '.$insert_id);				
				return $insert_id;
			}
			
			public function insert_citizen_details()
			{		
				$circle_name = $this->input->post('selected_circle');	
				$block_name = $this->input->post('selected_block');
				$gp_name = $this->input->post('selected_gp');
				$name = $this->input->post('name');
				$name_of_father = $this->input->post('name_of_father');
				log_message('info','##########INSIDE insert_incident_report_details FUNC::name:: '.$name);
				log_message('info','##########INSIDE insert_incident_report_details FUNC::name_of_father:: '.$name_of_father);
				$contact = $this->input->post('contact');
				$village = $this->input->post('village');
				$area = $this->input->post('area');
				$email = $this->input->post('email');
				log_message('info','##########INSIDE insert_incident_report_details FUNC::email:: '.$email);
				$gp_no = $this->get_gp_no($gp_name);
				
				$data = array(
						'gp_no' => $gp_no,
						'name' => $name,
						'father_name' => $name_of_father,
						'contact_no' => $contact,
						'village_name' => $village,
						'area_locality_street' => $area,
						'email_id' => $email					
				);

				$this->db->insert('registered_citizens', $data);

				$insert_id = $this->db->insert_id();
			
				return $insert_id;
				
			}
			public function get_gp_no($gp_name)
			{
				$this->db->select('gp_no');
				$this->db->from('gp');
				$this->db->where('gp_name', $gp_name);
				$query = $this->db->get();	
				return $query->row()->gp_no;
			}
		}
?>