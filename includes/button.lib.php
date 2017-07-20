<?php

/**********************************************************
this program is to create buttons for zimpbox operations
like 
    1) create_friend_button

creator:-          Raman Tehlan
Date of creation:- 13/05/2015
***********************************************************/


class button
{
	 /***************************************************
	     $no is to tell the button value
       $id is first user id 
       $s_id is second user id
       $action is weather to refresh or delete the box
       $box is if action is to delete the box then this is the box to delete
       $class is to add a class to button
	 *************************************************/
      
    function create_friend_button($no , $id , $s_id , $action , $box , $class)
    {
           global $host , $db_name , $connect;
            
           $user_id = $_SESSION['user_id'];


           $check_friend_no      = mysqli_num_rows(mysqli_query($connect , "SELECT * from `$db_name`.`users_friends` where following_id = '$s_id' and follower_id = '$id'"));


                 
                                        switch ($action) {
                                              case 'delete':
                                                         $action = "$('.$box').remove();";
                                              	break;
                                                 case 'refresh':
                                                         $action = "window.location.reload(!0);";
                                                  break;
                                                 default:
                                                        $action = "";
                                              	break;
                                             }


                                   /*******************************************
                                       this is to check is userching his own box
                                   **********************************************/
                                        if($user_id == $s_id)
                                        {
                                        	$button = "<div class='unfollow_button button_2 $class  button_no_$no' >YOU</div>";
                                        }
                       
                                       else if($check_friend_no == 0) // case we are not following him
                                       {



                                   $button = <<< EOFILE

                           <div class='follow_button button_2 $class  button_no_$no' >Follow</div>

                             <script>
                                         
                                        $('.button_no_$no').click(function(){
                                                    
                                              $('html').css('cursor','wait');
                                              var follow_but = $('.button_no_$no');
                                              follow_but.css('cursor','wait');
                                              
                                                           $.post("http://$host/signin/assets/php/comman/follow_user.php",{wall_user_id:$s_id},function(follow){
                                                              
                                                              follow_but.html(follow);

                                                              $('html').css('cursor','default');
                                                              follow_but.css('cursor','pointer');
                                                              $action
                                                             
                                                              });
                                        });
                                         
                                            
                                  
                             </script>   

EOFILE;
                                       }

                                       else  // case when we are following him
                                         {

                                          $button = <<< EOFILE
                           <div class='unfollow_button button_2 $class button_no_$no'>Following</div>

                          <script>

                            $(".button_no_$no").hover(function(){
                                  $(".button_no_$no").html('Unfollow');  
                            },function(){
                                  $(".button_no_$no").html('Following');  
                            });

                            $('.button_no_$no').click(function(){
                                        
                                        $('html').css('cursor','wait');
                                        var button_no_$no = $('.button_no_$no');
                                        button_no_$no.css('cursor','wait');

                                            $.post("http://$host/signin/assets/php/comman/unfollow_user.php",{wall_user_id:$s_id},function(unfollow){
                                             
                                                button_no_$no.html(unfollow);

                                                $('html').css('cursor','default');
                                                button_no_$no.css('cursor','default');
                                                $action;
                                                  
                                            });


                            });


             
                          </script>


EOFILE;

}// end of else

    return $button;

    }//end of function create_friend_button

}// end of class

?>