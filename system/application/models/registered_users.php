<?php

class Registered_Users extends Model{
  function getAll(){
    $q = $this->db->get('test');
    if($q->num_rows() > 0){
      foreach($q->result() as $row){
        $data[] = $row;
      }                
      return $data;
    }    
  }    

  function create(){
    $activate_key = md5("§(=!FCS04)|||/!+±]±å".$this->input->post('benutzername'));
    $activate_key = substr($activate_key,0,5);
    
    $data = array(
                   'benutzername' => $this->input->post('benutzername'),
                   'email' => $this->input->post('email'),
                   'name' => $this->input->post('nachname'),      
                   'vorname' => $this->input->post('vorname'),      
                   'strasse' => $this->input->post('strasse'),      
                   'ort' => $this->input->post('plzort'),
                   'passwort' => $this->input->post('password'),
                   'activate_slug' => $activate_key
                );
                
    $this->db->insert('users', $data);
  
    return $activate_key;
  }      
  
  function isUnique($datenfeld,$value){
    
    $query = $this->db->get_where('users', array($datenfeld => $value));
    if($query->num_rows() > 0){
      return false;          
    }else{
      return true;
    }

  }      

  function isExists($datenfeld,$value){
    
    $query = $this->db->get_where('users', array($datenfeld => $value));
    if($query->num_rows() == 1){
      return true;          
    }else{
      return false;
    }
  }      
  


  function isLogin($benutzername,$password){

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";

    $query = $this->db->query($sql, array($benutzername,$password));    
    
    if($query->num_rows() == 1){
      return true;
    }else{
      return false;
    }

  }     

  function setForgetSlug($benutzermail){
    $forget_slug = md5("§(=!FCS04)|||/!+±]±å".$benutzermail.time());
    $forget_slug = substr($forget_slug,0,5);              
    $data = array(
                   'forget_slug' => $forget_slug
                );

    $this->db->where('email', $benutzermail);

    $this->db->update('users', $data);

    return $forget_slug;
  }
  
  function updatePass($pass,$key){
    $data = array(
                   'passwort' => $pass,
                   'forget_slug' => ''
                );

    $this->db->where('forget_slug', $key);
    $this->db->update('users', $data);
  }
  
  function getUserIdByUsername($username){
    $query = $this->db->get_where('users', array('benutzername' => $username));
    return $query->row_array("id");
  }
  
}


?>