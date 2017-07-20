<?php  
       /*********************************************************
       this is out put format
   **********************************************************/
 
 function output_result($name,$username,$profile_pic)
 { global $host;

  echo "                 
                         
                                
                                <a href='http://$host/$username' >
                                         <div class='searched_user_bar_display_box'>
                                               <div class='profile_pic_of_search_user'>
                                                       <img src='" . _profile_small_image_dir_ . "$profile_pic'>
                                               </div>
                                               <div class='detail_of_search_user'>
                                                           <div class='name_of_the_search_user overflow'>
                                                                 $name<span class='attag_of_search_user'>@$username</span>
                                                           </div>
                                               </div>
                                          </div>
                                </a>

                                 
                               
                               
                         ";


 }






   

   /******************************************************
       this is to get the id of following AND following of following id
   *******************************************************/

    //set of following id in mysqli format
    $following_id_set                          = " ( id = 0 ";
    //set of following id to exclude them from all search in mysqli format
    $following_id_set_exclude                  = " ( id != $id ";
    //set of following of following id in mysqli_format
    $following_of_following_id_set             = "";
    //set of following of following id to exclude them from all search in mysqli format
    $following_of_following_id_set_exclude     = "";
       
    $code_to_get_following_id = mysqli_query($connect , "SELECT following_id from `$db_name`.`users_friends` where follower_id = $id");
  
    
               while($array_of_following_id = mysqli_fetch_array($code_to_get_following_id))
               {
                     $following_id_set         .= " or id = "  . $array_of_following_id['following_id'];     
                     $following_id_set_exclude .= " and id != " . $array_of_following_id['following_id'];     

                       /**********************************************************
                            this is to get the id of following of following
                       ***********************************************************/

                        $code_to_get_following_of_following_id = mysqli_query($connect , "SELECT following_id from `$db_name`.`users_friends` where follower_id = " . $array_of_following_id['following_id'] );

                                       while($array_of_following_of_following_id = mysqli_fetch_array($code_to_get_following_of_following_id))
                                        { 
                                              
                                              if($array_of_following_of_following_id['following_id'] != $id)
                                              {
                                                 $following_of_following_id_set         .= " or id = "  . $array_of_following_of_following_id['following_id'];  
                                                 $following_of_following_id_set_exclude .= " and id != " . $array_of_following_of_following_id['following_id'];  
                                              }

                                        }


               }


    $search_id_set = $following_id_set . $following_of_following_id_set . " )";
    $search_id_set_excluded = $following_id_set_exclude . $following_of_following_id_set_exclude . " )";

    

    


                     //this is the main output code to search out of following 
                    $code_to_search_in_freinds            = "SELECT * from `$db_name`.`users` 
                                                             where $search_id_set 
                                                             and (
                                                                  name like '%$search_input%' 
                                                                  or username like '%$search_input%' 
                                                                  or email = '$search_input'
                                                                  )
                                                             ORDER BY login_no DESC";

                    $code_to_search_in_friends_with_limit = mysqli_query($connect , "SELECT * from `$db_name`.`users` 
                                                                                     where $search_id_set 
                                                                                     and (
                                                                                          name like '%$search_input%' 
                                                                                          or username like '%$search_input%' 
                                                                                          or email = '$search_input'
                                                                                          ) 
                                                                                    ORDER BY login_no 
                                                                                    DESC  $pagination_sql " . max_search_result );
                    

                    //this code is to get all the posible output of search
                    $code_to_search_in_all_users          = "SELECT * from `$db_name`.`users` 
                                                             where id != $id 
                                                             and (
                                                                  name like '%$search_input%' 
                                                                  or username like '%$search_input%' 
                                                                  or email = '$search_input'
                                                                ) ";
    


                    $total_result_of_friends              = mysqli_num_rows(mysqli_query($connect , $code_to_search_in_freinds));
                    $total_result_of_friends_with_limit   = mysqli_num_rows($code_to_search_in_friends_with_limit);
                    $total_no_of_results                  = mysqli_num_rows(mysqli_query($connect , $code_to_search_in_all_users));
    

  


    



     
             if( $search_input === "total_users")
                  {            
                            $total_no_of_user = mysqli_num_rows(mysqli_query($connect , "SELECT * from `$db_name`.`users` " ));
                            $total_no_of_user = $total_no_of_user - 1;

                            echo "<div class='center_div_of_search overflow' >
                                         Total users of site are: <b>$total_no_of_user</b>
                                  </div>";
                  }  


    //no result found
  if($total_no_of_results  == 0)
    {
      echo "<div class='center_div_of_search overflow' >
               No Results Found for: <b>$search_input</b>
      </div>";
    }
 
    else
    {



                
                  //this is to count the no of time while happne
                      $while_no = 0;
               
                   //this is to print search result {first from friends}       
                 
                   while($array_of_freinds = mysqli_fetch_array($code_to_search_in_friends_with_limit))
                   {
                          $name_of_search        = $array_of_freinds['name'];
                          $username_of_search    = $array_of_freinds['username'];
                          $profile_pic_of_search = $array_of_freinds['profile_pic'];

              
                          if(!file_exists("../../.." . _simple_profile_small_image_dir_ . $profile_pic_of_search) || $profile_pic_of_search == "")      // if file exist is false then make it default
                                  {$profile_pic_of_search = "default.jpg";}

          
                          output_result($name_of_search , $username_of_search , "$profile_pic_of_search");
          
                          $while_no++;
                   }



    
       
            //result found in friends is less then the search limit so search main db
            //max_search_result is defined in config.inc.php
            if($total_result_of_friends_with_limit < max_search_result)
               {         

               

                  //this is perfect and working fine
                  //this is to tell the second limit of search 
                  //so that it dont cross the max_search_Result
                  $new_limit = max_search_result - $total_result_of_friends_with_limit;  
                 


                 //this is to tell the starting limit for search in complete db
                 
                         if(isset($load_no))
                           {
                            $starting_limit = ( max_search_result * ( $load_no - 1) ) - $total_result_of_friends;
                                      
                                 //this is to make limit zero if it get negative 
                                  if($starting_limit < 0)
                                  { 
                                     $starting_limit = 0; 
                                  }

                           }
                           else
                           {
                            $starting_limit = 0;
                           }
                  

                                      //this code is to get all the users except the friends {limit at end is left blank}
                    $code_to_search_in_all_users_limit    = "SELECT * from `$db_name`.`users` 
                                                             where $search_id_set_excluded
                                                              and (
                                                                   name like '%$search_input%' 
                                                                   or username like '%$search_input%' 
                                                                   or email = '$search_input'
                                                                   ) 
                                                              ORDER BY login_no 
                                                              DESC LIMIT $starting_limit ,  ";

                
                       
                       //this is to print cause total friends and freinds of friends are less then the limit
                         
                            //this is to add limit
                            $code_to_search_db = $code_to_search_in_all_users_limit . $new_limit;
                            //echo $code_to_search_db;

                    
                            $code_to_search_db = mysqli_query($connect , $code_to_search_db);


                         
                          while($array_of_all_users = mysqli_fetch_array($code_to_search_db))
                          {
                                 $name_of_search        = $array_of_all_users['name'];
                                 $username_of_search    = $array_of_all_users['username'];
                                 $profile_pic_of_search = $array_of_all_users['profile_pic'];

              
                                 if(!file_exists("../../.." . _simple_profile_small_image_dir_ . $profile_pic_of_search) || $profile_pic_of_search == "")      // if file exist is false then make it default
                                         {$profile_pic_of_search = "default.jpg";}

          
                                 output_result($name_of_search , $username_of_search , "$profile_pic_of_search");
          
                            $while_no++;
                          }


                                   
                                    if($total_no_of_results <= max_search_result)
                                     {
                                       echo "<div class='center_div_of_search overflow' >
                                                End of $total_no_of_results Results!
                                      </div>";
                                     }
                                   
                                         
                                           
 
               }
            /* 
                */



           

        

               /****** 
                this is working fine
                */
               //if results are more then limit then make load more button
              
               if($total_no_of_results > max_search_result)
               {
                            
                            



                             if(isset($load_no))
                                {    
                                    

                                     if( (( ($load_no - 1) * max_search_result) + $while_no) >= $total_no_of_results)  
                                     {
                                      echo "         
                                       <div class='center_div_of_search' >
                    
                                            End of $total_no_of_results Results!

                                       </div>
                                       ";
                                     }
                                    

                                     else
                                     {
                                       echo "         
                                       <div class='center_div_of_search search_load_more' >
                    
                                            <input type='button' class='button_2 search_load_more_button' data-load_no='" . ($load_no + 1) . "' value='Load More'>

                                       </div>
                                       ";
                                     }


                                }
                              else 
                                  {
                                      
                                      echo "         
                                       <div class='center_div_of_search search_load_more' >
                                                <input type='button' class='button_2 search_load_more_button' data-load_no='2' value='Load More'>
                                         </div>
                                         ";
                                         
                                  }

                
               }


    


   }//end of main else









      
       
  



?>