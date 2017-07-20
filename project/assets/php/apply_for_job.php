<?php

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['experience']) && isset($_POST['qualification']) && isset($_POST['ideals']))
{

//this is to include the config files
include "../../../includes/config.inc.php";



$user_id = $_SESSION['user_id'];
$experience = $_POST['experience'];
$qualification = $_POST['qualification'];
$ideals = htmlentities($_POST['ideals']);
$ideals = addslashes($ideals);


$code = "INSERT INTO `$db_name`.`app_jobs` (
                          `id`,
                          `job_request_from`,
                          `qualification`,
                          `experience`,
                          `person_ideals`,
                          `date`
                          )
                           values 
                           ( NULL , $user_id , '$qualification' , '$experience' , '$ideals' , '$current_date')
	                        ";

mysqli_query($connect , $code);



echo "Your job Application have been submitted successfully!";

}
else
{
	echo "Incomplete Information!";
}


?>