<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>untitled</title>

  <link href="/peppsystem_templates/peppsystem.css" rel="stylesheet" type="text/css" media="all" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      


      $(".peppsystem-button-blue").click(function(){
        parent.peppsystem.addNewImage({ "image_id" : "<?= $image_id ?>", "site_id" : "<?= $site_id ?>", "path" : "<?= $path ?>" });        
        return false;
      });
    });
  </script>
</head>

<body class="iframe">
<div id="peppsystem-page">
  <div id="peppsytem-page-inner">
    <h1>Upload Erfolgreich</h1>  
    <a class="peppsystem-button-blue" href="close">Übernehmen</a>
  </div>  
</div>
</body>
</html>