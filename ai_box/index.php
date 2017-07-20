<?php
/*********************************************************************************
   

creator: raman tehlan
date   : 25/07/2015
*******************************************************************************/


//this is to set the path of things from this page 
$path = "";
$path2 = "..";

session_start();

//this is to include the main_include 
include "includes/config.inc.php";


if(isset($_GET['ai_selected']))
{
    switch ($_GET['ai_selected']) {
        case 'home':
               $ai_selected = "home";
            break;
        case 'emotion':
               $ai_selected = "emotion";
            break;
        case 'learn':
               $ai_selected = "learn";
             break;
        case 'talk':
               $ai_selected = "talk";
             break;

        default:
            $ai_selected = "home";
            break;
    }
}
else
{
    $ai_selected = "home";
}





?>

<html>
<head>
	<title><?php echo _ai_name_ ?> ARTIFICIAL INTELIGIENCE</title>

    <link rel='icon' href="http://<?php  echo $host; ?>/assets/images/comman/logos/logo.png">


	<link rel="stylesheet" type="text/css" href="<?php echo _ai_css_dir_; ?>comman/basic-ui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo _ai_css_dir_; ?>index-ui.css">

    <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery.js'></script>
    <!--<script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-1.9.1.js'></script>-->
    <script type="text/javascript" src='http://<?php echo $host; ?>/assets/javascript/jquery/jquery-ui.js'></script> 

</head>
<?php 
       
        include "gui/top.php";

	 ?>
<body>

     <div id='body '>

                    <div class='center_working_area box_of_pop'>
                         <div class = 'top_of_pop'>
                                           
                                     <?php 
                                            
                                            switch ($ai_selected) {
                                                case 'home':
                                                           echo "Home";
                                                    break;
                                                case 'emotion':
                                                           echo "EMOTION ARTIFICIAL INTELIGIENCE";
                                                    break;
                                                case 'learn':
                                                           echo "LEARN ARTIFICIAL INTELIGIENCE";
                                                           
                                                break;
                                                case 'talk':
                                                           echo "TALK ARTIFICIAL INTELIGIENCE";
                                                           
                                                break;
                                            }


                                      ?>


                         </div>
                         <div class='body_of_pop'>
                                 
                                      <?php 
                                            
                                            switch ($ai_selected) {
                                                case 'home':

                                                            include "gui/home.php";
                                                
                                                    break;
                                                case 'emotion':

                                                            include "ai/ai_emotion/index.php";

                                                    break;
                                                case 'learn':

                                                            include "ai/ai_learn/index.php";
                                                           
                                                break;
                                                case 'talk':

                                                break;
                                            }


                                      ?>
                         
                         </div>

                    </div>


     </div>
     <?php 
       
        include "../includes/bottom_menu.inc.php";

     ?>
</body>



</html>