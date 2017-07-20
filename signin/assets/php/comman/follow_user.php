<?php
/*********************************8
 THIS CODE IS TO FOLLOW A USER AND PUT IT TO DATABASE

 following_id = wall_user_id
 follower_id = user_id    
***********************************/


session_start();

if(isset($_POST['wall_user_id']) && isset($_SESSION['user_id']))
{
   #including all needed files 
   include "../../../../includes/config.inc.php";
   include "../../../../includes/update_user_activity.lib.php";

   #creating object to update user activity here score
   $update_user_activity = new update_user_activity();
   
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


        $code_to_follow = "INSERT INTO `$db_name`.`users_friends` ( 
              `no` ,
              `follower_id` ,
              `following_id` , 
              `date` 
        	 ) 
             VALUES (
            NULL , '$user_id' , '$wall_user_id' , '$current_date' 
             )";
          
        mysqli_query($connect , $code_to_follow);
        echo "Following";

        //this is to add the score
        $update_user_activity -> add_score('follow_action');
        
   }
   else
   {
   	 echo "Following";
   }

}
else
{
	echo "<div class='comment_msg'>Error! incomplete information.</div>";
}


?>