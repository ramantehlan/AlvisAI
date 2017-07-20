<?php
$host = getenv("SERVER_NAME");
$protocol = "http";

/*
      [post comming to this page from index.php]
       f_name
       l_name
       u_name // removed
       password
       email
       birthday_date // removed
       birthday_month // removed 
       birthday_year // removed
       gender // removed
       country // removed
*/

/*
  type of error going from this page are
   tag-> username_found    (when user name already exist) // no need
   tag-> username_type     (when user name is wrongly typed) // no need
   tag-> signup_not_done   (when sign up f_name is missing) // no need
   tag-> email_found       (when email already exist ) // no need 
   tag-> dob_wrong         (when dob is less then 13 year of age) // no need
*/


/**********************************
this below if else is just to
check the post have came or not 

if post have come then 
     check is session of sign in have started 
             if yes then send user to its board 
             else do nothing and start check_username function
else post have not come 
     send the user back to home page

**********************************/
 session_start();
if(isset($_POST['f_name']) or isset($_SESSION['type']) )
{   $username = "";//this is to make username global
       

       if(isset($_SESSION['type']))
          {
                    switch ($_SESSION['type']) {
                      case 'signin':
                         header("location:$protocol://$host/board");
                         return false;
                        break;
                        case 'signup':
                          
                       
                        break;
                                }// end of switch
           }// end to check session if
          else
          {
            /* this is to connect to mysqli server */
            include_once '../includes/config.inc.php';
            /* this is library to check form */
            include_once '../includes/check_form_and_db.inc.php';
            /* this is element to check any thing */
            $check = new check_form_and_db();

           
           check_username();
           
          }
           



}// end to post check if

else
{
  header("location:$protocol://$host/error/signup_not_done");
 return false;
}

/***********************
this is check user name to check do user name
         if user name not found in db then  send it to check 
         else if user name is found in db then send back user to hame page with a error
*********************/


function check_username()
{ global $check , $username;
  $username             =  $_POST['l_name'] . "_" . $_POST['f_name']  ;
  $username = str_replace(" ", "", $username);
  $no_of_result    = $check -> check_username($username); 

  if($no_of_result >= 1)
  {
    
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789_";
    for ($i = 0; $i < 5; $i++) 
     {
        $n = rand(0, strlen($alphabet)-1);
        $pass[$i] = $alphabet[$n];
     }

    $random_name = implode($pass);
  
    
    $username = $_POST['f_name'] . "_" . rand(100,100000) .  $random_name;
    

    check_email();

  }
  else
  {
     check_email();
  }


 /* if($user_name === $user_name_filterd)
  {
     $no_of_result    = $check -> check_username($user_name); 
      
      if($no_of_result >= 1)
       {
        header("location:../error/username_found");
        return false;
       }
       else
       {
         check_username_keyword($user_name_filterd); // this function is to check the email
       }

    

  }//end of compage
  else
  {
    header("location:../error/username_type"); 
    return false;
        
  }//end of else

*/

}// end of check username function


/************************
to check there is no keyword in username
****************************/

/* this is removed in change

function check_username_keyword($username)
{
   global $check;
   $no = $check ->  check_username_keyword($username);

   /**************************
     if no is 0 then no keyword match 
     else if no is 1 then keyword match
   **************************/
/*
     if($no == 0)
     {
       check_email();
     }
     else
     {
        header("location:../error/username_keyword_found");
        return false;
     }

}

/**************************
this is to check the email of user
******************************/

function check_email(){
       global $check;
       $no    = $check -> check_email($_POST['email']);

       if($no >= 1)
       {
         header("location:../error/email_found");
        return false;
       }
       else
       {
         // check_dob(); this is removed
         start_process();
       }

}// check email function end


/****************************
this is to check the date of birth of the users
****************************/
/* thsi is removed
function check_dob(){
           $dob_d       = $_POST['birthday_year'] ."-". $_POST['birthday_month'] ."-".  $_POST['birthday_date'];
           global $check;
           $years       = $check -> check_dob($dob_d);
                               

                               if($years >= '13')
                                  {
                                     start_process();  // if this function is fine then go to next
                                     
                                   }
                              else
                                  {
                                         header("location:../error/dob_wrong");
                                         return false;
                                  }


}// end of check_dob

/********************
this below is to start the prcess
**********************/

function start_process(){
               global $connect , $protocol , $host , $username;
            $_SESSION['type']           = "signup";
            $_SESSION['f_name']         = preg_replace('#[^a-zA-Z]#', '', $_POST['f_name']);
            $_SESSION['l_name']         = preg_replace('#[^a-zA-Z]#', '', $_POST['l_name']);
            $_SESSION['u_name']         = $username;
            $_SESSION['password']       = $_POST['password'];
            $_SESSION['email']          = $_POST['email'];
           // $_SESSION['birthday']       = $_POST['birthday_year'] ."-". $_POST['birthday_month'] ."-".  $_POST['birthday_date'];
           // $_SESSION['gender']         = $_POST['gender'];
           // $_SESSION['country']        = $_POST['country'];
            mysqli_close($connect);

            header("$protocol://$host/register");
}// end of the function start process




