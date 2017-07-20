<?php
/****************************************************
this program is to create feed box for updates 
it also have comment and like option


creator:-          Raman Tehlan
Date of creation:- 16/03/2015
****************************************************/

//defined in config.inc.php



class feed_box
{


   PUBLIC function create_feed_box($type = NULL, $feed_no  , $updater_id , $updater_name , $updater_username , $update_profile_pic , $asker_id = null ,$anonymously , $feeling = null ,  $update = NULL, $photo = NULL , $question = NULL, $answer = NULL,  $date , $round_date , $inc_n)
   {    $host = getenv("SERVER_NAME");
        global  $db_name , $get_mysqli_info , $connect;
        global  $username , $name , $id , $profile_pic , $text_filter;


      $small_profile_pic_location = _profile_small_image_dir_;
      $medium_profile_pic_location = _profile_medium_image_dir_;
      $simple_original_profile_pic_location = _simple2_profile_original_image_dir_;

      $medium_update_pic_location = _update_medium_image_dir_;
      $update_pic_location = _update_image_dir_;

      $loading_icon = _loading_image_;

      $php_dir = _php_dir_;
       

      $random_bg_color =  rand(30,230) . "," . rand(30,230) . "," . rand(30,230);

                /*******************************************
                 this is to make the things default
                 
                 we will create different name and username for the comment
                 so that if it is annonmous still it could show the real name of 
                 user

                ********************************************/
                                    $ws_name        = $updater_name;
                                    $ws_username    = $updater_username;
                                    $ws_profile_pic = $update_profile_pic;
                                    $feed_box_data  = "";
                                    $update_type    = "";
                                    $feeling_type   = "";
                                    // this below is just for comment box
                                    $cs_name        = $updater_name;
                                    $cs_username    = $updater_username;
                                    $cs_profile_pic = $update_profile_pic;

                                    //this is to tell that we need to target question or update 
                                    $target = '';

               /*******************************************
                this is to handle the anonymous and unbelievability
                 of uploaded photo
               *********************************************/

                  if ($photo != "") {
        
                        $photo = <<< EOFILE
                            <div class='feed_box_body_content_img_holder feed_box_img_show_$inc_n'>
                                                       <img src='$medium_update_pic_location$photo' class='upload_img'>
                            </div>
                             
                             <script>                         

                             $('.feed_box_img_show_$inc_n').click(function(){
                                 
                                 $('.view_image_slide_magnifier').show();
                                 $('#black').show();

                                 $('.body_of_photo_view').html("<img src='$update_pic_location$photo' >")

                             });
 

                           </script>
EOFILE;
                        
                         
                                                  

                    }

                    if( $update != "")
                    {
                          $feed_box_data = "<span class='single_update' style='color:rgb($random_bg_color);'> $update </span>";
                          $update_type   = "";
                          $feeling_type  = " Feeling $feeling";
                          $target        = "a";

                           if($anonymously == 0)
                               {
                                    $ws_name        = $updater_name; 
                                    $ws_username    = $updater_username;

                                     if($ws_profile_pic == '' || file_exists($simple_original_profile_pic_location . $ws_profile_pic) != 1 )
                                                {
                                                    $ws_profile_pic = "default.jpg";
                                                }
                                      else
                                      {

                                           $ws_profile_pic = $update_profile_pic;
                                      }


                              }
                            else
                              {
                                    $ws_name        = "Anonymous";
                                    $ws_username    = "Anonymous";
                                    $ws_profile_pic = "default.jpg"; 

                              }

                    }


                    else if($question != "" && $answer != "" )
                       {               



                                 $update_type  = "answered a question";
                                 $target       = "b";     

                             if($anonymously == 0)
                             { 
                                   $code_to_get_asker_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * FROM `$db_name`.`users` where id = '$asker_id'"));
                                   $an_name        = $code_to_get_asker_info['name'];
                                   $an_username    = $code_to_get_asker_info['username']; 
                                   $asker_line     = "<a class='asker_name' href='http://$host/$an_username'>$an_name</a>";
                             } 
                             else
                             {
                                   $an_name        = "";
                                   $an_username    = "";
                                   $asker_line     = "";
                             }
                                 

                              $feed_box_data = "                                 
                                 <b>$question</b>$asker_line 
                                 <br><br>
                                 $answer";


                       }
                          

                      /******************************************************************8
                        this is to add delete button to the post
                      **********************************************************************/

                          $fix_option_bar = "";
                           
                          if($updater_id == $id)
                          {
                             $fix_option_bar = <<< EOFILE
                                                  
                                              <div class='other_option_bar_fix'>
                                                           
                                                        <div class='delete_button_of_post' id='delete_button_of_post_$inc_n'>
                                                                   Delete
                                                        </div>

                                                        <script>
                                                                   
                                                                   $('#delete_button_of_post_$inc_n').click(function(){
                                                                              


                                                                                    var r = confirm("Are you sure you want to delete this post!");
                                                                                    if (r == true) 
                                                                                     {
                                                                                               
                                                                                               $("#feed_box_$inc_n").remove();

                                                                                                  $.post("$php_dir" + "comman/delete_update.php",{target:'$target',target_no:$feed_no},function(delete_update){
                                                                                                                $(".action_area_on_feed_$inc_n").html(delete_update);
                                                                                                 });

                                                                                    }


                                                                               

                                                                   });
  
                                                        </script>

                                              </div>

EOFILE;
                          }


                       

                      /*****************************************************************888
                         this is to get no of likes and comment
                      **********************************************************************/



                        /*******************************************************************************
                             this is to get list of likes
                        *******************************************************************************/ 
                             $below_bar_display_of_like = "";
                             $like_bar                  = "";
 
                    if(allow_like)
                      {
                                           //this is to get no of likes        
                             $no_of_likes     = $get_mysqli_info -> get_feed_info($asker_id,$target,$feed_no,"likes");
                          //this is to tell the limit of likes        max_feed_like_limit it is set in config.inc.php
                             $limit_of_likes = max_feed_like_limit;
                          //this is the liker img content
                             $likes_content = "";
                          //this is to allow like or not 
                             $allow_like  = $get_mysqli_info -> get_feed_info($id,$target,$feed_no,"allow_like");
                          //this is the first display of like 
                             $below_bar_display_of_like = "<div class='feed_box_body_bottom_icon like_button'></div>
                                                           <div class='feed_box_body_bottom_information overflow information_of_likes_$inc_n'  >$no_of_likes</div>
                                                           <input type='hidden' id='no_of_likes_$inc_n' value='$no_of_likes'>";

                             if($allow_like == 1)
                             {
                                 $button_choice = "like_action_button";
                                 $title_choice  = "like";
                             }
                             else
                             {
                                 $button_choice = "unlike_action_button";
                                 $title_choice  = "unlike";
                             }  

                          if($no_of_likes == 0)
                          {
                             $likes_content = "<div class='no_likes_content no_likes_content_$inc_n'>Be first to like!</div>";
                             


                          }
                          else
                          {
                             
                              
                              $code_to_get_likes = mysqli_query($connect , "SELECT * from `$db_name`.`users_likes` where target = '$target' and target_no = $feed_no ORDER BY  `users_likes`.`no` DESC LIMIT 0 , $limit_of_likes");
                              
                              while($get_info = mysqli_fetch_array($code_to_get_likes))
                              {
                                    $liker_id = $get_info['liker_id'];
                                    
                                    $get_liker_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * from `$db_name`.`users` where id = $liker_id"));

                                    $liker_username    = $get_liker_info['username'];
                                    $liker_profile_pic = $get_liker_info['profile_pic'];
                                    $liker_name        = $get_liker_info['name'];

 
                                             if($liker_profile_pic == '' || file_exists($simple_original_profile_pic_location . $liker_profile_pic) != 1 )
                                                {
                                                    $liker_profile_pic = "default.jpg";
                                                }




                                    
                                     $likes_content .= "<a href='http://$host/$liker_username' class='liker_img_$inc_n$liker_username'><img title='$liker_name' src='$small_profile_pic_location$liker_profile_pic'></a>";

                              }

                          }


                          //this is the display like bar 
                          $like_bar = <<< EOFILE
                                    
                                                                        <div class='likes_of_feed_box'>
                                         <span class='saving_of_like_$inc_n'></span>
                                         <input type='hidden' class='allow_like_$inc_n' value='$allow_like'>
                                         <div class='like_unlike_button lul_button_$inc_n $button_choice' title='$title_choice'></div>
                                        
                                             
                                             <script>
                                                       
                                                       $(".lul_button_$inc_n").click(function(){
                                                                   
                                                                //this is to make the like and unlike button show
                                                                 $(this).toggleClass('like_action_button');
                                                                 $(this).toggleClass('unlike_action_button');

                                                                  //this is to check weather photo exist or not
                                                                  var class_check = $('a').hasClass('liker_img_$inc_n$username');
                                                                  
                                                                  //this is to get allow like 
                                                                  var allow_like = $('.allow_like_$inc_n').val();

                                                                       if(class_check === false && allow_like == 1)
                                                                       {   
                                                                         //this is to add the liker img
                                                                         $(".images_of_likers_of_$inc_n").before("<a href='http://$host/$username' class='liker_img_$inc_n$username'><img title='$name' src='$small_profile_pic_location$profile_pic'></a>");
                                                                        


                                                                         //this is to update the like information
                                                                          var no_of_likes = document.getElementById("no_of_likes_$inc_n").value;

                                                                          no_of_likes++;
                                                                        
                                                                         $(".information_of_likes_$inc_n").html(no_of_likes);
                                                                         $(".see_all_likes_$inc_n").html(no_of_likes);
                                                                          
                                                                          $("#no_of_likes_$inc_n").val(no_of_likes);



                                                                          //this is to change the title

                                                                          $(this).attr("title","unlike");

                                                                          //this is to tell the post that like or unlike
                                                                            var action = 'like';
                                                                          

                                                                       }
                                                                       else
                                                                       { 
                                                                         
                                                                         //this is to remove liker img
                                                                         $(".liker_img_$inc_n$username").remove();


                                                                         //this is to update the like information
                                                                          var no_of_likes = document.getElementById("no_of_likes_$inc_n").value;

                                                                          no_of_likes--;
                                                                        
                                                                         $(".information_of_likes_$inc_n").html(no_of_likes);
                                                                         $(".see_all_likes_$inc_n").html(no_of_likes);
                                                                         
                                                                         $("#no_of_likes_$inc_n").val(no_of_likes);
                                                                           


                                                                           //this is to change the title

                                                                           $(this).attr("title","like");   

                                                                           //this is to change the allow like input
                                                                           //this is to get allow like 
                                                                           $('.allow_like_$inc_n').val(1);
                                                                           

                                                                           //this is to tell the post that like or unlike
                                                                            var action = 'unlike';


                                                                       }

                                                                    //this is to send to like command
                                                                       $.post("$php_dir" + "comman/like_unlike.php",{target:'$target',target_no:$feed_no,action:action},function(like_unlike_action){
                                                                                $(".saving_of_like_$inc_n").html(like_unlike_action);
                                                                       });




                                                                //this is to remove the be first one to like text
                                                                 if($no_of_likes == 0)
                                                                 {
                                                                   $(".no_likes_content_$inc_n").toggle();
                                                                 }

                                                       });

                                             </script>

                                         
                                         <div class='images_of_likers'>
                                               
                                               <span class='images_of_likers_of_$inc_n'>
                                                    $likes_content
                                               </span>

                                               
                                           
                                             <div class='see_all_likes see_all_likes_$inc_n overflow' title='See all likes'>$no_of_likes</div>
                                                     <script>
                                                           $(".see_all_likes_$inc_n").click(function(){
                                                                  $("#black").show();
                                                                  $(".all_likes_of_feed_box").show();
                                                                  
                                                                  

                                                                  $('.body_of_all_like_box').html("<img class='loading_sign_of_all_like_box' src='$loading_icon'>");
                                                                    
                                                                     var no_of_likes = document.getElementById("no_of_likes_$inc_n").value
                                                                   
                                                                    $.post("$php_dir" + "comman/show_all_likes.php",{target:'$target',target_no:$feed_no,no_of_likes:no_of_likes,unique_no:'$inc_n'},function(show_all_likes){
                                                                           $('.body_of_all_like_box').html(show_all_likes);
                                                                   
                                                                    });

                                                           });

                                                     </script>
                                          </div> 

                                    </div>
                             
EOFILE;


                  }//end of if 


                        




                     
                       /************************************************************************
                          this is to get list of comments 
                       *************************************************************************/
                       $below_bar_display_of_comment = "";
                       $comment_bar                  = "";
                       $user_comment                 = "";

                     if(allow_comment)
                     {
                            //this is to get no of comments
                          $no_of_comments  = $get_mysqli_info -> get_feed_info($asker_id,$target,$feed_no,"comments");
                          //this is to tell the limit of comment     max_comment_result is set in config.inc.php
                          $limit_of_comments = max_comment_result;
                          //this is to store the comment content
                          $comment_content = "";
                          //this is the extra option to allow edit or not
                          $extra_option = "";
                          //this is the load more button div 
                          $load_more_div = "";
                          //this is to increase the comment 
                          $comment_no = 1;
                          //this is first display of comment
                          $below_bar_display_of_comment = "<div class='feed_box_body_bottom_icon comment_button'></div>
                                                           <div class='feed_box_body_bottom_information overflow information_of_comments_$inc_n' >$no_of_comments</div>
                                                           <input type='hidden' id='no_of_comments_$inc_n' value='$no_of_comments'>";

                           if($no_of_comments ==0)
                           {
                              $comment_content = ""; 

                                   $comment_bar = <<< EOFILE
                                        
                                        <div class='comment_process_area_$inc_n'></div>
                                    
                                    <div class='comment_of_feed_box '>
                                             
                                              

                                              <span class='comment_of_feed_box_$inc_n'>
                                                $comment_content
                                              </span>


                                    </div>
EOFILE;
                               

                           }
                           else
                           {
                              
                              $code_to_get_comments = mysqli_query($connect , "SELECT * from `$db_name`.`users_comments` where target = '$target' and target_no = '$feed_no' order by no DESC limit 0, $limit_of_comments");
                              
                               if($no_of_comments > $limit_of_comments)
                               {
                                  $load_more_div = "         <div class='load_more_div all_comment_button comment_shadow'>
                    
                                                                <input type='button' class='button_2 feed_more_button' value='Load More'>

                                                          </div>";
                               }

                              while($get_comment_info = mysqli_fetch_array($code_to_get_comments))
                              {
                                    
                                    $comment_no     = $get_comment_info['no'];
                                    $commenter_id   = $get_comment_info['commenter_id'];
                                    $comment_real   = $get_comment_info['comment'];
                                    $commenter_date = $get_comment_info['date']; 

                                    $get_commenter_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * FROM `$db_name`.`users` where id = $commenter_id"));

                                    $commenter_name           = $get_commenter_info['name'];
                                    $commenter_username       = $get_commenter_info['username'];
                                    $commenter_profile_pic    = $get_commenter_info['profile_pic'];

                                                                                if($commenter_profile_pic == '' || file_exists($simple_original_profile_pic_location . $commenter_profile_pic) != 1 )
                                                                                    {
                                                                                        $commenter_profile_pic = "default.jpg";
                                                                                    }


                                    $comment        = $text_filter -> convert_hash_tags($comment_real);
                                    $comment        = $text_filter -> convert_at_tags($comment);
                                    $comment        = $text_filter -> convert_smiles($comment);

                                    $date           = $text_filter -> round_date($commenter_date);

                                    //this is to choose to allow user to edit comment or not

                                    if($commenter_id == $id)
                                    {
                                      $extra_option = "  
                                                                 <input type='hidden' class='refreshed_comment_of_$inc_n$comment_no' value='$comment_real'>
                                                                 <div class='list_option_of_comment edit_comment_$inc_n$comment_no' title='Edit'>Edit</div>
                                                                  

                                                                <script>
                                                                          $('.edit_comment_$inc_n$comment_no').click(function(){
                                                                               
                                                                               $('.edit_comment_of_feed_box').show();
                                                                               $('#black').show();
                                                                                
                                                                               var refresh_comment = $('.refreshed_comment_of_$inc_n$comment_no').val(); 
                                                                               
                                                                               //this is to give comment to textarea
                                                                               $('.new_comment_holder').val(refresh_comment);

                                                                               //this is to give comment_no to input 
                                                                               $('.edit_comment_no_holder').val('$comment_no');
                                                                               
                                                                               //below code is just to give class to the input 

                                                                               //this is to give area of change to input
                                                                               $('.display_change_area_holder').val('main_comment_$inc_n$comment_no');

                                                                               //this is to give refresh comment input to input
                                                                               $('.refresh_comment_holder').val('refreshed_comment_of_$inc_n$comment_no');

                                                                          });  
                                                                </script> 


                                                                 <div class='list_option_of_comment delete_comment_$inc_n$comment_no' title='Delete'>Delete</div>

                                                                 <script>
                                                                        $('.delete_comment_$inc_n$comment_no').click(function(){
                                                                                 
                                                                                 var r = confirm('Are you sure you want to delete this comment!');
                                                                                    if (r == true) 
                                                                                     {
                                                                                             $('.$inc_n$comment_no').remove();

                                                                                                 $.post('$php_dir' + 'comman/delete_comment.php',{comment_no:'$comment_no'},function(delete_comment){
                                                                                                         $('.other_option_work_$inc_n$comment_no').html(delete_comment);

                                                                                 
                                                                                                 });//end of post 
                                                                                      
                                                                                      }
                                                                             
                                                                            });// end of click

                                                                 </script>
                                                        
                                                                 ";
                                    }
                                    else
                                    {
                                      $extra_option = "";
                                    }


                                          
                                 $comment_content .= "              
                                       <span class='other_option_work_$inc_n$comment_no'></span>

                                       <div class='comment_of_friends_box $inc_n$comment_no'>
                                                <div class='commenter_photo comment_shadow' title='$commenter_name'>
                                                          <a href='http://$host/$commenter_username'><img src='$medium_profile_pic_location$commenter_profile_pic'></a>
                                                </div>
                                                 
                                                <div class='comment_by_the_commenter comment_shadow'>
                                                         <div class='name_of_commenter_in_comment_box overflow capital'><a href='http://$host/$commenter_username'>$commenter_name</a></div>
                                                           
                                                                  <div class='main_comment main_comment_$inc_n$comment_no'>$comment</div>

                                                        <div class='option_of_comment'>
                                                                 $extra_option
                                                                 <div class='time_of_comment' title='$commenter_date'><div class='img_of_clock_on_comment'></div>$date</div>
                                                         </div> 
                                                         
                                                </div>
                                                
                                      </div>";

                                    $comment_no++;
                              }//end of while 
                               
                              
                              $comment_bar = <<< EOFILE
                                                                                     <div class='comment_process_area_$inc_n'></div>
                                    <div class='comment_of_feed_box '>
                                             
                                              

                                              <span class='comment_of_feed_box_$inc_n'>
                                                $comment_content
                                              </span>
                                              $load_more_div


                                    </div>
EOFILE;
                               

                           }

                           $user_comment = <<< EOFILE
                                    <br>      
                                    <div class='my_comment_of_feed_box'>
                                         
                                         <div class='commenter_photo' style='margin-top:5px;' title='$name'>
                                                          <a href='http://$host/$username' ><img src='$medium_profile_pic_location$profile_pic'></a>
                                         </div>
                                         <div class='comment_by_the_my'>
                                          
                                          <form>
                                                 <input type='comment' autocomplete='off' placeholder='write a comment...' class='input comment_input ' id='comment_input_$inc_n'>
                                                 <input type='submit' class='submit_comment_$inc_n' style='display:none'>
                                         </form>
                                                 <div class='rule_of_comment'>Press enter to comment</div> 

                                                 <script>
                                                           $(".submit_comment_$inc_n").click(function(){

                                                                     
                                                                   

                                                                  //this is to get the comment
                                                                  var comment = document.getElementById('comment_input_$inc_n').value;
                                                                  
                                                                  if(comment == "")
                                                                  {

                                                                  }
                                                                  else
                                                                  {
                                                                         //this is to make the input value 0
                                                                         $('#comment_input_$inc_n').val("");

                                                                          $(".comment_process_area_$inc_n").html("<div class='comment_msg'><img src='$loading_icon'></div>")

                                                                           
                                                                          $.post("$php_dir" + "comman/comment.php",{comment:comment,target:'$target',target_no:$feed_no},function(comment_on_feed){
                                                                                   $(".comment_process_area_$inc_n").html("");
                                                                                   $('.comment_of_feed_box_$inc_n').prepend(comment_on_feed);
                                                                                   
                                                                                  

                                                                          //this is to update the comment information
                                                                          var no_of_comments = document.getElementById("no_of_comments_$inc_n").value;

                                                                          no_of_comments++;
                                                                        
                                                                         $(".information_of_comments_$inc_n").html(no_of_comments);

                                                                          });

                                                                          //this is to stop the form
                                                                           return false;
                                                                  }

                                                                  
                                                                  
                                                                  


                                                           });     
                                                 </script>

                                         </div>

                                    </div>
EOFILE;

                     }// end of if

                        


                        /*****************************************************************
                           this is the main feed box frame 
                        ******************************************************************/
                                  
                                  //THIS IS TO SHOW INFO BAR

                                    $information_bar_of_update = "";
                           
                           if(allow_comment || allow_like)
                           {
                               $information_bar_of_update = <<< EOFILE
                         
                         <div class='feed_box_body_bottom' id='show_other_option_$inc_n'>
                               
                                $below_bar_display_of_like

                                $below_bar_display_of_comment
                               

                         </div>



                         <script type="text/javascript">
                               $(document).ready(function(){
                                          $("#show_other_option_$inc_n").click(function(){
                                                       $("#show_other_option_$inc_n").toggleClass("feed_box_body_bottom");
                                                       $("#show_other_option_$inc_n").toggleClass("feed_box_body_bottom_selected");
                                                       $("#feed_box_body_other_$inc_n").slideToggle(200);
                                          });
                               });
                         </script>
EOFILE;
                           }


                           //THIS IS MAIN FRAME

 

        $feed_box_one = <<< EOFILE
 <span class='action_area_on_feed_$inc_n'></span>
 <div class='feed_box' id='feed_box_$inc_n'>
                     

                     <div class='profile_picture_of_feeder' title='$ws_name'>
                           <a href='http://$host/$ws_username'>
                             <img src='$medium_profile_pic_location$ws_profile_pic'>
                           </a>
                     </div>
               

               <div class='feed_box_body'>
                         
                         
                           $photo

                         <div class='feed_box_body_top'>
                                   <div class='feed_box_body_top_name overflow '><a href='http://$host/$ws_username'><span class='capital'>$ws_name</span> <span class='user_at_tag'>@$ws_username</span></a></div>
                                   <div class='feed_box_body_top_about'>$update_type $feeling_type</div>
                                    <div class='feed_box_body_top_time' title='$date'><div class='img_of_clock'></div>$round_date</div>
                              
                          </div>

                         <div class='feed_box_body_content' >

                                $feed_box_data
                                
                                
                         </div> 

                          $fix_option_bar
                          
                           $information_bar_of_update


                         <div class='feed_box_body_other' id='feed_box_body_other_$inc_n'>
                                    
                                     $like_bar
                                     $comment_bar
                                     $user_comment


                         </div>


                     
               </div>

         </div>

EOFILE;


return $feed_box_one;

   }







}

 

?>