<?php
/***************************************************************
this page is to save the like and unlike
************************************************************/

session_start();
$host = getenv("SERVER_NAME");

if(isset($_POST['target']) && isset($_POST['target_no']) && isset($_POST['action']) && isset($_SESSION['user_id']))
{

    #including needed files
    include "../../../../includes/config.inc.php";
    include "../../../../includes/update_user_activity.lib.php";
    
    #creating object to update user activity here score
    $update_user_activity = new update_user_activity();

    //target tell that comment is done on qusetion or update
    // a => comment is done on update
    // b => comment is done on question
	$target    = $_POST['target'];
	//target no tell the id of question or update
    $target_no = $_POST['target_no'];
    //action tell to like or unlike
	$action    = $_POST['action'];
	$id        = $_SESSION['user_id'];

    if($action === "like") //do like
    {
        
        $code_to_like = "INSERT INTO `$db_name`.`users_likes` (`no`, `target`, `target_no`, `liker_id`, `date`) VALUES (NULL, '$target', '$target_no', '$id', '$current_date')";
        mysqli_query($connect , $code_to_like);

       //this is to add the score
       $update_user_activity -> add_score('like_action');
        
    }
    else if($action === "unlike") //remove like
    {
        $code_to_unlike = "DELETE FROM `$db_name`.`users_likes` WHERE `users_likes`.`target_no` = $target_no and `target` = '$target' and `liker_id` = $id;";
        mysqli_query($connect , $code_to_unlike);
    }



}
else
{
	echo "Error! incomplete information.";
}



?>