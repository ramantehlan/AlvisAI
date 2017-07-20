<?php

/******************************************************
this program is to create friend box of followers and 
following

creator:-          Raman Tehlan
Date of creation:- 02/07/2015
*******************************************************/


class users_friend_box
{
    
    /************************************************************
      $no is for button no so that each button have different no
      $box_no is for telling that which row do that box belong to
    *************************************************************/
  
   public function create_box($no , $box_no , $id , $s_id , $name , $username , $profile_pic , $fiendship_since)
   { 
   	      global $host , $db_name , $button;
        
          $random_bg_color =  rand(50,200) . "," . rand(50,200) . "," . rand(50,200);

          $friend_button = $button -> create_friend_button($no , $id , $s_id , "refresh" , "friend_box_del_$no" , "friend_box_button");
        
        if($profile_pic == '' || file_exists("user files/profile pictures/large/" . $profile_pic) != 1 )
        {
            $profile_pic = "default.jpg";
        }

         $box = <<< EOFILE
                    
                    <div class='friend_box box_$box_no friend_box_del_$no' >  
                                 
                                 <div class='friend_box_colour_bg_cover' style='background:rgb($random_bg_color);'>
                                       
                                        
                                          <div class='friend_box_profile_pic_box shadow'>
                                                   <a href='http://$host/$username' title='$name'>
                                                      <img src='http://$host/signin/user files/profile pictures/medium/$profile_pic'>
                                                   </a>
                                          </div>
                                       
                                        
                                 </div>

                                 <div class='friend_box_information_box'>
                                        
                                        <div class='friend_box_name_field overflow'>
                                              <a href='http://$host/$username' title='$name@$username'> 
                                                   <span style='text-transform: capitalize;'>$name</span><b>@$username</b></a>
                                        </div> 
                                                 
                                        <div class='friend_box_following_since'>
                                                $fiendship_since.    
                                        </div>

                                      
                                      $friend_button
                        
              </div>
        </div>                
                    
EOFILE;



 return $box;

   }

}


?>