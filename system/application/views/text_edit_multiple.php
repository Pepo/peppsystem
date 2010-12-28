<?= $this->load->view("header"); ?>
<body class="iframe">
  <div id="peppsystem-page"> 
    <div id="peppsystem-page-inner">
<h1>Text eingeben:</h1>
<?= form_open("text/single_save",array('id' => 'multiple-form'))?>

  <?= form_hidden('site_id', $this->uri->segment("3")); ?>
  <?= form_hidden('text_id', $this->uri->segment("4")); ?>
  <?= form_hidden('block', $this->uri->segment("5")); ?>
  <?= form_hidden('content'); ?>
  <textarea id="editor"><?= $text ?></textarea>
  <input type="reset" value="Abbrechen" />
  <input type="submit" value="Continue &rarr;">
<?= form_close() ?>


  <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("#editor").cleditor({
      controls : "bold italic underline bullets numbering link unlink"
    });                
  });

  </script>

<?= $this->load->view("footer"); ?>