/*
    [error comming from upload_information page]
      tag-> wrong_type  (signup/index.php) (when image is of wrong type)
      tag-> wrong_size  (signup/index.php) (when image is of wrong size)
*/
 
 /* this is removed
 function check_error()
 {
              if(isset($_GET['error']))
              {
                 switch ($_GET['error']) {
                   case 'wrong_type':
                     echo "<script type='text/javascript'>
                               $('#end_error').show();
                     </script>

                      Image must be of type jpg , png or gif ";
                     break;
                    case 'wrong_size':
                         echo "<script type='text/javascript'>
                               $('#end_error').show();
                     </script>

                      Image size should be less then 2MB.";
                    break;
                   default:
                      echo "<script type='text/javascript'>
                               $('#end_error').hide();
                     </script>";
                     break;
                 }
              }
 }

*/
header("location:$protocol://$host/register");
?>
<?php 
/*
<html>
<head>
	<title>Sign Up in AlvisAi</title>
              
              <link rel='icon' href="http://<?php  echo $host; ?>/assets/images/comman/logos/logo.png">

              <link rel='stylesheet' href='http://<?php echo $host; ?>/assets/css/comman/basic-ui.css'>
              <link rel='stylesheet' href='http://<?php echo $host; ?>/signup/assets/css/signup-ui.css'>
              <link rel='stylesheet' href='http://<?php echo $host; ?>/signup/assets/css/top.css'>
              


              
              <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-1.10.2.js'></script>
              <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-ui.js'></script>
              <script type="text/javascript" src='http://<?php echo $host; ?>/signup/assets/javascript/check_form.js'></script>

</head>
<body>
  <div id='black'>
  </div>
  
  <div id='loading'>
          <br><br><Br>
           <img src='http://<?php echo $host; ?>/assets/images/comman/other/preloader12.gif'>
           <br><Br>
           Please wait!<br>
           It may take few minutes
  </div>

     <div id='top'>
          <div id='middle_top'>
                          <a href='<?php echo "http://$host";  ?>' ><img src='http://<?php echo $host;  ?>/assets/images/comman/logos/logo_blue.png' id='logo' alt='zimg logo'></a>
          </div>
     </div>
     <div id='body'>
         
         <div id='end_error'>
           <?php
                // this is to print the error
                check_error();              
           ?>
          

         </div>

         <div id='section_1' class='box_of_pop section'>
                <div class='top_of_pop'>
                         Security
                </div>
                <div class='body_of_pop'>
                       <form method="post" action='http://<?php echo $host;  ?>/register' enctype="multipart/form-data">
                     <select type="question" id="s_question" class="input" name="s_question">
                                <option select="" value="">Select your security question</option>
                                <option value="What was your bast friend name when you were 10 year old.">What was your bast friend name when you were 10 year old.</option>
                               <option value="Where is your mother's home town.">Where is your mother's home town.</option>
                               <option value="what is your hobby.">what is your hobby.</option>
                               <option value="what game do you play.">what game do you play.</option>
                               <option value="what do you want to do in your life.">what do you want to do in your life.</option>
                               <option value="what is your nick name at home.">what is your nick name at home.</option>
                               <option value="what was your first school name.">what was your first school name.</option>
                               <option value="what was your first toy.">what was your first toy.</option>
                               <option value="what was your first club.">what was your first club.</option>
                               <option value="what is your grandfather name.">what is your grandfather name.</option>
                      </select>
                      <input type="answer" id="s_answer" autocomplete='off' class="input " placeholder="Answer" name="s_answer" maxlength='20'>
                      <div class='error_box' id='security_error'></div>
                
                </div>
         </div>

         <div id='section_2' class='box_of_pop section'>
                <div class='top_of_pop'>
                        Personal 
                </div>
                <div class='body_of_pop'>
                        
                         <input type="hometown" id="hometown" class="input" placeholder="Home town name" name="hometown" maxlength='40'>
                          <input type="web" id="web" class="input" placeholder="web" name="web" maxlength='40'>
                          <input type="hobby" id="hobby" class="input" placeholder="Hobby" name="hobby" maxlength='40'>
                          <textarea class='input ' id='about'  placeholder='Write About your self here in less then 300 words!' style='resize:none;height:120px;padding:5px;' maxlength='300' name='about'></textarea>
                </div>
         </div>

         <div id='section_3' class='box_of_pop section'>
                <div class='top_of_pop'>
                       Profile
                </div>
                <div class='body_of_pop'>
                           <div id='default_img_hold'><img src='http://<?php echo $host; ?>/assets/images/comman/user_files/default_m.png' alt='default profile picture' class='default_user' id='pre_profile_pic'></div>
                         <input type='file'  class='button' id='img_file'  name='profile' style='padding:3px;'>
                         
                         
                         <input type='submit' id='submit' class='button' value='Next' >
                </div>
         </div>
         <div id='display'>

        </div>
            


     </div>
     <?php include '../includes/bottom_menu.inc.php'; ?>

</body>
<script type="text/javascript">
/* $(function() {
    var availableTags = [
      "Computer",
      "Gaming",
      "Programming",
      "Basketball",
      "Football",
      "Cricket",
      "Hockey",
      "Golf",
      "Baseball",
      "Horse Ridding ",
      "Reading books",
      "Traveling",
      "skeeting"
    ];
    $("#hobby").autocomplete({
        source: availableTags,
        //autoFocus: true 
        //delay: 500
        minLength: 1,
        maxresult:5

    }); 
  });*//*
</script>
</html>

*/
?>