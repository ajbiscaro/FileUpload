<?php
/**
 * File Upload Model
 * Model for uploading file.
 * @File name: upload_model.php
 * @Version: 1.0 (September 29, 2013)
 * @copyright Copyright (C) Ardel John Biscaro
 * @link http://ajbiscaro.net84.net
 **/

class Upload_model extends CI_Model {
		
	function get_upload_list()
	{
	
		$this->db->select('file_id, filename');
	  	$this->db->from('files');
	  	$this->db->order_by('filename');
	  
	  	$return['rows'] = $this->db->get()->result();

	  	return $return;

	} 
	
	function save_upload($fileName, $filePath, $fileType, $fileSize)
	{
	
		$fileSize = $fileSize * 1024;
			
		$upload_data = array(
			'filename' => $fileName,
			'location' => $filePath,
			'type' => $fileType,
			'size' => $fileSize
		);	
		
		if ( $fileSize > 0 )
		{	
			$insert = $this->db->insert('files', $upload_data);
			return $this->db->insert_id();
		}
	
	}
	
	function delete_upload($id)
	{
		$this->db->select('location');
	  	$this->db->where('file_id',$id);
	  	$query1=$this->db->get('files');
	  	
	  	if ($query1->num_rows() > 0) 
		{
			foreach($query1->result_array() as $row) 
			{
	      	$location = $row['location'];
	  	 	}
		}
		
		$result = unlink($location);
		
		$this->db->where('file_id',$id);
		$query2=$this->db->delete('files');
		
		if ($query2 > 0) 
		{
			return true;
		}else
		{
			return false;
		}
	}
	
	function downloadFile($id)
	{	 	    
	 	$query= $this->db->get_where('files',array('file_id' => $id));

	   $row = $query->result();
	   
	   $size = $row[0]->size;
	   $type = $row[0]->type;
	   $name = $row[0]->filename;
	   $filePath = $row[0]->location;
	   
	   header("Content-Type: ". $type);
	   header("Content-Length: ". $size);
	   header("Content-Disposition: attachment; filename=". $name);
	   
	   readfile($filePath);
	
	   
	   exit;

	}
	
}