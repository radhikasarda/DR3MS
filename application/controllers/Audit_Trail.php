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
			$data_audit_trail_report = $this->audit_trail_model->get_audit_trail_report_data(); 
			$data_audit_trail_report_view = $this->load->view('data_audit_trail_report_view.php',$data_audit_trail_report,TRUE);
			echo $data_audit_trail_report_view;				
		}
		
   }
   
?>
	