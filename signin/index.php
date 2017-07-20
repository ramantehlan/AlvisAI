<?php


$host = getenv("SERVER_NAME");
$page = 'board';// this is to mark top option
$path = '..';



/********************************************
this code is to get my value
**********************************************/
include "$path/includes/main_header_asset.inc.php";


?>


<html>
<head>
  <title><?php  echo $name; ?> Board</title>
            
            <?php include "$path/includes/header_files.inc.php"; ?>   

            <link rel='stylesheet' href='<?php echo _css_dir_; ?>index/board-ui.css'>
            <link rel='stylesheet' href='<?php echo _css_dir_; ?>comman/feed-box-ui.css'>
           
            
              <meta name="robots" content="noindex,nofollow" />

</head>
<body>
  <?php
       
       include "top.php";

       
  ?>
<div id='body'>


  <?php
      /*****************************************
        this is for the center row or feed row
      *********************************************/
?>

 <div class='right_side_info_row '>
        
       <?php 
             
            /********************************************************
                 this is for the information box 
            *********************************************************/

       ?>

<div class='first_shadow_box' >
        <div class='user_info_box'>
               
               <div class='own_dp'>
                   <a href='http://<?php echo $host . "/" . $username; ?> '>
                             <img src='<?php echo _profile_medium_image_dir_ . $profile_pic; ?>'>
                     </a>
               </div>

               <div class='own_name overflow capital' title='<?php echo $name;  ?>'>
                <a href='http://<?php echo $host . "/" . $username; ?> '>  
                   <?php echo $name; ?>
                </a>
              </div>




              <?php
                                                          if(allow_views_show)
                                                            {
                                                               echo "          <div class='own_sub' title='Views: $views'>
                                                                                    <div class='small_img_box overflow info_box_views' ></div>
                                                                                    <div class='no_own_box overflow'>$views</div>
                                                                               </div>";
                                                            }

                                                          if(allow_score_show)
                                                            {
                                                               echo "         <div class='own_sub' title='Score: $score'>
                                                                                   <div class='small_img_box overflow info_box_score' ></div>
                                                                                   <div class='no_own_box overflow'>$score</div>
                                                                              </div>";                                                            
                                                            }
              ?>


        </div>

        <?php 
             
            /********************************************************
                 this is for the row bellow information box
            *********************************************************/

       ?>

         <div class='right_side_info_row_body'>
          
           <?php 
             
            /********************************************************
                 this is for the information box 

                 this is to show the random status from the database
                 status must not have image 
                 stauts must be less then 200 words
            *********************************************************/

          ?>
             
             <div class='ai_apps_display'>
                     
                      <?php  //echo "<a href='http://$host/ai-box'><img src='" . _small_site_logo_image_ . "'></a>"; ?>
                            
                            <div class='ai_app_options' id='talk_to_ai_2' title='Call <?php echo ai_name; ?>'>
                                    <img src='<?php echo _large_site_logo_image_; ?>'>
                            </div> 
                           

                            <script> 
                            $("#talk_to_ai_2").click(function(){

                                     //$('#black').show();
                                     $('.basic_box_ai').show();


                             });

                            </script>
             </div>

           
 

           

       


         </div>
         
         <?php 
              // this is for the bottom line 
              include "$path/includes/bottom_menu.inc.php";
         ?>
 </div><br>
            <?php 
                     /*************************************************
                        this is to get friend suggestion 
                     ******************************************************/
            ?>

            <div class='friends_suggestion_box box_of_pop' >
                <div class='top_of_pop'>
                   Friend Suggestion
                </div>
                <div class='friends_suggestion_box_body body_of_pop'>
                  
                  <?php 
                  
                      if(allow_friend_suggestion)
                        {
                          include "sub/friend_suggestion_box.php"; 
                        }

                  ?> 
                </div>
            </div>

 </div>




<?php
      /*****************************************
        this is for the center row or feed row
      *********************************************/
?>


 <div class='center_feed_row light_background'>
              
         <?php

          
          /****************************************************************************
            this is to check no of following of user 
            if following is less then or 5 then user will not get 
            annonmous feeds and it will show a msg box
          ****************************************************************************/
           

         $no_of_feed_following =  $get_mysqli_info -> get_info($id,0,"following");


  

          if($no_of_feed_following == 0)
          {
               echo "           
                     <div class='top_notic_msg'> 
                          To get feed you must follow users.
                     </div>         
                    <div class='no_updates'>
                             No Following!
                    </div>
                   ";


                   //just to avoid the error when no following are there
                    $allow_anon_feed = "";
                         
          }
         
         else
         {


              echo "<span class='board_activity' > "; 

              //this is page_limit used in load more so let it be 0
              $page_no = 0;
              
              //board_feed_limit is set in config.inc.php
               $pagination_sql = " LIMIT 0 , " . board_feed_limit;
               
                      /*************************************
                          this is to show msg and decide that which code to choose
                      ***************************************/

                           if($no_of_feed_following < 6)
                                {
                                     echo "<div class='top_notic_msg'> 
                                             To get anonymous feed you must follow atleast 5 users. 
                                           </div>
                                        ";
                                  
                                    $allow_anon_feed = "`anonymously` =  '0' and";
                               }
                              else
                               {
                                   $allow_anon_feed = "";
                               }


                             
                       

               include "sub/load_board.php";

              echo "</span>";


                             
          }// end of main else
        


               
            
        ?>



    











<?php 
      /****************************************************
        this is end of page
      ****************************************************/
?>
 </div>



  </div>

</div>



</body>
<script type="text/javascript">
                                                  
                           $(document).on('click','.board_feed_more_button',function(){

                                 
                                 $(".board_load_more").html("<img src='<?php echo _loading_image_; ?>'>");

                                 var ele = $(".board_load_more");

                                 $.ajax({
                                     
                                     url: '../../../../../../signin/load_more_board.php',

                                     type: 'POST',

                                     data: {
                                         load_no:$(this).data('load_no'),
                                         id: '<?php echo $id; ?>',
                                         name: '<?php echo $name; ?>',
                                         username: '<?php echo $username; ?>',
                                         profile_pic: '<?php echo $profile_pic; ?>',
                                         no_of_feed_following: '<?php echo $no_of_feed_following; ?>',
                                         allow_anon_feed: "<?php  echo $allow_anon_feed; ?>",
                                     } 
                                     ,


                                     success: function(respone)
                                     {
                                          if(respone)
                                          {
                                            ele.remove();
                                            $('.board_activity').append(respone);
                                          }
                                     }

                                 });

                          });

                   </script>
</html>




