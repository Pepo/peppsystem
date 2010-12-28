<?
class Text extends Controller{
  
  function __construct(){
    parent::Controller();
    $this->load->model('texts');                
  }  
  
  function index(){       
    
  }        

  function edit_multiple(){
    $data["text"] = $this->texts->get_single_text($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
    
    $this->load->view("text_edit_multiple.php",$data);
  }

  
  function edit_single(){
    $this->load->view("text_edit_single.php");
  }

  function single_save(){
    if($this->texts->single_save()){

      $entry = $this->texts->get_last_entry();
      
      $data["id"] = $entry->site_id;
      
      $this->load->view("text_single_save.php",$data);
    }
  }

}
?>