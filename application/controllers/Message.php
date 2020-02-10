<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Message extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('message_model');
			}
			
		
		}
	
		public function index()  
		{ 
			$start = 1;
			$records_per_page = 10;
			$total_rows = $this->message_model->num_inbox_message();
			log_message('info','##########INSIDE Message index FUNC::total_rows :: '.$total_rows);
			if($total_rows == 0)
			{
				$data['noData'] = 1;
				$this->load->view('no_data_view.php',$data,TRUE);	
			}
			
			else
			{			
				if (isset($_POST["submitForm"]))
				{
					$formSubmit = $this->input->post('submitForm');
					$last_end = $this->input->post('last_end');
					$last_start = $this->input->post('last_start');
					if( $formSubmit == 'next' )
					{
						if($last_end != null)
						{				
							$start = $last_end + 1 ;				
						}
						log_message('info','##########INSIDE Message index FUNC::start:: '.$start);
				
						if($total_rows < $start && $last_start != null)
						{
							$start = $last_start;
							log_message('info','##########INSIDE Message index FUNC::last_start:: '.$start);					
						}
					}
					
					if($formSubmit == 'prev' )
					{
						log_message('info','##########INSIDE Message index FUNC::Prev button clicked :: ');
						if($last_start != null && $last_start > $records_per_page)
						{				
							$start = $last_start - $records_per_page ;				
						}
						log_message('info','##########INSIDE Message index FUNC::start:: '.$start);
						
						if($last_end != null)
						{
							$end = $last_start - 1;
							log_message('info','##########INSIDE Message index FUNC::last_start:: '.$start);					
						}
					}
				}
			
				$data['inbox_message'] = $this->message_model->get_inbox_messages($start,$records_per_page);
				$data["start"] = $start;
				$data["end"] = $start+$records_per_page - 1;
				$data["total_records"] = $total_rows;
				
				$this->load->model('dashboard_model');				
				$data_last_login = $this->dashboard_model->get_last_login_time();
			
				$data = array_merge($data_last_login,$data);
				$this->load->view('message_view',$data);
			
			}
		}
		
		public function getSentMsg()
		{
			$start = 1;
			$records_per_page = 10;
			$total_rows = $this->message_model->num_sent_message();
			log_message('info','##########INSIDE Message getSentMsg FUNC::total_rows :: '.$total_rows);
			if($total_rows == 0)
			{
				$data['noData'] = 1;
				$this->load->view('no_data_view.php',$data,TRUE);	
			}
			
			else
			{			
				if (isset($_POST["submitForm"]))
				{
					$formSubmit = $this->input->post('submitForm');
					$last_end = $this->input->post('last_end');
					$last_start = $this->input->post('last_start');
					if( $formSubmit == 'next' )
					{
						if($last_end != null)
						{				
							$start = $last_end + 1 ;				
						}
						log_message('info','##########INSIDE Message getSentMsg FUNC::start:: '.$start);
				
						if($total_rows < $start && $last_start != null)
						{
							$start = $last_start;
							log_message('info','##########INSIDE Message getSentMsg FUNC::last_start:: '.$start);					
						}
					}
					
					if($formSubmit == 'prev' )
					{
						log_message('info','##########INSIDE Message getSentMsg FUNC::Prev button clicked :: ');
						if($last_start != null && $last_start > $records_per_page)
						{				
							$start = $last_start - $records_per_page ;				
						}
						log_message('info','##########INSIDE Message getSentMsg FUNC::start:: '.$start);
						
						if($last_end != null)
						{
							$end = $last_start - 1;
							log_message('info','##########INSIDE Message getSentMsg FUNC::last_start:: '.$start);					
						}
					}
				}
				
				$this->load->model('dashboard_model');	
				$data_last_login = $this->dashboard_model->get_last_login_time();
				//Load sent messages
				$data['sent_msg'] = $this->message_model->get_sent_msg($start,$records_per_page);
				$data["start"] = $start;
				$data["end"] = $start+$records_per_page - 1;
				$data["total_records"] = $total_rows;
				
				$data = array_merge($data_last_login,$data);
				$this->load->view('sent_message_view',$data);
			}
		}
		
		public function getDraftMsg()
		{
			$start = 1;
			$records_per_page = 10;
			$total_rows = $this->message_model->num_draft_message();
			log_message('info','##########INSIDE Message getDraftMsg FUNC::total_rows :: '.$total_rows);
			if($total_rows == 0)
			{
				$data['noData'] = 1;
				$this->load->view('no_data_view.php',$data,TRUE);	
			}
			
			else
			{			
				if (isset($_POST["submitForm"]))
				{
					$formSubmit = $this->input->post('submitForm');
					$last_end = $this->input->post('last_end');
					$last_start = $this->input->post('last_start');
					if( $formSubmit == 'next' )
					{
						if($last_end != null)
						{				
							$start = $last_end + 1 ;				
						}
						log_message('info','##########INSIDE Message getDraftMsg FUNC::start:: '.$start);
				
						if($total_rows < $start && $last_start != null)
						{
							$start = $last_start;
							log_message('info','##########INSIDE Message getDraftMsg FUNC::last_start:: '.$start);					
						}
					}
					
					if($formSubmit == 'prev' )
					{
						log_message('info','##########INSIDE Message getDraftMsg FUNC::Prev button clicked :: ');
						if($last_start != null && $last_start > $records_per_page)
						{				
							$start = $last_start - $records_per_page ;				
						}
						log_message('info','##########INSIDE Message getDraftMsg FUNC::start:: '.$start);
						
						if($last_end != null)
						{
							$end = $last_start - 1;
							log_message('info','##########INSIDE Message getDraftMsg FUNC::last_start:: '.$start);					
						}
					}
				}
				$this->load->model('dashboard_model');	
				$data_last_login = $this->dashboard_model->get_last_login_time();
				//Load sent messages
				$data['draft_msg'] = $this->message_model->get_draft_msg($start,$records_per_page); 
				$data["start"] = $start;
				$data["end"] = $start+$records_per_page - 1;
				$data["total_records"] = $total_rows;
				
				$data = array_merge($data_last_login,$data);
				$this->load->view('draft_message_view',$data);
			}
		}
		public function compose()
		{
			log_message('info','##########INSIDE compose FUNC::');
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			$data['users']  = $this->message_model->get_reciepent_list(); 
			$data = array_merge($data_last_login,$data);
			
			$this->load->view('compose_message_view',$data);
		}
		
		public function onViewRecievedMsgDetailsClick()
		{
			log_message('info','##########INSIDE onViewDetailsClick FUNC::');
			$data_msg_details = $this->message_model->get_recieved_msg_details(); 	
			$data_recieved_msg_details_view = $this->load->view('data_recieved_msg_details_view',$data_msg_details,TRUE);
			echo $data_recieved_msg_details_view;
			
		}
		public function onViewSentMsgDetailsClick()
		{
			$data_sent_msg_details = $this->message_model->get_sent_msg_details(); 	
			$data_sent_msg_details_view = $this->load->view('data_sent_msg_details_view',$data_sent_msg_details,TRUE);
			echo $data_sent_msg_details_view;
		}
		
		public function onViewDraftMsgDetailsClick()
		{
			log_message('info','##########INSIDE onViewDraftMsgDetailsClick FUNC::');
			$data_draft_msg_details = $this->message_model->get_draft_msg_details(); 
			$data_draft_msg_details_view = $this->load->view('data_draft_msg_details_view',$data_draft_msg_details,TRUE);
			echo $data_draft_msg_details_view;
		}
		
		public function onDraftClick()
		{
			$save_draft_msg = $this->message_model->save_draft_msg();
		}
		
		public function onSendClick()
		{
			$send_msg = $this->message_model->send_msg();
		}
		public function onSendDraftMsgClick()
		{
			$send_draft_msg = $this->message_model->send_draft_msg();
		}
		
		public function onDeleteDraftMsgClick()
		{
			$delete_draft_msg = $this->message_model->delete_draft_msg();
		}
		
		public function onSendReplyClick()
		{
			$send_reply_msg = $this->message_model->send_reply_msg();
		}
		public function onClickInboxForward()
		{
			$data_forward_msg_details = $this->message_model->get_forward_msg_details();
			$data_forward_msg_details_view = $this->load->view('data_forward_msg_details_view',$data_forward_msg_details,TRUE);
			echo $data_forward_msg_details_view;
			
		}
		public function onSendForwardMsgClick()
		{
			$forward_msg = $this->message_model->send_forward_msg();
		}
		
		public function onClickViewIncident()
		{
			$this->load->model('incident_model');
			$data_incident_details = $this->incident_model->get_incident_details(); 	
			$data_incident_details_view = $this->load->view('data_incident_details_view',$data_incident_details,TRUE);
			echo $data_incident_details_view;
		}
   }
   
?>