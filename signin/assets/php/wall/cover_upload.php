<?php 
/*
 THIS PAGE IS TO SAVE THE COVER PICTURE
*/

session_start();
$host = getenv("SERVER_NAME");


if(isset($_SESSION['user_id']) && isset($_FILES['cover_upload_img']))
{
include_once "../../../../includes/config.inc.php";
include "../../../../includes/update_user_activity.lib.php";

$update_user_activity = new update_user_activity();



$id             = $_SESSION['user_id'];
$fileTmpLoc     = $_FILES['cover_upload_img']['tmp_name'];
$fileErrorMsg   = $_FILES['cover_upload_img']['error'];
$cover_picture  = $id .  rand(1000,100000000) . "_" . rand(1000,100000000) . "_" .  rand(1000,1000000000) . "_" . rand(10000,10000000000) . ".jpg";
            	   
            
 if(!$fileTmpLoc)
    {
	  echo "Error: Please browse for a file before clicking the upload button.";

	   exit();
     }	 
  else
    {
	  if(move_uploaded_file($fileTmpLoc,"../../.." . _simple_cover_image_dir_ . $cover_picture) === true )
	  {
	  	   $line = mysqli_query($connect , "select * from `$db_name`.`users` where id='$id' and cover_pic != '' ");
	  	   $no   = mysqli_num_rows($line);
	  	   
	  	   if($no == 1 && allow_cover_picture_deletion)
	  	   {
	  	   	
	  	   	                    $get           = mysqli_fetch_array($line);
	  	   	                    $cover_old_pic = $get['cover_pic'];
              
                                if(file_exists("../../.." . _simple_cover_image_dir_ .$cover_old_pic ) === true)
                                {
                                    unlink("../../.." . _simple_cover_image_dir_ . $cover_old_pic);
                                }


	  	   }


	  	     $code = "UPDATE  `$db_name`.`users` SET  `cover_pic` =  '$cover_picture' WHERE  id = $id";
             mysqli_query($connect , $code);

 
             //this is to add the score
            $update_user_activity -> add_score('cover_action');

            echo "Done";
	  }
	  else
	  {
	  	echo "Error stoped the process";
	  }
         
     
   } 

} // end of if

else
{
	 echo "<div class='comment_msg'>Error! incomplete information.</div>";
}

?>