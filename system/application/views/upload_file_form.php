<?= $this->file->load("header") ?>
<body class="iframe">
  <div id="peppsystem-page"> 
     <div id="peppsystem-page-inner">
       <h1>Datei auswählen</h1>
       <?php echo $error;?>
                                                      
       <?php echo form_open_multipart('upload/do_file_upload');?>

       <?= form_hidden('site_id', $this->uri->segment("5")); ?>

        <input type="file" name="userfile" size="20" />

        <input type="reset" value="Abbrechen" />

        <input type="submit" value="upload" />
      </form>        
   </div>
  </div>

</body>
</html>