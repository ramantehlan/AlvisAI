<?php
/******************************************
this is to delete the question from the data base
*******************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['question_no']))
{
   
   //this is to connect to mysqli database
	include_once "../../../../includes/config.inc.php";
    
    //no is question id
    $no = $_POST['question_no'];

   //code is to delete the question
   $code_to_delete = "DELETE FROM `$db_name`.`users_questions` WHERE `no` = $no";
   mysqli_query($connect , $code_to_delete);
 
}
else
{
	echo "<div class='comment_msg'>Error! incomplete information.</div>";
}


?>