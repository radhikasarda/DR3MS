<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Reports extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			$this->load->model('report_model');
			
		}
	
		public function index()  
		{  
			$this->load->model('report_model');
			$this->load->library('table');
			
			$userid = $this->session->userdata('userid');
			
			$data_circles['circles'] = $this->report_model->get_circles($userid)->result(); 
			$data_circles['resources'] = $this->report_model->get_resources_names()->result();
			
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			
			
			$data = array_merge($data_circles,$data_last_login);
		
			$this->load->view('report_view',$data);
 
 
		}
	
		public function get_blocks()
		{
			if($this->input->post('circle_id'))
			{
				$selected_circle = $this->input->post('circle_id');			
				echo $this->report_model->get_blocks($selected_circle);
			}

		}
		
		public function get_gp()
		{
			if($this->input->post('block_id'))
			{
				$selected_block = $this->input->post('block_id');
				echo $this->report_model->get_gp($selected_block);
			}
		}
		
		public function onClickSubmit()
		{
			log_message('info','##########INSIDE SUBMIT FUNC::');
			$data_report_circlewise = $this->report_model->get_report_data(); 
			$data_report_view = $this->load->view('data_report_view.php',$data_report_circlewise,TRUE);
			echo $data_report_view;
			//$str= "<tr><td>TEST</td></tr>";
			//log_message('info','##########INSIDEonClickSubmit()');	
			
		}
	}  
?> 