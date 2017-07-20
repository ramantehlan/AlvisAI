<?php


session_start();

if(isset($_SESSION['user_id']) &&  isset($_POST['load_no'])   && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['profile_pic']) && isset($_POST['no_of_feed_following']) && isset($_POST['allow_anon_feed']))
{



$path = "..";





/*************************************************
this is to connect to the mysqli server 
**************************************************/

include "$path/includes/config.inc.php";



/******************************************************
 this is to include the library text_filter.lib.php 
 ***************************************************/

include  "$path/includes/text_filter.lib.php";
$text_filter = new text_filter();


/*********************************************************
this to includ ethe library get_mysqli.lib.php
***********************************************************/

include "$path/includes/get_mysqli_info.lib.php";
$get_mysqli_info = new get_mysqli_info();



//this is to get the load no
$load_no = $_POST['load_no'];

//page no to keep id unique
//board_feed_limit is set in config.inc.php
$page_no = board_feed_limit * ( $load_no - 1);



//this is to get viewer info
$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$profile_pic = $_POST['profile_pic'];
$no_of_feed_following = $_POST['no_of_feed_following'];
$allow_anon_feed = $_POST['allow_anon_feed'];



//board_feed_limit is set in config.inc.php
$pagination_sql = " LIMIT " . ( board_feed_limit * ( $load_no - 1) ) . " , " . board_feed_limit;;


include "sub/load_board.php";

}
else
{
	echo "Access Denied!";
}


?>