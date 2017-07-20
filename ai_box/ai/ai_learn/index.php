<?php 
/*******************************************************
this algoritham help ai to learn new thing
********************************************************/

?>


<link rel='stylesheet' href='<?php echo _ai_css_dir_; ?>learn-ui.css' >



<textarea class='sample_text_area learn_sample_text' placeholder='Write Text here...'>
today i am very sad, i had a fight with my brother. i love my brother but he fight a lot with me.
</textarea>

<select type='emotions' class='input other_input emotion'>
            <option value=''>Select Emotion Of Text</option>
            <option value='Happy'>Happy</option>
            <option value='Sad' selected>Sad</option>
</select>

<?php 
/*
<input type='reason' class='input other_input reason_of_emotion' placeholder='Reason Of Emotion' autocomplete='off' maxlength='50' style='margin-left:20px;'>
*/
?>

<input type='secret_key' class='input other_input secret_key' placeholder='Secret Key' autocomplete='off' maxlength='50' style='margin-left:20px;'>

<br><BR>

<input type='button' class='button learn_emotion_button' value='Learn Emotions'>






<div class='error'></div>
<div class='result_box'>

</div>


<script type="text/javascript">
              
              $('.learn_emotion_button').click(function(){
                        
                  var learn_sample_text = $('.learn_sample_text').val();
                  var emotion           = $(".emotion").val();
                 // var reason_of_emotion = $(".reason_of_emotion").val();
                  var secret_key        = $(".secret_key").val();
                      
                      if(learn_sample_text.length == 0)
                      {
                              $(".error").show();
                              $(".error").html("Text Error! Text length can't be 0.");	
                      }
                      else if(learn_sample_text.length < 10)
                      {
                              $(".error").show();
                              $('.error').html("Text Error! Minimum length of text should be 10.");
                      }
                      else if(emotion.length == 0)
                      {
                      	      $(".error").show();
                              $('.error').html("Emotion Error! Emotion can't be empty.");
                      }
                     /* else if(reason_of_emotion.length == 0)
                      {
                      	      $(".error").show();
                              $('.error').html("Reason Error! Reason of emotion can't be empty.");
                      }*/
                      else
                      {
                      	 $(".error").hide();
                      	 $(".result_box").show();
                      	 $.post("http://<?php echo $host; ?>/ai_box/ai/ai_learn/test_learn_ai.php",{text:learn_sample_text,
                                                                                                  emotion:emotion,
                      	 	                                                                        secret_key:secret_key
                      	 	                                                                        },function(test_learn_ai){
                                   
                                     $(".result_box").html(test_learn_ai);

                      	 });

                      }
 
              });


</script>



