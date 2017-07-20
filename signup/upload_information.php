<?php
// this include is to connect to the server
  include_once '../includes/config.inc.php';
  $host = getenv('SERVER_NAME');


  

  
   function ip_details($IPaddress) 
    {
        $json       = file_get_contents("http://ipinfo.io/{$IPaddress}");
        $details    = json_decode($json);
        return $details;
    }

  
   

    $lang       =   substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $IPaddress  =   $_SERVER['REMOTE_ADDR'];
    $details    =   ip_details("$IPaddress");
    

    

/*
'af', // afrikaans.
'ar', // arabic.
'bg', // bulgarian.
'ca', // catalan.
'cs', // czech.
'da', // danish.
'de', // german.
'el', // greek.
'en', // english.
'es', // spanish.
'et', // estonian.
'fi', // finnish.
'fr', // french.
'gl', // galician.
'he', // hebrew.
'hi', // hindi.
'hr', // croatian.
'hu', // hungarian.
'id', // indonesian.
'it', // italian.
'ja', // japanese.
'ko', // korean.
'ka', // georgian.
'lt', // lithuanian.
'lv', // latvian.
'ms', // malay.
'nl', // dutch.
'no', // norwegian.
'pl', // polish.
'pt', // portuguese.
'ro', // romanian.
'ru', // russian.
'sk', // slovak.
'sl', // slovenian.
'sq', // albanian.
'sr', // serbian.
'sv', // swedish.
'th', // thai.
'tr', // turkish.
'uk', // ukrainian.
'zh' // chinese.
        break;
      
      default:
        # code...
        break;
    }

*/




 /*
  [these are the session set at signup/index.php]   
        
       f_name
       l_name
       u_name
       password
       email
       birthday
       gender
       country
  
  [these are the post coming from signup/index.php]   
     
      s_question
      s_answer
      hometown
      web
      about
      hobby
 */

/*

  type of error going from this page to 
   tag-> signup_not_done  (home page)    (when user name already exist)
   tag-> all_ready_a_user (HOME page)    (when user is allready a member)
 
   tag-> wrong_type  (signup/index.php) (when image is of wrong type)
   tag-> wrong_size  (signup/index.php) (when image is of wrong size)
*/


/*
  function check is post and session = signup
  else 
  go back to home with error
*/

  session_start();

       if(isset($_SESSION['type']))
       {
           switch ($_SESSION['type']) {
           	case 'signup':
           		 
                  $email    = $_SESSION['email'];
                  $no       = mysqli_num_rows(mysqli_query($connect , "select * from `$db_name`.`users` where email='$email' "));

                     if($no >= 1)
                     { // code to send user to home page
                          header("location:$protocol://$host/error/all_ready_a_user");
                     }
                     else
                     {
                     	//check_img_upload(); removed
                      upload_information();
                     }
           		break;
           	case 'signin':
                header("location:protocol://$host/board");
            
           	  break;
           	default:
           		break;
           }
           /*
              this is just to stop overupload
              when the user refresh the page 
           */

             


       }//end of first if

       else
       {
       	 header("location:protocol://$host/error/signup_not_done");
       }//end of else
  

/*
 this is first step 
 first it check is image is uploaded or not 
 else
 next step
*/
/*
 function check_img_upload()
 { global $host;
 	if($_FILES['profile']['name'] != "")
 	{
 		 $p_type = $_FILES['profile']['type'];
         $p_size = $_FILES['profile']['size'];
         $p_temp = $_FILES['profile']['tmp_name']; 

         if($p_type == 'image/png' || $p_type == 'image/jpg' || $p_type == 'image/jpeg' || $p_type =='image/gif' || $p_type == 'image/jpe')
            {
                // 2048kb = 2mb
            	if(($p_size / 1024) >= 2049)
            	{  // when user uplaod wong size
                   header("location:http://$host/join/error/wrong_size");	 
            	}// end of if
            	else
            	{
                   $profile_picture = $_SESSION['country'] . "_" . $_SESSION['gender'] ."_". rand(1000,100000000) . "_" . $_SESSION['birthday'] . "_" . rand(1000,1000000000) . "_" . rand(10000,10000000000) . "_" . rand(10000,10000000000) . "_" . rand(10000,10000000000) . "_" . rand(10000,10000000000). ".jpg";
            	   
            	   /*
                       [here is the code to upload img in four sizes]
                          -> 32 * 32 small
                          -> 50 * 50 medium
                          -> 200 * 200 large
                          -> original
            	   */

                 /*
                    way used in making image 
                         -> first we resize it and save it to www/signup/upload
                            folder 
                         -> then we get it from upload folder to make it a thumb
                 */


                     // below all if else is to create jpg format of files
                    /*
                   if(move_uploaded_file($p_temp,"../signin" . _simple_profile_original_image_dir_ . $profile_picture) === true)
                   {
                     include_once("../includes/img_process.lib.php");
                     $img_process = new img_process();  
                       /* this is comman path of file upload *//*
                       $path       = "../signin" .  _simple_profile_image_dir_ ;
                       /* this is to get height and width of image upload *//*
                       list($width,$height) = getimagesize($path . "original/$profile_picture");
                       /* this is location of original file *//*
                       $main_file  = $path . "original/$profile_picture";
                       /* this is temp file for maiking thumb *//*
                       $tmp_file   = "uploads/$profile_picture";
                       /* this is max height for tmp file *//*
                       $hmax       = 1000;
                       /* these are path for storing img thumb *//*
                       $large_thumb   = $path . "large/$profile_picture";
                       $medium_thumb  = $path . "medium/$profile_picture";
                       $small_thumb   = $path . "small/$profile_picture";
                       /* size for img thumb *//*
                       $l_width  = 200;
                       $l_height = 200;

                       $m_width  = 50;
                       $m_height = 50;

                       $s_width  = 32;
                       $s_height = 32;
                       
                       /* this is for the large image upload */  /*         
                       
                       if($width > $height)
                           {$wmax = 400;}
                      else
                           {$wmax = 200;}
                       
                       $img_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                       $img_process -> img_thumb($tmp_file, $large_thumb, $l_width, $l_height, $p_type);
                       
                      
                      /* this is for the midium image upload *//*
                        
                       if($width > $height)
                           {$wmax = 100;}
                      else
                           {$wmax = 50;}
                        
                        $img_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                        $img_process -> img_thumb($tmp_file, $medium_thumb, $m_width, $m_height, $p_type);
                        

                      /* this is for the small image upload *//*
                         if($width > $height)
                           {$wmax = 72;}
                        else
                           {$wmax = 32;}
                        
                        $img_process -> img_resize($main_file, $tmp_file, $wmax, $hmax, $p_type);
                        $img_process -> img_thumb($tmp_file, $small_thumb, $s_width, $s_height, $p_type);
                        unlink($tmp_file);

                      
                   }
                    

                    

                    // this is end of img upload

                   upload_information($profile_picture);
            	}// end of else
              
            }//end of if type
         else
           {  // when user upload a wrong type file
              header("location:http://$host/join/error/wrong_type");
           }// end of else

 	}// end of if isset profile
 	else
 	{
 		upload_information(NULL);
 	}
 
 }// end of check_img_upload function
 */



