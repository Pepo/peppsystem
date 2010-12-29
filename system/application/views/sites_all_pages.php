<?= $this->load->view("header"); ?>
<body class="iframe">
  <div id="peppsystem-page"> 
    <div id="peppsystem-page-inner">
<? if($sites): ?>
  <h1>Seite auswählen</h1>                        
  <div id="allsites">
    <? sites_as_tree_as_html($sites); ?>

    <ul>
  <li class="new"><a href="/site/add/">Neue Seite erstellen</a></li>
    </ul>

  </div>

<? else: ?>
      <div id="allsites">
        <h1>Noch keine Seite angelegt</h1>                        
        <ul>
          <li><a href="/site/add" target="parent">Seite anlegen</a></li>
        </ul>
     </div>
<? endif; ?>

<?

function sites_as_tree_as_html($array,$parent_site_id = 0){
    print "<ul>";         
    foreach($array as $site):
      if($site["parent_site_id"] == $parent_site_id):
        print "<li>";
        ?>
        <li><a href="/site/show/<?= $site["id"]; ?>" target="_parent"><?= $site["sitename"]; ?></a> <span class="bottom-page"> | <a href="/site/add/<?= $site["id"]; ?>">Unterseite anlegen</a></span></li>
        <?
        sites_as_tree_as_html($array,$site["id"]);
        print "</li>";
      endif;
    endforeach;
    
    print "</ul>"; 
  
}?>