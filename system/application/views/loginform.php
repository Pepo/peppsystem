<?= $this->load->view("header"); ?>       
<body class="iframe">
  <div id="peppsystem-page">
    <div id="peppsystem-page-inner">
    <?php echo form_open("admin"); ?>
    <label>Benutzername</label>
    <input type="text" name="benutzername" value="<? echo set_value('benutzername'); ?>">
    <label>Passwort</label>
    <input type="password" name="passwort" value="<? echo set_value('passwort'); ?>">
    <?php echo form_submit("","Login"); ?>

    <?php echo validation_errors(); ?>
    
    <?php echo form_close(); ?>
    </div>
  </div>
  </bod> 
  </html>