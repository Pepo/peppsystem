$(document).ready(function(){
  peppsystem.init();
});                 

peppsystem = {
  init : function(){
    peppsystem.editclick();
  },

  editclick : function(){
       $("[peppsystem-edit=single]").click(function(){
               peppsystem.showSystem("edit_single.html",this);        
       });
  },
  
  showSystem : function(htmlsnippet,clickedElement){
    $('<div id="peppsystem-overlay"></div>').appendTo($("body"));
    $('<div id="peppsystem-overlay-content"></div>').appendTo($("body"));
    
    $('#peppsystem-overlay').css({
      'position' : 'absolute',
      'background-color' : '#000',
      'width' : '100%',
      'height' : '100%',
      'top' : '0',
      'left' : '0',
      'opacity' : 0.4         
    });

    $('#peppsystem-overlay-content').css({
      'position' : 'absolute',
      'width' : '100%',
      'height' : '100%',
      'top' : '0',
      'left' : '0',
      'text-align' : 'center'
    });
           
    $.ajax({
      url: "/peppsystem_templates/"+htmlsnippet,
      success : function(data){
         $("#peppsystem-overlay-content").append(data);
      },
      complete : function(){           
        $("#peppsystem-overlay-content").submit(function(){
          if($("input:first").val() != ""){
            peppsystem.writeContent($("input:first").val(),clickedElement);
          }else{
            alert("Feld darf nicht leer sein");               
          }
           return false;
        });
        
      }
    });
  },
  
  writeContent : function(content,clickedElement){
    id = $(clickedElement).attr("peppsystem_id");
    $.ajax({
      url : "../addcontent",
      type: "POST",
      data: "content="+content +"&id="+id+"&site=<?= $this->uri->segment(3); ?>",
      success: function(msg){           
        $(clickedElement).html(msg);
      },
      complete : function(){
        peppsystem.removeSystem();
      }      
    });
  },
  
  removeSystem : function(){
    $("#peppsystem-overlay, #peppsystem-overlay-content").remove();
  }
}
