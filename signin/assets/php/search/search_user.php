<?php
/**********************************************************
this is to display search done by the users

creator:- RAMAN TEHLAN
DATE OF CREATION :- 05-07-2015
********************************************************/

/*******************************************************
THIS IS SEARCH ALGORITHAM 

PEOPLE WILL FIRST SEARCH FOR THERE 
1.FRIENDS
2.PEOPLE 



{{{{{algoritham of search}}}}}
select my following id
select my following of following id
select from other users excluding following and following of following id


********************************************************/

session_start();


if(isset($_SESSION['user_id']) && isset($_POST['input']))
{ 
    // this is to connect to the database
    include "../../../../includes/config.inc.php";
  

   /*********************************************************
       this is main search background
   **********************************************************/
 


   //this is searcher id
   $id = $_SESSION['user_id'];

   //this is input of the user
   $search_input   = preg_replace('#[^a-zA-Z0-9_]# ' ,' ', $_POST['input']);



  //pagincation sql is used
  $pagination_sql = "LIMIT 0 , ";

 


//this code is to get all the posible output of search
$code_to_search_in_all_users          = "SELECT * from `$db_name`.`users` where id != $id and (name like '%$search_input%' or username like '%$search_input%' or email = '$search_input') ";
    

$total_no_of_results                     = mysqli_num_rows(mysqli_query($connect , $code_to_search_in_all_users));


    echo " <div class='search_result_stat_info'>
                                  $total_no_of_results Results Found for $search_input!
          </div>

          <div class='display_result_info'>
          ";

     include "load_search.php";

      echo "</div>";


}
else
{
	echo "incomplete information!";
}
   

?>