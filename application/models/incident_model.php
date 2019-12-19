<?php  
		class incident_model extends CI_Model  
		{  
			function __construct()  
			{  
				parent::__construct();	 
			}  
			
			public function get_circles()	 
			{
			$userid = $this->session->userdata('userid');
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
				return $this->db->insert_id();
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
				
				$file_1_name = $_FILES['file_1']['name'];
				$file_2_name = $_FILES['file_2']['name'];
				$file_3_name = $_FILES['file_3']['name'];
				log_message('info','##########INSIDE upload_image_to_server FUNC::file_1_name:: '.$file_1_name);
				$incident_id = ($_POST['incident_id']);		
				
				$response = null;
				if($file_1_name)
				{
					$temp_file_1_name = $_FILES['file_1']['tmp_name'];
					$response = $this->upload_image($file_1_name,$temp_file_1_name,$incident_id);
				}
				if($file_2_name)
				{
					$temp_file_2_name = $_FILES['file_2']['tmp_name'];
					$response = $this->upload_image($file_2_name,$temp_file_2_name,$incident_id);
				}
				if($file_3_name)
				{
					$temp_file_3_name = $_FILES['file_3']['tmp_name'];
					$response = $this->upload_image($file_3_name,$temp_file_3_name,$incident_id);
				}
				log_message('info','##########INSIDE upload_image_to_server FUNC::response:: '.$response);
				if($response == 0)
				{
					return $response;
				}
				else
				{
					$path_url = $this->config->base_url('upload/'.$incident_id);
					log_message('info','##########INSIDE upload_image_to_server FUNC::path_url:: '.$path_url);
					
					$this->db->set('dir_name',$path_url);
					$this->db->where('incident_id', $incident_id);
					$this->db->update('incident_report');
					
					return $response;
				}
				
			}
			
			public function upload_image($file_name,$temp_file_name,$incident_id)
			{
						
					log_message('info','##########INSIDE upload_image FUNC::filename:: '.$file_name);				
					log_message('info','##########INSIDE upload_image FUNC::incident_id:: '.$incident_id);
					log_message('info','##########INSIDE upload_image FUNC::temp_file_name:: '.$temp_file_name);
				
					/* Location */
					$location = 'upload/'.$file_name;				
					$path  =  'upload/'.$incident_id;				
				
					if(!is_dir($path)) //create the folder if it's not already exists
					{
						mkdir($path ,0755,TRUE);
					} 
				
					$uploadOk = 1;
					$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
					log_message('info','##########INSIDE upload_image FUNC::imageFileType:: '.$imageFileType);
				
					$valid_extensions = array("jpg","jpeg","png");
					/* Check file extension */
					if( !in_array(strtolower($imageFileType),$valid_extensions) ) 
					{
						$uploadOk = 0;
						log_message('info','##########INSIDE upload_image FUNC::EXTENSION NOT VALID:: ');
					}

					$filetobeuploaded = $path."/".$file_name;
					
					if($uploadOk == 0)
					{
						echo 0;
					}
					else
					{
						/* Upload file */
						if(move_uploaded_file($temp_file_name,$filetobeuploaded))
						{
							log_message('info','##########INSIDE upload_image FUNC:: location:: '.$filetobeuploaded);							
							
							$uploadOk = 1;
						}
						else
						{
							$uploadOk = 0;
							
						}
						return $uploadOk;
					}
			}
			
			public function get_all_incidents()
			{
				$userid = $this->session->userdata('userid');
				$c_s_no = $this->get_c_s_no($userid);
				
				if($c_s_no == 0)
				{			
					$this->db->select('*');
					$this->db->from('incident_report');
					$query = $this->db->get();
				}
				
				else
				{
					$query=$this->db->query("SELECT * FROM `incident_report` join gp g on incident_report.gp_no = g.gp_no join block b on g.b_s_no = b.b_s_no JOIN circle c on b.c_s_no = c.c_s_no  where c.c_s_no = ".$c_s_no);							
				}
				
				$data_all_incidents['incident'] = null;	
				$data_all_incidents['incident'] =  $query->result();
				return $data_all_incidents;	
			}
			
			public function get_incident_details()
			{
				$incident_id = $this->input->post('incident_id');
				$query = $this->db->query("SELECT * from incident_report where incident_id = '$incident_id'");
				
				$gp_no = $query->row()->gp_no;				
				$circle_name = $this->get_circle_name($gp_no);
				log_message('info','##########INSIDE get_circle_name FUNC:: circle_name:: '.$circle_name);	
				
				$i = 0;
				$data_incident_details_list = array();
				$incident_details = $query->result();
				$data['incident_details'] = $incident_details;
				foreach($incident_details as $row)
				{
					$list =  array(
								'incident_id' => $incident_id,
								'circle_name' => $circle_name,
								'block_name' => $row->block_name,
								'gp_name' => $row->gp_name,
								'subject' => $row->subject,
								'location' => $row->location_village_name,
								'longitude' => $row->longitude,
								'latitude' => $row->latitude,
								'landmark' => $row->landmark,
								'incident_date' => $row->incident_date,
								'incident_time' => $row->incident_time,
								'reporting_date_time' => $row->reporting_date_time,
								'contact_no' => $row->phone_no,
								'reported_by' => $row->reported_by,
								'detailed_report' => $row->detailed_report,
								'image_dir_name' => $row->dir_name
								);
								$data_incident_details_list[$i]  = $list;
				
								$i++;
				}
				$data['data_incident_details'] = $data_incident_details_list;
				
				return $data;
			}
			
			public function get_circle_name($gp_no)
			{
				$query=$this->db->query("SELECT circle_name from circle join block on block.c_s_no = circle.c_s_no join gp on gp.b_s_no = block.b_s_no where gp.gp_no = ".$gp_no);
				
				return $query->row()->circle_name;
			}
		}
?>