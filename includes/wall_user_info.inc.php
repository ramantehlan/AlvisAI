<?php
/**********************************************
this program is to get user information from database 
and store it to variables .this is included in wall only

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
**********************************************/

$check = mysqli_num_rows(mysqli_query($connect , "select * from `$db_name`.`users` where username = '$user' and account_active ='1'"));

if($check == 1)
{
        $get = mysqli_fetch_array(mysqli_query($connect , "select * from `$db_name`.`users` where username = '$user' "));


    $s_id                = $get['id'];
    $s_first_name        = $get['first_name'];
    $s_last_name         = $get['last_name'];
    $s_name              = $get['name'];
    $s_username          = $get['username'];
    $s_email             = $get['email'];
    $s_birthday          = $get['birthday'];
    $s_join_day          = $get['join_day'];
    $s_gender            = $get['gender'];
    $s_country           = $get['country'];
    $s_language          = $get['language'];
    $s_time_zone         = $get['time_zone'];
  /*$s_security_question = $get['security_question'];
    $s_security_answer   = $get['security_answer'];*/
    $s_hometown          = $get['hometown'];
    $s_hobby             = $get['hobby'];
    $s_about             = $get['about'];
    $s_web               = $get['web'];
    $s_profile_pic       = $get['profile_pic'];
    $s_cover_pic         = $get['cover_pic'];
    $s_bg_color          = $get['bg_color'];
    $s_bg_img            = $get['bg_img'];
    $s_status            = $get['status'];
    $s_views             = $get['views'];
    $s_score             = $get['score'];
    $s_question_title    = $get['question_title'];
    $s_allow_anon_ask    = $get['allow_anonymous_ask'];
    $s_who_can_ask       = $get['who_can_ask'];
    $s_account_active    = $get['account_active'];
    $s_online            = $get['online'];
    $s_last_login        = $get['last_login'];

    unset($get);
    unset($check);


       
     /**********************
      this is to process about 
    ***********************/

      $s_about = $text_filter -> convert_hash_tags($s_about);
      $s_about = $text_filter -> convert_at_tags($s_about);
      $s_about = $text_filter -> convert_smiles($s_about); 
   
     /*********************
       this is to make name capital
     **********************/

       $s_name = ucwords("$s_name");


        /**********************
             this is to make views round off
        ***********************/

             $s_r_views = $text_filter -> round_no($s_views);

         /**********************
             this is to make score round off
        ***********************/
                       
            $s_r_score = $text_filter -> round_no($s_score);


         /**********************
             this is to make score round off
        ***********************/
                       
            $s_r_status = $text_filter -> convert_smiles($s_status);

        /**********************
             this is to last login round off
        ***********************/   
          
          if($s_online != 1)
          {
            $s_r_last_login = $text_filter -> round_date($s_last_login);
          }
          else if($s_online != 0)
          {
            $s_r_last_login = "Online";
            $s_last_login = "Online";
          }
             

     /*********************
       this is to fill spaces if things empty
     **********************/


        if(strlen($s_about) == 0)
        {
            $s_about = "Empty";
        }

        if(strlen($s_web) == 0)
         {
             $s_web = "$host/$s_username";
         }


        /***********************
           this is if the profile picture is empty
           or if 
           profile picture do not exist
        ***************************/

        if($s_profile_pic == '' || file_exists("user files/profile pictures/large/" . $s_profile_pic) != 1 )
        {
            $s_profile_pic = "default.jpg";
        }

        /***************************
           this is to add views
           if it is not the user him self
        ***************************/

            if($s_username != $username)
            {
             

       /* this is to use the library update_user_activity() */

        $update      = new update_user_activity();

      /* 
      this is to add views of the visiter to wall  
      we are also saving cookie for next 3 month 
      to keep the views true
       60*60*24*90  =  7775000 
      */

        if(isset($_COOKIE["user_wall_visit_$s_id"]) != 1)
        {
              setcookie("user_wall_visit_$s_id","true", time() + 777600 );
              $update -> add_view($s_views , $s_id);

        }


       
           

            }

       /****************************************************
             this is to make the question title right
       ***************************************************/

       if($s_question_title == "")
       {
        $s_question_title ="Ask me a Question? ";
       }

      
      /******************************************************
         this is to make background color default
      *****************************************************/
         
        if ($s_bg_color == "") {
          $s_bg_color = "1E3250";
        }



    include "user_wall.php";

  }
else
{
   include "user_not_found.php";
}

?>

