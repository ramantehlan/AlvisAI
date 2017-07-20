<?php
/*
  this page is to save the information of user 
  which we get from wall of that user
*/

session_start();
$host = getenv("SERVER_NAME");

if(isset($_SESSION['user_id']) && isset($_POST['f_name']))
{

include_once "../../../../includes/config.inc.php";

$id             = $_SESSION['user_id'];
$f_name         = preg_replace('#[^a-zA-Z]#', '', $_POST['f_name']);
$l_name         = preg_replace('#[^a-zA-Z]#', '', $_POST['l_name']);
$hometown       = preg_replace('#[^a-zA-Z ]#','', $_POST['hometown']);
$web            = preg_replace('#[^a-zA-Z0-9/._-]#' ,'', $_POST['web']);
$about          = htmlentities($_POST['about']);
$about          = addslashes($about);
$question_title = addslashes($_POST['question_title']);
$status         = addslashes($_POST['status']);


 $code = "UPDATE  `$db_name`.`users` SET 
`first_name`     =  '$f_name',
`last_name`      =  '$l_name',
`name`           =  '$f_name $l_name',
`hometown`       =  '$hometown',
`about`          =  '$about',
`web`            =  '$web',
`status`         =  '$status',
`question_title` =  '$question_title' 
WHERE id =$id";

mysqli_query($connect , $code);

echo "done";

}
else
{
	 echo "<div class='comment_msg'>Error! incomplete information.</div>";
}




?>
