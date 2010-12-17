<?= $this->load->view("header"); ?>
<? if($sites): ?>
  <h1>Seite auswählen</h1>                        

  <ul id="allsites">
  <? foreach($sites as $site): ?>
    <li><a href="/site/edit/<?= $site->id; ?>" target="parent"><?= $site->sitename; ?></a> <span class="bottom-page"> | <a href="/site/add/<?= $site->id; ?>">Unterseite anlegen</a></span></li>
  <? endforeach; ?>
  <li class="new"><a href="/site/add/">Neue Seite erstellen</a></li>  
  </ul>

<? else: ?>
  Noch keine Seite angelegt

  <a href="/site/add" target="parent">Seite anlegen</a>

<? endif; ?>

