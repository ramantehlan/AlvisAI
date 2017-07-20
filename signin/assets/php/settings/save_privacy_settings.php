<?php
/*********************************************
this page is to save privacy settings 
**********************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['who_can_ask']))
{
             /* this is to connect to mysqli server */
            include_once '../../../../includes/config.inc.php';
            
            //this tell who can ask question
            // a=> everyone
            // b=> following
            $who_can_ask = $_POST['who_can_ask'];
            $allow_anon  = 1;
            $id          = $_SESSION['user_id'];

            switch ($_POST['allow_anon']) {
            	case 'true':
            		$allow_anon = 1;
            		break;
            	case 'false':
                    $allow_anon = 0;
            	     break;
            	default:
            	    $allow_anon = 1;
            		break;
            }
            
            $code_to_update_privacy = "UPDATE  `$db_name`.`users` SET  `allow_anonymous_ask` =  '$allow_anon',
                                   `who_can_ask` =  '$who_can_ask' WHERE id = $id";
            mysqli_query($connect , $code_to_update_privacy);
            echo "Saved successfully!";

}
else
{
 echo "<div class='comment_msg'>Error! incomplete information.</div>";
	
}


?>