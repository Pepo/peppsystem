<?
class Site extends Controller{
  
  function __construct(){
    parent::Controller();
    $this->load->model('sites');                
    $this->load->model('templates');      
  }  
  
  function index(){       

    $this->load->model('sites');    
    $data["sites"] = $this->sites->get_last_ten_entries();
    
    $this->load->view("sites_index.php",$data);
    
  }                         
  
  function add(){
    $this->load->model('templates');    

    $data["templates"] = $this->templates->get_last_ten_entries();

    $this->load->view("sites_add.php",$data);    
    
  }

  function save(){
    $this->load->model('sites');
    $this->sites->create($this->input->get_post('template'),$this->input->get_post('sitename'));
  }  
  
  function edit(){
    $this->load->helper('file');
    
    $site = $this->sites->get_site($this->uri->segment(3));

    $template = $this->templates->get_template($site["template_id"]);    

    $texts = $this->sites->get_texts($this->uri->segment(3));

    $pfad = 'website_templates/'.$template;
    
    $this->load->library('domparser');

    $html = new simple_html_dom();
    
    $html->load_file($pfad);
    
    foreach( $html->find("[peppsystem-edit=single]") as $key => $value){
      $html->find("[peppsystem-edit=single]",$key)->innertext = $texts[$html->find("[peppsystem-edit=single]",$key)->peppsystem_id];
    }
    
   
    $data["template"] = $html->save();

    // Dirty Replacements
    $data["template"] = str_replace("</head>",'<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script><script src="/peppsystem_templates/peppsystem.js"></script></html>',$data["template"]);
    
    $template = $html;
    
    $this->load->view("header");
    
    $this->load->view("site",$data);
    
    $this->load->view("footer");    

    
  } 
  
  function addcontent(){
    $this->sites->addcontent();
  }

}
?>