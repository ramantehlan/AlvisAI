<?php 
/******************************************************
this below code is run when we reload the page
********************************************************/


if(isset($_SESSION['user_id']) == 0)
{
  exit();
} 




if(isset($_POST['reload']))
{
    
    $id       = $_SESSION['user_id'];
    $country  = $_POST['country'];
    $language = $_POST['language'];
    $hometown = $_POST['hometown'];
    $hobby    = $_POST['hobby'];
   
    // this is the file pathe which change when reload
    $medium_file_path     = "../";
   
    // this is to connect to the database 
    include_once "../../includes/config.inc.php";




}
else
{
  $medium_file_path = "";
}


?>


  <link rel='stylesheet' href='<?php echo _css_dir_; ?>comman/friends_suggestion_box-ui.css'>

<?php
/*********************************************************************************************
this program is to show friends suggestion for a user 

{algorithm used for suggestion}

1-> We will collect all the id of people followed by user
2-> We will make a group of all the people followed by following of user
3-> we will choose people which share same :-
      a) country 
      b) language 
      c) hometown 
      d) hobby
4-> then randomly we will show 3 people out of the above group 


{algorithm used for new user or have less then 5 following}
1-> we will choose people which share same :-
      a) country 
      b) language 
      c) hometown 
      d) hobby
2-> we will choose randomly from this group.



PS: we will make sure user is not all ready following that person



**********************************************************************************************/

// this is to tell the MAXIMUM result possible _max...tion_ its is defined in config.inc.php
$max_result = max_friend_suggestion;

//set of following _id in mysqli format
$following_id_set                = " ( id = 0 ";

//set of following id to exclude them from suggestion in mysqli format
$following_id_set_exclude        = " ( id != $id ";

//set of following of following id in mysqli_format
$following_of_following_id_set             = " id = 0 ";

//set of following of following id  to exclude in mysqli_format (used when following of following is not showing max result)
$following_of_following_id_set_exclude     = " id != 0 ";

// this the basic code to get followers of user
$code_to_get_following = "SELECT * FROM `$db_name`.`users_friends` WHERE 
                                    `follower_id` = '$id'";

// this is the number of follower of user
$no_of_followers        = mysqli_num_rows(mysqli_query($connect , $code_to_get_following));
    


//getting data
$code_to_get_following_id = mysqli_query($connect , $code_to_get_following);

while($get_following_id = mysqli_fetch_array($code_to_get_following_id))
     {
          $following_id_set         .= " or  `id`  = " . $get_following_id['following_id'];
          $following_id_set_exclude .= " and `id`  != " . $get_following_id['following_id']; 
     
              /***********************************************************
                   this is to get the id of following of following
              **********************************************************/
           
                   $code_to_get_following_of_following = mysqli_query($connect , "SELECT following_id from `$db_name`.`users_friends` where follower_id = " . $get_following_id['following_id'] );
                
                       while($get_following_of_following_id = mysqli_fetch_array($code_to_get_following_of_following))
                       {
                            
                           if($get_following_of_following_id['following_id'] != $id)
                           {
                            $following_of_following_id_set .= " or id = "  . $get_following_of_following_id['following_id'];
                            $following_of_following_id_set_exclude .= " and `id`  != " . $get_following_of_following_id['following_id'];
                           } 

                       }
 
     }

     $following_id_set_exclude .= " )";
     $following_id_set         .= " )";
     



/************************************
 starting of suggestion program
*************************************/


