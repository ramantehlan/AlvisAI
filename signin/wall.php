
<?php


$page = 'wall';// this is to mark top option
$sub  = 'feed';// this is to open include
$path = '..';


$user = preg_replace('#[^0-9a-zA-Z_]#','', $_GET['user']);



/********************************************
this code is to get my value
**********************************************/
include "$path/includes/main_header_asset.inc.php";

/********************************************
this code is to get wall user info
*********************************************/

include "$path/includes/wall_user_info.inc.php";


?>

