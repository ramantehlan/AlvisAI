<?php 

session_start();

if(isset($_SESSION['user_id'])  && isset($_POST['load_no'])  && isset($_POST['s_id']) && isset($_POST['s_name']) && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['no_of_following'])  )
{

$path = "..";



//this is to get the load no
$load_no = $_POST['load_no'];

//this is used in keeping uniqness in the box
$uique_no = $load_no;

//this is to get search user info
$s_id = $_POST['s_id'];
$s_name = $_POST['s_name'];

//this is to get viewer info
$id = $_POST['id'];
$name = $_POST['name'];

$no_of_following = $_POST['no_of_following'];

/*************************************************
this is to connect to the mysqli server 
**************************************************/

include "$path/includes/config.inc.php";

/******************************************************
 this is to include the library text_filter.lib.php 
 ***************************************************/

include  "$path/includes/text_filter.lib.php";
$text_filter = new text_filter();

/******************************************************
 this is to include the library button
 ***************************************************/

include  "$path/includes/button.lib.php";
$button = new button();

/***********************************************
this is to get friend box
************************************************/
include "$path/includes/users_friend_box.lib.php";
$friend_box = new users_friend_box();


//max_following_result it is set in config.inc.php
$pagination_sql = "LIMIT  " . max_following_result * ( $load_no - 1) . " ,  " . max_following_result;

 include "sub/load_following.php";


}
else
{
	echo "Access Denied!";
}








?>