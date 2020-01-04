<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   class Master_Data_Update_Delete extends CI_Controller  
   {  
   
		function __construct()
		{
			
			parent::__construct();
			if(!$this->session->userdata('entrance'))
			{
				redirect(base_url());
				
			}
			else{
				$this->load->model('master_data_update_delete_model');
			}
			
			
		}
	
		public function index()  
		{ 
			
			$this->load->model('dashboard_model');	
			$data_last_login = $this->dashboard_model->get_last_login_time();
				
			$this->load->model('resource_report_model');
			$data_resources['resources'] = $this->resource_report_model->get_resources_names()->result();
			
			$userid = $this->session->userdata('userid');		
			$data_resources['circles'] = $this->resource_report_model->get_circles($userid)->result(); 
			
			$data = array_merge($data_resources,$data_last_login);
			$this->load->view('master_data_update_delete_view',$data);
			
		}
		
		public function onClickSubmitArea()
		{
			$this->load->model('master_data_model');
			log_message('info','##########INSIDE onClickSubmitArea FUNC::');
			$data_item_details = $this->master_data_model->get_item_details(); 
			
			$selected_item = $this->input->post('resource_id');	
			log_message('info','##########INSIDE onClickSubmitArea FUNC::selected_item::'.$selected_item);
			$data_item_details_view = null;
			
			if($selected_item == "circle")
			{
				$data_item_details_view = $this->load->view('master_data_circle_detail_update_delete_view.php',$data_item_details,TRUE);
			}
			if($selected_item == "block")
			{
				$data_item_details_view = $this->load->view('master_data_block_detail_update_delete_view.php',$data_item_details,TRUE);
			}
			if($selected_item == "gp")
			{
				$data_item_details_view = $this->load->view('master_data_gp_detail_update_delete_view.php',$data_item_details,TRUE);
			}
			
			echo $data_item_details_view;
		}
		
		public function getItemDetails()
		{
			$data_item_details = $this->master_data_update_delete_model->get_item_details(); 
			
			$selected_item = $this->input->post('selected_item');	
			
			$data_item_details_view = null;
			
			if($selected_item == "circle")
			{
				$data_item_details_view = $this->load->view('master_data_circle_edit_view.php',$data_item_details,TRUE);
			}
			if($selected_item == "block")
			{
				$data_item_details_view = $this->load->view('master_data_block_edit_view.php',$data_item_details,TRUE);
			}
			if($selected_item == "gp")
			{
				$data_item_details_view = $this->load->view('master_data_gp_edit_view.php',$data_item_details,TRUE);
			}
			
			echo $data_item_details_view;
		}
		
		public function onClickUpdateCircleData()
		{
			log_message('info','##########INSIDE onClickUpdateCircleData FUNC::');
			$response = $this->master_data_update_delete_model->update_circle_data();
			echo $response;	
		}
		
		public function onClickUpdateBlockData()
		{
			log_message('info','##########INSIDE onClickUpdateBlockData FUNC::');
			$response = $this->master_data_update_delete_model->update_block_data();
			echo $response;	
		}
		
		public function onClickUpdateGpData()
		{
			log_message('info','##########INSIDE onClickUpdateGpData FUNC::');
			$response = $this->master_data_update_delete_model->update_gp_data();
			echo $response;
		}
   }
?>