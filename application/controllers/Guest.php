<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
  
   class Guest extends CI_Controller  
   {  
		
		function __construct()
		{
       		parent::__construct();
			if(!$this->session->userdata('guest_entrance'))
			{
				redirect(base_url());
				
			}
		}
		
		
		public function index()  
		{  
			$this->load->model('incident_model');
			$data_circles['circles'] = $this->incident_model->get_circles()->result(); 		
			$this->load->view('guest_incident_report_view',$data_circles);
 
		}
   }
?>