<?php
/*********************************************
this program is to check form and input of 
users like
       1) username
       2) email
       3) date of birth

creator:-          Raman Tehlan
Date of creation:- 12/11/2014
**********************************************/


class check_form_and_db
{

   /******************************************
   this function is to check username
   ******************************************/  
    
    function check_username($username)
    {   global $db_name , $connect;

    	
        $username = preg_replace('#[^0-9a-zA-Z_]#',"",$username);
        $no       = mysqli_num_rows(mysqli_query($connect , "select username from `$db_name`.`users` where username = '$username' "));
        
        return $no;   
    }

    /*****************************************
     this function is to check email
    ******************************************/
     
     function check_email($email)
     {  global $db_name , $connect;
         
         $no    = mysqli_num_rows(mysqli_query($connect , "select email from `$db_name`.`users` where email = '$email'"));
         return $no;

     }
    
      /****************************************
      this function is to check dob difference
      *****************************************/
      
      function check_dob($dob)
      {
           $dob_d       = $dob;
           $date_t      = date('20y-m-d');
           $startdate   = "$dob_d";
           $enddate     = "$date_t";

                           $timestamp_start  = strtotime($startdate);
                           $timestamp_end    = strtotime($enddate);
                           $difference       = abs($timestamp_end - $timestamp_start); // that's it!
                           $years            = floor($difference/(60*60*24*365));

                            // Years, months and days version
                               $years = floor($difference / (365*60*60*24));
            
            return $years;
      }

      /*********************************************
       this function is to check username dont match any key word

->these are the keywords

error
localhost
site
join
end
board 
settings
questions
logout
hashtag 
get
forgot_password
ai_box
alvisai
alvis 

//if it match then pass true 1
//else pass false 0
      *********************************************/

      function check_username_keyword($username)
      {

        
        if( $username == "error" || $username == "localhost" || $username == "site" || $username == "join" || $username == "register" || $username == "board" ||  $username == "settings" || $username == "questions" || $username == "logout" || $username == "hashtag" ||  $username == "get" || $username == "forgot_password" || $username == "ai_box" || $username == company_name || $username == ai_name  )
         {
           return 1;
          }
        else
        {
          return 0; 
        }

      }
    
}

?>