<?php  
		class incident_report_model extends CI_Model  
		{  
			function __construct()  
			{  
				parent::__construct();	 
			}  
	
   
			public function get_incident_report_data()
			{
				$this->load->model('resource_report_model');
				$i = 0;
				$data_list = array();
				$c_s_no = null;
				$b_s_no = null;
				$gp_no = null;
				
				log_message('info','##########INSIDE INCIDENT REPORT DATA:: ');
				
				$selected_circle = $this->input->post('circle_id');
				
				if(($selected_circle)!= 'All')
				{
				$c_s_no = $this->resource_report_model->getc_s_no($selected_circle);
				}
				
				$selected_block = $this->input->post('block_id');
				
				if(($selected_block)!= 'All')
				{
				$b_s_no = $this->resource_report_model->get_b_s_no($selected_block);
				}
				
				$selected_gp = $this->input->post('gp_id');
				
				if(($selected_gp)!= 'All')
				{
					$gp_no = $this->resource_report_model->get_gp_no($selected_gp);
				}
				
				
				//log_message('info','##########selected_circle:: '.$selected_circle);
				//log_message('info','##########selected_gp:: '.$selected_gp);
				//log_message('info','##########selected_block:: '.$selected_block);
				//log_message('info','##########NUMBERS:: '.$c_s_no .' '.$b_s_no .' '.$gp_no );
				
					
					$query = $this->resource_report_model->get_gp_details($c_s_no,$b_s_no,$gp_no);
					$gp_details = $query->result();
					$data['gp_details'] = $gp_details;
					foreach($gp_details as $row){
						//log_message('info','##########GP LIST:: '.$row->gp_no .' '.$row->gp_name  );
						$gp_name = $row->gp_name;
						$query_selection = $this->get_all_incidents($gp_name);
						$all_incidents_details = $query_selection->result();
						foreach($all_incidents_details as $row1){
							//log_message('info','##########Incidents LIST:: '.$row1->incident_id .' '.$row1->location_village_name.' '.$row->circle_name.' '.$row->block.' '.$row->gp_no);
							$list =  array(
								'circle_name' => $row->circle_name,
								'block' => $row->block,
								'gp'  => $row->gp_name,
								'incident_id' =>$row1->incident_id,
								'location' =>$row1->location_village_name,
								'incident_date' =>$row1->incident_date
								);
								$data_list[$i]  = $list;
				
								$i++;
						}
					}
					$data['data_incident_report'] = $data_list;

					return $data;
			}
			
			public function get_all_incidents($gp_name)
			{
				$query = $this->db->query("SELECT * from incident_report where gp_name like '$gp_name'");
				return $query;
			}
			
			public function get_row_detailed_info()
			{
				$incident_id = $this->input->post('incident_id');
				$query = $this->db->query("SELECT * from incident_report where incident_id = '$incident_id'");
				$i=0;
				$incident_detail_data_list = [];
				foreach ($query->result() as $row)
				{
					$list =  array(
						'gp_name' => $row->gp_name,
						'location_village_name'  => $row->location_village_name,
						'longitude' =>$row->longitude,
						'latitude' =>$row->latitude,
						'landmark' => $row->landmark,
						'incident_date' => $row->incident_date,
						'incident_time' => $row->incident_time,
						'reporting_date_time' => $row->reporting_date_time,
						'phone_no' => $row->phone_no,
						'reported_by' => $row->reported_by
						);
					$incident_detail_data_list[$i]  = $list;
				
					$i++;			
				}
				$data['data_incident_report_detailed_info'] = $incident_detail_data_list;

				return $data;
			}
	}	
?>