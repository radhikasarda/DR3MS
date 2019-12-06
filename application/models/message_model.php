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
				$query = $this->db->query("SELECT * from message_comm where msg_from like '$user' ORDER BY `msg_saved_date` DESC;");
				$sent_msg_details = $query->result();
				$data['sent_msg_details'] = $sent_msg_details;
				foreach($sent_msg_details as $row)
				{
					$list =  array(
								'msg_create_date' => $row->msg_saved_date,
								'subject' => $row->subject,
								'msg_id' => $row->message_id
								);
								$data_list[$i]  = $list;
				
								$i++;
				}
				$data['data_sent_msg'] = $data_list;

				return $data;
			}
			
			public function get_draft_msg()
			{
				$i = 0;
				$data_list = array();
				$user = $this->session->userdata('userid');
				$query = $this->db->query("SELECT * from draft_message where msg_from like '$user' ORDER BY `draft_create_date` DESC;");
				$darft_msg_details = $query->result();
				$data['darft_msg_details'] = $darft_msg_details;
				foreach($darft_msg_details as $row)
				{
					$list =  array(
								'draft_create_date' => $row->draft_create_date,
								'subject' => $row->subject,
								'draft_id' => $row->draft_id
								);
								$data_list[$i]  = $list;
				
								$i++;
				}
				$data['data_draft_msg'] = $data_list;

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
								'date' => $row->msg_saved_date,
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
				$recipient_id = " ";
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
								'date' => $row->msg_saved_date,
								'msg_body' => $row->msg_body
								);
								$data_sent_msg_details_list[$i]  = $list;
				
								$i++;
				}
				$data['data_sent_msg_details'] = $data_sent_msg_details_list;
				
				return $data;
				
				
			}
			
			public function get_draft_msg_details()
			{
				$userid = $this->session->userdata('userid');
				$draft_id = $this->input->post('draft_id');
				$i = 0;
				$data_draft_msg_details_list = array();
				$query = $this->db->query("SELECT * from draft_message where draft_id = '$draft_id'");
				
				$selected_recipients = explode (",", $query->row()->recipient_id);  
				$selected_recipient_id_array = implode("','",$selected_recipients);
				
				$query_unselected_recipients = $this->db->query("SELECT uid from user where uid NOT IN ('".$selected_recipient_id_array."') AND uid NOT LIKE '$userid'");			
				$unselected_recipients = $query_unselected_recipients->result();
						
				$draft_msg_details = $query->result();
				$data['draft_msg_details'] = $draft_msg_details;
			
				foreach($draft_msg_details as $row)
				{
					$list =  array(
					
								'draft_id' => $row->draft_id,
								'subject' => $row->subject,
								'selected_recipients' => $selected_recipients,
								'unselected_recipients' => $unselected_recipients,
								'draft_create_date' => $row->draft_create_date,
								'msg_body' => $row->msg_body
								);
								$data_draft_msg_details_list[$i]  = $list;
				
								$i++;
				}
				$data['data_draft_msg_details'] = $data_draft_msg_details_list;
				
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
			
			public function save_draft_msg()
			{
				$userid = $this->session->userdata('userid');
				$recipient_id_list = $this->input->post('recipient_id_list');
				$subject = $this->input->post('subject');
				$msg = $this->input->post('msg');	

				$this->db->set('recipient_id', $recipient_id_list);
				$this->db->set('subject', $subject);
				$this->db->set('msg_from', $userid);
				$this->db->set('msg_body', $msg);
				$this->db->insert('draft_message');				
				
				return ($this->db->affected_rows() != 1) ? false : true;
			}
			
			public function send_msg()
			{
				$recipient_id_list = $this->input->post('recipient_id_list');
				$subject = $this->input->post('subject');
				$msg = $this->input->post('msg');	
				$msg_from = $this->session->userdata('userid');
				
				//insert into message_comm
				
				$insert_id = $this->insert_to_message_comm($msg_from,$subject,$msg);
				
				//insert to msg_recipient
				$affected_rows = $this->insert_to_message_recipient($recipient_id_list,$insert_id);				

				return ($affected_rows != 1) ? false : true;
			}
			
			public function insert_to_message_comm($msg_from,$subject,$msg)
			{
				$this->db->set('msg_from', $msg_from);
				$this->db->set('subject', $subject);
				$this->db->set('msg_body', $msg);
				$this->db->insert('message_comm');					
				$insert_id = $this->db->insert_id();
				
				return $insert_id;
			}
			
			public function insert_to_message_recipient($recipient_id_list,$insert_id)
			{
				$recipient_id_array = explode (",", $recipient_id_list);  
				
				foreach($recipient_id_array as $value)
				{
						log_message('info','##########INSIDE send_msg FUNC::RECIPIENTS ID:: '.$value);
						$this->db->set('recipient_id', $value);
						$this->db->set('message_id', $insert_id);
						$this->db->insert('message_recipient');				
						
				}
				return $this->db->affected_rows();
			}
			
			public function send_draft_msg()
			{
				$draft_id = $this->input->post('draft_id');
				$this->db->where('draft_id', $draft_id);
				$this->db->delete('draft_message');
				
				//send msg				
				$result = $this->send_msg();			
				return result;
				
			}
		}
?>