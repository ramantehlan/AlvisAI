<?php


session_start();

if(isset($_SESSION['user_id']) && isset($_POST['load_no']) && isset($_POST['input']))
{

$path = "../../../..";

/*************************************************
this is to connect to the mysqli server 
**************************************************/

include "$path/includes/config.inc.php";





   //this tell starting point s
   $load_no = $_POST['load_no'];

   //this is searcher id
   $id = $_SESSION['user_id'];

   //this is input of the user
   $search_input   = preg_replace('#[^a-zA-Z0-9@. ]#' ,'', $_POST['input']);

   
   //max_search_result is set in config.inc.php
   $starting_limit = max_search_result * ( $load_no - 1);
   $pagination_sql = "LIMIT  $starting_limit , ";


  /********************************************
    this is where printing of program start
  ********************************************/



include 'load_search.php';


}
else
{
  echo "Access Denied!";
}


?>