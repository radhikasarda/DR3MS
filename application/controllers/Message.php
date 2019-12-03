<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Message extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			$this->load->model('message_model');
			
		}
	
		public function index()  
		{  
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			//Load inbox messages data
			$data_inbox = $this->dashboard_model->get_inbox_messages();
			
			$data = array_merge($data_last_login,$data_inbox);
			$this->load->view('message_view',$data);
		}
		
		public function getSentMsg()
		{
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			//Load sent messages
			$data_sent_msg = $this->message_model->get_sent_msg(); 
			$data = array_merge($data_last_login,$data_sent_msg);
			$this->load->view('sent_message_view',$data);
		}
		
		public function getDraftMsg()
		{
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
			//Load sent messages
			$data_draft_msg = $this->message_model->get_draft_msg(); 
			$data = array_merge($data_last_login,$data_draft_msg);
			$this->load->view('draft_message_view',$data);
		}
		public function compose()
		{
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
   }
   
?>