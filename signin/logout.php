<?php
$host = getenv("SERVER_NAME");

/* this is to make user logout */

include '../includes/config.inc.php';
 /* this is to include the library  */
include_once "../includes/update_user_activity.lib.php";
session_start();


if(isset($_SESSION['type']))
{
     /* this is to use the library update_user_activity */

     $update = new update_user_activity();

     /* this is to make user go offline */

     $update -> make_user_offline();

     /* this is to make user last login */

     $update -> make_last_login();
     
     /*
        this is to remove the cookie
        604800 is the time of a week
     */

     setcookie("Alvis_remember_me",'false',time() - 604800);
     setcookie("Alvis_id",'',time() - 604800);
     setcookie("Alvis_username",'',time() - 604800);
     setcookie("Alvis_password",'',time() - 604800);

     session_destroy();

	 header("location:http://$host/");
   

}
else
{
	header("location:http://$host/");
}



