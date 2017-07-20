<?php
/*
   [Below are the links to this page]
    www -> site_name (www.AlvisAi.com) 

   [css link]
       -> www/assets/css/comman/basic-ui.css
       -> www/assets/css/index/index-ui.css
       -> www/assets/css/index/top.css
    
   [Javascript link]
        -> www/assets/javascript/index/lang.js
        -> www/assets/javascript/index/check_up.js
        -> www/assets/javascript/index/check_in.js 
        -> www/assets/javascript/jquery/jquery-1.10.2.js

   [Php link]
        -> www/assets/php/comman/bottom_menu_line.php {for getting site lines}
        -> www/assets/php/comman/dob_gender_country.php {for getting date of birth , gender and country in form}
        -> www/signup/index.php {for signup} assets 
        -> www/signin/functions/check_signin.php {for signin}
        -> www/index.php

*/
?>


<?php
$host = getenv("SERVER_NAME");
$ai_name = "Alvis";
$company_name = "AlvisAi";
$site_name = "localhost";
$protocol  = "http";


session_start();

/*
  [Function to check error from signup page]
                            
       [Tag]                  [error]

    username_found    (when user name already exist)
username_keyword_found (when user name have a keyword used in site)
    username_type     (when user name is wrongly typed)
    signup_not_done   (when sign up f_name is missing)
    email_found       (when email already exist )
    dob_wrong         (when dob is less then 13 year of age)
    all_ready_a_user  (when user uplaod data once again)
   



*/

function check_signup_error(){
          
          if(isset($_GET['error']))
          {
            switch ($_GET['error']) {
              case 'username_found':
                 echo "<script type='text/javascript'>
                               $('#signup_error').show();
                     </script>

                      Username error! Username already exist, please try with some other username.";
                break;
               case 'username_keyword_found':
                  echo "<script type='text/javascript'>
                               $('#signup_error').show();
                     </script>

                      Username error! Username Typed should not have a keyword ex:- error, localhost, site, join, end, board , settings, questions, logout, hashtag , get, forgot_password, ai_box, alvisai, alvis etc.";
                break;
                case 'username_type':
                 echo "<script type='text/javascript'>
                               $('#signup_error').show();
                     </script>

                      Username should not have any special character. It can only have numbers , alphabets and underscore '_' .";
                break;
                case 'signup_not_done':
                 echo "<script type='text/javascript'>
                               $('#signup_error').show();
                     </script>

                      You must fill the form before signup.";
                      
                break;
                case 'email_found':
                 echo "<script type='text/javascript'>
                               $('#signup_error').show();
                     </script>

                      Email error! email already exist. please try with some other email";
                break;
                case 'dob_wrong':
                 echo "<script type='text/javascript'>
                               $('#signup_error').show();
                     </script>

                      Your age is less then 13 years, you must be above 13 to be a user.";
                break;
                case 'all_ready_a_user':
                   echo "<script type='text/javascript'>
                               $('#signup_error').show();
                     </script>

                     Your are all ready a user, signin to use our services";
                break;
              default:
                 echo "<script type='text/javascript'>
                               $('#signup_error').hide();
                     </script>";
                break;
            }
          }
 
}

/*
      [Function to check error from signin page]
                            
       [Tag]                  [error]

      wrong_signin    (when singin is wrong)
      fb_login_failed   (fb_loginfalid)

*/
function check_signin_error()
{
    if(isset($_GET['error']))
    {
      switch ($_GET['error']) {
        case 'wrong_signin':
           echo "<script type='text/javascript'>
                               $('#signin_error').show();
                     </script>
                      Id or password enter by you is wrong.";
          break;
                case 'fb_login_failed':
                      echo "<script type='text/javascript'>
                               $('#signin_error').show();
                     </script>
                      Facebook Login Failed!.";
                 break;
        
        default:
          # code...
          break;
      }
    }

}




if(isset($_SESSION['type']))
{
   switch ($_SESSION['type']) {
     case 'signup':
        session_destroy();
       break;
     case 'signin':
        header("location:$protocol://$host/board");
     break;
     default:
      
       break;
   }
}
else if(isset($_COOKIE["Alvis_remember_me"]))
{
  $_SESSION['type']     = 'signin';
  $_SESSION['user_id']  = $_COOKIE['Alvis_id'];
  $_SESSION['username'] = $_COOKIE['Alvis_username'];
  $_SESSION['password'] = $_COOKIE['Alvis_password'];
  header("location:$protocol://$host/board");
  
}

