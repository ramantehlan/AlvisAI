<?php
/**************************************
this page is to save default images which are given by zimp
***************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['image_name']))
{
     /****************************
        program to delete last uploaded file is to me made here
     *************************/

     /* this is to connect to mysqli */
     include_once '../../../../includes/config.inc.php';

     $image = $_POST['image_name'] . ".jpg";
     $id    = $_SESSION['user_id'];

     $code_to_save_default_img = "UPDATE `$db_name`.`users` SET 
       `bg_img` = '$image'
       WHERE `id` = '$id'
     ";
     mysqli_query($connect , $code_to_save_default_img);
}
else
{
 echo "<div class='comment_msg'>Error! incomplete information.</div>";

}

?>
