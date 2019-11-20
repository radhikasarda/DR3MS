<?php  
   class Chart_model extends CI_Model  
   {  
      function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();	 
      }  
      
      public function get_assets()  
      { 
			$query = $this->db->query("SELECT sum(nos_of_items) as no_of_assets, c.circle_name as circle_name FROM assets a join gp g ON a.gp_no=g.gp_no join block b on g.b_s_no=b.b_s_no join circle c on b.c_s_no=c.c_s_no  group by c.circle_name");
			$record = $query->result();
			$data = [];
 
			foreach($record as $row) 
			{
				$data['label'][] = $row->circle_name;
				$data['data'][] = (int) $row->no_of_assets;
			}
			$data['chart_data'] = json_encode($data);
			//$this->load->view('chart_view',$data);
			return $data;
			
			
	  }
   }
?>