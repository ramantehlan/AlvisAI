<?php
/*
   [Below are the links to this page]
    www -> site_name (www.alvisai.com) 

   [css link]
       -> www/assets/css/comman/basic-ui.css
       -> www/assets/css/index/site-ui.css
       -> www/assets/css/index/top.css
    
   [Javascript link]
        -> www/assets/javascript/jquery/jquery-1.10.2.js
        -> www/assets/javascript/jquery/jquery-ui.js

   [Php link]
        -> www/assets/php/comman/bottom_menu_line.php 
        -> www/index.php

*/
?>
<?php
$host = getenv("SERVER_NAME");
$path = "..";
$site_name = "www.alvisAi.com";
$company_name = "AlvisAi";
$ai_name = "Alvis";

session_start();


  
       /*
             www.alvisai.com/site/index.php?page=jobs
             www.alvisai.com/site/jobs                    

             it is changed in new format by .htaccess

             $_GET['page'] in jobs in following case 
       */


       // this if else is to check is page is set of not else send it to set the page
       // then using switch we declare the value of page accoding to user assets. like it can be about , jobs etc

     
      if(isset($_GET['page']))
      {
         $val = strtolower($_GET['page']);
         switch ($val) {
              
              case 'about':
             $file ='about';
             $title ='About us';
             $description = "$ai_name is a Artificial Intelligence which talk and understand emotions. He is growing and learning every movement. he is getting smart day by day";
             break;

              case 'services':
             $file ='services';
             $title ='Services';
             $description = "";
             break;

              case 'security':
             $file ='security';
             $title ='Security';
             $description = "$company_name have taken variety security measures to maintain the safety of your personal information. When you enter, submit, or access your 
                                         personal information, there are multiple functions running in background. ";
             break;

              case 'credit':
             $file ='credit';
             $title ='Credit';
             $description = "$company_name is created by Raman Tehlan. You can contect him by ramantehlan@alvisai.com.";
             break;

              case 'jobs':
             $file ='jobs';
             $title ='Jobs';
             $description = "$company_name only need quality professionals for its team. We keep our site interface very beautiful and attractive.
                             We maintain our services and products to its best height. if you are interested then you can apply for it.";
             break;

              case 'feedback':
             $file ='feedback';
             $title ='Feedback';
             $description = "$company_name is trying hard to roll new features to its site but to do so we need your 
                             feedback. We need to know that do our services satisfy your social need or not and do 
                             our services have quality.";
             break;

              case 'contact':
             $file ='contact';
             $title ='Contact us';
             $description = "You can contact $company_name to tell some malfunction of the site , give some suggestions 
                            , tell if any service is not working etc";
             break;

              case 'term':
             $file ='term';
             $title ='Term & Conditions';
             $description = "The website ($site_name) is owned by $company_name corporation pvt ltd. By using or 
                             accessing this site, you agree to the terms & conditions.

";
             break;

              case 'privacy':
             $file ='privacy';
             $title ='Privacy Policy';
             $description = "We are working hard to advance our performance and quality of our services. We are
                              trying to improve your experience on our site.";
             break;

           
           default:
             $file ='about';
             $title ='About us';
             $description = "$ai_name is a Artificial Intelligence which talk and understand emotions. He is growing and learning every movement. he is getting smart day by day";
             
             break;
         }
      }
      else
      {
        Header("location:http://$host/site/about");
      }
 
   

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head> 
	 <title><?php echo $company_name . " | " . $title; ?></title>

	  <link rel='icon' href="http://<?php  echo $host; ?>/assets/images/comman/logos/logo.png">

              <link rel='stylesheet' href='http://<?php echo $host; ?>/assets/css/comman/basic-ui.css'>
              <link rel='stylesheet' href='http://<?php echo $host; ?>/project/assets/css/site-ui.css'>
              <link rel='stylesheet' href='http://<?php echo $host; ?>/project/assets/css/top-ui.css'>

              
<meta name='author' content='Raman Tehlan'>
<meta name='title' content='<?php echo $company_name . " | " . $title; ?>'>
<meta name='description' content='<?php echo $description; ?>'>
<meta name='keywords' content='<?php echo $company_name . " " . $ai_name ?> <?php echo $title; ?> Artificial Intelligence Social Network About contact '>
<meta name='language' content='English'>
<meta charset='urf-8'>  

              
              <script type="text/javascript">
              
