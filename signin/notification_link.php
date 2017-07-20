
<?php

$host = getenv("SERVER_NAME");
$page = 'notification_link';// this is to mark top option
$path = '..';



/********************************************
this code is to get my value
**********************************************/
include "$path/includes/main_header_asset.inc.php";


include "$path/includes/feed_box.lib.php";
$feed_box = new feed_box();

?>

 <?php

 





                    
                    if(isset($_GET['link_type']) && isset($_GET['link_no']))
                    {
                            
                            switch ($_GET['link_type']) {
                                case 'question':
                                      $code_to_exicute = "SELECT * from `$db_name`.`users_questions` where no = " . $_GET['link_no'];
                                  break;
                                
                                default:
                                      $code_to_exicute = "SELECT * from `$db_name`.`users_questions` where no = " . $_GET['link_no'];
                                  break;
                              }  
                            
                            if(mysqli_num_rows(mysqli_query($connect , $code_to_exicute)) == 1)
                            {

                               $link_info       = mysqli_fetch_array(mysqli_query($connect , $code_to_exicute));
                             

                              $get_question    = $link_info['question'];
                              $get_answer      = $link_info['answer'];
                              $get_no          = $_GET['link_no'];
                              $get_anonymously = $link_info['anonymously'];
                              $get_asker_id    = $link_info['asker_id'];
                              $get_asked_to    = $link_info['asked_to'];
                              $get_date        = $link_info['date'];
        

                               $get_question      = $text_filter -> convert_hash_tags($get_question);
                               $get_question      = $text_filter -> convert_at_tags($get_question);
                               $get_question      = $text_filter -> convert_smiles($get_question);

                               $get_answer        = $text_filter -> convert_hash_tags($get_answer);
                               $get_answer        = $text_filter -> convert_at_tags($get_answer);
                               $get_answer        = $text_filter -> convert_smiles($get_answer);

                               $round_date    = $text_filter -> round_date($get_date);


                               // this is to get asked person information
                                  
                                 $asked_info = mysqli_fetch_array(mysqli_query($connect , "select * from `$db_name`.`users` where id = '$get_asked_to'"));
                                 
                                 $asked_name        = $asked_info['name'];
                                 $asked_username    = $asked_info['username'];
                                 $asked_profile_pic = $asked_info['profile_pic'];
                                 $bg_color          = $asked_info['bg_color'];
                                 $bg_img            = $asked_info['bg_img'];

                                         if($asked_profile_pic == '' || file_exists(_simple2_profile_large_image_dir_ . $asked_profile_pic) != 1 )
                                                 {
                                                     $asked_profile_pic = "default.jpg";
                                                 }
                                  

                               
                               // this is just to print the feed box

                               $box = $feed_box -> create_feed_box( NULL , $_GET['link_no'] , 0 , "$asked_name" , "$asked_username" , "$asked_profile_pic" , $get_asker_id , $get_anonymously , NULL , NULL , $get_question , $get_answer , $get_date , $round_date , "1");
                               $title = $asked_name . "@" . $asked_username;
                            }
                            else
                            {
                                                           $box = <<< EOFILE
                                           <div class='center_error_box box_of_pop'>
                                                 <div class='top_of_pop'>
                                                                    No Information Found!
                                                    </div>
                                                   <div class='body_of_pop'>
                
                                                           
                                                                    <br>
                                                                            Information you are trying to search don't exist!

                                                                            <ol>
                                                                               <li>Please recheck Information you have type.</li>
                                                                               <li>Try to go back and click on the link again.</li>
                                                                               <li>Please try to reload this page.</li>
                                                                            </ol>
                                                                
                                                  </div>
                                           </div>

EOFILE;
                              
                              $title = "Information not found!";

                            }   
                             


                    }
                    else if(isset($_GET['link_type']) == 0 || isset($_GET['link_no']) == 0)
                    {
                            $box = <<< EOFILE
                                           <div class='center_error_box box_of_pop'>
                                                   <div class='top_of_pop'>
                                                                     Broken LINK!
                                                    </div>
                                                   <div class='body_of_pop'>
                
                                                           
                                                                    <br>
                                                                            LINK you are trying to reach is broken!

                                                                            <ol>
                                                                               <li>Please recheck LINK you have type.</li>
                                                                               <li>Try to go back and clikc on the LINK again.</li>
                                                                               <li>Please retype your URL.</li>
                                                                            </ol>
                                                                
                                                  </div>
                                           </div>

EOFILE;
                              
                            $title = "LINK is Broken!";


                    }

                ?>


<html>
<head>
  <title><?php  echo $title?> </title>
            
            <?php include "$path/includes/header_files.inc.php"; ?>   

           
            <link rel="stylesheet" type="text/css" href="<?php echo _css_dir; ?>comman/feed-box-ui.css">
            
              <meta name="robots" content="noindex,nofollow" />

              <style type="text/css">
                     /****************************
                     this is for the menu of wall
                     ***************************/
                     .menu{width:980;
                           border-radius:0px;
                           margin-bottom:0px;
                           margin-top:50px;
                     }
                      
                     .center_error_box{
                                      font-family: Century Gothic;
                                      color: rgb(180,180,180);
                                      font-size:14px;
                     }

              </style>

</head>
<body>
  <?php
       include "top.php";
  ?>
<div id='body'>

      <div class='center_row light_background'>
                
               
                   <?php
                           echo $box;
                   ?>

                                    

                
               <?php 
              // this is for the bottom line 
              include "$path/includes/bottom_menu.inc.php";
                 ?>
      </div>

</div>

</body>
<script type="text/javascript">


</script>
</html>