<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class District extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			//$this->load->library('session');
			//$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			//$this->output->set_header('Pragma: no-cache');
			//$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			$this->load->model('district_model');
		}
		
		
		public function index() 
		{  
			log_message('info','##########Loading District Controller INDEX FUNCTION');
			$data['districts'] = $this->district_model->get_districts();
			$this->load->view('index_view',$data);
			
		}
		
		public function getSelelctedDistrict()
		{
			log_message('info','##########Loading Login Controller getSelelctedDistrict() FUNCTION');
			
			$selected_district = $this->input->post('districts');
			log_message('info','##########Loading Login Controller getSelelctedDistrict() FUNCTION:: SELECTED DISTRICT:: '.$selected_district);
			
			$database_name = "database_".$selected_district;
			log_message('info','##########Loading Login Controller getSelelctedDistrict() FUNCTION:: database_name:: '.$database_name);
			
			$this->session->set_userdata('database_name', $database_name);

			$data['selected_district'] = $selected_district;
			$data['users'] = $this->get_users();
			$this->load->view('login_view',$data);

		}
		
		public function get_users()
		{
			log_message('info','##########Loading Login Controller get_users() FUNCTION');
			$database_name = $this->session->userdata('database_name');
			$db = $this->load->database($database_name, TRUE);
			$this->db=$db;						
			$result = $this->db->select('s_no, uid')-> get('user')-> result_array();
			$users = array(); 
			foreach($result as $r) 
			{ 
				$users[$r['uid']] = $r['uid']; 
			} 
			
			return $users;
				
		}
		
		public function loadGuestView()
		{
			log_message('info','##########Loading loadGuestView');
			$this->load->view('guest_view');
			
		}
		
	}
?>