/****************************
this is when user is allready following people more then 10 people
*****************************/

     if($no_of_followers >= 10)
     {          
               //fof is following of following
               $code_to_get_suggestion_from_fof = "SELECT * from `$db_name`.`users` WHERE 
                                            (  $following_of_following_id_set ) 
                                            and `account_active` = '1'
                                            and   $following_id_set_exclude
                                            ORDER BY  `users`.`login_no` DESC 
                                            limit 0 , $max_result
                                          ";



              //when fof is less then max result requited 
               $code_to_get_suggestion_from_complete_db = "SELECT * from `$db_name`.`users` where
                                                     (  `country` = '$country' OR 
                                                        `language` LIKE '%$language%' OR
                                                        `hometown` LIKE '%$hometown%' OR
                                                        `hobby` LIKE '%$hobby%'  ) 
                                                         and ( $following_of_following_id_set_exclude )
                                                         and `account_active` = '1'
                                                         and   $following_id_set_exclude
                                                         ORDER BY  `users`.`login_no` DESC 
                                                 
                                                 ";

          $no_of_suggestion_from_fof            = mysqli_num_rows(mysqli_query($connect , $code_to_get_suggestion_from_fof));
          $no_of_suggestion_from_fof_exclustion = mysqli_num_rows(mysqli_query($connect , $code_to_get_suggestion_from_complete_db));


                                     display_suggestion($code_to_get_suggestion_from_fof);

                                     if($no_of_suggestion_from_fof <= $max_result)
                                     {      
                                           $limit = $max_result - $no_of_suggestion_from_fof;

                                            display_suggestion($code_to_get_suggestion_from_complete_db . " limit 0 , $limit" , 212);
                                     }

                                     if( $no_of_suggestion_from_fof == 0 and $no_of_suggestion_from_fof_exclustion == 0)
                                     {
                                       echo "
                                                       <div class='friend_suggestion_box_user'>
                                                              <h4 style='text-align:center'>
                                                                  Great! you follow all the users.
                                                              </h4>
                                                        </div>
                                                      ";
                                     }


                
     }
     else
     {

/***************************************
These below is to check
1-> no of result should be greater the 3
2-> if it is less the decrease the parameter 
***************************************/
    
     $code_to_get_suggestion = "SELECT * FROM `$db_name`.`users` WHERE 
                                   (  `country` = '$country' OR 
                                     `language` LIKE '%$language%' OR
                                     `hometown` LIKE '%$hometown%' OR
                                     `hobby` LIKE '%$hobby%'  ) 
                                     and `account_active` = '1'
                                     and   $following_id_set_exclude
                                     ORDER BY  `users`.`login_no` DESC 
                                     limit 0 , $max_result
                                 ";

                     $no_result_suggestion = mysqli_num_rows(mysqli_query($connect , $code_to_get_suggestion));

                                      
                                               display_suggestion($code_to_get_suggestion);
                                  
                                          if ($no_result_suggestion == 0)
                                               {
                                                  echo "
                                                       <div class='friend_suggestion_box_user'>
                                                              <h4 style='text-align:center'>
                                                                  Great! you follow all the users.
                                                              </h4>
                                                        </div>
                                                      ";
                                                }
                                       

                                                                                             


     }// end of main else
   
     
            function display_suggestion($command_line , $inc_no = 2120)
            {
                  global $host , $max_result , $medium_file_path , $button , $id , $connect;

               
                  $enter_mysqli   = mysqli_query($connect , $command_line);

                  //this no_f will increase every time after while
                  $no_f = 1 . $inc_no;
                  while($get_friend_info = mysqli_fetch_array($enter_mysqli))
                  { 
                       
                       $fs_username     = $get_friend_info['username'];
                       $fs_name         = $get_friend_info['name'];
                       $fs_profile_pic  = $get_friend_info['profile_pic'];
                       $fs_id           = $get_friend_info['id'];

                                /*****************************************************
                                   this is just to check that do profile pic is ther or not
                              *****************************************************/

                               if($fs_profile_pic == '' || file_exists( $medium_file_path . _simple2_profile_medium_image_dir_ . $fs_profile_pic) != 1 )
                                  {
                                      $fs_profile_pic = "default.jpg";
                                  }

                                  /***********************************************
                                     this is to create the button
                                  **************************************************/

                          $friend_button = $button -> create_friend_button($no_f , $id , $fs_id , "" , "" , "suggestin_follow_button");


                   $suggestion_box = "
                       
                       <div class='friend_suggestion_box_user'>
                              <div class='friend_suggestion_box_user_picture'>
                                 <a href='http://$host/$fs_username'>
                                   <img src='" . _profile_medium_image_dir_ . "$fs_profile_pic'>
                                 </a>
                              </div>
                              <div class='friend_suggestion_box_user_name'><a href='http://$host/$fs_username'><span class='suggestion_name_text capital'>$fs_name</span>@$fs_username</a></div>
                
                              $friend_button

                                
                       </div>";

echo $suggestion_box;


                  $no_f++;
                  }






            }


      




?>
             
                  <script type="text/javascript">
                          function reload_suggestion()
                          {
                             $.post("http://<?php echo $host; ?>/signin/sub/friend_suggestion_box.php",{reload:"yes",country:"<?php echo $country; ?>",language:"<?php echo $language; ?>",hometown:"<?php echo $hometown; ?>",hobby:"<?php echo $hobby; ?>"},function(reload_suggestion_box){
                                  $(".friends_suggestion_box_body").html(reload_suggestion_box);
                             });
                          }
                        
                        

                  </script>  
       


