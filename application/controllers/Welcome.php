<?php  
   class Welcome extends CI_Controller  
   {  
      public function index()  
      {  
		 //load welcome page
		 $this->load->view('welcome_view');
 
      }
		public function select(){
			
		$action = $this->input->post('login'); 
        if($action == 'Login')
        {
		$this->load->view('login_view');
		}
		else if($action == 'Login'){
			
			$this->load->view('register_view');
		}

   }
   }   
?>  