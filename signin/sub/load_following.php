 <?php   
    /******************************************************
      this is to print following of user
    *******************************************************/

     
    $code_to_get_following  = mysqli_query($connect , "SELECT * from `$db_name`.`users_friends` where `follower_id` = $s_id $pagination_sql");
    
    /**************************************************************
     this is to tell that which row box is to be place 
     this is added to the class of the friend
    **************************************************************/
    $box_no = 1;

    /*************************************************************
      incriment no
    ****************************************************************/
    $while_no = 0;


    while ($get_info = mysqli_fetch_array($code_to_get_following))
    {  
         
         $f_id          = $get_info['following_id'];
         $f_date        = $get_info['date'];


         //this is to tell friendship since 
          $friendship    = "Following since " . $text_filter -> round_date_2($f_date);
         
         $get_following_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * from `$db_name`.`users` where id = $f_id "));

         $f_name        = $get_following_info['name'];
         $f_username    = $get_following_info['username'];
         $f_profile_pic = $get_following_info['profile_pic'];

    	echo $friend_box -> create_box($while_no . $uique_no  , $box_no , $id , $f_id , $f_name , $f_username , $f_profile_pic , $friendship);

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
    
    //max_following_result it is set in config.inc.php
    if($no_of_following > max_following_result)
    {
           if(isset($load_no))
        {    
             if( (( ($load_no - 1) * max_following_result) + $while_no) >= $no_of_following)  
             {
              echo "         
               <div class='load_more_div no_updates'>
                    
                    No More Following!

               </div>
               ";
             }
             else
             {
               echo "         
               <div class='load_more_div following_load_more'>
                    
                    <input type='button' class='button_2 feed_more_button following_feed_more_button' data-load_no='" . ($load_no + 1) . "' value='Load More'>

               </div>
               ";
             }


        }
        else 
        {
              echo "         
               <div class='load_more_div following_load_more'>
                    
                    <input type='button' class='button_2 feed_more_button following_feed_more_button' data-load_no='2' value='Load More'>

               </div>
               ";
        }
    }





    ?>