<?php
/***********************************************************


creator:-          Raman Tehlan
Date of creation:- 01/02/2015
**********************************************************/









class learn_algoritham
{
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
    function learn_emotion($text)
    {
          //there are taken global from set.lib.php
          global $negative_words , $positive_words , $action_words , $punctuations , $search , $correct;
          
          //this is to correct the text
          $text = $correct -> correct_abbreviation($text);

          //this is to convert the text in lower case
          $text = strtolower($text);



          /**********************************************************************
          this is to make array of text into sub string using punctuations
          *************************************************************************/

                //this is to tell no of punctuations present 
               // $no_of_punctuations = count($punctuations);
                 $tmp_text           = $text;
                
                 $tmp_text = str_replace($punctuations,"-",$tmp_text);

                 $sub_str_array = explode("-", $tmp_text);

         


         /*************************************************************************
          this is used to find all the negative words and get its 
          before words
          after words 
         ***************************************************************************/
          
          for($i = 0 ; $i < count($negative_words) ; $i++)
          {
              
              //to count the no of selected negative word present in the string 
              $no_of_negative_words_in_str = substr_count($text, $negative_words[$i]);


                //that negative word is present
                 if($no_of_negative_words_in_str != 0)
                      {   


                         
                         //this is to count the size of sub_str_array
                         $no_of_sub_str = count($sub_str_array);

                         //get each sub strings
                         for($j = 0; $j < $no_of_sub_str ; $j++)
                            {    
                                  
                                  $new_array = explode($negative_words[$i],$sub_str_array[$j] );
                                  print_r($new_array);
                                  
                            }
                            echo "<Br>";
                            


                      } 
              


          }//end of negative for

              

     

    }


}









?>