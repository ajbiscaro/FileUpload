<?php  
/**
 * File Upload Controller
 * Controller for uploading file.
 * @File name: upload.php
 * @Version: 1.0 (September 29, 2013)
 * @copyright Copyright (C) Ardel John Biscaro
 * @link http://ajbiscaro.net84.net
 **/
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Upload extends CI_Controller {
 
    function __construct()
    {
    		parent::__construct();
			
			//load upload model
			$this->load->model('upload_model');
 
    }
 
    public function index()
    {
    	//load uploaded files
    	$uploaded_files = $this->upload_model->get_upload_list();   
 		$data['uploads'] = $uploaded_files['rows'];

		$data['error']	= '';
		$data['msg']	= '';
		
		$this->load->view('upload', $data);
	}
	
	function do_upload()
	{
		$data['msg']	= '';
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf|docx|gif|jpg|png|txt';
		$config['max_size']	= '52428800';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		

		$this->load->library('upload', $config);
	

		if ( ! $this->upload->do_upload())
		{
			$data['error'] = $this->upload->display_errors();
			
			//load uploaded files
			$uploaded_files = $this->upload_model->get_upload_list(); 
			$data['uploads'] = $uploaded_files['rows'];
			
			$this->load->view('upload', $data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			
        	$fileName = $data['upload_data']['file_name'];
			$filePath = $data['upload_data']['full_path'];
			$fileSize = $data['upload_data']['file_size'];
			$fileType = $data['upload_data']['file_type'];
						
			$results = $this->upload_model->save_upload($fileName, $filePath, $fileType, $fileSize);
						
			//load uploaded files
			$uploaded_files = $this->upload_model->get_upload_list(); 
			$data['uploads'] = $uploaded_files['rows'];
			
			$data['msg']	= 'The file '.$fileName.' was successfully uploaded!';
			$data['error'] = '';

			if($results && $uploaded_files) $this->load->view('upload', $data);
		}
	}
	
	function downloadFile($id)
	{
		$return_reply = $this->upload_model->downloadFile($id);
	}
	
	function deleteFile($id)
	{
		$return_reply = $this->upload_model->delete_upload($id);
		 
		echo 'Record/s deleted successfully';
	}
	
}
 