<? $this->load->view("header"); ?>

<ul id="peppsystem-tab-navigation">
  <li class="active"><a href="linksystem">Externer Link</a></li>
  <li><a href="linkextern">Link auf System</a></li>
  <li><a href="linkdata">Link auf Datei</a></li>
</ul>

<div id="peppsystem-file-content">
  <div id="linksystem">
    <h1>Systemlink</h1>
    <form>
      <label>Seite auswählen</label>
      <? sites_as_tree_as_html($sites); ?>
  </div>

  <div id="linkextern">
    <h1>Link auf Externe Seite</h1>
  </div>


  <div id="linkdata">
    <h1>Datei auswählen</h1>
    <ul>
    <? foreach($uploads as $upload): ?>
        <li><a href="<?= $upload; ?>"><?= $upload; ?></a></li>
      <? endforeach; ?>
    </ul>           
  </div>  
</div>  
<? $this->load->view("footer"); ?>

<?
function sites_as_tree_as_html($array,$parent_site_id = 0){
    print "<ul>";         
    foreach($array as $site):
      if($site["parent_site_id"] == $parent_site_id):
        print "<li>";
        ?>
        <li><a href="/site/show/<?= $site["id"]; ?>" target="parent"><?= $site["sitename"]; ?></a> <span class="bottom-page"> | <a href="/site/add/<?= $site["id"]; ?>">Unterseite anlegen</a></span></li>
        <?
        sites_as_tree_as_html($array,$site["id"]);
        print "</li>";
      endif;
    endforeach;
    
    print "</ul>"; 
  
}?>