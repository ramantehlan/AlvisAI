<?php
/*********************************************************************************
   {ZIMP EMOTION ARTIFICIAL INTELIGIENCE ALGORITHM}

creator: raman tehlan
date   : 26/07/2015 algorithms
detail : this is to search functions
*******************************************************************************/


class search_algorithms
{
        //this function is to search position of a word in array and return an array of positions
	    //search_position_in_array(array , word)
        function search_positions_in_array($array_for_search , $words_for_search)
        {    
             
            $positions_set = "";

             for($i = 0; $i < count($array_for_search) ; $i++)
             {   

                   
                   if($array_for_search[$i] == $words_for_search)
                   {
                   	  
                      
                      //to store the new position with adding 1 to total positions
                      $positions_set  .=  " " . ($i + 1);

                   }//end of if


             }//end of for

        return $positions_set;

        }//end of search_positions_in_array();

}//end of class search_algorithms


?>