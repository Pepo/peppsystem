<?
class Texts extends Model {

  function single_save(){

    $site_id = $this->input->post("site_id");
    $text_id = $this->input->post("text_id");
    $content = $this->input->post("content");
    
    /**
    * cleEdit übergibt Leere Textfelder mit <br>. Dies schmeißt das raus.
    */
    if($content == "<br>"){
      $content = "";
    }
        
    $data = array('site_id' => $site_id, 'text_id' => $text_id, 'content' => $content, 'created_on' => date("Y-m-d H:i:s"));

    $this->db->insert('text', $data);              

    return true;
  }             
  
  function get_last_entry(){          

    $query = $this->db->get_where( 'text',array("id" => $this->db->insert_id()) );                  
    
    return $query->row();
  }

  function get_single_text($site_id,$text_id,$block_id){
    $this->db->order_by('created_on desc'); 

    $query = $this->db->get('text',array("site_id" => $site_id, "text_id" => $text_id, "block_id" => $block_id));
    
    if($query->num_rows > 0){
      print $query->row()->content;       
      return $query->row()->content;      
    }else{
      return false;
    }
   
  }

  function get_texts(){      
    
    $query = $this->db->get_where('text', array("site_id" => $this->uri->segment("3")) );
    
    
    $array = array();

    foreach ($query->result() as $key)
    { 
        $array[$key->text_id] = array("site_id" => $key->site_id, "content" => $key->content);
    }     

    return $array;

  }

}
?>