<?php
/***********************************
this page is to save background color 
***********************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['hex']))
{

     /* this is to connect to mysqli server */
     include_once '../../../../includes/config.inc.php';

    $hex = $_POST['hex'];
    $id  = $_SESSION['user_id'];
    $code_to_set_bg_color = " UPDATE `$db_name`.`users` SET 
     `bg_color` = '$hex' WHERE id = '$id' ";
    mysqli_query($connect , $code_to_set_bg_color);


}
else
{
 echo "<div class='comment_msg'>Error! incomplete information.</div>";
	
}

?>