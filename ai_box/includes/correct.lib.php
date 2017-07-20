<?php
/*********************************************************************************
   {ZIMP EMOTION ARTIFICIAL INTELIGIENCE ALGORITHM}

creator: raman tehlan 
date   : 26/07/2015 algorithms
detail : this is to correct a string  
*******************************************************************************/

class correct_algorithms 
{
	   function correct_abbreviation($str)
	   {

             //abbreviations of all kind 
             $abbreviation = array(
             	                   "lol",
             	                   "brb",
             	                   "gtg",
             	                   "gn",
             	                   "gm",
             	                   "sd"
             	                   );
             
             //correct full form of abbreviations
             $correct_full_form = array(
             	                      "laugh out loud" ,
             	                      "be right back" , 
             	                      "got to go",
             	                      "good night",
             	                      "good morning",
             	                      "sweet dream"
             	                      );

             
             //replace string with correct words
             $new_str = str_replace( $abbreviation , $correct_full_form , $str);

           return $new_str;

	   }


}



?>