$(document).ready(function(){
  peppsystem.init();
});                 

peppsystem = {
  init : function(){
    peppsystem.editclick();
    peppsystem.createAdmin();   
    peppsystem.showEditebleThings();
    peppsystem.editimageclick();
  },

  editclick : function(element){  
    $('.peppsystem-button-edit').remove();
      $("[peppsystemedit=single],[peppsystemedit=multiple]").prepend($('<a class="peppsystem-button-edit"></a>'));     
      $(".peppsystem-button-edit").click(function(){ 
        element = $(this).parent()
        peppsystem.showSingleEdit("edit_single.html",element);        
      });
  },
  
  editimageclick : function(){                
    $("img[peppsystemedit=picture]").offset().top;
    $("img[peppsystemedit=picture]").offset().left;
    
    $("img[peppsystemedit=picture]").each(function(index){

      $("body").append($('<a class="peppsystem-button-edit" peppsystemid=' + $("img[peppsystemedit=picture]").eq(index).attr("peppsystemid") + '></a>').css({
        'position' : 'absolute',
        'left' : $("img[peppsystemedit=picture]").eq(index).offset().left + 2,
        'top' : $("img[peppsystemedit=picture]").eq(index).offset().top + 2,
      }).click(function(){
        peppsystem.showIframeContent($("img[peppsystemedit=picture]").eq(index),'/index.php/upload/index/');
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
    
    
    $('<div id="peppsystem-overlay"></div>').appendTo($("body"));
    $('<div id="peppsystem-overlay-content"></div>').appendTo($("body"));
    $('#peppsystem-overlay').css({
      'height' : $("body").height()+200,
    });
        
    $('<iframe src="' + uri + width + '/' + height +'/' + siteId + '/' + id +'/' + block +'" width="600" height="600"></iframe>').appendTo($("#peppsystem-overlay-content"));
        
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
      url : "/peppsystem_templates/admin.html",
      success : function(data){   
        $("#peppsystem-admin").html(data);
      },complete : function(){
        $("#peppsystem-admin a").click(function(){
          peppsystem.showIframeContent(this,$(this).attr("href"));
          return false;
        });
      }
    });
  },
  
  showEditebleThings : function(){
    
  }
}
