<?php  
		class guest_model extends CI_Model  
		{  
			function __construct()  
			{  
				parent::__construct();

				$database_name = $this->session->userdata('database_name');
				$db = $this->load->database($database_name, TRUE);
				$this->db=$db;	
								
			}  
			
			public function get_circles()	 
			{
				log_message('info','##########INSIDE guest_model get_circles FUNC::');
				$query = $this->db->select('*')-> get('circle');
				return $query;
				
			}
			
			public function get_blocks($selected_circle)	
			{
				log_message('info','##########INSIDE get_blocks FUNC::selected_circle '.$selected_circle);
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
			
			public function send_incident_report()
			{
				//add incident details to database
				$insert_id = $this->insert_incident_report_details();
				log_message('info','##########INSIDE send_incident_report FUNC::insert_id:: '.$insert_id);
				
				return $insert_id;
			}
			
			public function insert_incident_report_details()
			{		
				$circle_name = $this->input->post('selected_circle');	
				$block_name = $this->input->post('selected_block');
				$gp_name = $this->input->post('selected_gp');
				$latitude = $this->input->post('latitude');
				$longitude = $this->input->post('longitude');
				log_message('info','##########INSIDE insert_incident_report_details FUNC::latitude:: '.$latitude);
				log_message('info','##########INSIDE insert_incident_report_details FUNC::longitude:: '.$longitude);
				$location = $this->input->post('location');
				$landmark = $this->input->post('landmark');
				$subject = $this->input->post('subject');
				$incident_date = $this->input->post('incident_date');
				$incident_time = $this->input->post('incident_time');
				$reported_by = $this->input->post('reported_by');
				$contact_no = $this->input->post('contact_no');
				$report_brief = $this->input->post('report_brief');
				
				$gp_no = $this->get_gp_no($gp_name);
				
				$data = array(
						'gp_no' => $gp_no,
						'block_name' => $block_name,
						'gp_name' => $gp_name,
						'subject' => $subject,
						'location_village_name' => $location,
						'longitude' => $longitude,
						'latitude' => $latitude,
						'landmark' => $landmark,
						'incident_date' => $incident_date,
						'incident_time' => $incident_time,
						'phone_no' => $contact_no,
						'reported_by' => $reported_by,
						'detailed_report' => $report_brief
						
				);

				$this->db->insert('incident_report', $data);

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
			public function upload_image_to_server()
			{
				//uplad images
				/* Getting file name */
				$response = null;
				$noImage = ($_POST['noImage']);	
				log_message('info','##########INSIDE upload_image_to_server FUNC::noImage:: '.$noImage);				
				if($noImage == 0)
				{ 
					
					$file_1_name = $_FILES['file_1']['name'];
					$file_2_name = $_FILES['file_2']['name'];
					$file_3_name = $_FILES['file_3']['name'];
					log_message('info','##########INSIDE upload_image_to_server FUNC::file_1_name:: '.$file_1_name);
					$incident_id = ($_POST['incident_id']);		
					$photo_no = 0;
					
					if($file_1_name)
					{
						$photo_no = 1;
						$temp_file_1_name = $_FILES['file_1']['tmp_name'];
						$response = $this->upload_image($file_1_name,$temp_file_1_name,$incident_id,$photo_no);
					}
					if($file_2_name)
					{
						$photo_no = 2;
						$temp_file_2_name = $_FILES['file_2']['tmp_name'];
						$response = $this->upload_image($file_2_name,$temp_file_2_name,$incident_id,$photo_no);
					}
					if($file_3_name)
					{
						$photo_no = 3;
						$temp_file_3_name = $_FILES['file_3']['tmp_name'];
						$response = $this->upload_image($file_3_name,$temp_file_3_name,$incident_id,$photo_no);
					}
					log_message('info','##########INSIDE upload_image_to_server FUNC::response:: '.$response);
					if($response == 0)
					{
						return $response;
					}
					else
					{
						$database_name = $this->session->userdata('database_name');
						$path_url = $this->config->base_url('upload/'.$database_name."/".$incident_id);
						log_message('info','##########INSIDE upload_image_to_server FUNC::path_url:: '.$path_url);
						
						$this->db->set('dir_name',$path_url);
						$this->db->where('incident_id', $incident_id);
						$this->db->update('incident_report');
						
						return $response;
					}
				}
				else{
					$response = 1;
					return $response;
				}
				
			}
			
			public function upload_image($file_name,$temp_file_name,$incident_id,$photo_no)
			{
						
					log_message('info','##########INSIDE upload_image FUNC::filename:: '.$file_name);				
					log_message('info','##########INSIDE upload_image FUNC::incident_id:: '.$incident_id);
					log_message('info','##########INSIDE upload_image FUNC::temp_file_name:: '.$temp_file_name);
					$database_name = $this->session->userdata('database_name');
					
					
					/* Location */
					$location = 'upload/'.$file_name;				
					$path  =  'upload/'.$database_name."/".$incident_id;				
					log_message('info','##########INSIDE upload_image FUNC::path:: '.$path);
					if(!is_dir($path)) //create the folder if it's not already exists
					{
						mkdir($path ,0755,TRUE);
					} 
				
					$uploadOk = 0;


					$filetobeuploaded = $path.'/'.$incident_id.'_photo_'.$photo_no.'.jpg';
					
						/* Upload file */
						if(move_uploaded_file($temp_file_name,$filetobeuploaded))
						{
							log_message('info','##########INSIDE upload_image FUNC:: location:: '.$filetobeuploaded);														
							$uploadOk = 1;
						}
						return $uploadOk;
			
			}
		
		}
?>