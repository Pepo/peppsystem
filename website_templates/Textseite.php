<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>untitled</title>
	<style type="text/css" media="screen">
	 #page{
	   border:1px solid #c0c0c0;
	   width:750px;
	   margin:0 auto;    
	   padding:18px;   
	   padding-top:0;
	 }               
   
  #header h1{
      padding:0.75em 0;
   }
   
                
   
	 #header{
	   background-color:#003A6C;
	   color:#fff;
	   height:150px;
	 }
	.content img{
	  float:left;
	  padding:2px;
	  margin:2px;
	  border:1px solid black;
	  margin-right:1em;
	  margin-bottom:1em;
	} 
	
  /* float clearing for IE6 */
  * html .clearfix{
  height: 1%;
  overflow: visible;
  }

  /* float clearing for IE7 */
  *+html .clearfix{
  min-height: 1%;
  }

  /* float clearing for everyone else */
  .clearfix:after{
  clear: both;
  content: ".";
  display: block;
  height: 0;
  visibility: hidden;
  font-size: 0;
  }

  A: Answer 2:

  .clearfix {
  overflow: hidden;
  }

  /* triggers has layout in IE6 */
  .container {
  zoom: 1;
  }	
	</style>
	

</head>

<body>
<div id="page">  
  <div id="header">
    <h1 class="irgendwas" peppsystemedit="single" peppsystemid="1">Header</h1>
  </div>
  <h1 peppsystemid="2" peppsystemedit="single">Überschrift</h1>
  <div class="content clearfix">
    <img src="temp_picture.png" height="300" width="400" peppsystemedit="picture" peppsystemid="2" alt="" />
    <p class="irgendwas" peppsystemid="3" peppsystemedit="multiple">Beispieltext-Mehrzeilig</p>
  </div>
    <img src="temp_picture.png" height="300" width="400" peppsystemedit="picture" peppsystemid="1" alt="" />
<div class="clearfix">
    <img src="temp_picture.png" height="80" width="120" peppsystemedit="picture" peppsystemid="3" alt="" />
</div>    
</div>  

</body>
</html>