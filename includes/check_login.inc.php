<?php
/*********************************************************************
  this program is just to check is login information
  
  this program do following jobs
  1) check username/email and password combination
  2) if information is correct then it 
     a) start a session 
     c) add no of login
     d) make cookie is remember me is set

   [error going from this page]
    
    wrong_signin -> id or email or password is wrong

creator:-          Raman Tehlan
Date of creation:- 21/06/2015
*******************************************************/

  $code_1   = mysqli_query($connect , "select * from `$db_name`.`users` where username = '" . $_POST['id_in'] . "' and password = '" .  md5(base64_encode($_POST['password_in'])) . "' ");
  $code_2   = mysqli_query($connect , "select * from `$db_name`.`users` where email = '" . $_POST['id_in'] . "' and password = '" .  md5(base64_encode($_POST['password_in'])) . "' ");
  $try_1    = mysqli_num_rows($code_1);
  $try_2    = mysqli_num_rows($code_2);

  if($try_1 === 1)
  {
     $get = mysqli_fetch_array($code_1);
     login();

  }

  else if($try_2 === 1)
  {
  	 $get = mysqli_fetch_array($code_2);
     login();
  }

  else 
  {
  	header("location:http://$host/error/wrong_signin/c");
  	return false;
  }

/***********************************************
    these are the function needed to be done 
***********************************************/
  function login(){
              
    global $get ;

     /* no_of_login is no of time user have loged in */
     $no_of_login    = $get['login_no'];
     /* account_active is to check is account active if not the make it active */
     $account_active = $get['account_active'];
     



     $_SESSION['type']      = "signin";
     $_SESSION['user_id']   = $get['id'];
     $_SESSION['username']  = $get['username'];
     $_SESSION['password']  = $get['password'];
   

    /* this is to use the library update_user_activity() */

        $update      = new update_user_activity();

	  /* this is to add no of login in user db */

       $update -> add_no_of_login($no_of_login);
          


      /* 
     this to set cookie with the information of user signin data
     cookie will be set for 7 days 
       60*60*24*7  =  604800
      */

        if(isset($_POST['remember_me'])  && isset($_COOKIE["Alvis_remember_me"]) != 1)
          {
                    
      
                          setcookie("Alvis_remember_me","true", time() + 604800 );
                          setcookie("Alvis_id"      ,"" . $get['id']       . "",time() + 604800 );
                          setcookie("Alvis_username","" . $get['username'] . "",time() + 604800 );
                          setcookie("Alvis_password","" . $get['password'] . "",time() + 604800 );
                          
                
          }




  }// end of login function

    


 


?>