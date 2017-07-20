<?php

/*******************************
this page is to unfollow a user 

 following_id = wall_user_id
 follower_id = user_id    
******************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['wall_user_id']))
{
   
   #include needed files  
   include "../../../../includes/config.inc.php";
  
   //this is id of that user whose wall is viewed
   //following_id
   $wall_user_id = $_POST['wall_user_id'];
   //this is id of that user who is viewing the wall
   //follower_id
   $user_id      = $_SESSION['user_id'];

   //first we will check that user_id is not already following the wall_user_id
   $check_friend_no      = mysqli_num_rows(mysqli_query($connect , "SELECT * from `$db_name`.`users_friends` where following_id = '$wall_user_id' and follower_id = '$user_id'"));




   if($check_friend_no == 0) // user_id is not following
   {
     
      echo "Follow";

   }
   else // else remove the folowing
   {
    
            $code_to_unfollow = "DELETE FROM `$db_name`.`users_friends` WHERE following_id = '$wall_user_id' and follower_id = '$user_id' ";
          
        mysqli_query($connect , $code_to_unfollow);
        echo "Follow";
    

   }


   

}
else
{
	echo "<div class='comment_msg'>Error! incomplete information.</div>";
}



?>