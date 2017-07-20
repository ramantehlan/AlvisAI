$(document).ready(function(){

     $("#lang_but").click(function(){
            $("#language_box").show();
            $("#black").show();
     });

/* this below is for all the pop ups just to hide  them through one code */
     $("#black").click(function(){
             $(".hide_out").hide();
            $("#black").hide();
     });

     $(".close_of_pop").click(function(){
             $(".hide_out").hide();
            $("#black").hide();
     });
   

    

});

