<?php

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['target']) && isset($_POST['target_no']) )
{
   
  //get all needed files
  include "../../../../includes/config.inc.php";

  

//target tell that comment is done on qusetion or update
// a => comment is done on update
// b => comment is done on question
  $target_no = $_POST['target_no'];

//target no tell the id of question or update
  $target    = $_POST['target'];


  switch ($_POST['target']) {
  	case 'a':
  	 	# this is a update
           
           //check is image deletion is allowed or not
           if(allow_update_image_deletion)
           {
                              //this is to delete the image uploaded by the user
                               $code_to_get_update_image = mysqli_query($connect , "SELECT attachments from `$db_name`.`users_updates` where no = $target_no and attachments != '' ");
                               $check_image_upload       = mysqli_num_rows($code_to_get_update_image);

                               if($check_image_upload >= 1)
                               { 
                                        $get_image_name = mysqli_fetch_array($code_to_get_update_image);
                                        $update_image   = $get_image_name['attachments'];

                                      if(file_exists("../../.." . _simple_update_image_dir_ . $update_image) === true)
                                      {
                                          unlink("../../.." .  _simple_update_image_dir_ . $update_image);
                                      }
            
                                      if(file_exists("../../.." . _simple_update_medium_image_dir_ . $update_image) === true)
                                      {
                                          unlink("../../.." . _simple_update_medium_image_dir_  . $update_image);
                                      } 

                               }
           }


          //check is update deletion allows
           if(allow_update_deletion)
           {

                    //this is to delete update
                     $code = "DELETE FROM `$db_name`.`users_updates` WHERE `users_updates`.`no` = $target_no;";
            
                     //this is to delete likes
                     $code_remove_likes = "DELETE FROM `$db_name`.`users_likes` WHERE `users_likes`.`target` = '$target' and `users_likes`.`target_no` = $target_no ";
           
                     //this is to delete comments
                     $code_remove_comments = "DELETE FROM `$db_name`.`users_comments` WHERE `users_comments`.`target` = '$target' and `users_comments`.`target_no` = $target_no ";

         
           }
           else
           {
                  

                     //this is to make deleted = 1
                     $code = "UPDATE `$db_name`.`users_updates` SET `deleted` = '1' WHERE `users_updates`.`no` = $target_no ";
                     

           }
            
          
           

  		break;
  	case 'b':
        # this is a question
             
          if(allow_question_deletion)
          {

           

               //this is to delete question
                     $code = "DELETE FROM `$db_name`.`users_questions` WHERE `users_questions`.`no` = $target_no";
           
                      //this is to delete likes
                     $code_remove_likes = "DELETE FROM `$db_name`.`users_likes` WHERE `users_likes`.`target` = '$target' and `users_likes`.`target_no` = $target_no ";
           
                     //this is to delete comments
                     $code_remove_comments = "DELETE FROM `$db_name`.`users_comments` WHERE `users_comments`.`target` = '$target' and `users_comments`.`target_no` = $target_no ";
          } 
          else
          {
                 
              #this is to make deleted = 1
              $code = "UPDATE `$db_name`.`users_questions` SET `deleted` = '1' WHERE `users_questions`.`no` = $target_no ";
             

          }  
          

        break;
  	
  	default:
  		# this is a unkonwn
           $code = "";
           $code_remove_likes = "";
           $code_remove_comments = "";
  		break;
  }

 mysqli_query($connect , $code);
 if(isset($code_remove_likes))
 {
    mysqli_query($connect , $code_remove_likes);
 }
 if(isset($code_remove_comments))
 {
  mysqli_query($connect , $code_remove_comments);
 }

 



}
else
{
	echo "<div class='comment_msg'>Error! incomplete information.</div>";
}

?>