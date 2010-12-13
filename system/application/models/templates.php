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

}
?>