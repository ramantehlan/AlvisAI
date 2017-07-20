<?php
/***********************************************************
this program is the algoritham used by zimp to understand 
emotions of its users

creator:-          Raman Tehlan
Date of creation:- 01/02/2015
**********************************************************/









class emotion_algorithms
{
    
   /***********************************************
      this is the main algorithm to 
      check the sadness of user

      today i am very sad because i had a fight with my friend. sad about it
   ***********************************************/

     function check_emotion($str)
     {
          //there are taken global from set.lib.php
          global $negative_words , $positive_words , $search , $correct;
          
          //this to correct the string
          $str = $correct -> correct_abbreviation($str); 

          //this is to convert the string in lower case 
          $str = strtolower($str);

          //this is to make array of separate words of a string
          $string_array = explode(" ", $str);

          //this is to get the site of the above array
          $string_array_length = count($string_array);
          







          //this is to display the basic informations
          $display_result = <<< EOFILE
                 
                 <b>no of words     : </b> $string_array_length <br>
                 <b>String          : </b> $str<br>

                      
EOFILE;
          
           echo $display_result;







 
           //this is to check all negative words and get there info
           for($i = 0  ;  $i < count($negative_words) ; $i++)
           {
                //selected negative word
                $negative_word_selected = $negative_words[$i];

                //count the no of negative_word_selected in the string
                $no_of_negative_words_in_str = substr_count($str,$negative_words[$i]);

               

                        //this is to search a negative word position only if word is there
                        if($no_of_negative_words_in_str != 0)
                        {
                          //to get positions of selected word in $string_array
                          $positions_of_selected_word_array = $search -> search_positions_in_array($string_array , $negative_word_selected); 
                          

                          
                        }
                        else
                        {
                          $positions_of_selected_word_array = "";
                        }


                //this is to display the basic informations of this word
                $display_negative_result = "
                        <br>         
                        <b><i> [$negative_word_selected]</i></b>
                        <br>

                      
                       <b>No of occurrence : </b> $no_of_negative_words_in_str <br>
                       <b>Positions of occurrence : </b> $positions_of_selected_word_array<br>
                       <b>After words : </b> <br>
                       <b>Before words : </b> <br>
                       

                      
";
               
               //display only if selected word is present
               if($no_of_negative_words_in_str != 0)
               {
                 echo $display_negative_result;
               }


           }//end of for
           



         /*  //this is to check all positive words and get there info
           for($i = 0  ; $i < countr($positive_words) ; $i++)
           {

           }
*/


    }
     



}









?>