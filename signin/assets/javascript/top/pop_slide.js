$(document).ready(function(){
   
   var update_but = $("#update_grid");
   var update_box = $("#update_box");
   var black      = $("#black");
   var close      = $("#close_update_box");


   update_but.click(function(){

   	        /*
              this is just to hide other things
              this hide code is written in function.js
            */
           hide(grid_but,grid_display);

           black.show();
           update_box.show();


   });

   close.click(function(){
         black.hide();
         update_box.hide();
   });


});