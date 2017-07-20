<?php

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['reason']) && isset($_POST['message']))
{

//this is to include the config files
include "../../../includes/config.inc.php";

$user_id = $_SESSION['user_id'];
$reason  = $_POST['reason'];
$message = htmlentities($_POST['message']);
$message = addslashes($message);

$code = "INSERT INTO `$db_name`.`app_contactus` (
                                 `id`,
                                 `contacted_by`,
                                 `contact_reason`,
                                 `message`,
                                 `date`
                                 )
                             values
                             (NULL, $user_id , '$reason' , '$message' , '$current_date')
                                               
";
 
 mysqli_query($connect , $code);

 echo "Your Contact Us request have been submitted successfully!";

}
else
{
	echo "Incomplete Information!";
}


?>