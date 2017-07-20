<span class='load_likes_box_temp'>
<?php

/**********************************************
this is to get all the likes of a feed
**********************************************/

session_start();
//$host  = getenv("SERVER_NAME");

if(isset($_SESSION['user_id']) && isset($_POST['target']) && isset($_POST['target_no']) && isset($_POST['no_of_likes']) && isset($_POST['unique_no']))
{
  
 #include needed files
 include "../../../../includes/config.inc.php";



   //target tell that comment is done on qusetion or update
   // a => comment is done on update
   // b => comment is done on question
   $target      = $_POST['target'];
   //target no tell about choosing feed no
   $target_no   = $_POST['target_no'];
   //this tell total no of likes  for the feed
   $no_of_likes = $_POST['no_of_likes'];
   //unique no to make the code function uniquly
   $unique_no = $_POST['unique_no'];
   

   $starting_limit = 0;
   $pagination_sql = " LIMIT $starting_limit , " . max_like_result;





  include "load_likes.php";

   
}
else
{
	//header("location:http://$host");
	echo "<div class='all_likes_msg'>Error! incomplete information.</div>";
}


?>
</span>



<script type="text/javascript">

//this is to load more feed on click 

$(document).on('click',".like_feed_more_button_<?php echo $unique_no;?>",function(){

    $(".like_load_more").html("<img src='<?php echo _loading_image_; ?>'>");
    var ele = $(".like_load_more");

    $.ajax({
           
           url: '../../../../signin/assets/php/comman/load_more_like.php',

           type: 'POST',

           data: {
               
                //data which is to be send to url
                load_no: $(this).data('load_no'),
                target: '<?php echo $target ?>',
                target_no: '<?php echo $target_no ?>',
                no_of_likes: '<?php echo $no_of_likes ?>',
                unique_no: '<?php echo $unique_no ?>',

           }
           
           ,
            
           success: function(response)
           {
               if(response)
               {
                 ele.remove();
                 $('.load_likes_box_temp').append(response);
               }
              
           }

    });//end of ajax call



});//end of click function

</script>




