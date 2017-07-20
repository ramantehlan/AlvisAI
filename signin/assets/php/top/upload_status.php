<?php 
/********************************8
THIS PAGE IS TO UPLOAD THE STATUS OR UPDATE 
*********************************/

session_start();

if(isset($_POST['update_textarea']) && isset($_POST['update_choice']) && isset($_SESSION['user_id']) && isset($_POST['feeling_choice']))
{
	  #include needed files
    include_once "../../../../includes/config.inc.php"; 	
    include_once("../../../../includes/img_process.lib.php");
    include "../../../../includes/update_user_activity.lib.php";

    $update_user_activity = new update_user_activity();


      
if(isset($_FILES['update_file_upload']))
 {

      $id = $_SESSION['user_id']; 
      $file_name       = $id . rand(1000,100000000) . "_" . rand(1000,100000000) . "_" .  rand(1000,1000000000) . "_" . rand(10000,10000000000) . ".jpg";
      $file_tmp_name   = $_FILES['update_file_upload']['tmp_name'];
      $file_type       = $_FILES['update_file_upload']['type'];
      $file_size       = $_FILES['update_file_upload']['size'];
      $file_error      = $_FILES['update_file_upload']['error'];

       if(!$file_tmp_name)
        {
	       echo "Error: Please browse for a file before clicking the upload button.";

	       exit();
        }	 
       else
       {

          if(move_uploaded_file($file_tmp_name,"../../.." . _simple_update_image_dir_ . "$file_name") == true)
          {
            upload_img();
            upload();
          }
          else
          {
          	echo "Error stopped the process.";
          }
    
       } 
      
 }// this is end of file if 
 else
 {
  upload();
 }// this is end of else










}// this is end of first if


else
{
 echo "<div class='comment_msg'>Error! incomplete information.</div>";
  
}


/**********************************
this is to make upload the image
***********************************/

function upload_img()
{
  global $file_name , $file_type ;

   /* this is for the type of file */
                       $p_type = $file_type;
                       /* this is just to use library */
                       $img_process = new img_process();  
                       /* this is comman path of file upload */
                       $path       = "../../..";
                       /* this is to get height and width of image upload */
                       list($width,$height) = getimagesize($path . _simple_update_image_dir_ . $file_name);
                       /* this is location of original file */
                       $main_file  = $path . _simple_update_image_dir_ . $file_name;
                       /* this is max  for  file */
                       $hmax       = 300;
                       /* these are path for storing img thumb */
                       $medium_thumb  = $path . _simple_update_medium_image_dir_ . $file_name;

                      if($width > $height)
                           {$wmax = 600;}
                      else
                           {$wmax = 600;}
                       
                       $img_process -> img_resize($main_file, $medium_thumb, $wmax, $hmax, $p_type);
                      
}

/*************************************
this function is for final upload
***************************************/

function upload()
{  
  global $db_name , $connect , $file_name , $current_date , $update_user_activity;

    $id = $_SESSION['user_id']; 
      $update_text    = htmlentities($_POST['update_textarea']);
      $update_text    = addslashes($update_text);
      $feeling        = htmlentities($_POST['feeling_choice']);
      $feeling        = addslashes($feeling);

      switch ($_POST['update_choice']) {
        case 'true':
          $update_choice = 1; 
          break;
        case 'false':
             $update_choice = 0;
        break;
        case 1:
             $update_choice = 1;
         break;
         case 0:
             $update_choice = 0;
         break;
        default:
          $update_choice = 1;
          break;
      }

         $code = "INSERT INTO  `$db_name`.`users_updates` (
                    `no` ,
                    `anonymously` ,
                    `deleted`,
                    `type` ,
                    `feeling`,
                    `updater_id` ,
                    `update` ,
                    `attachments` ,
                    `date`
                    )
                    VALUES (
                    NULL ,  '$update_choice', '0' ,  'status', '$feeling' , '$id',  '$update_text', '$file_name' ,  '$current_date'
                    );
                    ";

    mysqli_query($connect , $code);

                 //this is to add the score
            $update_user_activity -> add_score('update_action');
     
     echo "Successfully Updated!";
}



?>

