<?php
/*********************************************************************************
   {LEARN ARTIFICIAL INTELIGIENCE}

creator: raman tehlan
date   : 25/07/2015
*******************************************************************************/


?>



	<link rel="stylesheet" type="text/css" href="<?php echo _ai_css_dir_; ?>top-ui.css">



	<div class='top_bar'>
             
             <div class = 'main_top_bar'>
                 
                 <a href='<?php echo "http://$host";  ?>'><img src='http://<?php echo $host;  ?>/assets/images/comman/logos/logo_blue.png' id='logo' alt='zimg logo'></a>

                <div class='heading capital'> ARTIFICIAL INTELIGIENCE</div>

                <?php


/*************************************************
this is to connect to the mysqli server 
**************************************************/

include "$path2/includes/config.inc.php";



/******************************************************
 this is to include the library text_filter.lib.php 
 ***************************************************/

include  "$path2/includes/text_filter.lib.php";
$text_filter = new text_filter();

/*********************************************************
this to includ ethe library get_mysqli.lib.php
***********************************************************/

include "$path2/includes/get_mysqli_info.lib.php";
$get_mysqli_info = new get_mysqli_info();


/***************************************************
 this is to include the library  update_user_activity.lib.php
*********************************************************/

include "$path2/includes/update_user_activity.lib.php";

/*********************************
if -> session started then identity is already check so just get info
else if-> session is not started then check is post is set if yes then  check identity
else -> take the user to home page
***********************************/

       if(isset($_SESSION['type'])) 
       {
           switch ($_SESSION['type']) {
             case 'signin':

                /* this is for getting user_information */
                include  "$path2/includes/user_info.inc.php";

               break;
            case 'signup':
              
               break;
             default:
                header("location:http://$host/error/wrong_signin/a");
               break;
           }
       }






                                    if(isset($_SESSION['user_id']))
                                    {        
                                                 if($profile_pic == '' || file_exists("../signin/" . _simple2_profile_small_image_dir_ . $profile_pic) != 1 )
                                                  {
                                                      $profile_pic = "default.jpg";
                                                  }

                                            $img_dir = _profile_small_image_dir_ . $profile_pic;
                                            echo "   <a href='http://$host/board'>
                                                         <div class='user_id_box'>
                               
                                                              <div class='profile_image_holder'>
                                                                       <img src='$img_dir'>
                                                             </div>
                                                             <div class='name_of_person'>
                                                                    $name
                                                              </div>

                                                       </div>
                                                    </a>
                                                    ";
                                    }



                ?>


                <div class='top_menu'>
                         
                         <a href='http://<?php echo $host; ?>/ai-box/home' ><div class='top_menu_options <?php if($ai_selected == "home"){ echo "selected_top_menu_option";} ?>'>Home</div></a>
                         <a href='http://<?php echo $host; ?>/ai-box/emotion' ><div class='top_menu_options <?php if($ai_selected == "emotion"){ echo "selected_top_menu_option";} ?>'>Emotion AI</div></a>
                         <a href='http://<?php echo $host; ?>/ai-box/learn' ><div class='top_menu_options <?php if($ai_selected == "learn"){ echo "selected_top_menu_option";} ?>'>Learn AI</div></a>
                         <a href='http://<?php echo $host; ?>/ai-box/talk' ><div class='top_menu_options <?php if($ai_selected == "talk"){ echo "selected_top_menu_option";} ?>'>Talk AI</div></a>

                </div>
                
             </div>

	</div>