// this is to change the heading
var top ,  ypos;
function yScroll(){
   pagetop  = $('.top');
   pageicon = $(".logo"); 
   pagebody = document.getElementById('body');
   ypos    = window.pageYOffset;

   if(ypos > 150)
   {
     pagetop.addClass("menu_on_scroll");
     pageicon.addClass("icon_on_scroll");
     pagebody.style.marginTop = "70px";
   }
   else
   {
     pagetop.removeClass("menu_on_scroll");
     pageicon.removeClass("icon_on_scroll");
     pagebody.style.marginTop = "120px";
     
   }

}

window.addEventListener("scroll",yScroll);
              </script>

              <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-1.10.2.js'></script>
             <!-- <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-ui.js'></script> -->

</head>
<body>

	<div class='top'>
         <div id='middle_top'>
                         
                       <?php 
                             
                              echo " <a href='http://$host'><img src='http://$host/assets/images/comman/logos/logo_blue.png' class='logo' alt='<?php echo $company_name;  ?> logo'></a>";
                              
                              
                                  
/*************************************************
this is to connect to the mysqli server 
**************************************************/

include "$path/includes/config.inc.php";



/******************************************************
 this is to include the library text_filter.lib.php 
 ***************************************************/

include  "$path/includes/text_filter.lib.php";
$text_filter = new text_filter();

/*********************************************************
this to includ ethe library get_mysqli.lib.php
***********************************************************/

include "$path/includes/get_mysqli_info.lib.php";
$get_mysqli_info = new get_mysqli_info();


/***************************************************
 this is to include the library  update_user_activity.lib.php
*********************************************************/

include "$path/includes/update_user_activity.lib.php";

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
                include  "$path/includes/user_info.inc.php";

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
                     
                        


         </div>
	</div>

	<div id='body'> 
        <div class='tray box_of_pop'>
                <div class='top_of_pop' >
                          <?php echo $company_name; ?>
                </div>
                <div class='body_of_pop' style='padding-top:5px;'>
                         <a href='http://<?php echo $host; ?>/site/about'  class='option_of_tray_a'><div class='option_of_tray' id='about'>About</div></a>
                         <!--<a href='http://<?php echo $host; ?>/site/services'  class='option_of_tray_a'><div class='option_of_tray' id='services'>Services</div></a> -->
                         <a href='http://<?php echo $host; ?>/site/security'  class='option_of_tray_a'><div class='option_of_tray' id='security'>Security</div></a>
                         <a href='http://<?php echo $host; ?>/site/credit'  class='option_of_tray_a'><div class='option_of_tray' id='credit'>Credit</div></a>
                         <a href='http://<?php echo $host; ?>/site/jobs'  class='option_of_tray_a'><div class='option_of_tray' id='jobs'>Jobs</div></a>
                         <a href='http://<?php echo $host; ?>/site/feedback'  class='option_of_tray_a'><div class='option_of_tray' id='feedback'>Feedback</div></a>
                         <a href='http://<?php echo $host; ?>/site/contact'  class='option_of_tray_a'><div class='option_of_tray' id='contact'>Contact us</div></a>
                         <a href='http://<?php echo $host; ?>/site/term'  class='option_of_tray_a'><div class='option_of_tray' id='term'>Term & Condition</div></a>
                         <a href='http://<?php echo $host; ?>/site/privacy'  class='option_of_tray_a'><div class='option_of_tray' id='privacy'>Privacy Policy</div></a>
                              
                </div>        
        </div>

        <div id='content' class='box_of_pop' >
        	     <div class='top_of_pop' style='text-transform:capitalize;' >
                                 <?php 
                                           echo $title;

                                  ?>
                 </div>
                 <div class='body_of_pop' style='padding:20px;'>
                                  <?php 
                                  // all the files are saved according to the values assigned to them so just include them with $page.php
                                   include "$file.php"; 
                                   ?>
                </div>
         </div>


    </div>
</body>
<script type="text/javascript">
$(document).ready(function(){
             $("#<?php echo $file ?>").addClass('selected_option_of_tray');
             $("#<?php echo $file ?>").removeClass('option_of_tray');



});


</script>
</html>
