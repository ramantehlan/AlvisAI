<?php

session_start();



if(isset($_SESSION['user_id']) && isset($_POST['load_no']) && isset($_POST['target']) && isset($_POST['target_no']) && isset($_POST['no_of_likes']) && isset($_POST['unique_no']))
{

	
   #including needed files 
   include "../../../../includes/config.inc.php";

   //this is to get the load no
   $load_no = $_POST['load_no'];

    //target tell that comment is done on qusetion or update
   // a => comment is done on update
   // b => comment is done on question
   $target      = $_POST['target'];
   //target no tell about choosing feed no
   $target_no   = $_POST['target_no'];
   //this tell total no of likes  for the feed
   $no_of_likes = $_POST['no_of_likes'];
  //unique no to make the code function uniquly
   $unique_no = $_POST['unique_no'];

   //max_like_result is defined in config.inc.php
   $starting_limit = max_like_result * ( $load_no - 1);
   $pagination_sql = " LIMIT $starting_limit , " . max_like_result ;


    //to display the likes
    include "load_likes.php";


}
else
{
	echo "Access Denied!";
}

?>
