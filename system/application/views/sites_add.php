<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>untitled</title>

  <link href="/peppsystem_templates/peppsystem.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body class="iframe">
<div id="peppsystem-page"> 
   <div id="peppsystem-page-inner">
<h1>Seitenname</h1>
<?= form_open('site/save');?>
<?= form_input('sitename', 'johndoe'); ?>
<?= form_hidden('parent_id', $this->uri->segment(3)); ?>   
<p><?= form_dropdown('template', $templates ); ?></p>
<p><?= form_submit("","Speichern"); ?></p>

<?= form_close();?>                  
   </div>
</div>

</body>
</html>