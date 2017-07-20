
$(document).ready(function(){
  $( document ).tooltip({
      track:true,
      show:{effect:'show'} ,
     // hide:{ effect:'explode'}
     hide:{effect:'hide'}
    });


  $(".moveable").draggable({
                handle:'.mover' ,
                opacity: '0.9' ,
                halper: 'clone' ,
                container: 'html',


           });


 });




/*
  $('.resize_box').resizable({
    ghost:true
    ,animate:true
    //,aspectRatio: 16 / 9
    //,handles: "se"
    //,helper: "resize_div"
   });

  
(function($){
			$(window).load(function(){
/*
  [themes of scroll]
  minimal-dark
  light-thick
  rounded-dots
  dark-thin
  light-3
  3d-thick
  3d
  rounded
*/
/*
				$(".scroll").mCustomScrollbar({
					autoHideScrollbar:true,
					theme:"minimal-dark",
					//axis:"xy",
					//advanced:{autoExpandHorizontalScroll:true},
					scrollInertia:300,
					//snapAmount:188,
					//snapOffset:65,
					keyboard:{
						enable:true,
						scrollType:"stepless",
						scrollAmount:"auto"
					}
				}); 
				/*
				
				this is to take the scroll to last
				$('.scroll_to_bottom').mCustomScrollbar('scrollTo','last');
				
				*/
	/*		
				
				$('html').mCustomScrollbar({
					autoHideScrollbar:true,
				});
			});
})(jQuery);

});

*/




