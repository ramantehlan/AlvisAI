<?php


     $host = getenv("SERVER_NAME");
?>
<link rel='stylesheet' href='<?php echo _css_dir_; ?>top/top-ui.css'>
<link rel='stylesheet' href='<?php echo _css_dir_; ?>top/search-ui.css'>
<link rel='stylesheet' href='<?php echo _css_dir_; ?>top/pop-ui.css'>
<style type="text/css">
                html{background-color:#<?php echo $bg_color; ?>;
                     background-image:url("<?php echo _background_image_dir_ .  $bg_img; ?>");
                     background-size:<?php 
                       if($bg_img == "1.jpg" || $bg_img === "2.jpg" || $bg_img === "3.jpg" || $bg_img === "4.jpg" || $bg_img === "5.jpg" || $bg_img === "6.jpg" || $bg_img === "7.jpg" || $bg_img === "8.jpg" || $bg_img === "9.jpg" )
                        { echo "100%"; }
                       else
                       {
                        echo 'inherit';
                       }
                       
                     ?>;
                }

</style>





<?php
      
/********************************8
this is to show the introduction box about site
*************************************/
include "intro_box.php";

      /***********************************************
           this is for the background process
      ************************************************/

?>






 <?php 
     // this black is to get a black background
 ?>
<div id='black'></div>




<?php 
   //this is to show the image in large view
?>

<div class='view_image_slide_magnifier box_of_pop pop shadow moveable'>
       <div class='top_of_pop mover'>
               Photo viewer
              <div class='close_of_pop close_the_photo_viewer'></div>
       </div>
       <div class='body_of_pop body_of_photo_view'>
         
       </div>
</div>

<script type="text/javascript">
     $('.close_the_photo_viewer').click(function(){
           $('.view_image_slide_magnifier').hide();
           $('#black').hide();
     });

</script>





<?php 
    //this is to show the likes of users
?>
<div class='all_likes_of_feed_box box_of_pop pop shadow moveable'>
        <div class='top_of_pop mover'>
              Likes
             <div class='close_of_pop close_the_all_like_box'></div>
        </div>
        <div class='body_of_pop body_of_all_like_box'>
                

        
        </div>
</div>

<script type="text/javascript">



         
         $(".close_the_all_like_box").click(function(){
                   $('.all_likes_of_feed_box').hide();
                   $("#black").hide();
                 

         });



</script>








<?php 
    //this is to edit the comment
?>
<div class='edit_comment_of_feed_box box_of_pop pop shadow moveable'>
        <div class='top_of_pop mover'>
              edit comment
             <div class='close_of_pop close_the_edit_comment_box'></div>
        </div>
        <div class='body_of_pop body_of_edit_comment_box'>
        <form>
            <input type='hidden' value='' class='edit_comment_no_holder'>
            <input type='hidden' value='' class='display_change_area_holder'>
            <input type='hidden' value='' class='refresh_comment_holder'>
                 <textarea placeholder='new comment...' class='new_comment_holder'></textarea>
                 <span class='edit_comment_save_area'></span>

        
        </div>
        <div class='bottom_of_pop'>
             <input type='submit' value='Comment'  class='button update_button edit_comment_button' >
        </form>
        </div>
</div>

<script type="text/javascript">
         
         $(".close_the_edit_comment_box").click(function(){
                   $('.edit_comment_of_feed_box').hide();
                   $("#black").hide();
         });

         $(".edit_comment_button").click(function(){
                
                var new_comment = $('.new_comment_holder').val();

                if(new_comment == "")
                {

                }
                else
                {
                    //this is to get comment no
                    var comment_no         = $(".edit_comment_no_holder").val();
                    //this is to get display comment area
                    var display_change_area = $(".display_change_area_holder").val();
                    //this is to get saving new comment to input 
                    var refresh_comment_holder = $(".refresh_comment_holder").val();

                    $(".edit_comment_save_area").html("<div class='comment_msg'><img src='<?php echo _loading_image_; ?>'></div>");

                    $.post('<?php echo _php_dir_; ?>comman/edit_comment.php',{new_comment:new_comment,comment_no:comment_no,display_change_area:display_change_area,refresh_comment_holder:refresh_comment_holder},function(edit_comment){
                        
                        $(".edit_comment_save_area").html(edit_comment);
                        $('.new_comment_holder').val("");

                         $('.edit_comment_of_feed_box').hide();
                         $("#black").hide();
                         
                    });

                }

            return false;
         });


