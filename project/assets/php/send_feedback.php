<?php

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['topic']) && isset($_POST['feedback']))
{
   
//this is to include the config files
include "../../../includes/config.inc.php";

  $user_id  = $_SESSION['user_id'];
  $topic    = $_POST['topic'];
  $feedback = htmlentities($_POST['feedback']);
  $feedback = addslashes($feedback);

  $code = "INSERT INTO `$db_name`.`app_feedbacks` (
                                `id`,
                                `feedback_by`,
                                `feedback_topic`,
                                `feedback`,
                                `date`       
                                   )
                           values
                           ( NULL , $user_id , '$topic' , '$feedback' , '$current_date');
  	 ";

  mysqli_query($connect , $code);

  echo "Your Feedback have been submitted successfully!";

}
else
{
	echo "Incomplete Information!";
}

?>