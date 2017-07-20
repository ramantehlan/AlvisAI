<?php 


class filter
{       

       /*************************************************************
       this is to return text with different colors according to word type
       ***************************************************************/
       function classify_text($text)
       {
               //there are taken global from set.lib.php
                global $negative_words , $positive_words , $action_words , $punctuations , $search , $correct;
      
                //this is to correct the text
                $text = $correct -> correct_abbreviation($text);

                //this is to convert the text in lower case
                $text = strtolower($text);




                           
                           //this is to find negative words and highlight them
                           for($i = 0 ; $i < count($negative_words) ; $i++)
                           {        

                                            	
                                $text = str_ireplace($negative_words[$i], "<span class='red_text'>" . $negative_words[$i] . "</span>", $text);
                                          
        

                           }

                            //this is to find positive words and highlight them
                           for($i = 0 ; $i < count($positive_words) ; $i++)
                           {
                                     
                                    
                                  $text =   str_ireplace($positive_words[$i], "<span class='blue_text'>" . $positive_words[$i] . "</span>", $text);
                                    
                           }

                            //this is to find action words and highlight them
                           for($i = 0 ; $i < count($action_words) ; $i++)
                           {
                                     
                                  
                                            $text = str_ireplace($action_words[$i], "<span class='green_text'>" . $action_words[$i] . "</span>" , $text);
                                 

                           }

                            //this is to find $punctuations and highlight them
                           for($i = 0 ; $i < count($punctuations) ; $i++)
                           {
                               
                                           $text = str_ireplace($punctuations[$i] ,"<span class='gray_text'>" . $punctuations[$i] . "</span>", $text); 
                                    
                           }

                     
                      
                      return $text;



       }//end of classify_texT();

}//end of class


?>