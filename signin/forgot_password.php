<?php
/**********************************************
this page is to recome the password of the user




creator:-          Raman Tehlan
Date of creation:- 24/07/2015
**********************************************/


session_start();
$host = getenv("SERVER_NAME");

if(!isset($_SESSION['type']))
{
    include "../includes/config.inc.php";
}
else
{
	header("location: http://$host/board");
}





?>


<html>
<head>
	<title><?php echo company_name; ?> | Forgot password</title>
              
              <link rel='icon' href="http://<?php  echo $host; ?>/assets/images/comman/logos/logo.png">

              
              <link rel='stylesheet' href='http://<?php echo $host; ?>/assets/css/comman/basic-ui.css'>
              <link rel='stylesheet' href='http://<?php echo $host; ?>/signup/assets/css/top.css'>
              <link rel='stylesheet' href='http://<?php echo $host; ?>/signin/assets/css/other/forgot_password-ui.css'>
              

<meta name='author' content='Raman Tehlan'>
<meta name='title' content='<?php echo company_name; ?> | Forgot password'>
<meta name='description' content='Forgot password 
                                  To get your access back to your <?php echo company_name ?> account 
                                  you can use this page or if you forgot your <?php  echo ai_name ?> password
                                  you just have to fill a form to get your password.
'>
<meta name='keyword' content='<?php echo company_name . " " . ai_name ?> reset forgot password'>
<meta name='language' content='English'>
<meta charset='urf-8'>

              
              <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-1.10.2.js'></script>
              <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-ui.js'></script>

</head>
<body>
  <div id='black'>
  </div>

     <div id='top'>
          <div id='middle_top'>
                          <a href='<?php echo "http://$host";  ?>' ><img src='http://<?php echo $host;  ?>/assets/images/comman/logos/logo_blue.png' id='logo' alt='<?php echo company_name; ?> logo'></a>
          </div>
     </div>
     <div id='body'>


        <?php
                
                //this is to get the step if it is set
                if(isset($_GET['step']))
                {
                      $step = $_GET['step'];
                }
                else
                {
                      $step = 'ask';
                }
                 

                 switch ($step) {
                   case 'ask':
                     include "sub/forgot_password_step_ask.php";
                     break;

                   default:
                     include "sub/forgot_password_step_ask.php";
                     break;
                 }


                


        ?>
         

            


     </div>
     <?php include '../includes/bottom_menu.inc.php'; ?>

</body>

</html>