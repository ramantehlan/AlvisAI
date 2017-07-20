<?php
/***********************************************
this program is to get main library and 
includes 

creator:-          Raman Tehlan
Date of creation:- 23/01/2015
************************************************/

session_start();

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
this is to include the library button.lib.php 
********************************************************/

include "$path/includes/button.lib.php";
$button = new button();

/*********************************************************
this to includ ethe library get_mysqli.lib.php
***********************************************************/

include "$path/includes/get_mysqli_info.lib.php";
$get_mysqli_info = new get_mysqli_info();


/***************************************************
 this is to include the library  update_user_activity.lib.php
*********************************************************/

include "$path/includes/update_user_activity.lib.php";



/*********************************
if -> session started then identity is already check so just get info
else if-> session is not started then check is post is set if yes then  check identity
else -> take the user to home page
***********************************/

       if(isset($_SESSION['type'])) 
       {
           switch ($_SESSION['type']) {
             case 'signin':

                /* this is for getting user_information */
                include  "$path/includes/user_info.inc.php";

               break;
            case 'signup':
              
               break;
             default:
                header("location:http://$host/error/wrong_signin/a");
               break;
           }
       }


       else if(isset($_POST['id_in']) && isset($_POST['password_in']))
       {
              

               /* this is for checking login */
               include_once "$path/includes/check_login.inc.php";

               /* this is for getting user_information */
               include  "$path/includes/user_info.inc.php";

               
          }

       else
       {
        header("location:http://$host/error/wrong_signin/b");
        return false;
       }





?>





