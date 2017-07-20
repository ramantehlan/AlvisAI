
<?php

$page = 'questions';// this is to mark top option
$path = '..';



/********************************************
this code is to get my value
**********************************************/
include "$path/includes/main_header_asset.inc.php";

 

?>


<html>
<head>
  <title><?php  echo $name; ?> Questions</title>
            
            <?php include "$path/includes/header_files.inc.php"; ?>   

            <link rel='stylesheet' href='<?php echo _css_dir_; ?>questions/question-ui.css'>
           
            
              <meta name="robots" content="noindex,nofollow" />

</head>
<body>
  <?php
       include "top.php";
  ?>
<div id='body'>

      <div class='center_row light_background'>

        <?php 

             $line_to_get_questions = mysqli_query($connect , "SELECT * from `$db_name`.`users_questions` WHERE `asked_to` = $id and `answer` = ''  ORDER BY `no` DESC ");
             $no_of_questions       = mysqli_num_rows($line_to_get_questions);
           
        ?>
                
                <div class='questions_holder_box box_of_pop'>
                        <div class='top_of_pop'>
                               Questions
                        </div>
                        <div class='body_of_pop'> 
                          <?php 
                                    
                                    if($no_of_questions >= 1)
                                    {
                                        $q_no = 1;
                                        
                                        while($get_info = mysqli_fetch_array($line_to_get_questions))
                                        {
                                              $question_no = $get_info['no'];
                                              $anonymously = $get_info['anonymously'];
                                              $asker_id    = $get_info['asker_id'];
                                              $question    = $get_info['question'];
                                              $date        = $get_info['date'];

                                                  $question = $text_filter -> convert_hash_tags($question);
                                                  $question = $text_filter -> convert_at_tags($question);
                                                  $question = $text_filter -> convert_smiles($question);

                                                  $round_date = $text_filter -> round_date($date);

                                              if($anonymously != 1)
                                              {
                                                $get_asker_info     = mysqli_fetch_array(mysqli_query($connect , "SELECT * from `$db_name`.`users` where `id` = $asker_id "));
                                                $asker_name         = $get_asker_info['name'];
                                                $asker_username     = $get_asker_info['username'];
                                              }
                                              else
                                              {
                                                $asker_name     = "";
                                                $asker_username = "#";
                                              }
                                           
                                             // it is set in config.inc.php
                                             $php_dir = _php_dir_;

                                             $question_box = <<< EOFILE
                                      <div class='body_of_single_question question_body_$q_no'>
                                             <div class='top_body_of_question'>

                                                  <div class='left_side_of_question'>
                                                      Q.)
                                                  </div>
                                                  $question<a href='http://$host/$asker_username' class='question_link'>$asker_name</a> 
                                                    
                                                  <div class='answer_area_of_question' id='answer_area_of_question_$q_no'>
                                                                 <TEXTAREA Placeholder='Your Answer...'  id='answer_text_question_$q_no' class='textarea'></TEXTAREA>
                                                                 <input type='button' class='button_2' value='Close' id='close_answer_of_question_$q_no'>
                                                                 <input type='button' class='button_2' value='Answer' id='save_the_answer_of_question_$q_no' style='margin-right:10px;'>
                                                  </div>
                                                  <div class='error saving_platform' id='saving_platform_$q_no'></div>
                                                    <span id='action_platform_$q_no'></span>
                                              </div>
                                                
                                              <div class='menu_of_question_box' id='menu_of_question_box_$q_no'>
                                                          <div class='option_of_menu_question_box answer_question_button' id='answer_question_button_$q_no'>
                                                            Answer
                                                          </div>
                                                          <div class='option_of_menu_question_box delete_question_button' id='delete_question_button_$q_no'>
                                                            Delete
                                                          </div>

                                                          <div class=' time_of_question' title='$date'>
                                                              $round_date
                                                          </div>

                                              </div>   
                                              <script type="text/javascript">
                                                           $("#answer_question_button_$q_no").click(function(){
                                                                      $("#answer_area_of_question_$q_no").slideDown();
                                                                      $("#menu_of_question_box_$q_no").hide();

                                                           });

                                                           $("#close_answer_of_question_$q_no").click(function(){
                                                                      $("#answer_area_of_question_$q_no").slideUp();
                                                                      $("#menu_of_question_box_$q_no").show();
                                                           });



                                                           $("#delete_question_button_$q_no").click(function(){
                                                                    
                                                                  var r = confirm("Are you sure you want to delete this Question!");
                                                                  if (r == true) 
                                                                  {
                                                                  
                                                                    $('html').css('cursor','wait');
                                                                    $(this).css('cursor','wait');

                                                                    $.post("$php_dir" + "questions/delete_question.php",{question_no:$question_no},function(delete_question){
                                                                             
                                                                            $('#action_platform_$q_no').html(delete_question);
                                                                          
                                                                            $('html').css('cursor','default');
                                                                            $(this).css('cursor','default');
                                                                            $('.question_body_$q_no').remove();

                                                                    });
                                                                     
                                                                   }
                                                             
                                                           }); 

                                                           $("#save_the_answer_of_question_$q_no").click(function(){
                                                                         
                                                                         var display = $("#saving_platform_$q_no");
                                                                         var answer  = $("#answer_text_question_$q_no").val();
                                                                         
                                                                         if(answer == "")
                                                                         {
                                                                           display.show();
                                                                           display.html("Please enter a answer!");
                                                                         }
                                                                         else
                                                                         {
                                                                             $('html').css('cursor','wait');
                                                                             $(this).css('cursor','wait');
                                                                             display.show();
                                                                             display.html("Saving...");
 
                                                                          $.post("$php_dir" + "questions/answer_question.php",{question_no:$question_no,answer:answer},function(answer_question){
                                                                                      
                                                                             
                                                                             display.html(answer_question);

                                                                             $('html').css('cursor','default');
                                                                             $(this).css('cursor','default');
                                                                             $('.question_body_$q_no').remove();
                                                                           
                                                                           });

                                                                         }

                                                           });
                                                             
                                              </script>
                                             
                                       </div>

EOFILE;

echo $question_box;
                                        
                                        $q_no++;
                                        }

                                         


                                    }
                                    else
                                    {
                                          
                                     $no_question_found = <<< EOFILE
                                      <div class='no_question_found_box'>
                                                 No Questions.
                                      </div>
EOFILE;
 
 echo $no_question_found;
                                    }

                          ?>
                                       


                                    

                        </div>
                </div>
               <?php 
              // this is for the bottom line 
              include "$path/includes/bottom_menu.inc.php";
                 ?>
      </div>

</div>

</div>
</body>
<script type="text/javascript">


</script>
</html>