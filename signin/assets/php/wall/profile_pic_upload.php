<?php 

session_start();
$host = getenv("SERVER_NAME");

if(isset($_SESSION['user_id']) && isset($_FILES['profile_upload_img']))
{

include_once "../../../../includes/config.inc.php";
include_once("../../../../includes/img_process.lib.php");
include "../../../../includes/update_user_activity.lib.php";

$update_user_activity = new update_user_activity();

$id               = $_SESSION['user_id'];
$fileTmpLoc       = $_FILES['profile_upload_img']['tmp_name'];
$file_type        = $_FILES['profile_upload_img']['type'];
$fileErrorMsg     = $_FILES['profile_upload_img']['error'];
$profile_picture  = $id . rand(1000,100000000) . "_" . rand(1000,100000000) . "_" .  rand(1000,1000000000) . "_" . rand(10000,10000000000) . ".jpg";
        
     
    
   
 if(!$fileTmpLoc){
  echo "Error: Please browse for a file before clicking the upload button.";

  exit();
}  
else
{
    if(move_uploaded_file($fileTmpLoc,"../../.." ._simple_profile_original_image_dir_ . $profile_picture) === true )
    {
         $line = mysqli_query($connect , "select * from `$db_name`.`users` where id='$id' and profile_pic != '' ");
         $no   = mysqli_num_rows($line);

         if($no == 1 && allow_profile_picture_deletion)
         {
                          //this is to get old profile picture of user 
                          $get = mysqli_fetch_array($line);
                          $profile_old_pic = $get['profile_pic'];

                          if(file_exists("../../.." . _simple_profile_original_image_dir_ . $profile_old_pic) === true)
                           {
                                  unlink("../../.." .  _simple_profile_original_image_dir_ . $profile_old_pic);
                                  unlink("../../.." .  _simple_profile_large_image_dir_ . $profile_old_pic);
                                  unlink("../../.." .  _simple_profile_medium_image_dir_ . $profile_old_pic);
                                  unlink("../../.." .  _simple_profile_small_image_dir_ . $profile_old_pic);
                          }

         }
        
            
             upload_img();

             $code = "UPDATE  `$db_name`.`users` SET  `profile_pic` =  '$profile_picture' WHERE  id = $id";
             mysqli_query($connect , $code);

         
            //this is to add score
            $update_user_activity -> add_score('profile_pic_action');

            echo "Done";
    
    }
    else
    {
      echo "Error stopped the process.";
    }





     
}      

      

}
else
{
  echo "<div class='comment_msg'>Error! incomplete information.</div>";
}









         function upload_img()
         {         
                     global $profile_picture , $file_type;
                        
                       /* this is for the type of file */
                       $p_type = $file_type;
                       /* this is just to use library */
                       $img_process = new img_process();  
                       /* this is comman path of file upload */
                       $path       = "../../.." . _simple_profile_image_dir_;
                       /* this is to get height and width of image upload */
                       list($width,$height) = getimagesize($path . "original/$profile_picture");
                       /* this is location of original file */
                       $main_file  = $path . "original/$profile_picture";
                       /* this is temp file for maiking thumb */
                       $tmp_file   = "uploads/$profile_picture";
                       /* this is max height for tmp file */
                       $hmax       = 1000;
                       /* these are path for storing img thumb */
                       $large_thumb   = $path . "large/$profile_picture";
                       $medium_thumb  = $path . "medium/$profile_picture";
                       $small_thumb   = $path . "small/$profile_picture";
                       /* size for img thumb */
                       $l_width  = 200;
                       $l_height = 200;

                       $m_width  = 50;
                       $m_height = 50;

                       $s_width  = 32;
                       $s_height = 32;
                       
                       /* this is for the large image upload */           
                       
                       if($width > $height)
                           {$wmax = 300;}
                      else
                           {$wmax = 200;}
                       
                       $img_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                       $img_process -> img_thumb($tmp_file, $large_thumb, $l_width, $l_height, $p_type);
                       
                      
                      /* this is for the midium image upload */
                        
                       if($width > $height)
                           {$wmax = 75;}
                      else
                           {$wmax = 50;}
                        
                        $img_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                        $img_process -> img_thumb($tmp_file, $medium_thumb, $m_width, $m_height, $p_type);
                        

                      /* this is for the small image upload */
                         if($width > $height)
                           {$wmax = 48;}
                        else
                           {$wmax = 32;}
                        
                        $img_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                        $img_process -> img_thumb($tmp_file, $small_thumb, $s_width, $s_height, $p_type);
                        unlink($tmp_file);
                }  

?>