<?
class Site extends Controller{
  
  function __construct(){
    parent::Controller();
    $this->load->model('sites');                
    $this->load->model('templates');      
    $this->load->model('images');  
  }  
  
  function index(){       

    $this->load->model('sites');    
    $data["sites"] = $this->sites->get_last_ten_entries();
    $this->load->view("sites_index.php",$data);
    
    if(!$this->session->userdata("login")){
      redirect("/site/show/1");
    }
    
  }        
  
  function show(){ 
     $this->load->helper('file');

      $site = $this->sites->get_site($this->uri->segment(3));

      $images = $this->images->get_images($this->uri->segment(3));


      $template = $this->templates->get_template($site["template_id"]);    

      $texts = $this->sites->get_texts($this->uri->segment(3));

      $pfad = 'website_templates/'.$template;

      $this->load->library('domparser');

      $html = new simple_html_dom();

      $html->load_file($pfad);

      foreach( $html->find("[peppsystemedit=single]") as $key => $value){
        if(isset($texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid])){
          $text = $texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid];
        }

        $html->find("[peppsystemedit=single]",$key)->innertext = $text;
      }

      foreach( $html->find("[peppsystemedit=multiple]") as $key => $value){
        if(isset($texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid])){
          $text = $texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid];
        }

        $html->find("[peppsystemedit=multiple]",$key)->innertext = $this->sites->replaceText($text);
      }



      foreach($html->find("img[peppsystemedit]") as $item){      

        if( isset($images[$item->peppsystemid]) ){

          $item->src = "/uploads/".$images[$item->peppsystemid];

        }

      }
      $anz = count($html->find("[peppsystemid]"));

      for($i=0;$i <= $anz; $i++){

        $html->find("[peppsystemedit]",0)->peppsystemedit = null;
        $html->find("[peppsystemid]",0)->peppsystemid = null;

      }

      print $data["template"] = $html->save();

  }
                   
  
  function add(){
    $this->load->model('templates');    

    $data["templates"] = $this->templates->get_last_ten_entries();

    $this->load->view("sites_add.php",$data);    
    
  }

  function save(){
    $this->load->model('sites');
    
    $data["id"] = $id = $this->sites->create($this->input->get_post('template'),$this->input->get_post('sitename'));

    $this->load->view("sites_save.php",$data);        
  }  
  
  function edit(){
    
    if(!$this->session->userdata("login")){
      redirect("/site/show/1");
    }
    
    $this->load->helper('file');
    
    $site = $this->sites->get_site($this->uri->segment(3));
    
    $images = $this->images->get_images($this->uri->segment(3));
    

    $template = $this->templates->get_template($site["template_id"]);    

    $texts = $this->sites->get_texts($this->uri->segment(3));

    $pfad = 'website_templates/'.$template;
    
    $this->load->library('domparser');

    $html = new simple_html_dom();
    
    $html->load_file($pfad);
    
    foreach( $html->find("[peppsystemedit=single]") as $key => $value){
      if(isset($texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid])){
        $text = $texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid];
      }else{
        $text = "Text eingeben";
      }

      $html->find("[peppsystemedit=single]",$key)->innertext = $text;
    }

    foreach( $html->find("[peppsystemedit=multiple]") as $key => $value){
      if(isset($texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid])){
        $text = $texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid];
      }else{
        $text = "Text eingeben";
      }

      $html->find("[peppsystemedit=multiple]",$key)->innertext = $this->sites->replaceText($text);
    }



    foreach($html->find("img[peppsystemedit]") as $item){      
      
      if( isset($images[$item->peppsystemid]) ){        
        $item->src = "/uploads/".$images[$item->peppsystemid];        
      }else{
        $item->src = "/peppsystem_templates/temp_picture.png";
      }
      
    }
   
    $data["template"] = $html->save();

    // Dirty Replacements
    $data["template"] = str_replace("</head>",'<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script><script src="/peppsystem_templates/peppsystem.js"></script></head>',$data["template"]);
    $data["template"] = str_replace("</head>",'<link href="/peppsystem_templates/peppsystem.css" rel="stylesheet" type="text/css" media="all" /></head>',$data["template"]);
    
    $template = $html;
    
    $this->load->view("site",$data);
    

    
  } 
  
  function addcontent(){
    $this->sites->addcontent();
  }

}
?>