function upload_information(/*$profile this is removed*/)
{
     global $db_name , $host , $connect , $protocol , $details , $lang;
    
        $f_name                 = $_SESSION['f_name'];
      	$l_name                 = $_SESSION['l_name'];
      	$u_name                 = $_SESSION['u_name'];
        $password               = md5(base64_encode($_SESSION['password']));          
      	$email                  = $_SESSION['email'];
      	$birthday               = 'null';/*$_SESSION['birthday']; */
      	$gender                 = 'null';/*$_SESSION['gender']; */
      	$country                = "IN";//$details->country; ;/*$_SESSION['country'];*/
        $language               = $lang;
        $time_zone              = "";
        $profile_picture        = "";/*$profile;*/
      	$security_question      = "";/*$_POST['s_question'];*/
      	$security_answer        = "";/*preg_replace('#[^a-zA-Z0-9 ]#'     ,'', $_POST['s_answer']);*/
      	$hometown               = "Default";//$details->city; ;/*preg_replace('#[^a-zA-Z ]#'        ,'', $_POST['hometown']);*/
      	$web                    = "";/*preg_replace('#[^a-zA-Z0-9/._-]#' ,'', $_POST['web']);*/
      	$about                  = "";/*htmlentities($_POST['about']);*/
        $about                  = "";/*addslashes($about);*/
        $hobby                  = "";/*preg_replace('#[^a-zA-Z ]#'        ,'', $_POST['hobby']);*/
     
    
     

     $upload_data = "INSERT INTO  `$db_name`.`users` (

`id` ,
`login_no` ,
`first_name` ,
`last_name` ,
`name` ,
`username` ,
`email` ,
`password` ,
`birthday` ,
`join_day` ,
`gender` ,
`country` ,
`language` ,
`time_zone` ,
`security_question` ,
`security_answer` ,
`hometown` ,
`hobby` ,
`about` ,
`web` ,
`profile_pic` ,
`cover_pic` ,
`bg_color` ,
`bg_img` ,
`status` ,
`views` ,
`score` ,
`question_title`,
`allow_anonymous_ask` ,
`who_can_ask` ,
`account_active` ,
`online` ,
`last_login`,
`sad`
)
VALUES (
NULL ,  '0',  '$f_name',  '$l_name',  '$f_name $l_name',  '$u_name',  '$email', '$password' ,  $birthday, CURRENT_DATE(),  
$gender,  '$country',  '$language',  '$time_zone',  '$security_question',  '$security_answer', '$hometown',  '$hobby',  '$about',  '$web',  null, 
 null,  null,  'default.jpg',  null,  0,  0, Null , '1',  'a',  '1',  '1', CURRENT_DATE()  , '0'
)";




mysqli_query($connect , $upload_data);


session_destroy();

$get     = mysqli_fetch_array(mysqli_query($connect , "select * from `$db_name`.`users` where email ='$email'"));
$user_id = $get['id'];


session_start();

$_SESSION['type']      = "signin";
$_SESSION['user_id']   = $user_id;
$_SESSION['username']  = $u_name;
$_SESSION['password']  = $password;
echo $upload_data;
echo "done! <a href='$protocol://$host/board'>go to account</a>";



header("location:$protocol://$host/board");
//header("location:http://$host/join/error/wrong_size");



}//end of upload_informatino function


?>