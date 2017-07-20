<?php


if( isset($_POST['email']) || isset($_POST['year']) || isset($_POST['month']) || isset($_POST['date']) || isset($_POST['s_question']) || isset($_POST['s_answer']) )
{
  //this is to include the config file
  include "../../../../includes/config.inc.php";

  
  $email      = $_POST['email'];
  $dob        = $_POST['year'] ."-". $_POST['month'] ."-".  $_POST['date'];
  $s_question = $_POST['s_question'];
  $s_answer   = $_POST['s_answer'];

  $code = "SELECT * from `$db_name`.`users` where email = '$email' and birthday = '$dob' and security_question = '$s_question' and security_answer = '$s_answer' limit 0,1";
  $no = mysqli_num_rows(mysqli_query($connect , $code));

  if($no == 1)
  {
   

//this is to produce random password
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, strlen($alphabet)-1);
        $pass[$i] = $alphabet[$n];
    }
    $random_password = implode($pass);

   
        


     $new_password = md5(base64_encode($random_password));
     
      $change_password = "UPDATE `$db_name`.`users` set password = '$new_password' WHERE email = '$email' ";
      mysqli_query($connect , $change_password);

      

      echo "<script >
                   $('.body_of_forgot_page').html('Congratulation! your new password is <b>$random_password</b>');
      </script>";
      



  }
  else
  {
  	echo "Information Given by you is incorrect!";
  }

}
else
{
	echo "Incomplete Information!";
}

?>