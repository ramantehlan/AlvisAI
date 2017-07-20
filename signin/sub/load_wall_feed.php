<?php

/*******************************************8
    this is code to select the code for the 
    wall and other
*********************************************/

  switch ($page) {
    case 'wall':
         $wall_fetch_code = "SELECT * 
          FROM  `$db_name`.`users_updates` 
          WHERE updater_id = $s_id 
          AND  `deleted` != '1'
          ORDER BY  `users_updates`.`date` DESC 
         $pagination_sql
          ";
      break;
     case 'other':
           $wall_fetch_code = "SELECT * 
          FROM  `$db_name`.`users_updates` 
          WHERE  `anonymously` =  '0'
          AND  `deleted` != '1'
          AND  updater_id = $s_id
          ORDER BY  `users_updates`.`date` DESC 
         $pagination_sql
          ";
      break;
    default:
           $wall_fetch_code = "SELECT * 
          FROM  `$db_name`.`users_updates` 
          WHERE  `anonymously` =  '0'
          AND  `deleted` != '1'
          AND  updater_id = $s_id
          ORDER BY  `users_updates`.`date` DESC 
          $pagination_sql
          ";
      break;
  }

/*******************************************8
    this is code to get question which are not 
    blank
*********************************************/

if(allow_question)
{

  $question_fetch_code = "SELECT * FROM `$db_name`.`users_questions`
    WHERE `asked_to` = $s_id
    AND   `answer`  != ''
    AND  `deleted` != '1'
    ORDER BY `date` DESC
    $pagination_sql
  ";

}

/*******************************************
  this is to get the statistics of the 
  wall 
*********************************************/

  $code_to_mysqli_update   = mysqli_query($connect , $wall_fetch_code);
  $no_of_update            = mysqli_num_rows($code_to_mysqli_update);
  $update_n                = 1;

if(allow_question)
{

  $code_to_mysqli_question = mysqli_query($connect , $question_fetch_code);
  $no_of_question          = mysqli_num_rows($code_to_mysqli_question);
  $question_n              = 1;
}
else
{
  $question_n = 0;
  $no_of_question = 0;
}    

/*******************************************
  this is to handle the wall if there is 
  no activity done
*********************************************/

      if($no_of_update == 0 && $no_of_question == 0)
    {
      if(isset($load_no))
      {
             $empty_result = <<< EOFILE
                     <div class='load_more_div no_updates'>
                             
                             No More Activities!
                    </div>
EOFILE;
      }
      else
      {
             $empty_result = <<< EOFILE
                     <div class='load_more_div no_updates'>
                             
                             No Activities!
                    </div>
EOFILE;
      }
  
         echo $empty_result;
    }
   else
   {



      /*******************************************
  this is to show the result of the 
  wall when it is not empty
*********************************************/

if(allow_question)

{


/*******************************************
  this is to show the question
*********************************************/

 while ($get_wall_question = mysqli_fetch_array($code_to_mysqli_question))
 {

           /**********************************************
             this is to get the information of the question
           ***********************************************/
             
             $no          = $get_wall_question['no'];    
             $anonymously = $get_wall_question['anonymously'];
             $asker_id    = $get_wall_question['asker_id'];
             $question    = $get_wall_question['question'];
             $answer      = $get_wall_question['answer'];
             $date        = $get_wall_question['date'];

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

            $feed_box_bunch[$date . $question_n] = $feed_box -> create_feed_box( NULL , $no , $s_id , "$s_name" , "$s_username" , "$s_profile_pic" , $asker_id , $anonymously , null , NULL , NULL , $question , $answer , $date , $round_date , $question_n . "q_$page_limit");
             
            
             

$question_n++;
 }

}

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
                    $photo       = $get_wall_update['attachments'];
                    $date        = $get_wall_update['date'];

               /*******************************************
                 this to filter the update of wall
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

              $feed_box_bunch[$date . $update_n] =  $feed_box -> create_feed_box($type , $no , $s_id , "$s_name" , "$s_username" , "$s_profile_pic" , NULL , $anonymously , $felling , $update , $photo , NULL , NULL , $date , $round_date , $update_n . "u_$page_limit");

               
              
              
           
$update_n++;
  }


               
              
              

              krsort($feed_box_bunch);


            
               foreach($feed_box_bunch as $time => $data)
               {
                echo $data ;
               }
               

  
       if(isset($load_no))
             {
                              echo "         
               <div class='load_more_div wall_load_more_div'>
                    
                    <input type='button' class='button_2 feed_more_button wall_feed_more_button' data-load_no='" . ($load_no + 1) . "' value='Load More'>

               </div>

               ";
             }
             else
             {
                             echo "         
               <div class='load_more_div wall_load_more_div'>
                    
                    <input type='button' class='button_2 feed_more_button wall_feed_more_button' data-load_no='2' value='Load More'>

               </div>
               ";
             }
   
          


              
           
   }// this is end of main else


?>