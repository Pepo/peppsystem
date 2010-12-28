<?= $this->load->view("header") ?>
<body class="iframe">
  <div id="peppsystem-page"> 
     <div id="peppsystem-page-inner">

       <h1>Bild auswählen</h1>
       <?php echo $error;?>
                                                      
       <?php echo form_open_multipart('upload/do_upload');?>

       <?= form_hidden('width', $this->uri->segment("3")); ?>

       <?= form_hidden('height', $this->uri->segment("4")); ?>        

       <?= form_hidden('site_id', $this->uri->segment("5")); ?>

       <?= form_hidden('image_id', $this->uri->segment("6")); ?>
        
        <input type="file" name="userfile" size="20" />

        <input type="reset" value="Abbrechen" />

        <input type="submit" value="upload" />
      </form>        
   </div>
  </div>

</body>
</html>