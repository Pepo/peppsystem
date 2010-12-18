<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>untitled</title>

  <link href="/peppsystem_templates/peppsystem.css" rel="stylesheet" type="text/css" media="all" />
  <link href="/peppsystem_templates/cleditor/jquery.cleditor.css" rel="stylesheet" type="text/css" media="all" />

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script src="/peppsystem_templates/cleditor/jquery.cleditor.js"></script>
  
  <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    
    $("ul#allsites li").hover(function(element){
      $(this).find("span").show();
    },
    function(){
        $(this).find("span").hide();
    }
    );

    $("input[type=reset]").click(function(){
      window.parent.peppsystem.removeSystem();
    });
    
    $("input[type=submit]").click(function(){    
      content = $($("iframe")[0].contentWindow.document).find("body").html();
      $("input[name=content]").val(content);     
    });
    
    $("#select-template img").click(function(){        
        
        $("#select-template img").removeClass("active");
        
        $(this).addClass("active");
      });

  });
  </script>
</head>

<body class="iframe">
  <div id="peppsystem-page"> 
    <div id="peppsystem-page-inner">