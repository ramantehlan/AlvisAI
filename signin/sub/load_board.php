<?php


                      /***********************************
                      this is to get feed box library
                      ***********************************/

                      include "$path/includes/feed_box.lib.php";
                      $feed_box = new feed_box();



          



                     /*********************************************
                      this is to show feed
                     *********************************************/  

                                  //this is for increment
                                  $update_n               = 1;
                                  $question_n             = 1; 
                                 
                                  

                                  //this is to store all the following id in mysqli or format
                                               
                                  $all_following_id_update   = "";
                                
                                if(allow_question)
                                {
                                  
                                $all_following_id_question = "";
                              
                                 }

                                  //this is to get all the following

                          $code_to_get_feed_following = mysqli_query($connect , "SELECT * from `$db_name`.`users_friends` where follower_id = $id");

                          while($get_following_info  = mysqli_fetch_array($code_to_get_feed_following))
                          {
                                // this is following id
                                $following_id = $get_following_info['following_id'];

                                
                                $all_following_id_update     .= "`updater_id` = $following_id OR ";
                               
                                if(allow_question)
                                {
                                  
                                 $all_following_id_question   .= "`asked_to`   = $following_id OR ";
                                 
                                 }

                                  
                          }// end of  while

                                      /*******************************************************************
                                       this is the basic question to get question and update
                                      ********************************************************************/
                                     if(allow_question)
                                      {
                                        $code_to_mysqli_question = mysqli_query($connect , "SELECT * FROM `$db_name`.`users_questions`
                                                               WHERE ( $all_following_id_question 0 )
                                                               AND   `answer`  != ''
                                                               AND  `deleted` != '1'
                                                               ORDER BY `date` DESC
                                                               $pagination_sql");

                                       }
                                  
                                  
                                  
                                        $code_to_mysqli_update = mysqli_query($connect , "SELECT * 
                                                                FROM  `$db_name`.`users_updates` 
                                                                where  $allow_anon_feed
                                                                 `deleted` != '1' and
                                                                 ( $all_following_id_update 0 ) 
                                                                ORDER BY  `users_updates`.`date` DESC 
                                                                $pagination_sql");
                                      

                                   
                                        
                                       //this is know the no of updates done by following

                                       if(allow_question)
                                         {
                                                $total_no_of_questions = mysqli_num_rows($code_to_mysqli_question);
                                         }  
                                         else
                                         {
                                                $total_no_of_questions = 0;
                                         }
                                      
                                                  $total_no_of_update    = mysqli_num_rows($code_to_mysqli_update);
                                           

                                      
                                  if(allow_question)
                                  { 

                                      /******************************************
                                       this is the code to show the question feed
                                       *******************************************/


                                        while ($get_wall_question = mysqli_fetch_array($code_to_mysqli_question))
                                         {
                                             
                                                  /**********************************************
                                                     this is to get the information of the question
                                                   ***********************************************/
                                                     $no          = $get_wall_question['no'];
                                                     $anonymously = $get_wall_question['anonymously'];
                                                     $asker_id    = $get_wall_question['asker_id'];
                                                     $asked_to    = $get_wall_question['asked_to'];
                                                     $question    = $get_wall_question['question'];
                                                     $answer      = $get_wall_question['answer'];
                                                     $date        = $get_wall_question['date'];
                                                     
                                                     $get_person_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * from `$db_name`.`users` where id = $asked_to"));

                                                     $s_name        =   $get_person_info['name'];
                                                     $s_username    =   $get_person_info['username'];
                                                     $s_profile_pic =   $get_person_info['profile_pic'];
 
                                                     /******************************************
                                                      this is to filter the question and answer and date
                                                     *******************************************/

                                                      $question      = $text_filter -> convert_hash_tags($question);
                                                      $question      = $text_filter -> convert_at_tags($question);
                                                      $question      = $text_filter -> convert_smiles($question);

                                                      $answer        = $text_filter -> convert_hash_tags($answer);
                                                      $answer        = $text_filter -> convert_at_tags($answer);
                                                      $answer        = $text_filter -> convert_smiles($answer);

                                                      $round_date    = $text_filter -> round_date($date);

                                                      /******************************************
                                                        this is to get the username and name is it is not annonmous
                                                      ******************************************/
   
                                                         /****************************************
                                                         this is to store feed box into a array 
                                                         to arrange array in decreasing oreder of time
                                                      *****************************************/

                                                    $feed_box_bunch[$date .  $question_n] = $feed_box -> create_feed_box( NULL , $no ,  $asked_to , "$s_name" , "$s_username" , "$s_profile_pic" , $asker_id , $anonymously , null , NULL , NULL , $question , $answer , $date , $round_date , $question_n . "q_$page_no");
             
            
             

                                                 $question_n++;
                                         }//end of while


                                  }//end of if

                                        /*******************************************
                                          this is to show the update
                                        *********************************************/

                                        //this is to make the same series to get continue
                                        $update_n = $question_n;

                                          while ($get_wall_update = mysqli_fetch_array($code_to_mysqli_update)) 
                                          {
    
   
                                                      /*******************************************
                                                        this is to get the information of the update
                                                      *********************************************/ 
                                                            $no          = $get_wall_update['no'];
                                                            $anonymously = $get_wall_update['anonymously'];
                                                            $type        = $get_wall_update['type'];
                                                            $felling     = $get_wall_update['feeling'];
                                                            $update      = $get_wall_update['update'];
                                                            $updater_id  = $get_wall_update['updater_id'];
                                                            $photo       = $get_wall_update['attachments'];
                                                            $date        = $get_wall_update['date'];

                                                            $get_person_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * from `$db_name`.`users` where id = $updater_id"));

                                                            $s_name        =   $get_person_info['name'];
                                                            $s_username    =   $get_person_info['username'];
                                                            $s_profile_pic =   $get_person_info['profile_pic'];

                                                       /*******************************************
                                                         this to filter the update of feed
                                                        *********************************************/

                                                            $update     = $text_filter -> convert_hash_tags($update);
                                                            $update     = $text_filter -> convert_at_tags($update);
                                                            $update     = $text_filter -> convert_smiles($update);
                                                            $round_date = $text_filter -> round_date($date);
      


    
                                                      /*******************************************
                                                        this is to get the information of the wall
                                                      *********************************************/

                                                        /****************************************
                                                         this is to store feed box into a array 
                                                         to arrange array in decreasing oreder of time
                                                      *****************************************/

                                                      $feed_box_bunch[$date .  $update_n] =  $feed_box -> create_feed_box($type ,$no , $updater_id , "$s_name" , "$s_username" , "$s_profile_pic" , NULL , $anonymously , $felling , $update , $photo , NULL , NULL , $date , $round_date , $update_n . "u_$page_no");

               
              
              
           
                                                        $update_n++;
                                                   }// end of while

     if($total_no_of_update == 0 && $total_no_of_questions == 0)
     {
         if(isset($load_no))
         {
                      echo "<div class='no_updates'>
                             No More Feeds!
                    </div>";
         }
         else
         {

           echo "<div class='no_updates'>
                             No Feed!
                    </div>";

          }
          
     }
     else
     {
                  krsort($feed_box_bunch);
                
               foreach($feed_box_bunch as $time => $data)
               {
                echo $data ;
               }




             if(isset($load_no))
             {
                              echo "         
               <div class='load_more_div board_load_more'>
                    
                    <input type='button' class='button_2 feed_more_button board_feed_more_button' data-load_no='" . ($load_no + 1) . "' value='Load More'>

               </div>

               ";
             }
             else
             {
                             echo "         
               <div class='load_more_div board_load_more'>
                    
                    <input type='button' class='button_2 feed_more_button board_feed_more_button' data-load_no='2' value='Load More'>

               </div>
               ";
             }
                


     }


?>