<?php
/********************************************************
this program is to do text filter like 
   
    1) convert_hash_tags(str)
    2) convert_at_tags(str)
    3) convert_smiles(str)
    4) round_date(date)
    5) round_date_2(date)
    6) round_no(date)

creator:-          Raman Tehlan
Date of creation:- 02/04/2015
*********************************************************/

 class text_filter{
	 
   /***********************************************
      this is to cover all the #(hash) tags 
      so that they can be searched
   ***********************************************/

    /*********************************************
                   [NOTE]
        conver_hash_tags and conver_at_tags 
        has been commented to make there 
        function good for future
    ***********************************************/
  

   public function convert_hash_tags($str){
   /* $host = getenv("SERVER_NAME");


	    $regex = "/#+([a-zA-Z0-9_]+)/";
	    $str   = preg_replace($regex,"<a class='hash_a' href='http://$host/hashtag/$1'>$0</a> ", $str);
	    return($str);
      unset($str);
      unset($regex);
      unset($host);
      */
      return $str;
   }


/***********************************************
      this is to cover all the @(at) tags 
      so that they can be searched
***********************************************/

public function convert_at_tags($str){
  /*  $host = getenv("SERVER_NAME");

     $regex = "/@+([a-zA-Z0-9_]+)/";
     $str   = preg_replace($regex,"<a class='hash_a' href='http://$host/$1'>$0</a> ", $str);
	   return($str);
      unset($str);
      unset($regex);
      unset($host);
      */
      return $str;
   }



/***********************************************
      this is to change the smiles code 
      to smiles images
   ***********************************************/


public function convert_smiles($str){

  global $host;
  //folder can be default also
  $folder = 'default';
       $char  = array("<3",
                       "[peace]",
                       "[umbr]",
                       ":)",
                       ":|",
                       ":(",
                       ":P",
                       ":p",
                       ";)",
                       ":D",
                       ":O",
                       "!",
                       "?",
                       "->"

       );
       $icons = array("&#10084" ,
                      "&#9774" , 
                      "&#9730",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_smile.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_neutral.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_sad.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_surprised.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_surprised.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_wink.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_biggrin.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_surprised.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_exclaim.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_question.gif' class='gasture'>",
                      "<img src='http://$host/signin/assets/images/comman/smiles/$folder/icon_arrow.gif' class='gasture'>"


                      
                      
                      );
      
       $str   = str_replace($char,$icons,$str);
       return ($str);

      unset($str);
      unset($folder);
      unset($char);
      unset($icons);
      unset($host);
   
   }




/***********************************************
      this is to calculate the time of update 
      and make it in ago format
***********************************************/



    public function round_date($update_time)
       {
    
            $last_date    = strtotime($update_time);
            $current_date = strtotime(date('20y-m-d h:i:s'));
            $diff         = abs($current_date - $last_date);

            $seconds  = floor($diff/1);
            $minutes  = floor($diff/(60));
            $hours    = floor($diff/(60*60));
            $days     = floor($diff/(60*60*24));
            $week     = floor($diff/(60*60*24*7));
            $month    = floor($diff/(60*60*24*30));
            $years    = floor($diff/(365*24*60*60));
            
            $result = "updated";

             if($years >= 1)
             {$result = "$years year ago";}
           
             else if($month >= 1)
             {$result = "$month month ago";}

             else if($week >= 1)
             {$result = "$week week ago";}

             else if($days >= 1)
             {$result = "$days day ago";}
            
             else if($hours >= 1)
             {$result = "$hours hours ago";}
            
             else if($minutes >= 1)
             {$result = "$minutes minutes ago";}
             
             else
             {$result = "$seconds seconds ago";}

             return $result;

            unset($last_date);
            unset($current_date);
            unset($diff);
            unset($seconds);
            unset($minutes);
            unset($hours);
            unset($days);
            unset($week);
            unset($month);
            unset($years);
            unset($result);


           }




/***********************************************
      this is to change the smiles code 
      to smiles images
***********************************************/


           public function round_no($no)
           {
              $result = $no;

                    if($no < 1000)
                    {
                       $result = $no;
                    }
                    else if($no >= 1000)
                    {
                      $no     = floor($no/1000);
                      $result = $no . "K";
                    }

                    return $result;

            unset($result);

           }


/***********************************************
      this is to calculate the time of          {friendship} 
      and make it in easy format
***********************************************/

 public function round_date_2($update_time)
       {
    
            $last_date    = strtotime($update_time);
            $current_date = strtotime(date('20y-m-d h:i:s'));
            $diff         = abs($current_date - $last_date);

            $seconds  = floor($diff/1);
            $minutes  = floor($diff/(60));
            $hours    = floor($diff/(60*60));
            $days     = floor($diff/(60*60*24));
            $week     = floor($diff/(60*60*24*7));
            $month    = floor($diff/(60*60*24*30));
            $years    = floor($diff/(365*24*60*60));
            
            $result = "since";

             if($years >= 1)
             {$result = "$years year";}
           
             else if($month >= 1)
             {$result = "$month month";}

             else if($week >= 1)
             {$result = "$week week";}

             else if($days >= 1)
             {$result = "$days day";}
            
             else if($hours >= 1)
             {$result = "$hours hours";}
            
             else if($minutes >= 1)
             {$result = "$minutes minutes";}
             
             else
             {$result = "$seconds seconds";}

             return $result;

            unset($last_date);
            unset($current_date);
            unset($diff);
            unset($seconds);
            unset($minutes);
            unset($hours);
            unset($days);
            unset($week);
            unset($month);
            unset($years);
            unset($result);


      }




}// end of class text_filter


?>