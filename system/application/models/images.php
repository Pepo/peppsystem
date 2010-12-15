<?
class Images extends Model {

    function Images()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function writeImage($imageData){
      
      
      $query = $this->db->get_where('images', array('site_id'=> $imageData["site_id"],'image_id'=> $imageData["image_id"]), 1, 0);


      $data = array('site_id'=> $imageData["site_id"],'image_id'=> $imageData["image_id"],'path' => $imageData["path"]);     

      if($query->num_rows() == 0){

        $this->db->insert('images', $data);              

        print $this->input->post("content");
        
      }else{
        
        $query = $this->db->update('images', $data, array('site_id'=>$imageData["site_id"], 'image_id'=> $imageData["image_id"]));
        
        print $this->input->post("content");
        
      }      
      
    }  
    
    function get_images($site_id){
      $array = array();
      $query = $this->db->get_where('images', array("site_id" => $site_id));
      
      foreach ($query->result() as $row)
      {
        $array[$row->image_id] = $row->path;
      }     
      
      return $array;
      
      
    }
    

}
?>