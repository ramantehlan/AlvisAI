<?php

/****************************************************************
this is to edit the comment
****************************************************************/

session_start();

if(isset($_SESSION['user_id']) && isset($_POST['new_comment']) && isset($_POST['comment_no']) && isset($_POST['display_change_area']) && isset($_POST['refresh_comment_holder']))
{
	 #including needed files
   include "../../../../includes/config.inc.php";
	 include "../../../../includes/text_filter.lib.php";
   
   #creating object to fileter text
   $text_filter = new text_filter();
  
  #giving values

  #normal comment mean commant without any basic filter
  $normal_comment         = $_POST['new_comment'];
  $new_comment            = htmlentities($_POST['new_comment']);
  $new_comment            = addslashes($new_comment);
  #comment_no is id of comment
  $comment_no             = $_POST['comment_no'];
  #display_change_area is area where the comment was done 
  $display_change_area    = $_POST['display_change_area'];
  #refresh_comment_holder is hidden input to hold normal_comment for furthur change 
  $refresh_comment_holder = $_POST['refresh_comment_holder'];


  //simple mysqli code to update comment
  $code_to_update_the_comment = "UPDATE  `$db_name`.`users_comments` SET  `comment` =  '$new_comment' WHERE  `users_comments`.`no` = $comment_no";
  mysqli_query($connect , $code_to_update_the_comment);


#applying filter to the comment 
$new_comment        = $text_filter -> convert_hash_tags($new_comment);
$new_comment        = $text_filter -> convert_at_tags($new_comment);
$new_comment        = $text_filter -> convert_smiles($new_comment);


//making the change happen to page
        $feed_box_comment_edit = <<< EOFILE
        <input type = 'hidden' class='new_comment_for_script' value="$new_comment">
        <input type = 'hidden' class='normal_comment_for_script' value='$normal_comment'>
  <script>    
              var new_comment = $('.new_comment_for_script').val();
              var normal_comment = $('.normal_comment_for_script').val();

              $(".$display_change_area").html(new_comment);
              $(".$refresh_comment_holder").val(normal_comment);
  </script>
EOFILE;

echo $feed_box_comment_edit;


}
else
{
	echo "<div class='comment_msg'>Error! incomplete information.</div>";
}


?>