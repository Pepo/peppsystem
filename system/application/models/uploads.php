<?
class Uploads extends Model {

  function get_all_files(){

    $this->load->helper('directory');     

    $map = directory_map('./uploads/',true);

    $newmap = array();

    foreach($map as $key => $item){
      if(preg_match("/\./",$item)){                            
        $newmap[$key] = $item;
      }
    }

    $images = $newmap;                     

    $files = directory_map('./uploads/files/',true);
    
    $files =  array_merge ($files, $images);

    return $files;

  }

}
?>
