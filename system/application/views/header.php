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
    
    $("#allsites ul li").hover(function(element){
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
        
        $("input[name=template_id]").val($(this).attr("id"));     
        
        $("#select-template img").removeClass("active");
        
        $(this).addClass("active");
      });

     $("#peppsystem-tab-navigation a").click(function(){
       $("#peppsystem-tab-navigation li").removeClass("active");
       $("#linkdata, #linkextern, #linksystem").hide();
       $(this).parent().addClass("active");
       $("#"+$(this).attr("href")).show();
       return false;
     });

     $("#linksystem a").click(function(){
        
      
        console.log($(parent.document).find("body .cleditorPopup input[type=text]").val($(this).attr("href")));
        removeInsertLink();

        return false;
     });
          
  });  
  
  function removeInsertLink(){
      $(parent.document).find("#peppsystem-upload-index").remove();
  }
  
  function showInsertLink(){
    
    $('<div id="peppsystem-upload-index"><iframe src="/upload" width="494" height="217" border="0" /></div>').css({
      'width':'502px',
      'height':'260px',
      'background-color' : '#FFF',
      'position' : 'absolute',
      'z-index': 10001,
      'border' : '1px solid #999999',
      'border-top' : '0px',
      'top' : 90,
      'left' : $("#peppsystem-page-inner").offset().left
    }).appendTo("#peppsystem-page-inner");
    
  }

  </script>
</head>