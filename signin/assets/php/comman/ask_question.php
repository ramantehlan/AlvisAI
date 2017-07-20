<?php
/************************************
This files is to store the question 
asked by the user in the data base of
another person

creator:- Raman Tehlan
*************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['question']) && isset($_POST['wall_user_id']) && isset($_POST['anonymously']) )
{
  
     //to include needed files
     include "../../../../includes/config.inc.php";
     include "../../../../includes/update_user_activity.lib.php";

     //creating object to update user activity
     $update_user_activity = new update_user_activity();
      
    

     //assigning values
     $id           = $_SESSION['user_id'];
     $wall_user_id = $_POST['wall_user_id'];
     $question     = htmlentities($_POST['question']);
     $question     = addslashes($question);
      
     


     //anonymously tell that weather to ask question anonymously or not
     // 1 = yes (ask anonymously)
     // 0 = no (dont ask anonymously) 

     switch ($_POST['anonymously']) {
     	case 'true':
     		$anonymously = 1;
     		break;
     	case 'false':
            $anonymously = 0;
     	    break;
     	default:
     		$anonymously = 1;
     		break;
     }




     //this is to insert question in database
     $code_to_inset_question = " INSERT INTO `$db_name`.`users_questions` (
              `no` ,
              `anonymously` , 
              `deleted`,
              `asker_id` ,
              `asked_to` ,
              `question` ,
              `answer` ,
              `attachments` ,
              `date` 
     	   )
          VALUE (
          NULL , '$anonymously' , '0' , '$id' , '$wall_user_id' , '$question' , '' , '' , '$current_date' )";



   //this is to execute the insertion of data 
   mysqli_query($connect , $code_to_inset_question);
   echo "Done";

         
            //this is to add the score
            $update_user_activity -> add_score('question_action');


}
else
{
	header("location:http://$host");
}

?>