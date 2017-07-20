<?php
/**************************************************************88
this file is to delete comment

creator: Raman Tehlan
*****************************************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['comment_no']))
{ 
	 
	 include "../../../../includes/config.inc.php";
      
     //get id of comment
     $comment_no = $_POST['comment_no'];

     //command to delete the comment
     $code_to_delete_comment = "DELETE FROM `$db_name`.`users_comments` WHERE `users_comments`.`no` = $comment_no";
     mysqli_query($connect , $code_to_delete_comment);

}
else
{
	echo "<div class='comment_msg'>Error! incomplete information.</div>";
}

?>