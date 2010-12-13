<? if($sites): ?>

  <? foreach($sites as $site): ?>
  
  <a href="<?= current_url() ?>/site/edit/<?= $site->id; ?>"><?= $site->sitename; ?></a>
    

    
  <? endforeach; ?>


<? else: ?>
  Noch keine Seite angelegt

  <a href="<?= current_url() ?>/site/add">Seite anlegen</a>

<? endif; ?>