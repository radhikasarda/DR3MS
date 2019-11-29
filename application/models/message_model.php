<?php  
		class message_model extends CI_Model  
		{  
			function __construct()  
			{  
				parent::__construct();	 
			}  
			
			public function get_sent_msg()
			{
				$i = 0;
				$data_list = array();
				$user = $this->session->userdata('userid');
				$query = $this->db->query("SELECt * from message_comm where msg_from like '$user' ORDER BY `msg_create_date` DESC;");
				$sent_msg_details = $query->result();
				$data['sent_msg_details'] = $sent_msg_details;
				foreach($sent_msg_details as $row)
				{
					$list =  array(
								'msg_create_date' => $row->msg_create_date,
								'subject' => $row->subject,
								'msg_id' => $row->message_id
								);
								$data_list[$i]  = $list;
				
								$i++;
				}
				$data['data_sent_msg'] = $data_list;

				return $data;
			}
			
			public function get_reciepent_list()
			{
				$userid = $this->session->userdata('userid');
				$result = $this->db->query("SELECT uid as user from user where uid NOT LIKE '$userid'")->result_array();;
				$users = array(); 
				foreach($result as $r) 
				{ 
					$users[$r['user']] = $r['user']; 
				} 

				return $users;
			}
			
			public function get_recieved_msg_details()
			{
				$msg_id = $this->input->post('msg_id');
				$i = 0;
				$data_recieved_msg_details_list = array();
				$query = $this->db->query("SELECT * from message_comm where message_id = '$msg_id'");
				$msg_details = $query->result();
				$data['msg_details'] = $msg_details;
				foreach($msg_details as $row)
				{
					$list =  array(
								'subject' => $row->subject,
								'msg_from' => $row->msg_from,
								'date' => $row->msg_create_date,
								'msg_body' => $row->msg_body
								);
								$data_recieved_msg_details_list[$i]  = $list;
					
								$i++;
				}
				$data['data_recieved_msg_details'] = $data_recieved_msg_details_list;
				return $data;
			
				
			}
			
			public function get_sent_msg_details()
			{
				$msg_id = $this->input->post('msg_id');
				$i = 0;
				$data_sent_msg_details_list = array();
				log_message('info','##########INSIDE get_msg_details FUNC::MSG ID:: '.$msg_id);
				$recipient_id = $this->get_recipient_id($msg_id);
				$query = $this->db->query("SELECT * from message_comm where message_id = '$msg_id'");
				$sent_msg_details = $query->result();
				$data['sent_msg_details'] = $sent_msg_details;
				foreach($sent_msg_details as $row)
				{
					$list =  array(
								'subject' => $row->subject,
								'to' => $recipient_id,
								'date' => $row->msg_create_date,
								'msg_body' => $row->msg_body
								);
								$data_sent_msg_details_list[$i]  = $list;
				
								$i++;
				}
				$data['data_sent_msg_details'] = $data_sent_msg_details_list;
				
				return $data;
				
				
			}
			
			public function get_recipient_id($msg_id)
			{
				$this->db->select('recipient_id');
				$this->db->from('message_recipient');
				$this->db->where('message_id', $msg_id);
				$query = $this->db->get();	
				return $query->row()->recipient_id;
			}
			
		}
?>