<?php
/********************************
this is to answer the question
***********************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['answer']))
{

    // this is to connect to the database
    include_once "../../../../includes/config.inc.php";
    include "../../../../includes/update_user_activity.lib.php";

    #object to update user activity
    $update_user_activity = new update_user_activity();
    
    
    $answer         = htmlentities($_POST['answer']);
    $answer         = addslashes($answer);
    //no is id of question
    $no             = $_POST['question_no'];
    //this is id of user
    $id             = $_SESSION['user_id'];


    #below code is to get asker_id
    $get_asker = mysqli_fetch_array(mysqli_query($connect , "SELECT * FROM `$db_name`.`users_questions` where `no` = $no"));
    $asker_id  = $get_asker['asker_id'];
   

    //below code is to make notification 
    //if asker is same as the person who is answering then make no notification
    if($asker_id == $id)
    {

    }
    else //if answerer is different from asker
    {
           //below code is to make notification in asker data
           $update_the_notification_of_asker = "INSERT INTO `$db_name`.`users_notifications` 
                (
                   `no` ,
                   `from` , 
                   `to` , 
                   `link_no` ,
                   `link_type` ,
                   `seen` , 
                   `date`
                )
              VALUES 
              ( NULL ,
                '$id' ,
                '$asker_id' ,
                '$no' ,
                'question' ,
                '0' ,
                '$current_date'
                )";
           mysqli_query($connect , $update_the_notification_of_asker);
    }
   

    //this code is to add answer and current date to the code
    $update_the_question = "UPDATE  `$db_name`.`users_questions` SET 
          `answer` =  '$answer',
          `date`   =  '$current_date'  
           WHERE  `users_questions`.`no` =$no;";

    mysqli_query($connect , $update_the_question);

                

            //this is to add the score
            $update_user_activity -> add_score('question_action');


}
else
{
	echo "<div class='comment_msg'>Error! incomplete information.</div>";
}


?>