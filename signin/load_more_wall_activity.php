<?php

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['page']) && isset($_POST['load_no'])  && isset($_POST['s_id']) && isset($_POST['s_username']) && isset($_POST['s_profile_pic']) && isset($_POST['s_name']) && isset($_POST['id']) && isset($_POST['name']) && isset($_POST['username']) && isset($_POST['profile_pic']) )
{



$path = "../";



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


/***********************************
this is to get feed box library
***********************************/

include "$path/includes/feed_box.lib.php";
$feed_box = new feed_box();






//wall_feed_limit IS SET in config.inc.php
$feed_limit = wall_feed_limit;



//this is to get on which page we are on wall or other
$page = $_POST['page'];

//this is to get the load no
$load_no = $_POST['load_no'];



//this is to get search user info
$s_id = $_POST['s_id'];
$s_name = $_POST['s_name'];
$s_username = $_POST['s_username'];
$s_profile_pic = $_POST['s_profile_pic'];

//this is to get viewer info
$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$profile_pic = $_POST['profile_pic'];

/*echo "$s_username $username <Br>
      $s_id $id <br>
      $s_name $name <br>
      $s_profile_pic $profile_pic <br>
";*/

 
//starting limit 
  if($load_no > 0)
    {
         $page_limit = $feed_limit * ( $load_no - 1);
         $pagination_sql = " LIMIT $page_limit , $feed_limit";
         
    }
   else 
   {
      $page_limit = 0;
      $pagination_sql = " LIMIT 0 , $feed_limit";
   }


include "sub/load_wall_feed.php";




}//end of if
else
{
	echo "Access Denied!";
}



?>