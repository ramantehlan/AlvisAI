<?php
/*****************************
this is to upload image 

we will also deleate the last image uploaded by the user 
if it is not default
*****************************/

session_start();
$host = getenv("SERVER_NAME");

if(isset($_SESSION['user_id']) && isset($_FILES['image_file']))
{     
	  // this is to connect to mysqli server
      include_once "../../../../includes/config.inc.php";

      $id            = $_SESSION['user_id'];
      $fileTmpLoc    = $_FILES['image_file']['tmp_name'];
      $fileErrorMsg  = $_FILES['image_file']['error'];
      $file_name     = $id ."_bg_" .  rand(1000,100000000) . "_" . rand(1000,100000000) . "_" .  rand(1000,1000000000) . "_" . rand(10000,10000000000) . ".jpg";
      
      if(!$fileTmpLoc)
      {
      	echo "Error: Please browse for a file before clicking the upload button.";

      	exit();
      }
      else
      {
      	 if(move_uploaded_file($fileTmpLoc,"../../.." .   _simple_background_image_dir_ . $file_name) === true)
           {   

           	  $line_get_mysqli_bg        =  mysqli_query($connect , "select * from `$db_name`.`users` where id='$id'");
              $code_to_check_background =  mysqli_num_rows($line_get_mysqli_bg);
                
              if($code_to_check_background == 1)
              {         
                      $get         = mysqli_fetch_array($line_get_mysqli_bg);  
                      $old_bg_pic  = $get['bg_img'];

                      if($old_bg_pic != '1.jpg' || $old_bg_pic != '2.jpg' || $old_bg_pic != '3.jpg' || $old_bg_pic != '4.jpg' || $old_bg_pic != '5.jpg' || $old_bg_pic != '6.jpg' || $old_bg_pic != '7.jpg' || $old_bg_pic != '8.jpg' || $old_bg_pic != '9.jpg')
                      {
                      	        if(file_exists("../../.." . _simple_background_image_dir_ . $old_bg_pic))
                                 {
                                     unlink("../../.." . _simple_background_image_dir_ . $old_bg_pic );
                                 }
                      }

              	           $code_add_mysqli_bg = "UPDATE `$db_name`.`users` SET `bg_img` = '$file_name' WHERE id ='$id' ";
              	           mysqli_query($connect , $code_add_mysqli_bg);
              	           echo $file_name;
                      
              }
              else
              {
              	$code_add_mysqli_bg = "UPDATE `$db_name`.`users` SET `bg_img` = '$file_name' WHERE id ='$id' ";
              	mysqli_query($connect , $code_add_mysqli_bg);
              	echo $file_name;
              }
              

           }
          else
          {
          	echo "Error Stoped the process";
          }

      }


}
else
{
 echo "<div class='comment_msg'>Error! incomplete information.</div>";
	
}



?>