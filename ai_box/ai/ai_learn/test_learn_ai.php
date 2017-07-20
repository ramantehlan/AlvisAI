<?php
/*
test 1:
today i am very sad, i had a fight with by brother. i love my brother but he fight a lot with me.

*/

session_start();


if(isset($_POST['text']) && isset($_POST['emotion']) /*&& isset($_POST['reason_of_emotion'])*/ )
{
 
  $text              = $_POST['text'];
  $emotion           = $_POST['emotion'];
  //$reason_of_emotion = $_POST['reason_of_emotion'];
  

  //if secret key is true then save it to the database
  if(isset($_POST['secret']))
  { 
  	 if($_POST['secret'] == "raman9")
  	 {
        $allow_saving = "true";
  	 }

  }
  else
  {
  	  $allow_saving = "false";
  }

 

  
  $path = "../..";

  include "$path/includes/ai_learn_includes/main.inc.php";


  
  $new_text = $filter -> classify_text($text);

  $experiment = $learn -> learn_emotion($text);

  echo "
         
         <div class='info_bar highlight_box'>
           
            <div class='info_bar_option red_text'>
              <div class = 'red_box sign_box'></div> Negative Words
            </div>
            
            <div class='info_bar_option blue_text'>
              <div class = 'blue_box sign_box'></div> Positive Words
            </div>

            <div class='info_bar_option green_text'>
              <div class = 'green_box sign_box'></div> Action Words
            </div>

             <div class='info_bar_option gray_text'>
              <div class = 'gray_box sign_box'></div> Punctuations
              </div>

          </div> 
          
          <div class='display_of_text_with_colors highlight_box'>
                      $new_text
          </div>

          <div class='experimental_display highlight_box'>
                 $experiment
          </div>


  ";  

  
  /********************************************
  this is running of algorithams
  ********************************************/





  


}
else
{
	echo "Incomplete Information!";
}


?>