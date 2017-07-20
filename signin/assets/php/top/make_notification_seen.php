<?PHP 

/************************************************
this page is to make the notification seen
**************************************************/

session_start();

if(isset($_SESSION['user_id']))
{
   include_once "../../../../includes/config.inc.php"; 	
   $id = $_SESSION['user_id'];

   $code_to_make_seen = "UPDATE `$db_name`.`users_notifications` set `seen` = '1' where `to` = $id";

   mysqli_query($connect , $code_to_make_seen);

}
else
{
 echo "<div class='comment_msg'>Error! incomplete information.</div>";
	
}







?>