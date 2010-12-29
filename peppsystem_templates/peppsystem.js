$(document).ready(function(){
  peppsystem.init();
});                 

peppsystem = {
  init : function(){
    peppsystem.editclick();
    peppsystem.createAdmin();   
    peppsystem.editimageclick();
    peppsystem.editblockclick();
    alert("block branch");
  },

  editblockclick : function(){
    var top = $("[peppsystemedit=block]").offset().top;
    var left = $("[peppsystemedit=block]").offset().left -20;   

    $("[peppsystemedit=block]").each(function(index){
      $("body").append($('<a class="peppsystem-button-edit peppsystem-block-clone peppsystem-button-edit-on-fly" peppsystemid="'+$("[peppsystemedit=block]").eq(index).attr("peppsystemid")+'"></a>').css({'left':left,'top':top,'position':'absolute'}));
    });
    
    
    $('.peppsystem-block-clone').hover(function(){
      var block_id = $(this).attr("peppsystemid");
      var clone;   
      var base_element;
    });
    
    $('.peppsystem-block-clone').click(function(){
      var block_id = $(this).attr("peppsystemid");
      var clone;   
      var base_element;
      $("[peppsystemedit=block]").each(function(index){
        if($(this).attr("peppsystemid") == block_id){
          base_element = $(this);
          clone = $(this).clone();
        };
      });

      clone.insertAfter(base_element);

    });

  },
  editclick : function(element){  
    $('.peppsystem-button-edit').remove();
      $("[peppsystemedit=single],[peppsystemedit=multiple]").prepend($('<a class="peppsystem-button-edit"></a>'));     
      $(".peppsystem-button-edit").click(function(){ 
        element = $(this).parent()
        if(element.attr("peppsystemedit") == "multiple"){
          peppsystem.showIframeContent(element,"/index.php/text/edit_multiple/");        
        }else{
          peppsystem.showIframeContent(element,"/index.php/text/edit_single/");                  
        }
      });
  },
  
  editimageclick : function(){                
    $("img[peppsystemedit=picture]").offset().top;
    $("img[peppsystemedit=picture]").offset().left;
    
    $("img[peppsystemedit=picture]").each(function(index){

      $("body").append($('<a class="peppsystem-button-edit peppsystem-button-edit-on-fly" peppsystemid=' + $("img[peppsystemedit=picture]").eq(index).attr("peppsystemid") + '></a>').css({
        'position' : 'absolute',
        'left' : $("img[peppsystemedit=picture]").eq(index).offset().left + 2,
        'top' : $("img[peppsystemedit=picture]").eq(index).offset().top + 2,
      }).click(function(){
        peppsystem.showIframeContent($("img[peppsystemedit=picture]").eq(index),'/index.php/upload/do_upload/');
        return false;
      }));
            
    });
    
    
    
  },
  showIframeContent : function(clickedElement, uri){
    
    peppsystem.removeSystem();
    
    width = $(clickedElement).attr("width");
    height = $(clickedElement).attr("height");    

    id = $(clickedElement).attr("peppsystemid"); 

    siteId = location.href.split("/");
    siteId = siteId.reverse();
    siteId = siteId[0];
    
    block = 0;
    
    $('body').css({'overflow':'hidden'});
                
    $('<div id="peppsystem-overlay"></div>').appendTo($("body"));
    $('<div id="peppsystem-overlay-content"></div>').appendTo($("body"));

    $('#peppsystem-overlay').css({
      'height' : $("body").height()+200,
    });

    if( $(clickedElement).is("img") ){
      $('<iframe src="' + uri + width + '/' + height +'/' + siteId + '/' + id +'/' + block +'" width="600" height="600"></iframe>').appendTo($("#peppsystem-overlay-content"));      
    }else{
      $('<iframe src="' + uri + siteId + '/' + id +'/' + block +'" width="600" height="600"></iframe>').appendTo($("#peppsystem-overlay-content"));      
    }
        

        
  },
    
  showSingleEdit : function(htmlsnippet, clickedElement){
    
    if($(clickedElement).attr("peppsystemedit") == "multiple"){
      htmlsnippet = "edit_multiple.html";      
    }else{
      htmlsnippet = "edit_single.html";
    }
    
    $('<div id="peppsystem-overlay"></div>').appendTo($("body"));
    $('<div id="peppsystem-overlay-content"></div>').appendTo($("body"));
      
      $.ajax({
        url: "/peppsystem_templates/"+htmlsnippet,
        success : function(data){
           $("#peppsystem-overlay-content").append(data);
        },
        complete : function(){           
          $("#peppsystem-overlay-content").submit(function(){
              if(htmlsnippet == "edit_multiple.html"){
                peppsystem.writeContent($("textarea:first").val(),clickedElement);                
              }else{
                peppsystem.writeContent($("input:first").val(),clickedElement);
              }
             return false;
          });


    $("#peppsystem-overlay-content").bind("reset", function() {
      if(confirm("Wirklich abbrechen?")){
        peppsystem.removeSystem();
      }      
    });        

        }
      });
          
  },   
     
  writeContent : function(content,clickedElement){
    id = $(clickedElement).attr("peppsystemid"); 
    siteId = location.href.split("/");
    siteId = siteId.reverse();
    siteId = siteId[0]; 
    console.log(id);
    console.log(content);    
    console.log(siteId);                                  

    $.ajax({
      url : "../addcontent",
      type: "POST",
      data: "content="+content +"&id="+id+"&site="+siteId,
      success: function(msg){ 
        peppsystem.editclick();
      },
      complete : function(){
        peppsystem.removeSystem();
        window.location.reload();
      }      
    });
  },
  
  removeSystem : function(){
    $("#peppsystem-overlay, #peppsystem-overlay-content").remove();
  },   
  
  addNewImage : function(path){
    
      $('"img[peppsystemid='+path.image_id+']"').attr("src","/uploads/"+path.path);
    
    peppsystem.removeSystem();
  },
  
  createAdmin : function(){
    $('<div id="peppsystem-admin"></div>').appendTo($("body"));
    $('peppsystem-admin').css({
      'position':'absolute',
      'left':0
    })         
    
    $.ajax({
      url : "/system/application/views/site_admin.php",
      success : function(data){   
        $("#peppsystem-admin").html(data);
      },complete : function(){
        $("#peppsystem-admin a").click(function(){
          if($(this).attr("class") == "iframe"){
            peppsystem.showIframeContent(this,$(this).attr("href"));
            return false;
          }
        });
      }
    });
  },
  
  showInsertLink : function(){
    alert("jammas");
  }
}
