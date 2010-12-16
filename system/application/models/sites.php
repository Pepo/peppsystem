<?
class Sites extends Model {

    var $id   = '';
    var $sitename = '';


    function Sites()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('sites');
        
        return $query->result();
        
    }   
    
    function create($id,$name){
      $query = $this->db->get('sites');
      $data = array(
                     'template_id' => $id,
                     'sitename' => $name
                  );


                $this->db->insert('sites', $data);
                      
                  return $this->sites->get_last_id();
    
    }

    function get_last_id(){
      $query = $this->db->query('select id from sites ORDER BY id desc');
      $row = $query->row();
      return $row->id;
    }  
    
    function get_site($site_id){
      $query = $this->db->query("select * from sites WHERE id Like $site_id");
      $row = $query->row();

         $row = $query->row();

         return array("sitename" => $row->sitename, "template_id" => $row->template_id);
      
    }
    
   function get_template($site_id){
    
     $query = $this->db->query('select * from templates ORDER BY id desc');

     $row = $query->row();

     return $row->id;
   } 
   
   function addcontent(){
     
      $query = $this->db->get_where('text', array('site_id'=>'33','text_id'=> '3'), 1, 0);

      $data = array('site_id' => $this->input->post("site"),'text_id' => $this->input->post("id"),'content' => $this->input->post("content"));     

      if($query->num_rows() == 0){

        $this->db->insert('text', $data);              
        
      }else{
        
        $query = $this->db->update('text', $data, array('site_id'=>'33','text_id'=> '3'));
        
      }
     


   }
   
   function replaceText($text){
     $text = str_replace("\n\n","</p><p>",$text);
     $text = str_replace("\n","<br />",$text);
     $text = str_replace("</p><p>","</p>\n<p>",$text);
     $text = str_replace("<br />","\n<br />",$text);

     return "<p>".$text;
   }

}
?>