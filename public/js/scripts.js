$(document).ready(function(){  
   $("#menu >li").click(function(e){  
        var a = e.target.id;  
       console.log(event.target);
        //desactivamos seccion y activamos elemento de menu  
        $("#menu li.active").removeClass("active");  
        $("#menu li."+a).addClass("active"); 
        $(".tab-pane").css("display", "none");  
        $("."+a).fadeIn();  
       
    }); 

});  