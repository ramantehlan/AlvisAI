<?php 

if($username != $s_username)
{
  $page = 'other';
}

?>
<html>
<head>
  <title>@<?php  echo $s_username; ?> Wall</title>
            
            <?php include "$path/includes/header_files.inc.php"; ?>  

            <link rel='stylesheet' href='<?php echo _css_dir_; ?>wall/wall-ui.css'>
            
            
              <meta name='author' content='<?php $s_name; ?>'>
              <meta name='keyword' content='<?php echo $s_name; ?> wall <?php echo ai_name . " " . company_name . " " . site_name;  ?>'>
              <meta name='description' content="<?php echo company_name;  ?> wall of <?php echo $s_name ?>. you can view Photos , updates , about and more about <?php echo $s_name; ?> etc. First you must join the <?php echo company_name; ?>">
              <meta name='language' content='English'>
              <meta charset='urf-8'>  

              

</head>
<body>
  <?php
       include "top.php";
     


/***********************************
this is to know that on which page do we have to go
************************************/

if(isset($_GET['page']))
{  $_GET['page'] = strtolower($_GET['page']);

   switch ($_GET['page']) {
     case 'following':
          $sub = 'following';    
     break;
     case 'followers':
          $sub = 'followers';
     break;
     default:
          $sub = 'activity';
       break;
   }
}




// below script if for wall background color and image
  ?>



<style type="text/css">
                html{background-color:#<?php echo $s_bg_color; ?>;
                     background-image:url("<?php echo _background_image_dir_ . $s_bg_img; ?>");
                    background-size:<?php 
                       if($s_bg_img === '1.jpg' || $s_bg_img === '2.jpg' || $s_bg_img === '3.jpg' || $s_bg_img === '4.jpg' || $s_bg_img === '5.jpg' || $s_bg_img === '6.jpg' || $s_bg_img === '7.jpg' || $s_bg_img === '8.jpg' || $s_bg_img === '9.jpg' )
                        { echo '100%'; }
                       else
                       {
                        echo 'inherit';
                       }
                     ?>;
                }

</style>



<?php
 /****************************************8
  this is starting of page
 ****************************************/

?>

