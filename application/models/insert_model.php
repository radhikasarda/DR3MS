<?php  
   class Insert_model extends CI_Model  
   {  
      function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();	 
      }  
      //we will use the insert function  
      public function insert()  
      { 
		// grab user input
        $username = $this->input->post('name');
        $password = $this->input->post('password');
		$email = $this->input->post('email');

		$salt = '$2a$07$R.gJb2U2N.FmZ4hPp1y2CN$';
		$passwordenc = password_hash($password, PASSWORD_BCRYPT);

		//define max length for salt
		//define("MAX_LENGTH", 10);
		//$intermediateSalt = md5(uniqid(rand(), true));
		//$salt = substr($intermediateSalt, 0, MAX_LENGTH);
		
		//$passwordenc = hash("sha512",  $password . $salt);
		
		// Prepare array of data
		echo $passwordenc ;
		$data = array(
        'username'=>$username,
		'email' =>$email,
        'password'=>$passwordenc
		);
		


		//Run insert query
        $this->db->insert('users',$data);
		//Return response
		return ($this->db->affected_rows() != 1) ? false : true;
 
      }  
   }  
?>  