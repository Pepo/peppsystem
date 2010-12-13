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
                      
                redirect("/site/edit/".$this->sites->get_last_id(),'refresh');
    
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
      
      $data = array(
                      'site_id' => $this->input->post("site"),
                      'text_id' => $this->input->post("id"),
                      'content' => $this->input->post("content")
                   );

     $this->db->insert('text', $data);              
     
     print $this->input->post("content");
   }

   function get_texts(){      
     $query = $this->db->get('text', array("site_id" => 32) );
     $array = array();
     foreach ($query->result() as $row)
     {
       $array[$row->text_id] = $row->content;
     }     

     return $array;

   }

}
?>