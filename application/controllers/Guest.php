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
				
				//$data_circles['circles'] = $this->guest_model->get_circles()->result();
				$data['circles'] = $this->guest_model->get_circles(); 					
				$this->load->view('guest_report_view',$data);
			}
		}
		
		//For filling combobox
		public function get_blocks()
		{
			$json = array();
			$selected_circle = $this->input->post('circleID');
			log_message('info','##########INSIDE get_blocks FUNC::CIRCLE ID'.$selected_circle);
			$json = $this->guest_model->get_blocks($selected_circle);
			header('Content-Type: application/json');
			echo json_encode($json);
			
			/*$circle_id = $this->input->post('circle_id');
			log_message('info','##########INSIDE get_blocks FUNC::CIRCLE ID'.$circle_id);
			if($this->input->post('circle_id'))
			{
				log_message('info','##########INSIDE get_blocks FUNC::');
				$selected_circle = $this->input->post('circle_id');			
				echo $this->guest_model->get_blocks($selected_circle);
			}*/
			
		}
		
		//For filling combobox
		public function get_gp()
		{
			$json = array();
			$selected_block = $this->input->post('blockID');
			log_message('info','##########INSIDE get_blocks FUNC::BLOCK ID'.$selected_block);
			$json = $this->guest_model->get_gp($selected_block);
			header('Content-Type: application/json');
			echo json_encode($json);
			/*if($this->input->post('block_id'))
			{
				log_message('info','##########INSIDE get_gp FUNC::');
				$selected_block = $this->input->post('block_id');
				echo $this->guest_model->get_gp($selected_block);
			}*/
		}
		
		public function sendIncidentReport()
		{
			$result = $this->guest_model->send_incident_report();
			log_message('info','##########INSIDE sendIncidentReport FUNC::result:: '.$result);
			echo $result;
		}
		
		public function uploadImage()
		{
			log_message('info','##########INSIDE uploadImage FUNC::');
			$result = $this->guest_model->upload_image_to_server();
			echo $result;
		}
		
		/*public function onClickBackToLogin()
		{
			$this->load->model('district_model');
			$selected_district = $this->session->userdata('selected_district');
			$this->district_model->loadLoginView($selected_district);
		}*/
		public function logout()
		{
			log_message('info','########## INSIDE logout');
			session_destroy();
			//redirect(base_url());
			
		}
		
   }
?>