/* end of check signup function */

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>Worlds #1 Artificial Intelligence in a social network</title>
              
              <link rel='icon' href="<?php echo $protocol; ?>://<?php  echo $host; ?>/assets/images/comman/logos/logo.png">

              <link rel='stylesheet' href='<?php echo $protocol; ?>://<?php echo $host; ?>/assets/css/comman/basic-ui.css'>
              <link rel='stylesheet' href='<?php echo $protocol; ?>://<?php echo $host; ?>/assets/css/index/index-ui.css'>
              <link rel='stylesheet' href='<?php echo $protocol; ?>://<?php echo $host; ?>/assets/css/index/top.css'>
              

	            <meta name='author' content='Raman Tehlan'>
              <meta name='title' content ='Worlds #1 Artificial Intelligence in a social network'>
              <meta name='keywords' content=' AlvisAi , ai , alvis , sign , alvisai , alvisai soon on app ,  language , people , Artificial Intelligence , social networking  , Alvis , India , Raman Tehlan'>
              <meta name='description' content="<?php echo $company_name ?> is a Internet Company, with a Aim to use today's technology (Artificial Intelligence) to help people, make there life easy.
                                                We created <?php echo $ai_name ?> an Artificial Intelligence to talk and understand humans.">
              <meta name='language' content='English'>
              <meta charset='urf-8'>  
             

              
              <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-1.10.2.js'></script>

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-67527439-1', 'auto');
ga('send', 'pageview');

</script>
<!-- End Google Analytics -->



</head>
<body>

<div itemscope itemtype="http://schema.org/Person">
   <span itemprop="name">Raman Tehlan</span>
   <span itemprop="company">AlvisAi corporation pvt ltd</span>
   <a itemprop="email" href="mailto:ramantehlan@alvisai.com">ramantehlan@alvisai.com</a>
</div>
            <?php  // below is that structure which remain hidden for jquery ?>
            <div id='black'>

            </div>

            <div id='language_box' class='box_of_pop hide_out'>
 	             <div class='top_of_pop'> 
                            Language
                          <div class='close_of_pop'></div>    
 	             </div>
 	             <div class='body_of_pop' style='padding:30px;color:rgb(60,130,130);'>
                             AlvisAi.com is only available in English language but soon it will be available in following languages.
                                    <br><Br>
                               <a href='#' class='lang_a'><div class='lang_div'>&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Catal&agrave;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Čeština</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Dansk</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Deutsch</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&Epsilon;&lambda;&lambda;&eta;&nu;&iota;&kappa;&#940;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div  selected_lang'>English</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Espa&ntilde;ol</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Eesti</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Suomi</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Fran&ccedil;ais</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Galego</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&#2361;&#2367;&#2344;&#2381;&#2342;&#2368;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Hrvatski</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Magyar</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Bahasa </div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Italiano</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&#26085;&#26412;&#35486;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Lietuvi&#371;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Norsk</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Nederlands</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Polski</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Portugu&ecirc;s</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Rom&acirc;n&#259;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&#3523;&#3538;&#3458;&#3524;&#3517;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Sloven&#269;ina</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Sloven&scaron;&#269;ina</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>Svenska</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>T&uuml;rk&ccedil;e</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&#1059;&#1082;&#1088;&#1072;&#1111;&#1085;&#1089;&#1100;&#1082;&#1072;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&#1038;&#1079;&#1073;&#1077;&#1082;&#1095;&#1072;</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>O&lsquo;zbekcha</div></a>
                               <a href='#' class='lang_a'><div class='lang_div'>&#20013;&#25991;</div></a>
                 </div>
            </div>

            <?php  // end of background structure ?>
          
            <?php include 'includes/bottom_menu.inc.php'; ?>

             <!--this is site lock -->
            <?php /*  <a href="#"  onclick="window.open('https://www.sitelock.com/verify.php?site=www.alvisai.com','SiteLock','width=600,height=600,left=160,top=170');" >
                         <img alt="SiteLock" class='site_lock' style='margin-top:50px;'  title="SiteLock" src="//shield.sitelock.com/shield/www.alvisai.com"/>
             </a>*/ ?>
             

            <div id='top'>
                    <div id='middle_top'>
                          <a href='<?php echo "$protocol://$host";  ?>'><img src='<?php echo $protocol; ?>://<?php echo $host;  ?>/assets/images/comman/logos/logo_blue.png' id='logo' alt='zimg logo'></a>
                          <div class='lang' id='lang_but'>?</div>
                    </div>
            </div>

            <div id='body'>
	
                           
                           <div id='about'>
                                        <h1 id='about_heading'>Welcome to AlvisAi.</h1>
                                        <div id='about_body'>Connect with people using network of<br>
                                                               a Artificial Intelligence which talk<br>
                                                              and understand you. Update anonymously <br>
                                                              and follow your friends and people.
                                                            
                                        </div>
            
                                        

                                        <div class='coming_soon'>Soon coming on...</div>
                                         <img src='<?php echo $protocol; ?>://<?php  echo $host; ?>/assets/images/index/app_icon/app-store-icon.png' class='app' alt='App store icon'>
                                         <img src='<?php echo $protocol; ?>://<?php  echo $host; ?>/assets/images/index/app_icon/Google-Play-Store.png' class='app' alt='App store icon'>
                                           


                                        
                                          

            
      
                           </div>  
                   <div class='right_box_holder'>
                          <div id='signin_box' class='box_of_pop comman_box'>
                          	     <div class='top_of_pop top_of_signin'>
                                              <h2>Sign in</h2>
                          	     </div>
                          	     <div class='body_of_pop'>
                                           <form method='post' action='http://<?php echo $host ?>/board'>
                                               <input type='username' placeholder='username or email' name='id_in' maxlength='255' class='input' id='id_in'>
                                               <input type='password' placeholder='Password' name='password_in' maxlength='50' class='input' id='password_in'>
                                               <div class='keep'><input type='checkbox' class='keep_box' name='remember_me' checked='checked'> keep me in.</div>
                                               <a href='http://<?php echo $host; ?>/forgot_password' title='Forgot password' class='forgot_something_link'>Forgot password?</a>
                                               <input type='submit' value='Sign in' class='button' id='signin'>
                                           </form>
                                         <?php
                                         /*  <div class='or_tag'>Or</div>
                                          <input type='submit' value='Sign in with Facebook' class='button' id='signin'>
                                           */
                                          ?>
                                          <!--<div class='or_tag'>Or</div> -->



