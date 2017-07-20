<?php 
/********************************************
this page is to save security settings 

remember to encrypt the password before use md5(base64_encode(password)); 
************************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['email']))
{
                /* this is to connect to mysqli server */
            include_once '../../../../includes/config.inc.php';
            /* this is library to check form */
            include_once '../../../../includes/check_form_and_db.inc.php';
            /* this is element to check any thing */
            $check = new check_form_and_db();

            if(md5(base64_encode($_POST['current_password'])) != $_SESSION['password'])
            {
                  echo "Current password is incorrect!";
            }
            else
            {
              check_email();
            }


} 
else
{
 echo "<div class='comment_msg'>Error! incomplete information.</div>";
	
}


/**************************
this is to check the email of user
******************************/

function check_email(){
      
    if($_POST['email'] != $_POST['current_email'])
    {
       global $check;
       $no    = $check -> check_email($_POST['email']);
       if($no >= 1)
       {
         echo "Email already exist, please try with some other Email.";
        
       }
       else
       {
          check_new_password();
       }
     }
     else
     {
         check_new_password();
     }

}// check email function end


/*************************************
 this is to check the new password
***********************************/

function check_new_password()
{
    if(strlen($_POST['new_pass']) !=0 )
    {
    	     if( strlen($_POST['new_pass']) < 6)
    	     {
    	     	echo "New Password should have at least 6 character!";
    	     }
             else if($_POST['new_pass'] != $_POST['new_pass_2'])
             {
    	           echo "New password don't match retyped new password!";
             }
             else
             {
             	upload_information();
             }
    }
    else
    {
    	upload_information();

    }


}// check new password ends

/***********************************
this is to upload the final information after check
************************************/

function upload_information()
{
      global $db_name , $connect;

      $id         = $_SESSION['user_id'];
      $email      = $_POST['email']; 
      $s_question = $_POST['s_question']; 
      $s_answer   = preg_replace('#[^a-zA-Z0-9 ]#',"" ,$_POST['s_answer']);
      if(strlen($_POST['new_pass']) != 0){
        $password   = md5(base64_encode($_POST['new_pass']));
      }else{
        $password   = md5(base64_encode($_POST['current_password']));
      }
     


      $code_to_update_security ="UPDATE `$db_name`.`users` 
            SET `email`              = '$email' ,
                 `security_question` = '$s_question' , 
                 `security_answer`   = '$s_answer' ,
                 `password`          = '$password' 
                 WHERE `id` = '$id'
      ";
      mysqli_query($connect , $code_to_update_security);


      $_SESSION['password'] = $password;
      echo "Saved successfully! " ;

}// end of upload function


?>