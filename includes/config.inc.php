<?php
/*****************************************************************
configration file of SITE

creator:-          Raman Tehlan
Date of creation:- 02/07/2015
*********************************************************************/











/*****************************************************
THIS IS MYSQL DETAIL AREA
******************************************************/

$db_host       ='localhost';
$db_user       ='root';
$db_password   ='';
$db_name       ='alvisai';
$host          = getenv("SERVER_NAME");
$protocol      = "http";
$connect       = mysqli_connect($db_host,$db_user,$db_password);


 mysqli_connect($db_host,$db_user,$db_password);

/*
define("_db_host_", "localhost");
define("_db_user_", "root");
define("_db_password_", "9868154619man");
define("_db_name_", "app");
define("_host_", getenv("SERVER_NAME") );
*/











/*----------------------------------------------------------
THIS IS DIRECTORY DEFINE AREA

directory define here are 
           -> background image location
           -> cover picture location
           -> profile images location
           -> update images location
-----------------------------------------------------------*/



#background image location
define('_background_image_dir_',"$protocol://$host/signin/user files/background pictures/");

define('_simple_background_image_dir_',"/user files/background pictures/");

#cover picture location
define('_cover_image_dir_',"$protocol://$host/signin/user files/cover pictures/");

define('_simple_cover_image_dir_',"/user files/cover pictures/");

#profile images location
define('_profile_image_dir_',"$protocol://$host/signin/user files/profile pictures/");
define('_profile_original_image_dir_',"$protocol://$host/signin/user files/profile pictures/original/");
define('_profile_large_image_dir_',"$protocol://$host/signin/user files/profile pictures/large/");
define('_profile_medium_image_dir_',"$protocol://$host/signin/user files/profile pictures/medium/");
define('_profile_small_image_dir_',"$protocol://$host/signin/user files/profile pictures/small/");

define('_simple_profile_image_dir_',"/user files/profile pictures/");
define('_simple_profile_original_image_dir_',"/user files/profile pictures/original/");
define('_simple_profile_large_image_dir_',"/user files/profile pictures/large/");
define('_simple_profile_medium_image_dir_',"/user files/profile pictures/medium/");
define('_simple_profile_small_image_dir_',"/user files/profile pictures/small/");

define('_simple2_profile_image_dir_',"user files/profile pictures/");
define('_simple2_profile_original_image_dir_',"user files/profile pictures/original/");
define('_simple2_profile_large_image_dir_',"user files/profile pictures/large/");
define('_simple2_profile_medium_image_dir_',"user files/profile pictures/medium/");
define('_simple2_profile_small_image_dir_',"user files/profile pictures/small/");

#update images location
define("_update_image_dir_","$protocol://$host/signin/user files/update pictures/");
define("_update_medium_image_dir_","$protocol://$host/signin/user files/update pictures medium/");

define("_simple_update_image_dir_","/user files/update pictures/");
define("_simple_update_medium_image_dir_","/user files/update pictures medium/");

#assets location
define("_image_dir_","$protocol://$host/signin/assets/images/");
define("_css_dir_","$protocol://$host/signin/assets/css/");
define("_javascript_dir_","$protocol://$host/signin/assets/javascript/");
define("_php_dir_","$protocol://$host/signin/assets/php/");

define("_simple_image_dir_","/signin/assets/images/");
define("_simple_css_dir_","/signin/assets/css/");
define("_simple_javascript_dir_","/signin/assets/javascript/");
define("_simple_php_dir_","/signin/assets/php/");



#loading image location 
define("_loading_image_",_image_dir_ . "comman/preloader12.gif");

#logo image location
define("_small_site_logo_image_","$protocol://$host/assets/images/comman/logos/logo.png");
define("_large_site_logo_image_","$protocol://$host/assets/images/comman/logos/logo_blue.png");











/********************************************************
THIS IS FUNCTIONING SWITCH AREA

ture/false switch of zimpbox
it can terminate user from using zimpbox services


it can close following features of zimpbox:-
    
    1)  questions                                          -- DONE
    2)  activity , smile status , views , score            -- DONE
    3)  comment , like  , do_comment , do_like             -- DONE                              
    5)  image update                                       -- DONE
    6)  friend suggestion                                  -- DONE
    7)  background - colour , image , upload image         -- DONE
    8)  zimp talk                                          -- DONE
    9)  blocking , privacy , account , security & display  -- DONE
    10) show notification                                  -- DONE
*********************************************************/


//allow questions {working}
define('allow_question',false);//false

//allow activity , smile status , views , score {working}
define('allow_activity_show',false);//false
define('allow_smile_status_show',false);//false
define('allow_views_show',true);
define('allow_score_show',true);

//allow comment and like {working}
define('allow_like',true);
define('allow_comment',false);//false

//allow  image update {working}
define('allow_image_update',true);

//allow friend suggestion {working}
define('allow_friend_suggestion',true);

//allow background colour , image , upload image
define('allow_background_colour',true);
define('allow_background_image',false);//false
define('allow_background_image_upload',true);


//allow zimp_talk   {working}  
define('allow_ai_talk',true);

//allow settings   {working}
define('allow_blocking',false);//false
define('allow_privacy',false);//false
define('allow_display',true);
define('allow_security',true);
define('allow_account',true);
define('allow_disactive_button',false);//false

//SHOW NOTIFICATION {working}
define('allow_notification',false);//false



//allow deleting of images or not  {working}
define('allow_update_image_deletion',true);

#allow update deletion {working}
define('allow_update_deletion',true); 

#allow question deletion {working}
define('allow_question_deletion',true);

#allow profile picture deletion {working}
define('allow_profile_picture_deletion',true);

#allow cover picture deletion {working}
define('allow_cover_picture_deletion',true);







/*********************************************************
THIS IS GENERAL INFORMATINO AREA 
**********************************************************/ 

#TO SET CURRENT DATE
$current_date = date('20y-m-d h:i:s');

#TO SET NO OF WALL FEEDS TO SHOW // working
//default is 10
define("wall_feed_limit" , 10);

#TO SET NO OF BOARD FEEDS TO SHOW //working (FOR EACH CATAGERY)
//default is 10
define("board_feed_limit" , 10);

#TO SET NO OF LIKES TO SHOW // working
define("max_like_result" , 20);

#TO SET NO OF SEARCH TO SHOW // working 
//default as 8
define("max_search_result" , 8); 

#TO SET NO OF FOLLOWING TO SHOW /// working
//default as 12
define("max_following_result" , 12);

#TO SET NO OF FOLLOWERS TO SHOW //// working
//default as 12
define("max_followers_result" , 12);

//this is to tell max friend suggestion to display
//default as 6
define("max_friend_suggestion",6);


//this is to tell max notification to display
//default as 5
define("notification_max_limit",5);



#to set comment limit //// working
//default as 5
define("max_comment_result" , 5);

#to set like limit       ///working
//default as 8
define("max_feed_like_limit", 8);



/////////////////////////////////////////////

#this is to define the site name 
define("site_name","localhost");

#company name
define('company_name',"AlvisAi");

#this is to define the ai name 
define("ai_name","Alvis");















/***************************************************************
other definations of program
*************************************************************/



  





?>