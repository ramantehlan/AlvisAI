<?php

/*****************************************************************
this is the library to get basic information from the mysqli
database of anyuser

to use it 
$get_mysqli_info -> get_info($id,$id_2,information)

creator:-          Raman Tehlan
Date of creation:- 11/06/2015
*****************************************************************/

class get_mysqli_info{

         

        /*this is used to get information like 
           followers 
           following 
           follower_since 
           following_since
           unseen_notifications
           score 
           login_no
        */
        function get_info($id,$id_2,$information)
         {
               global $db_name , $text_filter , $connect;
                  
                switch ($information) 
                {
                	case 'followers':

                		  $code_to_get_followers  = "SELECT `no` from `$db_name`.`users_friends` where `following_id` = $id";
                          $no_of_followers        = mysqli_num_rows(mysqli_query($connect , $code_to_get_followers));

                          $no_of_followers        = $text_filter -> round_no($no_of_followers);

                          return $no_of_followers;
                		break;

                    case 'following':

                          $code_to_get_following  = "SELECT `no` from `$db_name`.`users_friends` where `follower_id` = $id";
                          $no_of_following        = mysqli_num_rows(mysqli_query($connect , $code_to_get_following));

                          $no_of_following        = $text_filter -> round_no($no_of_following);
                           
                          return $no_of_following;    

                        break;

                    case 'friends_since':

                          $get_data          = mysqli_fetch_array(mysqli_query($connect , "SELECT `date` from `$db_name`.`users_friends` where `following_id` = $id and `follower_id` = $id_2 "));
                          $date_of_follow    = $get_data['date'];

                          $since             = $text_filter -> round_date_2($date_of_follow);
                          
                          return $since;

                        break;
                     case 'unseen_notifications':
                              
                          $line_to_get_notifications = mysqli_query($connect , "SELECT `no` FROM `$db_name`.`users_notifications` WHERE `to` = '$id' and `seen` = '0'");
                          $no_of_notifications       = mysqli_num_rows($line_to_get_notifications);

                          return $no_of_notifications;

                         break;
                      case 'all_notifications':
                             
                             $line_to_get_notifications = mysqli_query($connect , "SELECT `no` FROM `$db_name`.`users_notifications` WHERE `to` = '$id' ");
                             $no_of_notifications       = mysqli_num_rows($line_to_get_notifications);
                            
                             return $no_of_notifications;

                          break;
                      case 'score':
                	             
                               $code_to_get_score = mysqli_fetch_array(mysqli_query($connect , "SELECT `score` from `$db_name`.`users` where id = $id "));
                               

                               $score = $code_to_get_score['score'];

                               return $score;

                      break;
                      case 'count_login':
                             $code_to_get_login = mysqli_fetch_array(mysqli_query($connect , "SELECT `login_no` from `$db_name`.`users` where id = $id "));
                               

                             $login = $code_to_get_login['login_no'];

                             return $login;
                      break;
                }


         }







      /*this is used to get infromation like 
          likes 
          comments
          allow_likes
       */
      function get_feed_info($id,$target,$target_no,$information)
      {
           global $db_name , $text_filter , $connect;
          
           switch ($information) 
           {
             case 'likes':
                    
                    $code_to_get_likes = "SELECT `no` from `$db_name`.`users_likes` where  target = '$target' and target_no = $target_no";
                    $no_of_likes       = mysqli_num_rows(mysqli_query($connect , $code_to_get_likes));
                    $no_of_likes       = $text_filter -> round_no($no_of_likes);

                    return $no_of_likes;

               break;
             case 'comments':

                    $code_to_get_comment = "SELECT `no` from `$db_name`.`users_comments` where  target = '$target' and target_no = $target_no";
                    $no_of_comment       = mysqli_num_rows(mysqli_query($connect , $code_to_get_comment));
                    $no_of_comment       = $text_filter -> round_no($no_of_comment);

                    return $no_of_comment;

               break;
              case 'allow_like':
                     
                    $code_to_get_like  =  "SELECT `no` from `$db_name`.`users_likes` where  target = '$target' and target_no = $target_no and liker_id = $id";
                    $no_of_rows        = mysqli_num_rows(mysqli_query($connect , $code_to_get_like));
                    
                    
                    if($no_of_rows >= 1)
                    {
                       return 0;
                       //0 is for false 
                    }
                    else
                    {
                      return 1;
                      //1 is for true
                    }



               break;
            }


      }


      function get_project_info($information)
      {
          global $db_name ,  $connect;
           
           switch ($information) {
             case 'allow_apply_for_jobs':
                      $code = "SELECT job_request_from from `$db_name`.`app_jobs` where job_request_from = " . $_SESSION['user_id'];
                      $no_of_rows = mysqli_num_rows(mysqli_query($connect , $code));
                    
                      /*
                        a user is allowed to apply for job just once so to check it this method is used 
                        1-> allow to apply 
                        0-> dont allow to apply
                      */
                      if($no_of_rows >= 1)
                      {
                         return 0;
                      }
                      else
                      {
                          return 1;
                      }

               break;
            
              case 'allow_feedback':
                     $code = "SELECT feedback_by from `$db_name`.`app_feedbacks` where feedback_by = " . $_SESSION['user_id'];
                      $no_of_rows = mysqli_num_rows(mysqli_query($connect , $code));
                    
                      /*
                        a user is allowed to apply for job just once so to check it this method is used 
                        1-> allow to apply 
                        0-> dont allow to apply
                      */
                      if($no_of_rows >= 1)
                      {
                         return 0;
                      }
                      else
                      {
                          return 1;
                      }
               break;
               
               case 'allow_contactus':
                     $code = "SELECT contacted_by from `$db_name`.`app_contactus` where contacted_by = " . $_SESSION['user_id'];
                      $no_of_rows = mysqli_num_rows(mysqli_query($connect , $code));
                    
                      /*
                        a user is allowed to apply for job just once so to check it this method is used 
                        1-> allow to apply 
                        0-> dont allow to apply
                      */
                      if($no_of_rows >= 1)
                      {
                         return 0;
                      }
                      else
                      {
                          return 1;
                      }
               break;

             default:
                  return 0;
               break;
           }

      

      }



      

}//this is end of class


?>