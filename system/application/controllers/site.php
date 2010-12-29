<?
class Site extends Controller{
  
  function __construct(){
    parent::Controller();
    $this->load->model('sites');                
    $this->load->model('templates');      
    $this->load->model('images');  
    $this->load->model('texts');  
  }  
  
  function index(){       
    $this->load->model('sites');        

    $data["sites"] = $this->sites->get_all_sites();

    /**
    *  ist User nicht eingeloggt und hat auch noch keine Seite angelegt, leite um zum Login
    */ 
    if(count($data["sites"]) <= 0 && $this->session->userdata("login") != true){
      redirect("/admin/");
    }

    /**
    *  ist User nicht eingeloggt zeige Startseite
    */ 

    else{
      $id = $this->sites->get_homepage_id(); 
      redirect("/site/show/".$id);
    }
  }        

  function show_all_pages(){
    $data["sites"] = $this->sites->get_all_sites();
    $this->load->view("sites_all_pages",$data);
  }
  
  function show(){   
      
      if($this->session->userdata("login")){
        $this->edit();
       return false; 
      }
    
      $this->load->helper('file');

      $id = $this->uri->segment(3);
      
      $site = $this->sites->get_site($id);
      
      $images = $this->images->get_images($id);


      $template = $this->templates->get_template($site["template_id"]);    

      $texts = $this->texts->get_texts($id);

      $this->load->library('domparser');

      $html = new simple_html_dom();

      $template = $this->load->view('website_templates/'.$template,array(),true);

      $html->load($template);
      
      foreach( $html->find("[peppsystemedit=single]") as $key => $value){

        if(isset($texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid]) && $texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid]["content"] != ""){
          $text = $texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid]["content"];
        }else{
          $html->find("[peppsystemedit=single]",$key)->outertext = "";
        }
        
        if(isset($text)){
          $html->find("[peppsystemedit=single]",$key)->innertext = $text;
        }
      }

      foreach( $html->find("[peppsystemedit=multiple]") as $key => $value){
        if(isset($texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid])  && $texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid]["content"] != ""){
          $text = $texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid]["content"];
        }else{
          $html->find("[peppsystemedit=multiple]",$key)->outertext = "";
            }

        if(isset($text)){
        $html->find("[peppsystemedit=multiple]",$key)->innertext = $this->sites->replaceText($text);          
        }

        
      }



      foreach($html->find("img[peppsystemedit]") as $item){      

        if( isset($images[$item->peppsystemid]) ){
          $item->src = "/uploads/".$images[$item->peppsystemid];
        }else{
          $item->outertext = "";
        }

      }
      $anz = count($html->find("[peppsystemid]"));

      for($i=0;$i <= $anz; $i++){

        $html->find("[peppsystemedit]",0)->peppsystemedit = null;
        $html->find("[peppsystemid]",0)->peppsystemid = null;

      }

      print $html->save();
                
  }
                   
  
  function add(){
    $this->load->model('templates');    

    $this->templates->check_new_templates();
    
    $data["templates"] = $this->templates->get_all_templates();

    $this->load->view("sites_add.php",$data);    
    
  }

  function save(){
    $this->load->model('sites');
    
    $data["id"] = $id = $this->sites->create($this->input->get_post('template_id'),$this->input->get_post('sitename'),$this->input->get_post('parent_id'));
    
    redirect("/site/show_all_pages/");
                  
  }  
  
  function edit(){
    
    if(!$this->session->userdata("login")){
      redirect("/admin");
    }
            
    $this->load->helper('file');

    $id = $this->uri->segment(3);    

    $site = $this->sites->get_site($id);    

    $texts = $this->texts->get_texts($id);

    $images = $this->images->get_images($id);

    $template = $this->templates->get_template($site["template_id"]);

    $pfad = 'website_templates/'.$template;
    
    $this->load->library('domparser');

    $html = new simple_html_dom();
    
    $html->load_file($pfad);
    
    foreach( $html->find("[peppsystemedit=single]") as $key => $value){
      if(isset($texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid])  && $texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid]["content"] != ""){
        $text = $texts[$html->find("[peppsystemedit=single]",$key)->peppsystemid]["content"];
      }else{
        $text = "Text eingeben";
      }
      $html->find("[peppsystemedit=single]",$key)->innertext = "$text";
    }

    foreach( $html->find("[peppsystemedit=multiple]") as $key => $value){
      if(isset($texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid])  && $texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid]["content"] != ""){
        $text = $texts[$html->find("[peppsystemedit=multiple]",$key)->peppsystemid]["content"];
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
    $data["template"] = str_replace("</head>",'<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script><script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script><script src="/peppsystem_templates/peppsystem.js"></script></head>',$data["template"]);
    $data["template"] = str_replace("</head>",'<link href="/peppsystem_templates/peppsystem.css" rel="stylesheet" type="text/css" media="all" /></head>',$data["template"]);
    
    $template = $html;
    
    $this->load->view("site",$data);
    

    
  } 
  
  function addcontent(){
    $this->sites->addcontent();
  }

}
?>