</script>








 <?php 
     // this loading is to show loading sign
 ?>
<div id='loading'>
        
        <img src="<?php echo _loading_image_; ?>">
</div>







 <?php 
     // this update uploading box is to show that how much update is uploaded
 ?>
<div class='update_uploading_box pop' ><br>
       <progress id='update_progressBar' value='0' max='100' style='width:300px;'></progress><Br>
       <b>Status</b>: <span id='update_upload_status'>Loading...</span>
</div>








 <?php 
     // this is the update box 
 ?>
<div id='update_box' class='box_of_pop shadow moveable pop'>
          <div class='top_of_pop mover' >
            
            Update

          <div class='close_of_pop' id='close_update_box'></div>
          </div>
          <div class='body_of_pop update_body_of_pop'>
                  
              
                 <!--   <div class='row_of_update'>
                          <span style='float:left;'> Update Type: </span>
                               <select class='input select_of_update'>
                                     <option value='' selected>Status</option>
                                     <option value=''>Secret</option>
                                     <option value=''>Wish</option>
                                     <option value=''>Crush</option>
                                     <option value=''>Weird</option>
                                     <option value=''>Anger</option>
                               </select>
                    </div> -->
                  
        <form id='upload_update'  enctype='multipart/form-data' method='post'>

                    <textarea placeholder="Feel free to write!!!  " class='update_textarea' id='update_textarea' ></textarea>
     
                  <div class='row_of_update' style='margin-top:20px;'>
                           <span style='float:left'>Add Feeling: 
                                     
                           </span>

                              
                                <select class='input select_of_update' id='feeling_choice'>
                                     <option value='' selected>Select your feeling</option>
                                      <option value='Happiness' >Happiness</option>
                                      <option value='Love' >Love</option>
                                      <option value='Courage' >Courage</option>
                                      <option value='Hope' >Hope</option>
                                      <option value='Pride' >Pride</option>
                                      <option value='Satisfaction' >Satisfaction</option>
                                      <option value='Relief' >Relief</option>
                                      <option value='Trust' >Trust</option>
                                      <option value='Calmness' >Calmness</option>
                                      <option value='Relaxation' >Relaxation</option>
                                      <option value='Anger' >Anger</option> 
                                      <option value='Annoyance' >Annoyance</option>
                                      <option value='contempt' >contempt</option>
                                      <option value='Disgust' >Disgust</option>
                                      <option value='Irritation' >Irritation</option>
                                      <option value='Anxiety' >Anxiety</option>
                                      <option value='Embarrassment' >Embarrassment</option>
                                      <option value='Fear' >Fear</option>
                                      <option value='Helplessness' >Helplessness</option>
                                      <option value='Worry' >Worry</option>
                                      <option value='Doubt' >Doubt</option>
                                      <option value='Envy' >Envy</option>
                                      <option value='Frustraion' >Frustraion</option>
                                      <option value='Guilt' >Guilt</option>
                                      <option value='Shame' >Shame</option>
                                      <option value='Boredom' >Boredom</option>
                                      <option value='Despair' >Despair</option>
                                      <option value='Disappointment' >Disappointment</option>
                                      <option value='Hurt' >Hurt</option>
                                      <option value='Sadness' >Sadness</option>
                                      <option value='Stress' >Stress</option>
                                      <option value='Tension' >Tension</option>
                                      <option value='Amusement' >Amusement</option>
                                      <option value='Delight' >Delight</option>
                                      <option value='Elation' >Elation</option>
                                      <option value='Exitement' >Exitement</option>
                                      <option value='Joy' >Joy</option>
                                      <option value='Pleasure' >Pleasure</option>
                                      <option value='Affection' >Affection</option>
                                      <option value='Empathy' >Empathy</option>
                                      <option value='Friendliness' >Friendliness</option>
                                      <option value='Serenity' >Serenity</option>
                                      <option value='Interest' >Interest</option>
                                      <option value='Politeness' >Politeness</option>
                                      <option value='Surprise' >Surprise</option>
                                </select>
                                <div class='notic_of_not_public'>This help alvis and people understand you!</div>

                    </div>

                          <div class='row_of_update' style='margin-top:30px;'>
                           <span style='float:left'>Anonymously: </span>

                               <input type='checkbox' id='update_choice' >
                                       <label for='update_choice'>
                                            <div class='checkbox--img pop_check_box'></div>
                                       </label>
                    </div>



                    <?php 

                      if(allow_image_update)
                        {
                          echo "<div class='row_of_update' style='margin-top:20px;'>
                           <span style='float:left'>Upload Photo: </span>
                             <input type='file' class='update_file_upload' id='update_file_upload'>
                         </div>";

                        }
                        else
                        {
                          echo "<input type='hidden' class='update_file_upload' id='update_file_upload' value='' >";
                        }


                        ?>
 
                    <div class='error' id='update_error'></div>
          </div>
          <div class='bottom_of_pop'>
                    <input type='button' value='Update'  class='button update_button' onclick='upload_update();'>
                    


    <script>

      function upload_update(){
           
         // this is just to get the value of them 
         


         <?php
             if(allow_image_update)
             {
               echo "var file   = _('update_file_upload').files[0];";
             }
             else 
             {
              echo "var file =  ''; ";
             }

         ?>

         
         var text   = _('update_textarea').value;
         var choice = _('update_choice').checked;
         var feeling_choice = _('feeling_choice').value;
         

         
         if(text == "")
           {          
                    $("#update_error").show();
                    $("#update_error").html("<?php echo $first_name; ?>, update can't be empty.");
           }
          else if(text.length < 10)
          {
                    $("#update_error").show();
                    $("#update_error").html("<?php echo $first_name; ?> your update must have at least 10 letters.");
          }
          else if(feeling_choice.length == "")
          {
                    $("#update_error").show();
                    $("#update_error").html("<?php echo $first_name; ?> adding feeling is compulsorily.");
          
          }
          else if(_("update_file_upload").value == "")
          {   

                   $("#update_error").hide();
                   $('#update_box').hide();
                   $('.update_uploading_box').show();

                    var formdata = new FormData();
                   formdata.append("update_textarea",text);
                   formdata.append("update_choice",choice);
                   formdata.append("update_file_upload",file);
                   formdata.append("feeling_choice",feeling_choice);

                   var ajax = new XMLHttpRequest();
                   ajax.upload.addEventListener("progress", progressHandler_update,false);
                   ajax.addEventListener("load", completeHandler_update , false);
                   ajax.addEventListener("error",errorHandler_update,false);
                   ajax.addEventListener("abort",abortHandler_update,false);
                   ajax.open("POST","../../../..<?php echo _simple_php_dir_ ?>top/upload_status.php");
                   ajax.send(formdata);

          }
      
           else 
          {  
              if(file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/jpg' ||  file.type == 'image/gif' || file.type == 'image/jpe')
               {
               
               if( (file.size/1024) > 2048)
                     {
                       $("#update_error").show();
                       $("#update_error").html("Image size should be less then 2MB.");
                     }

                  else
                  {

                   $("#update_error").hide();
                   $('#update_box').hide();
                   $('.update_uploading_box').show();

                    var formdata = new FormData();
                   formdata.append("update_textarea",text);
                   formdata.append("update_choice",choice);
                   formdata.append("update_file_upload",file);
                   formdata.append("feeling_choice",feeling_choice);


                   var ajax = new XMLHttpRequest();
                   ajax.upload.addEventListener("progress", progressHandler_update,false);
                   ajax.addEventListener("load", completeHandler_update , false);
                   ajax.addEventListener("error",errorHandler_update,false);
                   ajax.addEventListener("abort",abortHandler_update,false);
                   ajax.open("POST","../../../..<?php echo _simple_php_dir_ ?>top/upload_status.php");
                   ajax.send(formdata);
                   
                  }
              
               }

         else
         {
           $("#update_error").show();
           $("#update_error").html("Image must be of type jpg , png or gif.");
         }

          }// end of else



        
        
         
         
       
       }// end of function


       

    </script>

    <script>

       function _(el){
        return document.getElementById(el);
       }

        function progressHandler_update(event){
                 var percent = (event.loaded / event.total) * 100 ;
                 _("update_progressBar").value = Math.round(percent);
                 _("update_upload_status").innerHTML = Math.round(percent) +"% uploaded... please wait";

       }
      function completeHandler_update(event){
                 _("update_upload_status").innerHTML = event.target.responseText;
                 _("update_progressBar").value =  100;

                  _('update_textarea').value    = "";
                  _("update_file_upload").value = "";
                   $('.pop').hide();
                   $('#black').hide();
                   //$('html').css('cursor','wait');
                   //window.location.reload(!0);
                 
       }
       function errorHandler_update(event){
                   $("#update_error").show();
                   $('.update_uploading_box').hide();
                   $('#update_box').show();
                 _("update_error").innerHTML = "Upload Failed";

       }

        function abortHandler_update(event){
                   $("#update_error").show();
                   $('.update_uploading_box').hide();
                   $('#update_box').show();
                 _("update_error").innerHTML = "Upload Aborted";

       }
    </script>

          </div>
    </form>
 </div>

<?php
      
      /***********************************************
           this is for the main frame
      ************************************************/

?>
 <div id='top' class='shadow'> 
        <div id='middle_top'>
                <div class='top_logo loading_logo' id='talk_to_ai' title='Call <?php echo ai_name; ?>'></div> 

   <?php
      
      /***********************************************
           this is for the top options of board wall 
      ************************************************/

?>

                <div id='top_menu'>
                       <a href='http://<?php echo $host; ?>/board'><div class='top_menu_option' title='Board' id='board'>
                           Board 
                       </div></a>
                       <a href='http://<?php echo $host . '/' . $username; ?>'><div class='top_menu_option' title='Wall' id='wall'>
                           Wall 
                       </div></a>
                       <?php 

                        //this is to check that is switch file allowing question or not

                        if(allow_question )
                        {
                                                   $line_to_get_questions = mysqli_query($connect , "SELECT * from `$db_name`.`users_questions` WHERE `asked_to` = $id and `answer` = '' ");
                                                   $no_of_questions       = mysqli_num_rows($line_to_get_questions);
                                                   $question_add_data     = "";
                                                   
                                                   // this is to show no of new questions

                                                   if($page != "questions" && $no_of_questions >= 1)
                                                   {
                                                           $question_add_data = " <div class='top_icon_menu_option_box_alert'>$no_of_questions</div>";
                                                   }
                             
                             echo "  <a href='http://$host/questions'><div class='top_menu_option' title='Question Box' id='top_question'>Questions $question_add_data</div></a>";

                        }

                      

                      ?>
                       
                </div>
                
<?php
      
      /***********************************************
           this is for the search box and its tools
      ************************************************/

?>
                <div id='top_search_box'>
                	
                	<div class='top_search_box_display'>
                       

                	</div>
                	<div class='top_search_box_tool'>
                	  <form method='post' action='#' style='margin:0px;'>
                         <input type='input' class='input top_search_box_input' id='search_user' autocomplete='off' placeholder='Search for Friends and Friends of Friends' maxlength='100'>
                         <input type='submit' class='search_input top_search_button'   value='' >
                         
                      </form>

                    </div>
                    <div class='hint_for_search shadow overflow'>Press enter to search</div>

                    <script type="text/javascript">
                       
                            $(document).on('click','.search_load_more_button',function(){
 
                               
                               $(".search_load_more").html("<img src='<?php echo _loading_image_; ?>'>");

                               var ele = $(".search_load_more");

                               $.ajax({

                                   url: '../../../../../..<?php echo _simple_php_dir_ ?>search/load_more_search.php',

                                   type: 'POST',

                                   data: {
                                       load_no: $(this).data('load_no'),
                                       input: document.getElementById('search_user').value,
                                        

                                   }
                                   ,
                                   success: function(response)
                                   {
                                          if(response)
                                          {
                                             ele.remove();
                                             $('.display_result_info').append(response);
                                          }
                                   }
                                  
                               });//end of ajax
                              
                            });//end of function
                   
                    </script>
                    
                </div>
               

<?php
      
      /***********************************************
           this is for the top right side icon bar
      ************************************************/

?>
                <div id='top_icon_menu'>
                         
                          <div class='top_icon_menu_option slide' id='top_grid'> </div>
                             <div  class='hide box_of_slide_down slide' id='grid_box_slide_down' >
                                         
                                        <a href='http://<?php echo $host; ?>/<?php echo $username; ?>' title='<?php echo $name; ?>'>
                                        <div class='user_menu_card'>
                                             <div class='menu_profile_pic'>
                                                           <img src='<?php echo _profile_medium_image_dir_ .  $profile_pic; ?>'>
                                             </div>
                                             <div class='menu_name overflow'>
                                                         <?php echo $name; ?>
                                             </div>
                                        </div>
                                       </a>
                                        
                                        <?php 
                                         //this is to add update option to grid
                                         //<div class='grid_option' id='update_grid' title='Update'></div>
                                         ?>
                                        <a href='http://<?php echo $host; ?>/settings/'><div class='grid_option' id='settings_grid' title='Settings'></div></a>
                                        <div class='grid_option' id='information_grid' title='Information'></div>
                                        <a href='http://<?php echo $host; ?>/logout'><div class='grid_option' id='logout_grid' title='Logout'></div></a>
                             </div>
                           



                          
                                       <?php  
                                                // this is to get no of notifications
                                                $no_of_new_notifications = $get_mysqli_info -> get_info($id,0,'unseen_notifications');
                                                $no_of_new_notifications_display = "";

                                                //this is to set the max no of notifications
                                                if($no_of_new_notifications > 6)
                                                {
                                                  $notifications_max_limit = $no_of_new_notifications;
                                                }
                                                else
                                                {
                                                   $notifications_max_limit = notification_max_limit;
                                                }
                                                

                                                if($no_of_new_notifications >= 1)
                                                {  $php_dir = _php_dir_;
                                                   $no_of_new_notifications_display =  "
                                                  <div class='top_icon_menu_option_box_alert notifications_alert'>$no_of_new_notifications</div> 
                                                         <div class='remove_notification'></div>
                                                           
                                                           <script type='text/javascript'>
                                                                 $('#top_notification').click(function(){
                                                                          
                                                                          $('.notifications_alert').remove();
                                                                           
                                                                        /*  $.post('$php_dir" . "top/make_notification_seen.php',{},function(make_notic_seen){
                                                                                        
                                                                                       // $('.remove_notification').html(make_notic_seen);                   

                                                                          });*/

                                                                  });

                                                           </script>
                                                    ";
                                                }


                                                 if(allow_notification)
                                                 { 
                                                      
                                                         $line_to_get_notifications = mysqli_query($connect , "SELECT * FROM `$db_name`.`users_notifications` WHERE `to` = '$id' ORDER BY  no DESC limit 0 , $notifications_max_limit");
                                                         $no_of_display_notifications     = mysqli_num_rows($line_to_get_notifications);
                                                         $notifications_box_content = "";

                                                     if($no_of_display_notifications >= 1)
                                                     { 
                                                      
                                                      // this code is to show notifications
                                                    
                                                              while ($get_noti_info = mysqli_fetch_array($line_to_get_notifications))
                                                               {
                                                                    
                                                                    $user_from_noti = $get_noti_info['from'];
                                                                    $user_to_noti   = $get_noti_info['to'];
                                                                    $link_no        = $get_noti_info['link_no'];
                                                                    $link_type      = $get_noti_info['link_type'];
                                                                    $seen           = $get_noti_info['seen'];
                                                                    $date           = $get_noti_info['date'];
                                                                    $round_date     = $text_filter -> round_date($date);



                                                                    /********************************************
                                                                     this is to get from_noti_info                                                   
                                                                    ***********************************************/                                                      
                                                                     
                                                                     $snap_code          = mysqli_query($connect , "SELECT * from `$db_name`.`users` where id='$user_from_noti'");
                                                                     $get_user_from_info = mysqli_fetch_array($snap_code);
                                                                     $un_name            = $get_user_from_info['first_name'];
                                                                     $un_profile_pic     = $get_user_from_info['profile_pic'];
                                                                     $un_username        = $get_user_from_info['username'];
 

                                                                
                                                                     $noti_content = "<span class='notification_user_name'> @$un_username </span>";

                                                                 switch ($link_type) 
                                                                    {
                                                                      case 'question':
                                                                           $noti_content .= "<span class = 'notification_real_msg' > Answered your question. </span>";
                                                                        break;
                                                                      
                                                                      default:
                                                                          $noti_content  .= "<span class = 'notification_real_msg' > Updated. </span>";
                                                                        break;
                                                                    }

                                                      $notifications_box_content .= "
                                                        
                                                              <div class='single_notification_box seen_of_the_noti_$seen'>
                                                                 <a href='http://$host/$un_username'> <div class='notic_img_box' title='$un_name'>
                                                                          <img  src='" . _profile_medium_image_dir_ . "$un_profile_pic'>
                                                                  </div></a>
                                                                       <a href='$protocol://$host/get/$link_type/$link_no'>
                                                                              <div class='notic_body'>
                                                                                      $noti_content 
                                                                              </div>
                                                                              <div class='notic_time' title='$date'> 
                                                                                   $round_date
                                                                              </div>
                                                                      </a>
                                                              </div>";
                                                      

                                                               }
                                                                // this is to get all notification and then show load button

                                                                $no_of_all_notifications = $get_mysqli_info -> get_info($id,0,'all_notifications');
                                                              
                                                               if($no_of_all_notifications > $notifications_max_limit)
                                                               {
                                                                
                                                                $notifications_box_content .= "<div class='load_more_div notification_load' >
                    
                                                                           <input type='button' class='button_2 feed_more_button' value='Load More'>

                                                                      </div>";
                                                               }
 

                                                     }// end of if
                                                     else
                                                     {
                                                      // this code is to show that no notifications
                                                         
                                                           $notifications_box_content = <<< EOFILE
                                                                     
                                                                     <div class='no_notification_box'>
                                                                          No Notifications.
                                                                     </div>
EOFILE;



                                                     }


                                                    $display_notification = <<< EOFILE
                                                           <div class='top_icon_menu_option slide' id='top_notification'>
                                                                    $no_of_new_notifications_display
                                                           </div>
                                                                
                                                          <div  class='hide box_of_slide_down slide' id='notification_box_slide_down' >
                                                                    <div class='top_of_slide_down'>
                                                                          Notification
                                                                    </div>
                                                                    <div class='body_of_slide_down scroll' id='body_of_notification_slide_down'> 
                                                                     
                                                                       $notifications_box_content

                                                                    </div>
                                                         </div>   

EOFILE;
                                                          
                                                          echo $display_notification;

                                                 }

                                       ?>             
                        
                      <?php 
                            //this is for update button
                      ?>
                     <div class='<?php //grid_option ?> top_icon_menu_option slide' id='update_grid' title='Update'></div>


                </div>
        </div>
 </div>

<script type="text/javascript">
// this is just to select the top bar option 
 $(document).ready(function(){
  
   var page         = "<?php echo $page; ?>";
   var current_page = $("#<?php echo $page; ?>");

   current_page.removeClass("top_menu_option");
   current_page.addClass("top_menu_option_selected");

   if(page == "questions")
   {
   	 $("#top_question").addClass("top_icon_menu_option_current");
   }



 }) ;

////////// it ends //////////////

 window.addEventListener("load",function(){
        $(".top_logo").removeClass("loading_logo");
});

</script>

 
 <script type="text/javascript" src='<?php echo _javascript_dir_; ?>top/functions.js'></script>
 <script type="text/javascript" src='<?php echo _javascript_dir_; ?>top/slide.js'></script>
 <script type="text/javascript" src='<?php echo _javascript_dir_; ?>top/pop_slide.js'></script>

<?php 
 /**************************
  this is for the close all pop ups
 ****************************/
?>

<script type="text/javascript">
         $("#black").click(function(){
                  $('.pop').hide();
                  $('#black').hide();
         });




       


/************************************************************************************
this is the search program
************************************************************************************/


$(document).ready(function(){



                         //this is to active when the seach button is pressed
                         search_but.click(function(){
        
                               search_user();   
                               return false;
                         });



                         //this is to active when the key is typed
                         search_input.keyup(function(){
                             
                           // search_user();   

                             var length = document.getElementById("search_user").value.length;
                              
                              if(length >= 1 )
                              {
                                 $('.hint_for_search').show();
                                 $('.hint_for_search').html('Press enter to search');
                              }
                              else
                              {
                                    hide_search();
                                    $('.hint_for_search').hide();
                                 //$('.hint_for_search').html('Press enter to close');
                              }
                            

                            //   search_user();   
                            //   return false;
                         });




                         function search_user()
                         {
                            if(document.getElementById("search_user").value != " ")    
                            {
                              var value  = search_input.val();
                              var length = document.getElementById("search_user").value.length;

                                 /*
                                       this is just to hide the slide_down menu 
                                       this hide code is written in function.js
                                 */


                                 if(length >= 1)
                                 {  
                                    show_search();
                                    
                                    
                                      search_display.html("<img src='<?php echo _loading_image_; ?>' class='while_search_img'> ");
                                    
                                    
                                    

                                         $.post("<?php echo _php_dir_; ?>search/search_user.php",{input:value},function(show_search){
                                                  search_display.html(show_search);
                                        
                                         });
                                    
                                 }
                                 
                            }//end of if
                             

                         }//end of search_user();


});





</script>


<?php
     //include of ai talk allow_ai_talk is set in config.inc.php
     if(allow_ai_talk)
     {    
     include "../ai_box/ai/program_o/gui/index.php";

     }

?>


