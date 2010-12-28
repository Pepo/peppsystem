<?= $this->load->view("header"); ?>       
<body class="iframe">
  <div id="peppsystem-page"> 
    <div id="peppsystem-page-inner">
<h1>Seitenname</h1>
<?= form_open('site/save');?>
<?= form_input('sitename'); ?>
<?= form_hidden('parent_id', $this->uri->segment(3)); ?>   
<?= form_hidden('template_id',""); ?>   
  <h1>Template wählen</h1>
  <div id="select-template">

  <? 
  foreach($templates as $key => $template): 

  $templateimg = preg_replace("/\.(.*)$/",".png",$template)

  ?>

   <img src="/website_templates/images/<?= $templateimg ?>" id="<?= $key ?>" width="100">
  <? endforeach; ?>
  </div>
<p><?= form_reset("","Abbrechen"); ?> <?= form_submit("","Speichern"); ?></p>

<?= form_close();?>                  
<?= $this->load->view("footer"); ?>       