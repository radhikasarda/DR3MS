<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class Guest extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('guest_model');
			}
		}
		
		
		public function index()  		
		{  
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else
			{
				
				$data_circles['circles'] = $this->guest_model->get_circles()->result(); 		
				$this->load->view('guest_report_view',$data_circles);
			}
		}
		
		//For filling combobox
		public function get_blocks()
		{
			$circle_id = $this->input->post('circle_id');
			log_message('info','##########INSIDE get_blocks FUNC::CIRCLE ID'.$circle_id);
			if($this->input->post('circle_id'))
			{
				log_message('info','##########INSIDE get_blocks FUNC::');
				$selected_circle = $this->input->post('circle_id');			
				echo $this->guest_model->get_blocks($selected_circle);
			}
			
		}
		
		//For filling combobox
		public function get_gp()
		{	
			if($this->input->post('block_id'))
			{
				log_message('info','##########INSIDE get_gp FUNC::');
				$selected_block = $this->input->post('block_id');
				echo $this->guest_model->get_gp($selected_block);
			}
		}
		
		public function sendIncidentReport()
		{
			$result = $this->guest_model->send_incident_report();
			
			echo $result;
		}
		
		public function uploadImage()
		{
			log_message('info','##########INSIDE uploadImage FUNC::');
			$result = $this->guest_model->upload_image_to_server();
			if($result != 0)
			{
				$this->session->unset_userdata('entrance');
			}
			echo $result;
		}
		
   }
?>