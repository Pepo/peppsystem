<?
class Admin extends Controller{
  
  function __construct(){
    parent::Controller();
    $this->load->model('Registered_Users');  
  }
  
  function index(){
    if($_POST)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('benutzername','Benutzername','trim|required');
        $this->form_validation->set_rules('passwort','Passwort','trim|required');

        if($this->form_validation->run() == FALSE){
          $this->load->view("loginform");
        }else{
          if($this->Registered_Users->isLogin($this->input->post('benutzername'),$this->input->post('passwort'))){
            $this->session->set_userdata('login', true);
            $this->session->set_userdata('username', $this->input->post('benutzername'));            

            redirect('/', 'refresh');            
          }else{               
            print "nologin";
            $this->load->view("loginform");
          }

        }
       
    }else{
      $this->load->view("loginform");
    }
  }

  function logout(){
    $this->session->unset_userdata("login");
    redirect('/', 'refresh'); 
  }
}


?>