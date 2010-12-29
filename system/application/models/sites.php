<?
class Sites extends Model {

    var $id   = '';
    var $sitename = '';


    function Sites()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function get_all_sites(){
      $array = array();
      $query = $this->db->get_where("sites");

     foreach( $query->result() as $site){
       $array[$site->id]["id"] = $site->id;
       $array[$site->id]["parent_site_id"] = $site->parent_site_id;
       $array[$site->id]["sitename"] = $site->sitename;
     }
        
     return $array;

    }



    function get_homepage_id(){
      $query = $this->db->get('config',array('name' => "homepage"));      
      return $query->row()->value; 
    }
        
    function get_last_ten_entries()
    {
        $query = $this->db->get('sites');
        
        return $query->result();
        
    }   
    
    function create($id,$name,$parent_id = 0){
      $query = $this->db->get('sites');
      $data = array(
                     'template_id' => $id,
                     'sitename' => $name,
                     'parent_site_id' => $parent_id
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
   
   function get_homepage(){
     $query = $this->db->query('select * from config WHERE name = "homepage"');     
     return $query->row_array();
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