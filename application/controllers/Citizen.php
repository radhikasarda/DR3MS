<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class Citizen extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('citizen_model');
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
				$data['user_exist'] = 0;
				$data['circles'] = $this->citizen_model->get_circles(); 	
				$this->load->view('citizen_registration_view',$data);
			}
		}
		
		//For filling combobox
		public function get_blocks()
		{
			$json = array();
			$selected_circle = $this->input->post('circleID');
			log_message('info','##########INSIDE get_blocks FUNC::CIRCLE ID'.$selected_circle);
			$json = $this->citizen_model->get_blocks($selected_circle);
			header('Content-Type: application/json');
			echo json_encode($json);
		}
		
		//For filling combobox
		public function get_gp()
		{	
			$json = array();
			$selected_block = $this->input->post('blockID');
			log_message('info','##########INSIDE get_blocks FUNC::BLOCK ID'.$selected_block);
			$json = $this->citizen_model->get_gp($selected_block);
			header('Content-Type: application/json');
			echo json_encode($json);
		}
		
		public function register_citizen()
		{
			$result = $this->citizen_model->register_citizen();				
			echo $result;
		}
		
		
		public function update_citizen_details()
		{
			$result = $this->citizen_model->update_citizen();
			echo $result;
		}
		public function logout()
		{
			log_message('info','########## INSIDE logout');
			session_destroy();			
			
		}
		
   }
?>