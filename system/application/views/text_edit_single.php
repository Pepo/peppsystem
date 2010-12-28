<?= $this->load->view("header"); ?>
<body class="iframe">
  <div id="peppsystem-page"> 
    <div id="peppsystem-page-inner">
<h1>Text eingeben:</h1>
<?= form_open("text/single_save")?>

  <?= form_hidden('site_id', $this->uri->segment("3")); ?>
  <?= form_hidden('text_id', $this->uri->segment("4")); ?>
  <?= form_hidden('block', $this->uri->segment("5")); ?>
  <?= form_input('content'); ?>

  <input type="reset" value="Abbrechen" />
  <input type="submit" value="Continue &rarr;">
<?= form_close() ?>

<?= $this->load->view("footer"); ?>