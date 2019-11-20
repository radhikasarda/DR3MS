<?php  
   class encryption_model extends CI_Model  
   {  
      function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();  
      }  
      //we will use the encrypt function  
      public function encrypt()  
      { 
		// grab user password
        $password = $this->input->post('password');

		//define max length for salt
		define("MAX_LENGTH", 10);
		$intermediateSalt = md5(uniqid(rand(), true));
		$salt = substr($intermediateSalt, 0, MAX_LENGTH);
		
		$passwordenc = hash("sha512",  $password . $salt);
		
		// Prepare array of data
		$data = array(
        'username'=>$username,
        'password'=>$passwordenc
		);
		
		//Run insert query
        $this->db->insert('users',$data);
		
		//Return response
		return ($this->db->affected_rows() != 1) ? false : true;
 
      }  
   }  
?>  