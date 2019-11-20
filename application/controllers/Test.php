<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Test extends CI_Controller  
   {  
   
		public function __construct()
		{
			
			parent::__construct();
			
			
		}
	
		public function index()  
		{  
			$test_key = "Hello";
			$this->session->set_flashdata('test_key', $test_key);
			$test_index = $this->session->userdata('test_key');
			log_message('info','##########INDEX FUNCTION:::KEY:: '.$test_index);
			$this->load->view('Test_view');
			
		}
	
		public function clickTest()
		{
			$test = $this->session->flashdata('test_key');
			log_message('info','##########CLICK FUNCTION:::KEY:: '.$test);
			echo "Test::::";
			echo $test;
			//$this->session->unset_userdata('test_key');
		
		}
		
	}  
?> 