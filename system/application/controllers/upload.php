<?php

class Upload extends Controller {
	
	function Upload()
	{
		parent::Controller();
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{	
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '10240';
		$config['max_height']  = '7680';
    
    $this->load->library('upload', $config);
    	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			
			$this->load->view('upload_form', $error);
		}	
		else
		{
			$data = array('upload_data' => $this->upload->data());

			// resize the image
      $site_id = $this->input->post("site_id");		
      $image_id = $this->input->post("image_id");		      
      $uploaddata = $this->upload->data();               
      
      $picture['image_library'] = 'gd2';      
      $picture['source_image'] = $uploaddata["full_path"];			
			$picture['width'] = $this->input->post("width");
			$picture['height'] = $this->input->post("height");
			$picture['maintain_ratio'] = false;

      $this->load->library('image_lib',$picture);
      $this->image_lib->resize();
      
      $this->load->model("images");
      
      $this->images->writeImage(array("site_id" => $site_id, "image_id" => $image_id, "path" => $uploaddata["file_name"]));
      
      $data["path"] = $uploaddata["file_name"];
      $data["site_id"] = $site_id;
      $data["image_id"] = $image_id;

      $this->load->view('upload_success', $data);
      
		}

	}	
}
?>