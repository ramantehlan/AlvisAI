<?php

 /******************************************************
      this is to print followers of user
    *******************************************************/

     
    $code_to_get_followers  = mysqli_query($connect , "SELECT * from `$db_name`.`users_friends` where `following_id` = $s_id $pagination_sql");
    
    /**************************************************************
     this is to tell that which row box is to be place 
     this is added to the class of the friend
    **************************************************************/
    $box_no = 1;

    /*************************************************************
      incriment no
    ****************************************************************/
    $while_no = 0;


    while ($get_info = mysqli_fetch_array($code_to_get_followers))
    { 
          
         $f_id          = $get_info['follower_id'];
         $f_date        = $get_info['date'];

         //this is to tell friendship since 
         $friendship    = "Follower since " . $text_filter -> round_date_2($f_date);
         
         $get_followers_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * from `$db_name`.`users` where id = $f_id"));

         $f_name        = $get_followers_info['name'];
         $f_username    = $get_followers_info['username'];
         $f_profile_pic = $get_followers_info['profile_pic'];

    	echo $friend_box -> create_box($while_no . $uique_no , $box_no , $id , $f_id , $f_name , $f_username , $f_profile_pic , $friendship);

    	if($box_no == 1)
    	{
    		$box_no = 2;
    	}
    	else if($box_no == 2)
    	{
    		$box_no = 3;
    	}
    	else if($box_no == 3)
    	{
    		$box_no = 1;
    	}

       $while_no++;

    }
   
   //max_followers_result it is set in config.inc.php
    if($no_of_followers > max_followers_result)
    {  
        if(isset($load_no))
        {    
             if( (( ($load_no - 1) * max_followers_result) + $while_no) >= $no_of_followers)  
             {
              echo "         
               <div class='load_more_div no_updates'>
                    
                    No More Followers!

               </div>
               ";
             }
             else
             {
               echo "         
               <div class='load_more_div followers_load_more'>
                    
                    <input type='button' class='button_2 feed_more_button followers_feed_more_button' data-load_no='" . ($load_no + 1) . "' value='Load More'>

               </div>
               ";
             }


        }
        else 
        {
              echo "         
               <div class='load_more_div followers_load_more'>
                    
                    <input type='button' class='button_2 feed_more_button followers_feed_more_button' data-load_no='2' value='Load More'>

               </div>
               ";
        }
        
    }
	


?>