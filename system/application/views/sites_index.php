<?= $this->load->view("header"); ?>
<? if($sites): ?>
  <h1>Seite auswählen</h1>                        
  <? foreach($sites as $site): ?>
  <ul id="allsites">
    <li><a href="/index.php/site/edit/<?= $site->id; ?>" target="parent"><?= $site->sitename; ?></a></li>
  </ul>

    
  <? endforeach; ?>


<? else: ?>
  Noch keine Seite angelegt

  <a href="/index.php/site/add" target="parent">Seite anlegen</a>

<? endif; ?>
<?= $this->load->view("footer"); ?>