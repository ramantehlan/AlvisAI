<?php
/***************************************************************
this program is to get user information from database 
and store it to variables .this is included in all the programes.

after creating variables this program
   
   1) make the name capital
   2) check profile picture 
   3) active the account if it is disactive
   4) it makes the user online
   5) declare the question title if default

   [error going from this page]
    
    wrong_signin -> id or email or password is wrong

creator:-          Raman Tehlan
Date of creation:- 02/07/2015
***************************************************/




$code     = mysqli_query($connect , "select * from `$db_name`.`users` where id='" . $_SESSION['user_id'] . "' and password='" . $_SESSION['password'] . "'");
$check_no = mysqli_num_rows($code);



if($check_no === 1)
{

	$get = mysqli_fetch_array( $code);


    $id                = $_SESSION['user_id'];
	  $first_name        = $get['first_name'];
	  $last_name         = $get['last_name'];
    $name              = $get['name'];
    $username          = $get['username'];
    $email             = $get['email'];
    $birthday          = $get['birthday'];
    $join_day          = $get['join_day'];
    $gender            = $get['gender'];
    $country           = $get['country'];
    $language          = $get['language'];
    $time_zone         = $get['time_zone'];
    $security_question = $get['security_question'];
    $security_answer   = $get['security_answer'];
    $hometown          = $get['hometown'];
    $hobby             = $get['hobby'];
    $about             = $get['about'];
    $web               = $get['web'];
    $profile_pic       = $get['profile_pic'];
    $cover_pic         = $get['cover_pic'];
    $bg_color          = $get['bg_color'];
    $bg_img            = $get['bg_img'];
    $status            = $get['status'];
    $views             = $get['views'];
    $score             = $get['score'];
    $question_title    = $get['question_title'];
    $allow_anon_ask    = $get['allow_anonymous_ask'];
    $who_can_ask       = $get['who_can_ask'];
    $account_active    = $get['account_active'];
    $online            = $get['online'];
    $last_login        = $get['last_login'];
    $sad               = $get['sad'];

  //------------------------------------------------------------------------
  // Set timezone
  //------------------------------------------------------------------------
  if(function_exists('date_default_timezone_set') && function_exists('date_default_timezone_get'))
  {
    @date_default_timezone_set(@date_default_timezone_get());
  }
  elseif(function_exists('date_default_timezone_set'))
  {
    @date_default_timezone_set($time_zone_locale);
  }

    unset($get);
    unset($check_no);
    unset($code);
         
     /**********************
      this is to process about 
    ***********************

      $about = $text_filter -> convert_hash_tags($about);
      $about = $text_filter -> convert_at_tags($about);
      $about = $text_filter -> convert_smiles($about); 
   
     /*********************
       this is to make name capital
     **********************/

       $name = ucwords("$name");


        /**********************
             this is to make views round off
        ***********************

             $views = $text_filter -> round_no($views);

         /**********************
             this is to make score round off
        ***********************
                       
            $score = $text_filter -> round_no($score);


         /**********************
             this is to make score round off
        ***********************
                       
            $status = $text_filter -> convert_smiles($status);

        /**********************
             this is to last login round off
        *********************** 
          
          if($online != 1)
          {
            $last_login = $text_filter -> round_date($last_login);
          }
          else if($online != 0)
          {
            $last_login = "Online";
          }
             

     /*********************
       this is to fill spaces if things empty
     **********************


        if(strlen($about) == 0)
        {
            $about = "Empty";
        }

        if(strlen($web) == 0)
         {
             $web = "$host/$username";
         }


        /***********************
           this is if the profile picture is empty
           or if 
           profile picture do not exist
        ***************************/

        if($profile_pic == '' || file_exists("user files/profile pictures/large/" . $profile_pic) != 1 )
        {
            $profile_pic = "default.jpg";
        }
        

        
       /* this is to use the library update_user_activity() */

        $update      = new update_user_activity();

      /* this is to make a account active again if it is not active */

        $update -> check_account_active($account_active);

       /* this is to make user online */

       $update -> make_user_online();

       /****************************************************
             this is to make the question title right
       ***************************************************/

       if($question_title == "")
       {
        $question_title ="Ask me a Question? ";
       }



}
else 
{
  
  session_destroy();
  header("location:http://$host/error/wrong_signin/d");
    return false;
}


?>