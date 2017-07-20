<?php
/**************************************************8
this file is to do comment on a feed  

creator: Raman Tehlan
*************************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['comment']) && isset($_POST['target']) && isset($_POST['target_no']) )
{

//to include needed files
include "../../../../includes/config.inc.php";
include "../../../../includes/text_filter.lib.php";
include "../../../../includes/update_user_activity.lib.php";

//creating object to update user activity
$update_user_activity = new update_user_activity();

//creating object to filter text
$text_filter = new text_filter();


//assigning values
$id        = $_SESSION['user_id'];
$comment   = htmlentities($_POST['comment']);
$comment   = addslashes($comment);

//target tell that comment is done on qusetion or update
// a => comment is done on update
// b => comment is done on question
$target    = $_POST['target'];

//target no tell the id of question or update
$target_no = $_POST['target_no'];



//to insert data in data base
$code_to_add_comment = "INSERT INTO `$db_name`.`users_comments` (`no`, `target`, `target_no`, `commenter_id`, `comment`, `date`) VALUES (NULL, '$target', '$target_no', '$id', '$comment', '$current_date')";
mysqli_query($connect , $code_to_add_comment);

            //this is to add the score
            $update_user_activity -> add_score('comment_action');



/*************************************
below program is to return the comment 
back to display it
*************************************/


$get_commenter_info = mysqli_fetch_array(mysqli_query($connect , "SELECT * FROM `$db_name`.`users` where id = $id"));

$commenter_name     = $get_commenter_info['name'];
$commenter_username = $get_commenter_info['username'];
$commenter_profile_pic    = $get_commenter_info['profile_pic'];

                                             if($commenter_profile_pic == '' || file_exists("../../.." . _simple_profile_medium_image_dir_ .  $commenter_profile_pic) != 1 )
                                                {
                                                    $commenter_profile_pic = "default.jpg";
                                                }



$comment        = $text_filter -> convert_hash_tags($comment);
$comment        = $text_filter -> convert_at_tags($comment);
$comment        = $text_filter -> convert_smiles($comment);

$date           = $text_filter -> round_date($current_date);


/*

                                                                 <div class='list_option_of_comment' title='Edit'>Edit</div>
                                                                 <div class='list_option_of_comment' title='Delete'>Delete</div>
*/

echo "                                  <div class='comment_of_friends_box'>
                                                <div class='commenter_photo comment_shadow' title='$commenter_name'>
                                                          <a href='http://$host/$commenter_username'><img src='" . _profile_medium_image_dir_ . "$commenter_profile_pic'></a>
                                                </div>
                                                 
                                                <div class='comment_by_the_commenter comment_shadow'>
                                                         <div class='name_of_commenter_in_comment_box overflow capital'><a href='http://$host/$commenter_username'>$commenter_name</a></div>
                                                           
                                                                  <div class='main_comment'>$comment</div>

                                                        <div class='option_of_comment'>
                                                                 <div class='time_of_comment' title='$current_date'><div class='img_of_clock_on_comment'></div>$date</div>
                                                         </div> 
                                                         
                                                </div>
                                                
                                      </div>";


}
else
{
	echo "<div class='comment_msg'>Error! incomplete information.</div>";
}











?>