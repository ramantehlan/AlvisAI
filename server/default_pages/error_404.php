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
$path = "../../../../../..";
$site_name = "www.alvisAi.com";
$company_name = "AlvisAi";
$ai_name = "Alvis";

session_start();

if(isset($_SESSION['user_id']))
{
  header("location:http://<?php echo $host; ?>");
}


  
       /*
             www.alvisai.com/site/index.php?page=jobs
             www.alvisai.com/site/jobs                    

             it is changed in new format by .htaccess

             $_GET['page'] in jobs in following case 
       */


       // this if else is to check is page is set of not else send it to set the page
       // then using switch we declare the value of page accoding to user assets. like it can be about , jobs etc

    
 
   

?>
<html>
<head> 
   <title><?php echo $company_name . " | "; ?> Error 404</title>

    <link rel='icon' href="http://<?php  echo $host; ?>/assets/images/comman/logos/logo.png">

              <link rel='stylesheet' href='http://<?php echo $host; ?>/assets/css/comman/error-pages-ui.css'>

              
 

              
 


              <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-1.10.2.js'></script>
             <!-- <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-ui.js'></script> -->

</head>
<body>

     <div id='top'>
          <div id='middle_top'>
<a href='<?php echo "http://$host";  ?>' ><img src='http://<?php echo $host;  ?>/assets/images/comman/logos/logo_blue.png' id='logo' alt='<?php echo $company_name; ?> logo'></a>
          </div>
     </div>
  <div id='body'> 
      
       <div class='user_not_found_box box_of_pop'>
                
               <div class='top_of_pop'>
                       Error 404
               </div>
               
               <div class='body_of_pop body_of_all_error_box'>
                        
                        <div class='left_icon_box'>
                            <a href='<?php echo "http://$host";  ?>' ><img src='http://<?php echo $host;  ?>/assets/images/comman/logos/logo_blue.png' class='app_logo_img' alt='<?php echo $company_name; ?> logo'></a>
         
                        </div>
                        <div class='right_content_box'>
                                 <br><br><BR>
                                 <Br>
                                  <b>Page not found!</b>
                        </div> 

               </div>

       </div>

  </div>
</body>
</html>
