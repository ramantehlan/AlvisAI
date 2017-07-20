
<?php

$page = 'settings';//this is to mark top option
$sub  = 'account';//this is to sub include
$path = '..';



/********************************************
this code is to get my value
**********************************************/
include "$path/includes/main_header_asset.inc.php";



/***********************************
this is to know that on which page do we have to go
************************************/

if(isset($_GET['page']))
{  $_GET['page'] = strtolower($_GET['page']);

   switch ($_GET['page']) {

     case 'account':
          
           if(allow_account)
             {
               $sub = 'account';
             }

     break;
          case 'privacy':
             
             if(allow_privacy)
             {
               $sub = 'privacy';
             }
          
     break;
          case 'security':
            
            if(allow_security)
             {
               $sub = 'security';
             }

     break;
          case 'display':
             
            if(allow_display)
             {
               $sub = 'display';
             }

     break;
          case 'blocking':
                       
            if(allow_privacy)
              {
                $sub = 'blocking';
              }
          
     break;
     default:
           
                                           if(allow_account)
                                             {
                                                $sub = 'account';
                                             }

       break;
   }
}

?>


<html>
<head>
  <title><?php  echo $name; ?> Setting</title>
            
            <?php include "$path/includes/header_files.inc.php"; ?>  

            <link rel="stylesheet" href="<?php echo _css_dir_; ?>settings/settings-ui.css"> 
            <link rel="stylesheet" href="<?php echo _css_dir_; ?>settings/settings-sub-ui.css"> 
            
              <meta name='author' content='Raman Tehlan'> 

</head>
<body>
  <?php
       include "top.php";
  ?>


<div id='body'>
    <div class='left_row'>
             <div class='settings_menu box_of_pop'>
                  <div class='top_of_pop'>
                   Settings
                   </div>
                   <div class='body_of_pop' style='padding:5px;padding-top:0px;'>
                        
                        <?php
                          

                                           if(allow_account)
                                             {
                                               echo "<a href='http://$host/settings/account'><div class='option_of_settings_menu' id='account'>Account</div> </a>";
                                             }
 
                                           if(allow_privacy)
                                             {
                                                echo "<a href='http://$host/settings/privacy'><div class='option_of_settings_menu' id='privacy'>Privacy</div> </a>";
                                             }
 
                                           if(allow_security)
                                             {
                                                echo "<a href='http://$host/settings/security'><div class='option_of_settings_menu' id='security'>Security</div> </a>";
                                             }
 
                                           if(allow_display)
                                             {
                                                echo "<a href='http://$host/settings/display'><div class='option_of_settings_menu' id='display'>Display</div> </a>";
                                             }
 
                                           if(allow_blocking)
                                             {
                                                echo " <a href='http://$host/settings/blocking'><div class='option_of_settings_menu' id='blocking'>Blocking</div> </a>";
                                             }


                        ?>

                        
                   </div> 

                   <script type="text/javascript">
                                
                               
                               /********************************
                                 this is to mark the page on which we are 
                               ***********************************/

                                switch('<?php echo $sub; ?>')
                                {
                                     case 'account':
                                                mark('account');
                                     break;
                                          case 'privacy':
                                                mark('privacy');
                                             
                                     break;
                                          case 'security':

                                                mark('security');

                                     break;
                                          case 'display':

                                                mark('display');

                                     break;
                                          case 'blocking':

                                                mark('blocking');

                                     break;
                                     default:

                                                mark('account');

                                       break;
                                }

                                function mark(but)
                                {
                                   var but = $('#' + but);
                                   but.removeClass('option_of_settings_menu');
                                   but.addClass("option_of_settings_menu_selected");
                                }

                                /********************************
                              this is to load the page which we wish to see 
                                *********************************/

                  </script>

             </div>

        <?php 
              include "$path/includes/bottom_menu.inc.php";
         ?>
    </div>

             <div class='data_box box_of_pop'>
                 <div class='top_of_pop capital' >
                          <?php echo $sub; ?>
                 </div>
                 <div class='body_of_pop' style='padding:0px;'>
                              
                                 <?php 
                              switch($sub)
                                {
                                     case 'account':
                                          include 'sub/settings_account.php';
                                     break;
                                          case 'privacy':
                                          include 'sub/settings_privacy.php';
                                     break;
                                          case 'security':
                                          include 'sub/settings_security.php';
                                     break;
                                          case 'display':
                                          include 'sub/settings_display.php';
                                     break;
                                          case 'blocking':
                                          include 'sub/settings_blocking.php';
                                     break;
                                     default:
                                          include 'sub/settings_account.php';
                                       break;
                                }
                                 ?>

                 </div>
             </div>
 
 
</div>

</body>
</html>