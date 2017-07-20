<?php
/********************************************
this program is to update user activity
  
  1) add_no_of_login
  2) check_account_active
  3) make_user_online
  4) make_user_offline
  5) make_last_login
  6) add_views
  7) add_score


creator:-          Raman Tehlan
Date of creation:- 02/07/2015
*********************************************/



class update_user_activity{
   


/***************************************************
   this is to add no of login in user db
*****************************************************/     

      function add_no_of_login($no)
        { 
          global $db_name , $connect;
          $id = $_SESSION['user_id'];
          $new_no   = $no + 1;
          $code     = "UPDATE `$db_name`.`users` SET  login_no =  '$new_no' WHERE id ='$id' ";
          
          mysqli_query($connect , $code);
          unset($id);
          unset($code);
         }

 /***************************************************
   this is make a account active again 
   if it is not active
  *****************************************************/    

       function check_account_active($no)
       {
           global $db_name , $connect ;
           $id = $_SESSION['user_id'];

            
             if($no == 0)
               {
                   $code = "UPDATE  `$db_name`.`users` SET  `account_active` =  '1' WHERE  id ='$id'";
                   mysqli_query($connect , $code);
                   
               }

             unset($id);  
             unset($code);  

       }

   /************************************************
      this is to make user online when the user 
      do signin 
   *************************************************/
          
        function make_user_online()
        {
          global $db_name , $connect ;
          $id = $_SESSION['user_id'];
          
          $code = "UPDATE  `$db_name`.`users` SET  `online` = '1' WHERE id = '$id'";
          mysqli_query($connect , $code);
          unset($id);
          unset($code);
        }

  /************************************************
      this is to make user offline when the user 
      do logout
   *************************************************/
          
        function make_user_offline()
        {
          global $db_name , $connect ;
          $id = $_SESSION['user_id'];
          
          $code = "UPDATE  `$db_name`.`users` SET  `online` = '0' WHERE id = '$id'";
          mysqli_query($connect , $code);
          unset($id);
          unset($code);
        }

    /**************************************************
        this is to set the last log in time of a user
        this is set when user log out
    ***************************************************/
        
        function make_last_login()
        {
          global $db_name , $connect ;
          $id = $_SESSION['user_id'];
          $current_date = date('20y-m-d h:i:s');

          $code ="UPDATE  `$db_name`.`users` SET  `last_login` =  '$current_date' WHERE id ='$id'";
          mysqli_query($connect , $code);
          unset($id);
          unset($code);

        }

      /***********************************************
        this is to add views to the user database when a user open
        its page
      ************************************************/

        function add_view($views , $id)
        {
            global $db_name , $connect ;
            $views = $views + 1;
            $code = "UPDATE  `$db_name`.`users` SET  `views` =  '$views' WHERE id ='$id' ";
            mysqli_query($connect , $code);
            unset($code);

        }
         
        /********************************************
       this is to add score to the user database when user do a activity

        [ACTIVITY]                 [SCORE]          [WORKING]
       
        1)profile_pic_action        20                done
        2)cover_action              20                done       
        
        3)update_action             10                done
        4)question_action (ask/ans) 10                done

        5)comment_action            5                 done
        6)like_action               5                 done
        7)follow_action             5                 done

        *************************************************/


       //to use this function $update_user_activity -> add_score(source);
       function add_score($score_source)
       {
          global $db_name , $connect ;
          
          //this is to get id
          $id = $_SESSION['user_id'];
          
          /*//this is to get current score  [way 1]
          
          global $get_mysqli_info;
          $score = $get_mysqli_info -> get_info($id,0,'score');

          */

          //this is to get current score [way 2] 
          $code_to_get_score = mysqli_fetch_array(mysqli_query($connect , "SELECT * from `$db_name`.`users` where id = $id "));
                               

          $score = $code_to_get_score['score'];
            

          //this is to decide the increment value
          switch ($score_source) {
             case 'profile_pic_update':
                  $add_amount = 20;
               break;
              case 'cover_action':
                  $add_amount = 20;
               break;
              case 'update_action':
                   $add_amount = 10;
              break;
              case 'question_action':
                    $add_amount = 10;
              break;
              case 'comment_action':
                    $add_amount = 5;
              break;
              case 'like_action':
                    $add_amount = 5;
              break;
              case 'follow_action':
                    $add_amount = 5;           
              break;
             default:
               $add_amount = 0;
               break;
           } 

           $new_score = $score + $add_amount;

           $code = "UPDATE  `$db_name`.`users` SET  `score` =  '$new_score' WHERE  `users`.`id` =$id";
           mysqli_query($connect , $code);
             
       }
      

}


?>