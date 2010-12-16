<?
class Templates extends Model {

    var $id   = '';
    var $templatefile = '';


    function Sites()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function get_last_ten_entries()
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

      $map = directory_map('./website_templates/');

      $database = $this->get_last_ten_entries();
 
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