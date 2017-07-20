<?php


session_start();

if( isset($_POST['text']))
{

//this is to set the path of things from this page 
$path = "../..";

//this is to include the main_include 
include "$path/includes/ai_emotion_includes/main.inc.php";

//this is sample text to check
$text = $_POST['text'];



  echo $emotions -> check_emotion($text);

}
else
{
	echo "Incomplete Information!";
}



?>