<?php 
   
    

 /*

// added in v4.0.0
require_once 'signup/fb_login/autoload.php';


use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '514507378699403','86184695447e52d9dfd438e226e1ccd2' );

// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://www.alvisai.com/signup/fb_login/fb_redirect.php' );

try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}

              //else echo login
           echo "<a href='" . $helper -> getLoginUrl() . "' class='fb_link'>

                                  <div class='fb_button'  > 
                                     <img src='http://$host/assets/images/comman/logos/fb_logo.png' class='fb_logo_button' >
                                     Login With Facebook
                                 </div>
                </a>";
          /*}*/
               
                
                  
          
   
?>






                                        <div id='signin_error' class='error_box'><?php check_signin_error(); ?></div>

                          	     </div>                                 
                         

                          </div>


                        <div id='signup_box' class='box_of_pop comman_box'>
                                 <div class='top_of_pop'>
                                              <h2>Sign up? it's free</h2>
                                 </div>

                                 <div class='body_of_pop'>
                                          <form method='post' action='<?php echo $protocol; ?>://<?php echo $host;  ?>/join'>
                                            <input type='name' placeholder='First name' name='f_name' maxlength='30' class='input' id='f_name' style='width:43%;float:left;'>
                                            <input type='name' placeholder='Second name' name='l_name' maxlength='30' class='input' id='l_name' style='width:44%;margin-left:6%;float:left;'>
                                            <input type='Email' placeholder='Email' name='email' maxlength='255' class='input' id='email'>
                                            <input type='password' placeholder='New Password' name='password' maxlength='100' class='input' id='password'>
                                            <?php 
                                              // include "includes/dob_gender_country.inc.php";
             
                                            ?>
                                            <input type='submit' value='Sign up' class='button' id='signup' >
                                        </form>
                                        <div id='signup_error' class='error_box'><?php check_signup_error(); ?></div>
                                 </div>    
                          </div>


                      </div>
            </div>
            

         
</body>
<script type="text/javascript" src='<?php echo $protocol; ?>://<?php  echo $host; ?>/assets/javascript/index/lang.js'></script>
<script type="text/javascript" src='<?php echo $protocol; ?>://<?php  echo $host; ?>/assets/javascript/index/check_up.js'></script>
<script type="text/javascript" src='<?php echo $protocol; ?>://<?php  echo $host; ?>/assets/javascript/index/check_in.js'></script>

</html>
