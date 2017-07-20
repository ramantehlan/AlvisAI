<?php

$page = 'other';

?>
<html>
<head>
  <title><?php echo $user; ?> Don't exist!</title>
            
            <?php include "$path/includes/header_files.inc.php"; ?>  

            <link rel='stylesheet' href='<?php echo _css_dir_; ?>comman/user_not_found-ui.css'>
            
            
 <meta name="robots" content="noindex,nofollow" />  

              

</head>
<body>
  <?php
       include "top.php";



  if($user == "anonymous" || $user == "Anonymous")
                             {
                                  $main_content =  "Username you are trying to search <b>$host/$user</b> can be anyone.
                                     
                                 <ol>
                                    <li>Anonymous can be anyone from your following.</li>
                                    <li>Anonymous can be anyone from your followers.</li>
                                    <li>Anonymous can be anyone on this site.</li>
                                 </ol>
  
                                  ";

                                  $title = "Not Specified!";

                                  $head = "Can't Disclose";
                             }
                             else
                             {
                                  $main_content = " Username you are trying to search <b>$host/$user</b> don't exist.

                                 <ol>
                                    <li>Please recheck username you have type.</li>
                                    <li>Please try to reload this page.</li>
                                    <li>Please retype your URL.</li>
                                 </ol>";

                                 $title = "Don't exist!";

                                 $head = "Not Found!";

                             }

// below script if for wall background color and image
  ?>





<style type="text/css">
                html{background-color:#<?php echo $s_bg_color; ?>;
                     background-image:url("<?php echo _background_image_dir_ . $s_bg_img; ?>");
                    background-size:<?php 
                       if($s_bg_img == "1.jpg" || $s_bg_img === "2.jpg" || $s_bg_img === "3.jpg" || $s_bg_img === "4.jpg" || $s_bg_img === "5.jpg" || $s_bg_img === "6.jpg" || $s_bg_img === "7.jpg" || $s_bg_img === "8.jpg" || $s_bg_img === "9.jpg" )
                        { echo "100%"; }
                       
                     ?>;
                }

</style>



<?php
 /****************************************8
  this is starting of page
 ****************************************/
?>

<div class='body'>


    <div class='user_not_found_box box_of_pop'>
    	 <div class='top_of_pop'>
                  <?php echo $user . " " . $title; ?> 
    	 </div>
    	 <div class='body_of_pop body_of_user_not_found_box'>
                
                <div class='left_icon_box'>
                
                 <img src='<?php echo _large_site_logo_image_; ?>' class='app_logo_img'>
                
                </div>
                
                <div class='right_content_box'>
                 
                         <br>
                         <b> <?php echo $head; ?> </b> 
                         <br><Br>
                         <span class='detail_of_search'>
                           <?php 
                             
                              echo $main_content;
 
                           ?>
                                
                         </span>

                 </div>

    	 </div>

    </div>

    <?php 
              // this is for the bottom line 
              include "$path/includes/bottom_menu.inc.php";
    ?>


</div>


</body>
</html>