<div id='body'>
     <div class='center_row light_background'>
        
          <div class='cover_box' >


                      <?php 
                                    /**********************************
                                      this is for the cover picture box
                                    **********************************/
                      ?>

                      <div class='cover_picture shadow' style='background:rgb(<?php echo rand(50,200) . "," . rand(50,200) . "," . rand(50,200); ?>);'>
                                <img src='<?php echo _cover_image_dir_ . $s_cover_pic; ?>'>
                      </div>

                       <script type="text/javascript">
                              //this is to show photo viewer
                              var blank = "";
                          if(blank != '<?php echo $s_cover_pic; ?>')
                            { 

                              $('.cover_picture').click(function(){
                                 
                                 $('.view_image_slide_magnifier').show();
                                 $('#black').show();

                                 $('.body_of_photo_view').html("<img src='<?php echo _cover_image_dir_ . $s_cover_pic; ?>'>")

                             });

                          }
                          
                      </script>

                       <?php 
                                    /**********************************
                                      this is for the profile picture box
                                    **********************************/
                      ?>
                      
                      <div class='profile_picture_box shadow' style='background:rgb(<?php echo rand(50,200) . "," . rand(50,200) . "," . rand(50,200); ?>);' >
                                <img title='<?php echo $s_name; ?>' src='<?php echo _profile_large_image_dir_ . $s_profile_pic; ?>'>
                               
                      </div>
                      <script type="text/javascript">
                              //this is to show photo viewer

                        if(blank != '<?php echo $s_profile_pic; ?>')
                            { 
                             
                             $('.profile_picture_box').click(function(){
                                 
                                 $('.view_image_slide_magnifier').show();
                                 $('#black').show();

                                 $('.body_of_photo_view').html(" <img src='<?php echo _profile_original_image_dir_ . $s_profile_pic; ?>'>")

                             });

                            }
                          
                      </script>

                      <?php 
                                    /**********************************
                                      this is for the information box
                                    **********************************/
                      ?>
                      
                      <div class='information_box'>
                              <div class='information_box_body'>
                                          <div class='name_bar_of_user'>
                                                          <span class='capital name_of_user_of_wall'>
                                                                             <?php echo "$s_name</span> @$s_username"; ?>
                                          </div>
                                          <div class='place_of_user overflow capital'>
                                                          <div class='information_box_body_icon info_box_location' title='Location'></div> 
                                                          <?php echo $s_hometown; ?> , <?php echo $s_country; ?>
                                          </div>
                                          <div class='about_of_user'> 
                                                          <div class='information_box_body_icon info_box_about' title='about'></div> 
                                                          <div class='about_of_user_body'><?php echo $s_about; ?>
                                                          </div>
                                          </div>
                                          <div class='link_of_user overflow'>
                                                          <div class='information_box_body_icon info_box_link' title='Link'></div> 
                                                          <a href="http://<?php echo $s_web; ?>"><?php echo $s_web; ?></a>
                                          </div>

                                          <div class='bottom_other_informaiton_box'>
                                                 <?php 
                                                     
                                                       //this is to check that is switch file allowing or not

                                                          if(allow_smile_status_show) 
                                                             {
                                                               echo "<div class='bottom_other_information_box_option overflow'  title='Status: $s_status'><div class='information_box_body_icon info_box_status'></div>$s_r_status</div>";
                                                             }

                                                          if(allow_views_show)
                                                            {
                                                               echo " <div class='bottom_other_information_box_option overflow'  title='Views: $s_views' ><div class='information_box_body_icon info_box_views'></div>$s_r_views</div> ";
                                                            }

                                                          if(allow_score_show)
                                                            {
                                                               echo "<div class='bottom_other_information_box_option overflow' title='Score: $s_score'><div class='information_box_body_icon info_box_score' ></div>$s_r_score</div>";                                                            
                                                            }

                                                          if(allow_activity_show)
                                                             {
                                                                echo " <div class='bottom_other_information_box_option overflow' title='Activity: $s_last_login'><div class='information_box_body_icon info_box_activity' ></div>$s_r_last_login</div> ";
                                                             }

                                                 ?> 
                                                  
                                           </div>
                               </div>
                      </div>

                      <?php 
                                    /**********************************
                                      this is for the operatin box
                                    **********************************/
                            
                      ?>

                      <div class='opration_box'>

                          
                          <?php 
                               if($username != $s_username)
                                 {

                                    $part = $button -> create_friend_button(0, $id , $s_id , "refresh" , "" , "opration_button");
                                
                                 }
                                 
                                 else
                                 {

                                                    
                  /* here you cand edit
                   -> name done
                   -> location done
                   -> about done
                   -> link done
                   -> status done
                   -> title of question done
                   -> cover photo done
                   -> profile photo done 
                   */

                    //this is to check is smile status and question allowed
                   $smile_status_update_box = "";
                   $question_title_box      = "";

                   if(allow_smile_status_show)
                   {
                     $smile_status_update_box = "<input type='status' id='status' class='input edit_other_input' placeholder='status' name='status' maxlength='15' style='width:47%;margin-left:6%;float:left;' value='$status'>";
                   }

                   if(allow_question)
                   {
                     $question_title_box = "<input type='title' id='question_title' class='input edit_other_input' placeholder='Question title' name='question_title' maxlength='50' style='width:47%;float:left;' value='$question_title'>";
                   }


                                    $php_dir = _simple_php_dir_;
                                    $part = <<< EOFILE
                                      <div class='edit_button button_2 opration_button'>Edit</div>

<div class='file_upload_box pop' ><br>
       <progress id='progressBar' value='0' max='100' style='width:300px;'></progress><Br>
       <b>Status</b>: <span id='image_upload_status'>Loading...</span>
</div>

<div class='edit_profile_box box_of_pop moveable shadow pop'>
          <div class='top_of_pop mover'>
              Edit Profile
            <div class='close_profile_edit close_of_pop'></div>
          </div>
          <div class='body_of_pop' >
                     

                   <div class='box_to_change'>
                         <div class='heading_to_change'>Cover Picture</div>
                    <form id='upload_cover' enctype='multipart/form-data' method='post'>
                          <input type='file'  class='input edit_input' id='cover_upload_img'  name='cover_upload_img' style='padding-top:4px;'>
                           <input type='button'  class='button'  onclick='upload_cover();' value='Upload' >
                           <div class='error' id='cover_error'></div>
                    </form>
                   </div>

                   <script>

       function upload_cover(){

 
         var file = _("cover_upload_img").files[0];
         var formdata = new FormData();
         formdata.append("cover_upload_img",file);
         

         if(file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/jpg' ||  file.type == 'image/gif' || file.type == 'image/jpe')
         {
               if( (file.size/1024) > 2048 )
                     {
                       $("#cover_error").show();
                       $("#cover_error").html("Image size should be less then 2MB.");
                     }

                    

                 else
                  {

                   $("#cover_error").hide();
                   $('.file_upload_box').show();
                   $('.edit_profile_box').hide();

                   var ajax = new XMLHttpRequest();
                   ajax.upload.addEventListener("progress", progressHandler_img_cover,false);
                   ajax.addEventListener("load", completeHandler_img_cover , false);
                   ajax.addEventListener("error",errorHandler_img_cover,false);
                   ajax.addEventListener("abort",abortHandler_img_cover,false);
                   ajax.open("POST","..$php_dir" + "wall/cover_upload.php");
                   ajax.send(formdata);
                   alert(done);
                  }
                  
         }

         else
         {
           $("#cover_error").show();
           $("#cover_error").html("Image must be of type jpg , png or gif.");
         }
        
         
         

       }
       
       


  </script>

  <script>
       
      function _(el){
        return document.getElementById(el);
       }


        function progressHandler_img_cover(event){
                 var percent = (event.loaded / event.total) * 100 ;
                 _("progressBar").value = Math.round(percent);
                 _("image_upload_status").innerHTML = Math.round(percent) +"% uploaded... please wait";

       }
      function completeHandler_img_cover(event){
                 _("image_upload_status").innerHTML = event.target.responseText;
                 _("progressBar").value =  100;

                   $('html').css('cursor','wait');
                   window.location.reload(!0);
                 
       }
       function errorHandler_img_cover(event){
                   $("#cover_error").show();
                   $('.file_upload_box').hide();
                   $('.edit_profile_box').show();
                 _("cover_error").innerHTML = "Upload Failed";

       }

        function abortHandler_img_cover(event){
                   $("#cover_error").show();
                   $('.file_upload_box').hide();
                   $('.edit_profile_box').show();
                 _("cover_error").innerHTML = "Upload Aborted";

       }
  </script>

                   <div class='box_to_change'>
                     <div class='heading_to_change'>Profile Picture</div>
                    <form id='upload_profile' enctype='multipart/form-data' method='post'>
                          <input type='file'  class='input edit_input' id='profile_upload_img'  name='profile_upload_img' style='padding-top:4px;'>
                           <input type='button'  class='button' onclick='upload_profile();'  value='Upload' >
                           <div class='error' id='profile_pic_error'></div>

                    </form>
                   </div>

    <script>
      
      function upload_profile(){
           
         
         var file = _("profile_upload_img").files[0];
         var formdata = new FormData();
         formdata.append("profile_upload_img",file);
         

         if(file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/jpg' ||  file.type == 'image/gif' || file.type == 'image/jpe')
         {
               if( (file.size/1024) > 2048 )
                     {
                       $("#profile_pic_error").show();
                       $("#profile_pic_error").html("Image size should be less then 2MB.");
                     }

                  else
                  {

                   $("#profile_pic_error").hide();
                   $('.file_upload_box').show();
                   $('.edit_profile_box').hide();

                   var ajax = new XMLHttpRequest();
                   ajax.upload.addEventListener("progress", progressHandler_img_profile,false);
                   ajax.addEventListener("load", completeHandler_img_profile , false);
                   ajax.addEventListener("error",errorHandler_img_profile,false);
                   ajax.addEventListener("abort",abortHandler_img_profile,false);
                   ajax.open("POST","..$php_dir" + "wall/profile_pic_upload.php");
                   ajax.send(formdata);
                   
                  }
         }

         else
         {
           $("#profile_pic_error").show();
           $("#profile_pic_error").html("Image must be of type jpg , png or gif.");
         }
        
         
         
       
       }



       

    </script>

    <script>

        function progressHandler_img_profile(event){
                 var percent = (event.loaded / event.total) * 100 ;
                 _("progressBar").value = Math.round(percent);
                 _("image_upload_status").innerHTML = Math.round(percent) +"% uploaded... please wait";

       }
      function completeHandler_img_profile(event){
                 _("image_upload_status").innerHTML = event.target.responseText;
                 _("progressBar").value =  100;

                   $('html').css('cursor','wait');
                   window.location.reload(!0);
                 
       }
       function errorHandler_img_profile(event){
                   $("#profile_pic_error").show();
                   $('.file_upload_box').hide();
                   $('.edit_profile_box').show();
                 _("profile_pic_error").innerHTML = "Upload Failed";

       }

        function abortHandler_img_profile(event){
                   $("#profile_pic_error").show();
                   $('.file_upload_box').hide();
                   $('.edit_profile_box').show();
                 _("profile_pic_error").innerHTML = "Upload Aborted";

       }
    </script>

                   <div class='box_to_change' style='width:80%;margin-left:8%;border:0px;'>
                        <form id='upload_profile' enctype='multipart/form-data' method='post'>
                            <input type='name' placeholder='First name' name='f_name' maxlength='30' class='input edit_other_input' id='f_name' style='width:47%;float:left;margin-top:0px;' value='$first_name'>
                            <input type='name' placeholder='Second name' name='l_name' maxlength='30' class='input edit_other_input' id='l_name' style='width:47%;margin-left:6%;float:left;margin-top:0px;' value='$last_name'>      
                            
                            <input type="hometown" id="hometown" class="input edit_other_input" placeholder="Home town name" name="hometown" maxlength='40' style='width:47%;float:left;' value='$hometown'>
                            <input type="web" id="web" class="input edit_other_input" placeholder="web" name="link" maxlength='40' style='width:47%;margin-left:6%;float:left;' value='$web'>
                         
                            <textarea class='input edit_other_input' id='about'  placeholder='Write About your self here in less then 300 words!' style='resize:none;height:75px;padding:5px;' maxlength='300' name='about'>$about</textarea>
                            $question_title_box 
                            $smile_status_update_box
                           
                           
               
                         
                           <input type='button'  class='button' onclick='upload_information();'  value='Save' >
                           <div class='error' id='profile_information_error'>Saving...</div>

                        </form>
        
        <script> 

             function create_new_ajax(meth,url)
                {
                      var x = new XMLHttpRequest();
                      x.open(meth,url,true);
                      x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                      return x;
                 }

           function upload_information()
           {  
              $("#profile_information_error").show();
              var y = create_new_ajax("POST","..$php_dir" + "wall/profile_information_upload.php");
              y.onreadystatechange = function ()
               {
                 
                  if(y.readyState == 4 && y.status == 200)
                   {
                   $("#profile_information_error").html(y.responseText);
                   $('html').css('cursor','wait');
                   window.location.reload(!0);
                   }
                }
           

              var f_name         = $("#f_name").val();
              var l_name         = $("#l_name").val();
              var hometown       = $("#hometown").val();
              var web            = $("#web").val();
              var about          = $("#about").val();
              var question_title = $("#question_title").val();
              var status         = $("#status").val();

              if(f_name == "" || l_name == "")
              {
                $("#profile_information_error").html("First name and Last name cannot be empty");
              }

              else if(f_name == l_name)
              {
                  $("#profile_information_error").show();
                  $("#profile_information_error").html("First name should not match Last name.");
                  
              }

              else
              {
              y.send("f_name=" + f_name + "&l_name=" + l_name + "&hometown=" + hometown + "&web=" + web + "&about=" + about + "&question_title=" + question_title + "&status=" + status);
              }

        
            }


        
       
        </script>

                   </div>

                   <br>
                  

                  
          </div>
</div>
EOFILE;

                                 }

                                  echo $part;

                          ?>
                              
                               


                              



                      </div>
                        
         </div>

         <?php 
               /****************************
                 this is for the question box
               ****************************/
              
                /******************************************
                we will check the permission of user 
                a -> everyone
                b -> followers
                *******************************************/

                /***************************************
                we will check following things 
                1-> do wall user asking of question to all or not 
                2-> do wall user follow visiter or not 
                3-> then block the user from asking question 
                ****************************************/

          //this is to check that is switch file allowing question or not

          if(allow_question )
            {
                  
                  if($username != $s_username)
              {
                 if($s_who_can_ask == 'a')
                 {
                   include "sub/question_box.php";
                 }
                  else
                  {
                     $code_find_wall_follow_visiter = mysqli_num_rows(mysqli_query($connect , "select * from `$db_name`.`users_friends` where follower_id = $s_id and following_id = $id"));
                     
                     if($code_find_wall_follow_visiter == 0)// wall user dont follow visiter
                     {
                        echo "<div class='unable_to_question' >$s_name dont follow you! so you can't ask questions.</div>";
                     }
                     else// wall user is following visiter 
                     {
                       include "sub/question_box.php";              
                     }

                  }
              }
              else
              {
                include "sub/question_box.php";
              }


            }// end of allow question

              




         ?>

                  <?php 
               /****************************
                 this is for the menu box
               ****************************/
                 ?>

                 <?php
                         
                         

                        // this is to get followers

                                    $no_of_followers = $get_mysqli_info -> get_info($s_id,0,"followers");

                        // this is to get following
                         
                                    $no_of_following = $get_mysqli_info -> get_info($s_id,0,"following");
                                   

 
                   
                 ?>

                 <div class='menu_of_wall'>

                          <a href='http://<?php echo $host . "/" . $s_username; ?>/activity'><div class='option_of_menu_of_wall capital' id='activity_button'>Activity </div></a>
                          <a href='http://<?php echo $host . "/" . $s_username; ?>/followers'><div class='option_of_menu_of_wall capital' id='followers_button'>Followers (<?php echo $no_of_followers; ?>)</div></a>
                          <a href='http://<?php echo $host . "/" . $s_username; ?>/following'><div class='option_of_menu_of_wall capital' id='following_button'>Following (<?php echo $no_of_following; ?>)</div></a>

                          
                          <script type="text/javascript">
                                
                               
                               /********************************
                                 this is to mark the page on which we are 
                               ***********************************/

                                switch('<?php echo $sub; ?>')
                                {
                                   case 'followers':
                                         mark('followers_button');
                                   break;
                                   case 'following':
                                         mark('following_button');
                                   break;
                                   default:
                                          mark('activity_button');
                                   break;
                                }

                                function mark(but)
                                {
                                   var but = $('#' + but);
                                   but.removeClass('option_of_menu_of_wall');
                                   but.addClass("option_of_menu_of_wall_selected");
                                }

                                /********************************
                              this is to load the page which we wish to see 
                                *********************************/

                          </script>

                       
                 </div>

                  <?php 
               /****************************
                 this is for the wall box for include
               ****************************/
                 ?>

                 <div class='wall_content_body'>
                         
                       <?php 
                      
                            switch ($sub) {
                              case 'followers':
                                    
                                  echo "<span class='followers_activity'> ";  

                                     include "../includes/users_friend_box.lib.php";
                                     $friend_box = new users_friend_box();

                                     echo "<link rel='stylesheet' href='" . _css_dir_ . "comman/user_friend_box-ui.css'>";

                                     /*************************************************************
                                       this page is to show followers of the user
                                       ************************************************************/

                                       if($no_of_followers == 0)
                                       {
                                             echo "
                                                           <div class='no_updates'>
                                                                   No Followers!
                                                          </div>";

                                       }
                                       else
                                       {
                                          
                                          //this is used in keeping uniquness in box
                                          
                                           $uique_no = 0;
                                         //max_followers_result it is set in config.inc.php
                                         $pagination_sql = "LIMIT 0 , " . max_followers_result;
                                        
     
                                          include "sub/load_followers.php";


                                       }



                                  echo "</span>";
                                  ?>

<script type="text/javascript">

 $(document).on('click','.followers_feed_more_button',function(){
           
           $(".followers_load_more").html("<img src='<?php echo _loading_image_; ?>'>");

           var ele = $(".followers_load_more");

           $.ajax({
               
               url: '../../../../../../signin/load_more_followers.php',

               type: 'POST',

               data: { 
                 load_no:$(this).data('load_no'),
                 s_id: '<?php echo $s_id ?>',
                 s_name: '<?php echo $s_name ?>',
                 id: '<?php echo $id ?>',
                 name: '<?php echo $name ?>',
                 no_of_followers: '<?php echo $no_of_followers ?>',
               }
               ,
               success: function(response)
               {
                  if(response)
                  {
                    ele.remove();
                    $('.followers_activity').append(response);
                  }
               }

           });

 });

</script>

                                    
                                  <?php
                                break;
                              case 'following':
                                          


                                  echo "<span class='following_activity' > ";

                                     echo "<link rel='stylesheet' href='" . _css_dir_ . "comman/user_friend_box-ui.css'>";

                                     include "../includes/users_friend_box.lib.php";   
                                     $friend_box = new users_friend_box();  

                                               /*************************************************************
                                               this page is to show following of the user
                                               ************************************************************/



                                               if($no_of_following == 0)
                                               {
                                                      $empty_result = <<< EOFILE
                                                                   <div class='no_updates'>
                                                                            No Following!
                                                                   </div>
EOFILE;
                                               echo $empty_result;
                                               }
                                               else
                                               {

                                                //this is used in keeping uniqness in the box
                                                  $uique_no = 0;
                                                 //max_following_result it is set in config.inc.php
                                                 $pagination_sql = "LIMIT 0 , " . max_following_result;

                                                 include "sub/load_following.php";


                                               }


                                    echo "</span>";
                                    ?>
                                     
                                               <script type="text/javascript">
                                                    
                                                     $(document).on('click','.following_feed_more_button',function(){
                                                             
                                                             $(".following_load_more").html("<img src='<?php echo _loading_image_; ?>'>");

                                                             var ele = $(".following_load_more");
                                                                  
                                                             $.ajax({
                                                                    
                                                                    url: '../../../../../../signin/load_more_following.php' ,
                                                                    type: "POST" ,
                                                                    data:{
                                                                       load_no:$(this).data('load_no'),
                                                                       s_id: '<?php echo $s_id ?>',
                                                                       s_name: '<?php echo $s_name ?>',
                                                                       id: '<?php echo $id ?>',
                                                                       name: '<?php echo $name ?>',
                                                                       no_of_following: '<?php echo $no_of_following ?>',

                                                                    },

                                                                    success: function(response)
                                                                    {
                                                                       if(response)
                                                                       {
                                                                         ele.remove();
                                                                         $('.following_activity').append(response);
                                                                       }
                                                                    }

                                                             });//end of ajax

                                                     });//end of function

                                               </script>

                                    <?php

                                break;
                               
                              default:
                                    echo "<span class='wall_activity' >";
                                    
                                    ?>  

<link rel="stylesheet" type="text/css" href="<?php echo _css_dir_; ?>comman/feed-box-ui.css">
<style>
 
 /* 
these are the changes to feed box
*/

.feed_box_body{margin-left:175px;
               width:550px;
}

.profile_picture_of_feeder{
                          margin-left:105px;
}


</style>

<?php


/***********************************
this is to get feed box library
***********************************/

include "$path/includes/feed_box.lib.php";
$feed_box = new feed_box();


//this is to decide the feed limit
//wall_feed_limit IS SET in config.inc.php
$feed_limit = wall_feed_limit;

//this is page_limit used in load more so let it be 0
$page_limit = 0;

//make limit 
$pagination_sql = " LIMIT 0 , $feed_limit";


include "sub/load_wall_feed.php";






                                  echo "</span>";
                                      ?>
<script type="text/javascript">

 $(document).on( 'click' , '.wall_feed_more_button' , function(){
   
   //this is to make button value to loading
    $(".wall_load_more_div").html("<img src='<?php echo _loading_image_; ?>'>");

   //this is to get div of button
    var ele = $(".wall_load_more_div");
   
    
    //this is to send the ajax request
    $.ajax({
          
          //this is to avode error (../../)
          url: '../../../../../../signin/load_more_wall_activity.php' ,

          type: 'post' ,

          data: { 
                 load_no:$(this).data('load_no'),
                 page: '<?php echo $page ?>',
                 s_id: '<?php echo $s_id ?>',
                 s_name: '<?php echo $s_name ?>',
                 s_username: '<?php echo $s_username ?>',
                 s_profile_pic: '<?php echo $s_profile_pic ?>',
                 id: '<?php echo $id ?>',
                 name: '<?php echo $name ?>',
                 username: '<?php echo $username?>',
                 profile_pic: '<?php echo $profile_pic ?>',
           }
           ,
         
          success: function(response)
          {
              if(response)
              {
                ele.remove();
                $('.wall_activity').append(response);

              }
          }


    });//end of ajax request



 });//end of load more

</script> 
                                      <?php
                                break;
                            }
                         
                       ?>

                 </div>





               <?php 
              // this is for the bottom line 
              include "$path/includes/bottom_menu.inc.php";
                 ?>

      
            
    </div>
  </div>


</body>
<script type="text/javascript">
$(document).ready(function(){

$(".edit_button").click(function(){
    
     $(".edit_profile_box").show();
     $("#black").show();

});

$(".close_profile_edit").click(function(){
     
     $(".edit_profile_box").hide();
     $("#black").hide();

});


});


</script>

<script type="text/javascript"></script>



</html>