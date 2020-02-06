<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Audit_Trail extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('audit_trail_model');
			
			}
			
		}
		
		
		public function index()
		{
			$this->load->library('table');
			
			$userid = $this->session->userdata('userid');
			
			$data['users'] = $this->audit_trail_model->get_users();
			
			$this->load->model('dashboard_model');
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			$data = array_merge($data,$data_last_login);
		
			$this->load->view('audit_trail_view',$data);
		}
		
		public function onClickSubmitSelectedData()
		{	
			$start = 1;
			$records_per_page = 10;
			$last_end = $this->input->post('last_end');
			$last_start = $this->input->post('last_start');
			$target = $this->input->post('target');
			$total_rows = $this->audit_trail_model->num_rows();
			log_message('info','##########INSIDE onClickSubmitSelectedData FUNC::total_rows :: '.$total_rows);
			if($total_rows == 0)
			{
				$data['noData'] = 1;
				$data_audit_trail_report_view = $this->load->view('no_data_view.php',$data,TRUE);
				echo $data_audit_trail_report_view;	
			}
			else
			{
				if($target > 0)
				{
					log_message('info','##########INSIDE onClickSubmitSelectedData FUNC::Next button clicked :: ');
					if($last_end != null)
					{				
						$start = $last_end + 1 ;				
					}
					log_message('info','##########INSIDE onClickSubmitSelectedData FUNC::start:: '.$start);
			
					if($total_rows < $start && $last_start != null)
					{
						$start = $last_start;
						log_message('info','##########INSIDE onClickSubmitSelectedData FUNC::last_start:: '.$start);					
					}
				}
				else
				{
					log_message('info','##########INSIDE onClickSubmitSelectedData FUNC::Prev button clicked :: ');
					if($last_start != null && $last_start > $records_per_page)
					{				
						$start = $last_start - $records_per_page ;				
					}
					log_message('info','##########INSIDE onClickSubmitSelectedData FUNC::start:: '.$start);
					
					if($last_end != null)
					{
						$end = $last_start - 1;
						log_message('info','##########INSIDE onClickSubmitSelectedData FUNC::last_start:: '.$start);					
					}
				}

				log_message('info','##########INSIDE onClickSubmitSelectedData FUNC::total_rows:: '.$total_rows);
				$data["audit"] = $this->audit_trail_model->get_audit_trail_report_data($start,$records_per_page); 
				$data["start"] = $start;
				$data["end"] = $start+$records_per_page - 1;
				$data["total_records"] = $total_rows;
			
				$data_audit_trail_report_view = $this->load->view('data_audit_trail_report_view.php',$data,TRUE);
				echo $data_audit_trail_report_view;	
			}		
		}
		
   }
   
?>
	