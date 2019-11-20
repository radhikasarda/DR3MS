<?php  
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Chart extends CI_Controller  
   {  
   
	   function __construct()
		{
        // this is your constructor
        parent::__construct();
		
        
		}
		
		public function index()  
		{  
		
 
		}
		
			
		public function view_chart()
		{
		 
		// Load the model
        $this->load->model('chart_model');
		
		// insert the data
		$data =  $this->chart_model->get_assets();
		$this->load->view('chart_view',$data);
		
		}
   }	
 ?>