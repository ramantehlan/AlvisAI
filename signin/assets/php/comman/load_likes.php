<?php


   //if there are no likes
   if($no_of_likes == 0)
   {
      echo "<div class='all_likes_msg'>No Likes!</div>";
  
   }
   //if no of likes are not zero
   else
   {
   //this is to count no of times while loop run
   //then it is use to make id unique
   $while_no = 0;




   $code_to_get_all_likes = mysqli_query($connect , "SELECT * from `$db_name`.`users_likes` where target = '$target' and target_no = '$target_no' ORDER BY `users_likes`.`no` DESC $pagination_sql");
    
     while($get_info = mysqli_fetch_array($code_to_get_all_likes))
     {     
          #getting liker id
          $liker_id = $get_info['liker_id'];
          
          //this is to get information of liker
          $get_liker_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * from `$db_name`.`users` where id = $liker_id"));

          $liker_username    = $get_liker_info['username'];
          $liker_name        = $get_liker_info['name'];
          $liker_profile_pic = $get_liker_info['profile_pic'];

              
             //this is to make profile picture default if it do not exist
             if($liker_profile_pic == '' || file_exists("../../.." . _simple_profile_small_image_dir_ . $liker_profile_pic) != 1 )
                         {
                             $liker_profile_pic = "default.jpg";
                         }


          //displaying liker info
          echo "<a href='http://$host/$liker_username'>
               <div class='all_liker_one_body' title='$liker_name'> 
                    <div class='all_liker_profile_pic_holder'>
                        <img  src='" . _profile_small_image_dir_ . "$liker_profile_pic'>
                     </div>
                     <div class='all_liker_info_holder overflow'>
                                $liker_name
                     </div>
                </div>
               </a>
          ";

      
      #to increse while no
      $while_no++;


     }// end of while




     // if no of likes is greater then 
     //max_like_result is defined in config.inc.php
     if( ($no_of_likes > max_like_result)  && ($starting_limit + 1) < $no_of_likes)
     {
     	 
          //action to do only if load no is there
           if(isset($load_no))
              {
                      //if no_of_likes are displayed then display msg
                      if( (( ($load_no - 1) * max_like_result) + $while_no) >= $no_of_likes)  
                        {
                          echo "<div class='load_more_div all_liker_load'>
                                     No More Likes!
                                </div>";
                        }
                         //if more result are left
                        else
                        {
                         echo "<div class='load_more_div all_liker_load like_load_more' >
                    
                                           <input type='button' class='button_2 feed_more_button like_feed_more_button_$unique_no'  data-load_no='" . ($load_no + 1) . "' value='Load More' >

                                 </div>";
                        }
        
        
              }
             else//this is first load more button
             {
                     echo "<div class='load_more_div all_liker_load like_load_more' >
                    
                                <input type='button' class='button_2 feed_more_button like_feed_more_button_$unique_no'  data-load_no='2' value='Load More' >
      
                      </div>";
             
             }//end of else





     }//end of main if




}//end of else


?>



