<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Incident extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			$this->load->model('incident_model');
			
		}
	
		public function index()  
		{  
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			//Load inbox messages data
			$data_inbox = $this->dashboard_model->get_inbox_messages();
			
			$data = array_merge($data_last_login,$data_inbox);
			$this->load->view('incident_view',$data);
		}
   }
?>