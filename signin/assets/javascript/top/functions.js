 
 var search_input    = $("#search_user");
 var search_display  = $(".top_search_box_display");
 var search_but      = $(".top_search_button");
 var search_tool_box = $(".top_search_box_tool"); 

 var search_holder   = $("#top_search_box");

 var noti_but      = $("#top_notification");
 var noti_display  = $("#notification_box_slide_down"); 
 var grid_but      = $("#top_grid");
 var grid_display  = $("#grid_box_slide_down");



//this is to show the menu option
   function show(but,box)
   { 
     but.toggleClass("top_icon_menu_option");
     but.toggleClass("top_icon_menu_option_selected");
       
       /* alert(but.id);
         if(but == "noti_but")
         {
                       noti_but.addClass("noti_selected");
         }*/


     box.toggleClass("hide");
     box.toggleClass("show");
   }

   function hide(but,box)
   {
   	 but.addClass("top_icon_menu_option");
     but.removeClass("top_icon_menu_option_selected");
                    
    /* if(but == "noti_but")
         {
                       noti_but.removeClass("noti_selected");
         }
*/

     box.addClass("hide");
     box.removeClass("show");
   }



//this is to show search
function show_search()
{
 


     search_tool_box.removeClass("top_search_box_tool");
     search_tool_box.addClass("top_search_box_tool_searched");

     search_display.slideDown();

     search_input.removeClass("top_search_box_input");
     search_input.addClass("top_search_box_input_searched");

 
     search_but.addClass("top_search_button_searched");

     search_holder.addClass("shadow");

}

function hide_search()
{
	


     search_tool_box.addClass("top_search_box_tool");
     search_tool_box.removeClass("top_search_box_tool_searched");

     search_display.slideUp();

     search_input.addClass("top_search_box_input");
     search_input.removeClass("top_search_box_input_searched");

     search_but.removeClass("top_search_button_searched");

     search_holder.removeClass("shadow");


}







//this is to close the menu
        window.addEventListener('mouseup',function(event){
          

           var box_1 = document.getElementById('grid_box_slide_down');
           if(event.target != box_1 && event.target.parentNode != box_1)
           {
        

             hide(grid_but,grid_display);


           }


           var box_2 = document.getElementById('notification_box_slide_down');
           if(event.target != box_2 && event.target.parentNode != box_2 && event.target.parentNode.parentNode != box_2 && event.target.parentNode.parentNode.parentNode != box_2  && event.target.parentNode.parentNode.parentNode.parentNode != box_2)
           {
        
             hide(noti_but,noti_display);


           }


           var box_3 = document.getElementById('top_search_box');
           if(event.target != box_3 && event.target.parentNode != box_3 && event.target.parentNode.parentNode != box_3 && event.target.parentNode.parentNode.parentNode != box_3 && event.target.parentNode.parentNode.parentNode.parentNode != box_3 && event.target.parentNode.parentNode.parentNode.parentNode.parentNode != box_3)
           {
        
              hide_search();  

           }

         
        
        
        });






