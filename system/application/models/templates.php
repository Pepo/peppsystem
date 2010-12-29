<?
class Templates extends Model {

    var $id   = '';
    var $templatefile = '';


    function Sites()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function get_all_templates()
    {
          $array = "";
          $query = $this->db->get('templates');

           foreach ($query->result() as $row)
           {
              $array[$row->id] = $row->filename;
           }

        return $array;
    }
    
    function get_template($template_id){
      
      $query = $this->db->query("select filename from templates WHERE id = '$template_id'"); 
      $row = $query->row();
      
      
      
      return $row->filename;

    }                      
    
    function check_new_templates(){
      $this->load->helper('directory');

      $map = directory_map('./website_templates/',true);

      $newmap = array();

      /*
       Schmeißt alles raus was ein Ordner ist bzw. Filenames die keinen Punkt enthalten 
      */
      foreach($map as $key => $item){
        if(preg_match("/\./",$item)){                            
          $newmap[$key] = $item;
        }
      }

      $map = $newmap;
      
      $database = $this->get_all_templates();
       
      if(!$database){
              foreach($map as $template){                                
                $this->db->insert('templates', array("filename" => $template));                          
              }
      }else{
              foreach($map as $template){
                if(!in_array($template,$database)){
                  $this->db->insert('templates', array("filename" => $template));                          
                }
              }
        
      }
      
    }

}
?>