<?php
/***************************************************************
THIS PAGE IS TO SAVE ACCOUNT SETTINGS 
WE NEED TO CHECK THE USERNAME ENTER BY USER
WE NEED TO CHECK DATE OF BIRTH IS NOT LESS THEN 13 YEARS
****************************************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['new_username']) && isset($_POST['dob']) && isset($_POST['hobby']) )
{

            /* this is to connect to mysqli server */
            include_once '../../../../includes/config.inc.php';
            /* this is library to check form */
            include_once '../../../../includes/check_form_and_db.inc.php';
            /* this is element to check any thing */
            $check = new check_form_and_db();
            

            //calling function to check date_of_birth
            check_date_of_birth();


}
else
{
 echo "<div class='comment_msg'>Error! incomplete information.</div>";
}



/****************************
this is to check the date of birth of the users
****************************/

function check_date_of_birth(){
           $dob_d       = $_POST['dob'];
           global $check;
           $years       = $check -> check_dob($dob_d);
                               

                               if($years >= '13')
                                  {
                                     check_username();  // if this function is fine then go to next
                                     
                                   }
                              else
                                  {
                                         echo "Your age is less then 13 years, you must be above 13 to be a user.";
                                         return false;
                                  }


}// end of check_dob




/***********************
this is check user name to check do user name
         if user name not found in db then  send it to check 
         else if user name is found in db then send back user to hame page with a error
*********************/

function check_username()
{ global $check , $connect;
  $username             = $_POST['new_username'];
  $old_username         = $_SESSION['username'];
  $user_name_filterd     = preg_replace('#[^0-9a-zA-Z_]#',"",$_POST['new_username']);
  
  if($username === $user_name_filterd)
  {
    

     if($username != $old_username)
     {

                $no_of_result    = $check -> check_username($username); 
      
                 if($no_of_result >= 1)
                 {
                  echo "Username already exist, please try with some other username.";
                  return false;
                 }

                 else
                 {
                   check_username_keyword($username);
                 }

     }
     else
     {
         check_username_keyword($username);
     }



  }//end of compage
  else
  {
    echo "Username should not have any special character. It can only have numbers , alphabets and underscore '_' .";
    return false;
        
  }//end of else

}// end of check username function



/***************************************
this is to check that username dont have any keywords
****************************************/

function check_username_keyword($username)
{
   global $check;
   $no = $check ->  check_username_keyword($username);

   /**************************
     if no is 0 then no keyword match 
     else if no is 1 then keyword match
   **************************/

     if($no == 0)
     {
       save_account_settings(); // this function is to save settings
     }
     else
     {
         echo "Username error! Username Typed should not have a keyword ex:- error, localhost, site, join, end, board , settings, questions, logout, hashtag , get, forgot_password, ai_box, alvisai, alvis etc.";
        return false;
     }

}

/********************************
this function is to save to mysqli after checking everything 
*******************************/

function save_account_settings()
{ 
   global $db_name , $connect;

   $username = $_POST['new_username'];
   $dob      = $_POST['dob'];
   $hobby    = preg_replace('#[^a-zA-Z ]#','', $_POST['hobby']);
   $id       = $_SESSION['user_id'];

  $code_to_edit_account_settings = "UPDATE  `$db_name`.`users` 
   SET  `username` =  '$username',
    `birthday` =  '$dob',
    `hobby` =  '$hobby' 
    WHERE  id = $id";

    mysqli_query($connect , $code_to_edit_account_settings);
    echo "Saved successfully!";

    $_SESSION['username']  = $username;

 
}


?>